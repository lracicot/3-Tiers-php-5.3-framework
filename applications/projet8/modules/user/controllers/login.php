<?php

namespace projet8\modules;
use \projet8\libraries\Controller;

require_once(APPPATH.'/entities/user.php');
require_once(APPPATH.'/modules/category/models/category_model.php');

class Login extends Controller
{
    private $model = null;

    public function __construct($route, $config)
    {
        parent::__construct($route, $config);
        
        $this->model = new user_model($this->db, $this);
        $this->category_model = new category_model($this->db, $this);

        $this->data['menu'] = $this->category_model->find_all();
        $this->data['authentification'] = $this->authentification;
        $this->data['_route'] = $route;
        $this->data['_configs'] = $config;
    }

    public function register()
    {
        $this->output('login/register', $this->data);
    }

    public function logTry()
    {
        if (is_post_request())
        {
            if (($user = $this->model->login($_POST['email'], $_POST['passwd'])))
            {
                $this->authentification->set_userdata('user_id', $user->getId());
                $this->authentification->setAuthData($user);

                $cartModel = new \projet8\modules\Cart_model($this->db, $this);
                $this->cart = $cartModel->getCart($user->getId());
                $this->data['cart'] = $this->cart;

                $this->output('login/login_success', $this->data);
            }
            else
            {
                header("Location: ".$_SERVER['HTTP_REFERER']);
            }
        }
        else
        {
            header("Location: http://website.localhost/projet8");
        }
    }

    public function logout()
    {
        $this->authentification->setAuthData(new \projet8\entities\User($this->db, $this->model));
        session_destroy();
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function add()
    {
        if (is_post_request())
        {
            $user = $this->model->create($_POST);
            
            if (count($user->getErrors()))
            {
                $this->data += $_POST;
                $this->data['errors'] = $user->getErrors();
                $this->output('login/register', $this->data);
                return;
            }

            $this->model->save($user);
            $this->output('login/register_success', $this->data);
        }
        else
        {
            $this->register();
        }
    }

    public function notifyError(Exception $ex, $method = false)
    {
        $this->output('error/database', array('error', $e));
    }
}