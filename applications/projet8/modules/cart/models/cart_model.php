<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/cart.php');
require_once(APPPATH.'/entities/cart_item.php');

class Cart_model
{
    private $controller;
    private $db;

    public function __construct($database, $controller)
    {
        $this->db = $database;
        $this->controller = $controller;
    }

    public function getCart($client_id)
    {
        $cart = new \projet8\entities\cart($this->db, $client_id);
//$this->_getCartItems($cart, $client_id);
        foreach ($this->_getCartItems($cart) AS $item)
        {
            $cart->addItem($item);
        }

        return $cart;
    }

    private function _getCartItems(\projet8\entities\cart $cart)
    {
        $getItem = $this->db->prepare('SELECT * FROM shop_panier WHERE client = :client');
        $getItem->bindParam(':client', $cart->getClient());
        $getItem->execute();

        return $getItem->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Cart_item', array($this->db, $cart));
    }
}