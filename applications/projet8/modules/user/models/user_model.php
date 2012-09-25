<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/user.php');

class User_model
{
    private $controller;
    private $db;

    public function __construct($database, $controller)
    {
        $this->db = $database;
        $this->controller = $controller;
    }

    public function create($data = array())
    {
        $user = new \projet8\entities\User($this->db, $this);
        $user->setMail($_POST['email']);
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setTelephone($_POST['tel']);
        $user->setMdp($_POST['passwd1'], $_POST['passwd2']);
        $user->setAd_ligne1($_POST['ad_l1']);
        $user->setAd_ligne2($_POST['ad_l2']);
        $user->setAd_cp($_POST['zip_code']);
        $user->setAd_ville($_POST['ville']);

        return $user;
    }

    public function save(\projet8\entities\User $user)
    {
        try
        {
            $setUser = $this->db->prepare('INSERT INTO shop_client (mail, nom, prenom, telephone, mdp, ad_ligne1, ad_ligne2, ad_cp, ad_ville)
                VALUES (:mail, :nom, :prenom, :telephone, :mdp, :ad_ligne1, :ad_ligne2, :ad_cp, :ad_ville)');

            $setUser->bindParam(':mail', $user->getMail());
            $setUser->bindParam(':nom', $user->getNom());
            $setUser->bindParam(':prenom', $user->getPrenom());
            $setUser->bindParam(':telephone', $user->getTelephone());
            $setUser->bindParam(':mdp', md5($user->getMdp()));
            $setUser->bindParam(':ad_ligne1', $user->getAd_ligne1());
            $setUser->bindParam(':ad_ligne2', $user->getAd_ligne2());
            $setUser->bindParam(':ad_cp', $user->getAd_cp());
            $setUser->bindParam(':ad_ville', $user->getAd_ville());

            $setUser->execute();
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function find($id)
    {
        try
        {
            $getUser = $this->db->prepare('SELECT * FROM shop_client WHERE id = :id_client');
            $getUser->bindParam(':id_client', $id);
            $getUser->execute();

            $user = $getUser->fetchObject('\projet8\entities\User', array($this->db, $this));

            return $user;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function login($email, $passwd)
    {
        try
        {
            $getUser = $this->db->prepare('SELECT * FROM shop_client WHERE mail = :email AND mdp = :passwd');
            $getUser->bindParam(':email', $email);
            $getUser->bindParam(':passwd', md5($passwd));
            $getUser->execute();

            $user = $getUser->fetchObject('\projet8\entities\User', array($this->db, $this));

            return $user;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function isEmailExist($email)
    {
        try
        {
            $getemail = $this->db->prepare('SELECT COUNT(*) AS num_row FROM shop_client WHERE mail = :mail');
            $getemail->bindParam(':mail', $email);
            $getemail->execute();

            $email = $getemail->fetch();

            return (bool)$email['num_row'];
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}