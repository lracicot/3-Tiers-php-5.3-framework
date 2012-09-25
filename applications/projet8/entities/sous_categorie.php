<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class SousCategorie extends Entity
{
	private $id;
    private $libelle;
    private $parent;

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

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

    public function getCategorieObj()
    {
        $getCategorie = $this->db->prepare('SELECT * FROM shop_categorie WHERE id = :id_categorie');
        $getCategorie->bindParam(':id_categorie', $this->getParent());
        $getCategorie->execute();

        return $getCategorie->fetchObject('\projet8\entities\Categorie', array($this->db));
    }

    public function getBooks($limit = false)
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE sous_categorie = :sous_categorie' .
                (($limit) ? ' LIMIT '.$limit : ''));
        $getBooks->bindParam(':sous_categorie', $this->getId());
        $getBooks->execute();

        return $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));
    }

    public function getBooksExcept($except, $limit = false)
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE sous_categorie = :sous_categorie' .
                ' AND id <> :except' .
                (($limit) ? ' LIMIT '.$limit : ''));
        $getBooks->bindParam(':sous_categorie', $this->getId());
        $getBooks->bindParam(':except', $except);
        $getBooks->execute();

        return $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));
    }

}