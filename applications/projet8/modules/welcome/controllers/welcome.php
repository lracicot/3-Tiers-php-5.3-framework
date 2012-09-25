<?php

namespace projet8\modules;
//use \lrcore\libs\Controller;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/book.php');
require_once(APPPATH.'/modules/book/models/book_model.php');
require_once(APPPATH.'/modules/category/models/category_model.php');

class Welcome extends Controller
{
    private $model = null;
    
    public function __construct($route, $config)
    {
        parent::__construct($route, $config);
        
        $this->model = new book_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function index()
    {
        echo "<strong>404 Page not found</strong>";
    }

    public function welcome_show()
    {
        $this->data['books'] = $this->model->find_all(20);

        $this->output('welcome/all_books', $this->data);
    }

    public function test($id)
    {
        echo $id;
    }
}