<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class Categorie extends Entity
{
	private $id;
    private $libelle;

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

    public function getBooks()
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE categorie = :categorie');
        $getBooks->bindParam(':categorie', $this->getId());
        $getBooks->execute();

        return $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));
    }

    public function getSousCategorie()
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_sous_categorie WHERE parent = :id_categorie');
        $getBooks->bindParam(':id_categorie', $this->getId());
        $getBooks->execute();

        return $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\SousCategorie', array($this->db));
    }

}