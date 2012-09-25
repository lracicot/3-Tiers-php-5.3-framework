<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/order.php');
require_once(APPPATH.'/modules/order/models/order_model.php');
require_once(APPPATH.'/modules/category/models/category_model.php');

class Order extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);

        $this->model = new order_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function listing()
    {
        if ($this->authentification->userdataExist('user_id'))
        {
            $this->data['orders'] = $this->model->find_all($this->authentification->userdata('user_id'));
            $this->output('order/listing', $this->data);
        }
        else
        {
            header("Location: http://website.localhost/projet8");
        }
    }

    public function show($id)
    {
        $this->data['order'] = $this->model->find($id);
        
        $this->output('order/show', $this->data);
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }
}