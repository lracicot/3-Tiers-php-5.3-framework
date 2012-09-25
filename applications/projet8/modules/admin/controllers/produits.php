<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/modules/category/models/category_model.php');
require_once(APPPATH.'/modules/category/models/sous_categorie_model.php');
require_once(APPPATH.'/modules/author/models/author_model.php');
require_once(APPPATH.'/modules/book/models/book_model.php');

class Produits extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);
        
        $this->model = new book_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);
        $this->author_model = new author_model($this->db, $this);
        $this->sous_categorie_model = new SousCategory_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function listing()
    {
        $this->data['books'] = $this->model->find_all();
        $this->output('books/listing', $this->data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function edit($id)
    {
        $book = $this->model->find($id);

        if (is_post_request())
        {
            $book->setIsbn($_POST['isbn']);
            $book->setCategorie($_POST['categorie']);
            $book->setSousCategorie($_POST['sous_categorie']);
            $book->setTitre($_POST['titre']);
            $book->setPrixHt($_POST['prix_ht']);
            $book->setPrixTtc($_POST['prix_ttc']);
            $book->setParution($_POST['parution']);
            $book->setResume($_POST['resume']);
            $book->setAuteur($_POST['auteur']);

            $this->model->save($book);
            
            header("Location: http://website.localhost/projet8/admin/");
        }
        else
        {
            $this->data['authorsList'] = $this->author_model->find_all();
            $this->data['sous_categorieList'] = $this->sous_categorie_model->find_all();
            $this->data['book'] = $book;
            $this->output('books/edit', $this->data);
        }
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }
}