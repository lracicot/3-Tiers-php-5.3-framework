<?php

namespace projet8\modules;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/entities/author.php');
require_once(APPPATH.'/entities/categorie.php');
require_once(APPPATH.'/entities/sous_categorie.php');

class Author_model
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
            $getAuthor = $this->db->prepare('SELECT * FROM shop_auteurs WHERE id = :id_auteur');
            $getAuthor->bindParam(':id_auteur', $id);
            $getAuthor->execute();

            $author = $getAuthor->fetchObject('\projet8\entities\Author', array($this->db));

            return $author;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function find_all($limit = false)
    {
        try
        {
            $getAuthor = $this->db->prepare('SELECT * FROM shop_auteurs' . (($limit) ? ' LIMIT ' . $limit : '') );
            $getAuthor->execute();

            $authors = $getAuthor->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Author', array($this->db));

            return $authors;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}