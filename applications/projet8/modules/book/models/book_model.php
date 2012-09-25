<?php

namespace projet8\modules;
//use projet8\entities\Book;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/entities/author.php');
require_once(APPPATH.'/entities/categorie.php');
require_once(APPPATH.'/entities/sous_categorie.php');

class Book_model
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
            $getBook = $this->db->prepare('SELECT * FROM shop_livres WHERE id = :id_livre');
            $getBook->bindParam(':id_livre', $id);
            $getBook->execute();

            $book = $getBook->fetchObject('\projet8\entities\Book', array($this->db));

            return $book;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function delete($id)
    {
        $deleteBook = $this->db->prepare('DELETE FROM shop_livres WHERE id = :id_livre');
        $deleteBook->bindParam(':id_livre', $id);
        $deleteBook->execute();
    }

    public function save(Book $book)
    {
        $setBook = $this->db->prepare('UPDATE shop_livres SET
            isbn = :isbn,
            categorie = :categorie,
            sous_categorie = :sous_categorie,
            prix_ht = :prix_ht,
            prix_ttc = :prix_ttc,
            parution = :parution,
            resume = :resume,
            auteur = :auteur
            WHERE id = :id');

        $setBook->bindParam(':id', $book->getId());
        $setBook->bindParam(':isbn', $book->getIsbn());
        $setBook->bindParam(':categorie', $book->getCategorie());
        $setBook->bindParam(':sous_categorie', $book->getSousCategorie());
        $setBook->bindParam(':prix_ht', $book->getPrixHt());
        $setBook->bindParam(':prix_ttc', $book->getPrixTtc());
        $setBook->bindParam(':parution', $book->getParution());
        $setBook->bindParam(':resume', $book->getResume());
        $setBook->bindParam(':auteur', $book->getAuteur());

        $setBook->execute();
}

    public function find_all($limit = false)
    {
        try
        {
            $getBooks = $this->db->prepare('SELECT * FROM shop_livres' . (($limit) ? ' LIMIT ' . $limit : '') );
            $getBooks->execute();

            $books = $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));

            return $books;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }

    public function select_search($keywords = array())
    {
        try
        {
            $q = 'SELECT * FROM shop_livres WHERE';

            for($i=0; $i<count($keywords); $i++)
            {
                $q .= ' (`titre` LIKE :title'.$i.' OR `resume` LIKE :resume'.$i.') AND';
            }

            $getBooks = $this->db->prepare(substr($q, 0, -4));

            for($i=0; $i<count($keywords); $i++)
            {
                $keyword = "%".$keywords[$i]."%";
                $getBooks->bindValue(':title'.$i, $keyword);
                $getBooks->bindValue(':resume'.$i, $keyword);
            }

//            var_dump($getBooks->debugDumpParams());die();
            $getBooks->execute();
//            var_dump($getBooks->getLastQuery());die();

            $books = $getBooks->fetchAll(\PDO::FETCH_CLASS, '\projet8\entities\Book', array($this->db));

            return $books;
        }
        catch (Exception $e)
        {
            $controller->notifyError($e, __METHOD__);
        }
    }
}