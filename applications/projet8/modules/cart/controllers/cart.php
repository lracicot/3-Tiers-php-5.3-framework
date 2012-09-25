<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/cart.php');
require_once(APPPATH.'/entities/cart_item.php');
require_once(APPPATH.'/entities/order.php');
require_once(APPPATH.'/entities/order_line.php');
require_once(APPPATH.'/modules/category/models/category_model.php');
require_once(APPPATH.'/modules/cart/models/cart_model.php');

class Cart extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);
        
        $this->model = new user_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function add($book_id = 0, $confirm = false)
    {
        $this->layout = 'ajax';
        
        if (!$this->authentification->getAuthData()->getId())
        {
            $this->output('add_item_login', $this->data);
        }
        else
        {
            $item = new \projet8\entities\Cart_item($this->db, $this->cart);
            $item->setArticle((int)$book_id);
            $added = $this->cart->addItem($item, $confirm);

            if ($added)
            {
                $this->cart->save();
                $this->output('add_item_confirm', $this->data);
            }
            else
            {
                $this->data['product'] = $book_id;
                $this->output('add_item_quantity', $this->data);
            }
        }
    }

    public function remove($book_id = 0)
    {
        $this->cart->removeItem($book_id);

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function checkout()
    {
        $this->output('checkout', $this->data);
    }

    public function confirm()
    {
        $order = new \projet8\entities\Order($this->db);
        $order->setClient($this->authentification->userdata('user_id'));
        $order->setDate(date('Y-m-d'));
        $order->setExpedition('S');

        $order_total_ht = 0;
        $order_total_ttc = 0;

        foreach ($this->cart->getItems() as $item)
        {
            $line = new \projet8\entities\OrderLine($this->db);
            $line->setPrix_ht($item->getArticle()->getPrixHt());
            $line->setPrix_ttc($item->getArticle()->getPrixTtc());
            $line->setArticle($item->getArticle()->getId());
            $line->setQuantite($item->getQuantite());
            $line->setTotal_ht($item->getArticle()->getPrixHt() * $item->getQuantite());
            $order_total_ht += $item->getArticle()->getPrixHt() * $item->getQuantite();
            $line->setTotal_ttc($item->getArticle()->getPrixTtc() * $item->getQuantite());
            $order_total_ttc += $item->getArticle()->getPrixTtc() * $item->getQuantite();

            $order->addLine($line);
        }
        
        $order->setTotal_ht($order_total_ht);
        $order->setTotal_ttc($order_total_ttc);

        $order_id = $order->save($this->authentification->userdata('user_id'));

        $this->cart->purge();


        header("Location: http://website.localhost/projet8/order/".$order_id);
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }

    /**
     * AJAX ONLY
     *
     * @param <type> $method
     */
    public function getNbItems()
    {
        echo count($this->cart->getItems());
    }
    
    /**
     * AJAX ONLY
     *
     * @param <type> $method
     */
    public function update_all()
    {
        $items = json_decode($_POST['items']);

        $this->cart->purge();

        foreach ($items as $itemData)
        {
            $item = new \projet8\entities\Cart_item($this->db, $this->cart);
            $item->setArticle($itemData->article);
            $item->setQuantite($itemData->quantite);

            $this->cart->addItem($item);
        }

        $this->cart->save();
    }
}