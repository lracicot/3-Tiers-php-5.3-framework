<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class Cart_item extends Entity
{
    private $cart = null;

    private $id = 0;
	private $quantite = 1;
	private $article = 0;

    public function __construct($db, $cart)
    {
        $this->db = $db;
        $this->cart = $cart;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setArticle($book_id) {
        $this->article = $book_id;
    }

    public function getArticle() {

        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE id = :article');
        $getBooks->bindParam(':article', $this->article);
        $getBooks->execute();

        return $getBooks->fetchObject('\projet8\entities\Book', array($this->db));
    }

    public function save($client = 0)
    {
        try
        {
            if ($this->id)
            {
                $setCart = $this->db->prepare('UPDATE shop_panier SET client = :client, article = :article, quantite = :quantite
                    WHERE id = :id');

                $setCart->bindParam(':id', $this->getId());
            }
            else
            {
                $setCart = $this->db->prepare('INSERT INTO shop_panier (client, article, quantite)
                    VALUES (:client, :article, :quantite)');
            }

            $setCart->bindParam(':client', $client);
            $setCart->bindParam(':article', $this->article);
            $setCart->bindParam(':quantite', $this->getQuantite());

            $setCart->execute();
        }
        catch (Exception $e)
        {
            $cart->notifyError($e, __METHOD__);
        }
    }

}