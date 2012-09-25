<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/sous_categorie.php');
require_once(APPPATH.'/modules/category/models/sous_categorie_model.php');
require_once(APPPATH.'/modules/category/models/category_model.php');

class Sous_Categorie extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);

        $this->model = new SousCategory_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function show($id)
    {
        $this->data['sous_categorie'] = $this->model->find($id);
        
        $this->output('sous_categorie/show', $this->data);
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }
}