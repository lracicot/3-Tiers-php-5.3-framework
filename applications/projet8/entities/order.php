<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;
require_once(APPPATH.'/entities/order_line.php');

class Order extends Entity
{
    private $id;
    private $client;
    private $date;
    private $total_ht;
    private $total_ttc;
    private $expedition;

    private $order_lines = array();

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getTotal_ht() {
        return $this->total_ht;
    }

    public function setTotal_ht($total_ht) {
        $this->total_ht = $total_ht;
    }

    public function getTotal_ttc() {
        return $this->total_ttc;
    }

    public function setTotal_ttc($total_ttc) {
        $this->total_ttc = $total_ttc;
    }

    public function getExpedition() {
        return $this->expedition;
    }

    public function setExpedition($expedition) {
        $this->expedition = $expedition;
    }

    public function getOrderLines()
    {
        $getLines = $this->db->prepare('SELECT * FROM shop_ligne_commande WHERE commande = :commande');
        $getLines->bindParam(':commande', $this->getId());
        $getLines->execute();

        return $getLines->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\OrderLine', array($this->db));
    }

    public function addLine(OrderLine $line)
    {
        $this->order_lines[] = $line;
    }

    public function save($client_id)
    {
        if ($this->id)
        {
            $setOrder = $this->db->prepare('UPDATE shop_commande SET
                client = :client,
                date = :date,
                total_ht = :total_ht,
                total_ttc = :total_ttc,
                expedition = :expedition
                WHERE id = :id');

            $setOrder->bindParam(':id', $this->getId());
        }
        else
        {
            $setOrder = $this->db->prepare('INSERT INTO shop_commande (client, date, total_ht, total_ttc, expedition)
                VALUES (:client, :date, :total_ht, :total_ttc, :expedition)');
        }

        $setOrder->bindParam(':client', $this->getClient());
        $setOrder->bindParam(':date', $this->getDate());
        $setOrder->bindParam(':total_ht', $this->getTotal_ht());
        $setOrder->bindParam(':total_ttc', $this->getTotal_ttc());
        $setOrder->bindParam(':expedition', $this->getExpedition());

        $setOrder->execute();

        $order_id = ($this->getId()) ? $this->getId() : $this->db->lastInsertId();

        foreach ($this->order_lines as $line)
        {
            $line->save($order_id);
        }

        return $order_id;
    }
}