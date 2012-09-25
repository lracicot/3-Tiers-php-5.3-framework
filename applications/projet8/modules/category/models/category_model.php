<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/entities/author.php');
require_once(APPPATH.'/entities/categorie.php');
require_once(APPPATH.'/entities/sous_categorie.php');

class Category_model
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
            $getCategorie = $this->db->prepare('SELECT * FROM shop_categorie WHERE id = :id_categorie');
            $getCategorie->bindParam(':id_categorie', $id);
            $getCategorie->execute();

            $categorie = $getCategorie->fetchObject('\projet8\entities\Categorie', array($this->db));

            return $categorie;
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
            $getCategories = $this->db->prepare('SELECT * FROM shop_categorie');
            $getCategories->execute();

            $categories = $getCategories->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Categorie', array($this->db));

            return $categories;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}