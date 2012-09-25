<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class OrderLine extends Entity
{
    private $id = 0;
    private $commande;
    private $article;
    private $prix_ht;
    private $prix_ttc;
    private $quantite;
    private $total_ht;
    private $total_ttc;

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

    public function getCommande() {
        return $this->commande;
    }

    public function setCommande($commande) {
        $this->commande = $commande;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article) {
        $this->article = $article;
    }

    public function getPrix_ht() {
        return $this->prix_ht;
    }

    public function setPrix_ht($prix_ht) {
        $this->prix_ht = $prix_ht;
    }

    public function getPrix_ttc() {
        return $this->prix_ttc;
    }

    public function setPrix_ttc($prix_ttc) {
        $this->prix_ttc = $prix_ttc;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
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

    public function getCommandeObj()
    {
        $getCategorie = $this->db->prepare('SELECT * FROM shop_commande WHERE id = :commande');
        $getCategorie->bindParam(':commande', $this->getCommande());
        $getCategorie->execute();

        return $getCategorie->fetchObject('\projet8\entities\Order', array($this->db));
    }

    public function getArticleObj()
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE id = :article');
        $getBooks->bindParam(':article', $this->article);
        $getBooks->execute();

        return $getBooks->fetchObject('\projet8\entities\Book', array($this->db));
    }

    public function save($order_id)
    {
        try
        {
            if ($this->id)
            {
                $setOrderLine = $this->db->prepare('UPDATE shop_ligne_commande SET
                    commande = :commande,
                    article = :article,
                    prix_ht = :prix_ht,
                    prix_ttc = :prix_ttc,
                    quantite = :quantite,
                    total_ht = :total_ht,
                    total_ttc = :total_ttc
                    WHERE id = :id');

                $setOrderLine->bindParam(':id', $this->getId());
            }
            else
            {
//                var_dump($this->getArticle());die();
//                $setOrderLine = $this->db->prepare('INSERT INTO shop_ligne_commande (commande, article, prix_ht, prix_ttc, quantite, total_ht, total_ttc)
//                    VALUES ("'.$order_id.'", :article, :prix_ht, :prix_ttc, :quantite, :total_ht, :total_ttc)');
                $setOrderLine = $this->db->prepare('INSERT INTO shop_ligne_commande (commande, article, prix_ht, prix_ttc, quantite, total_ht, total_ttc)
                    VALUES ("'.$order_id.'", "'.$this->getArticle().'", "'.$this->getPrix_ht().'", "'.$this->getPrix_ttc().'", "'.$this->getQuantite().'", "'.$this->getTotal_ht().'", "'.$this->getTotal_ttc().'")');
            }

//            $setOrderLine->bindParam(':commande', );
//            $setOrderLine->bindParam(':article', $this->getArticle());
//            $setOrderLine->bindParam(':prix_ht', $this->getPrix_ht());
//            $setOrderLine->bindParam(':prix_ttc', $this->getPrix_ttc());
//            $setOrderLine->bindParam(':quantite', $this->getQuantite());
//            $setOrderLine->bindParam(':total_ht', $this->getTotal_ht());
//            $setOrderLine->bindParam(':total_ttc', $this->getTotal_ttc());

//        var_dump($setOrderLine);die();
            $setOrderLine->execute();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

}