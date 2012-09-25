<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class cart extends Entity
{
    private $client = 0;
    private $cart_items = array();

    public function __construct($db, $client)
    {
        $this->client = $client;
        $this->db = $db;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function getItems()
    {
        return $this->cart_items;
    }

    public function purge()
    {
        $getItem = $this->db->prepare('DELETE FROM shop_panier WHERE client = :client');
        $getItem->bindParam(':client', $this->getClient());
        $getItem->execute();

        $this->cart_items = array();
    }

    public function removeItem($item_id)
    {

        foreach ($this->cart_items as $key => $cart_item)
        {
            if ($cart_item->getArticle()->getId() == $item_id)
            {
                $getItem = $this->db->prepare('DELETE FROM shop_panier WHERE client = :client AND article = :article');
                $getItem->bindParam(':client', $this->getClient());
                $getItem->bindParam(':article', $item_id);
                $getItem->execute();

                unset($this->cart_items[$key]);
            }
        }
    }

    public function addItem(cart_item $item, $confirm = false)
    {
        foreach ($this->cart_items as $cart_item)
        {
            if ($cart_item->getArticle()->getId() == $item->getArticle()->getId())
            {
                if ($confirm)
                {
                    $cart_item->setQuantite($cart_item->getQuantite() + $item->getQuantite());
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        
        $this->cart_items[] = $item;
        return true;
    }

    public function save()
    {
        foreach ($this->cart_items as $item)
        {
            $item->save($this->client);
        }
    }

}