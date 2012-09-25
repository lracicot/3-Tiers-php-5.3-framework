<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;

class Book extends Entity
{
	private $id;
	private $isbn;
	private $categorie;
	private $sous_categorie;
	private $titre;
	private $prix_ht;
	private $prix_ttc;
	private $parution;
	private $resume;
	private $auteur;

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

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function getSousCategorie() {
        return $this->sous_categorie;
    }

    public function setSousCategorie($sousCategorie) {
        $this->sous_categorie = $sousCategorie;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getPrixHt() {
        return $this->prix_ht;
    }

    public function setPrixHt($prixHt) {
        $this->prix_ht = $prixHt;
    }

    public function getPrixTtc() {
        return $this->prix_ttc;
    }

    public function setPrixTtc($prixTtc) {
        $this->prix_ttc = $prixTtc;
    }

    public function getParution() {
        return $this->parution;
    }

    public function setParution($parution) {
        $this->parution = $parution;
    }

    public function getResume() {
        return $this->resume;
    }

    public function setResume($resume) {
        $this->resume = $resume;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function getAuteurObj()
    {
        $getAuthor = $this->db->prepare('SELECT * FROM shop_auteurs WHERE id = :id_author');
        $getAuthor->bindParam(':id_author', $this->getAuteur());
        $getAuthor->execute();

        return $getAuthor->fetchObject('\projet8\entities\Author', array($this->db));
    }

    public function getCategorieObj()
    {
        $getCategorie = $this->db->prepare('SELECT * FROM shop_categorie WHERE id = :id_categorie');
        $getCategorie->bindParam(':id_categorie', $this->getCategorie());
        $getCategorie->execute();

        return $getCategorie->fetchObject('\projet8\entities\Categorie', array($this->db));
    }

    public function getSousCategorieObj()
    {
        $getSousCategorie = $this->db->prepare('SELECT * FROM shop_sous_categorie WHERE id = :id_sous_categorie');
        $getSousCategorie->bindParam(':id_sous_categorie', $this->getSousCategorie());
        $getSousCategorie->execute();

        return $getSousCategorie->fetchObject('\projet8\entities\SousCategorie', array($this->db));
    }

}