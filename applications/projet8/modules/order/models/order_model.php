<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/entities/order.php');
require_once(APPPATH.'/entities/order_line.php');

class Order_model
{
    private $controller;
    private $db;

    public function __construct($database, $controller)
    {
        $this->db = $database;
        $this->controller = $controller;
    }

    public function find($id)
    {
        try
        {
            $getOrder = $this->db->prepare('SELECT * FROM shop_commande WHERE id = :id_commande');
            $getOrder->bindParam(':id_commande', $id);
            $getOrder->execute();

            $order = $getOrder->fetchObject('\projet8\entities\Order', array($this->db));

            return $order;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function find_all()
    {
        try
        {
            $getOrders = $this->db->prepare('SELECT * FROM shop_commande');
            $getOrders->execute();

            $orders = $getOrders->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Order', array($this->db));

            return $orders;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}