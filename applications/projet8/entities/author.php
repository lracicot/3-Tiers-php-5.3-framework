<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class Author extends Entity
{
	private $id;
	private $nom;
	private $prenom;

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

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getBooks()
    {
        $getBooks = $this->db->prepare('SELECT * FROM shop_livres WHERE auteur = :id_auteur');
        $getBooks->bindParam(':id_auteur', $this->getId());
        $getBooks->execute();

        return $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));
    }
}