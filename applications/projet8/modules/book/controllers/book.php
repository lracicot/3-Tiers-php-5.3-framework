<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/modules/book/models/book_model.php');
require_once(APPPATH.'/modules/category/models/category_model.php');

class Book extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);

        $this->model = new book_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function show($id)
    {
        $this->data['book'] = $this->model->find($id);
        
        $this->output('book/show', $this->data);
    }

    public function search()
    {
        if (is_post_request())
        {
            $this->data['search'] = $_POST['search'];
            $this->data['books'] = $this->model->select_search(explode(' ', $_POST['search']));
            $this->output('book/search_result', $this->data);
        }
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }
}