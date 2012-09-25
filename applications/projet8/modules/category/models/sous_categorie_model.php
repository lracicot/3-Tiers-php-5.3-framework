<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/entities/author.php');
require_once(APPPATH.'/entities/categorie.php');
require_once(APPPATH.'/entities/sous_categorie.php');

class SousCategory_model
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
            $getSousCategorie = $this->db->prepare('SELECT * FROM shop_sous_categorie WHERE id = :id_sous_categorie');
            $getSousCategorie->bindParam(':id_sous_categorie', $id);
            $getSousCategorie->execute();

            $sousCategorie = $getSousCategorie->fetchObject('\projet8\entities\SousCategorie', array($this->db));

            return $sousCategorie;
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
            $getSousCategories = $this->db->prepare('SELECT * FROM shop_sous_categorie');
            $getSousCategories->execute();

            $sousCategories = $getSousCategories->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\SousCategorie', array($this->db));

            return $sousCategories;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}