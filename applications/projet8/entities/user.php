<?php
namespace projet8\entities;
use \lrcore\libraries\Entity;
use \lrcore\libraries\DataStorage;

class User extends Entity implements DataStorage
{
	private $id;
	private $mail;
	private $nom;
	private $prenom;
	private $telephone;
	private $mdp;
	private $ad_ligne1;
	private $ad_ligne2;
	private $ad_cp;
	private $ad_ville;

    private $model = null;

    public function __construct($db, $model = null)
    {
        $this->db = $db;
        $this->model = $model;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        if ($mail == '')
        {
            $this->_errors['mail'] = 'Le email est requis';
        }
        elseif (!preg_match('/^[^@]*@[^@]*\.[^@]*$/', $mail))
        {
            $this->_errors['mail'] = 'Le email n\'est pas valide';
        }
        elseif ($this->model->isEmailExist($mail))
        {
            $this->_errors['mail'] = 'Cette adresse email existe déjà dans le système.';
        }

        $this->mail = $mail;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        if ($nom == '')
        {
            $this->_errors['nom'] = 'Le nom est requis';
        }
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        if ($prenom == '')
        {
            $this->_errors['prenom'] = 'Le prenom est requis';
        }
        $this->prenom = $prenom;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        if ($telephone == '')
        {
            $this->_errors['telephone'] = 'Le telephone est requis';
        }
        $this->telephone = $telephone;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp, $mdp2) {
        if ($mdp == '')
        {
            $this->_errors['mdp'] = 'Le mot de passe est requis';
        }
        if ($mdp != $mdp2)
        {
            $this->_errors['mdp'] = 'Le mot de passe est requis';
        }
        $this->mdp = $mdp;
    }

    public function getAd_ligne1() {
        return $this->ad_ligne1;
    }

    public function setAd_ligne1($ad_ligne1) {
        if ($ad_ligne1 == '')
        {
            $this->_errors['ad_ligne1'] = 'L\'adresse ligne 1 est requise';
        }
        $this->ad_ligne1 = $ad_ligne1;
    }

    public function getAd_ligne2() {
        return $this->ad_ligne2;
    }

    public function setAd_ligne2($ad_ligne2) {
        $this->ad_ligne2 = $ad_ligne2;
    }

    public function getAd_cp() {
        return $this->ad_cp;
    }

    public function setAd_cp($ad_cp) {
        if ($ad_cp == '')
        {
            $this->_errors['ad_cp'] = 'Le code postal est requis';
        }
        $this->ad_cp = $ad_cp;
    }

    public function getAd_ville() {
        return $this->ad_ville;
    }

    public function setAd_ville($ad_ville) {
        if ($ad_ville == '')
        {
            $this->_errors['ad_ville'] = 'La ville est requise';
        }
        $this->ad_ville = $ad_ville;
    }

    public function getData($id = false)
    {
        return $this;
    }

    public function purgeData($id)
    {
        $this->id = false;
    }


}