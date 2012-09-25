<?php

namespace projet8\libraries;

use \lrcore\libraries\Authentification;

class Controller extends \lrcore\libs\Controller
{
    protected $data = array();
    protected $cart = null;
    
    public function __construct($route, $config)
    {
        parent::__construct($route, $config);

        $cartModel = new \projet8\modules\Cart_model($this->db, $this);
        $userModel = new \projet8\modules\User_model($this->db, $this);
        $currentUser = new \projet8\entities\User($this->db, $userModel);

        if ($this->authentification->userdataExist('user_id') &&
                ($loggedUser = $userModel->find($this->authentification->userdata('user_id'))))
        {
            $currentUser = $loggedUser;
            $this->cart = $cartModel->getCart($this->authentification->userdataExist('user_id'));
        }

        $this->authentification->setAuthData($currentUser);

        $this->_generate();
    }

    protected function _generate()
    {
        $this->data['authentification'] = $this->authentification;
        $this->data['cart'] = $this->cart;
    }
}