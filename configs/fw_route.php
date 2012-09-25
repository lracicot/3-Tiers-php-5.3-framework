<?php

class fw_route
{
    private $route;

    public function __construct()
    {
        $route = array();

        $route['/(.*)/'] = 'projet8/welcome/welcome/index/';
        $route['/test\/([0-9]+)/'] = 'projet8/welcome/welcome/test/$1';
        $route['/^$/'] = 'projet8/welcome/welcome/welcome_show/';
        $route['/book\/([0-9]+)/'] = 'projet8/book/book/show/$1';
        $route['/book\/search/'] = 'projet8/book/book/search';
        $route['/auteur\/([0-9]+)/'] = 'projet8/author/author/show/$1';
        $route['/souscategorie\/([0-9]+)/'] = 'projet8/category/sous_categorie/show/$1';
        $route['/category\/([0-9]+)/'] = 'projet8/category/category/show/$1';
        $route['/register/'] = 'projet8/user/login/register';
        $route['/register\/validation/'] = 'projet8/user/login/add';
        $route['/login/'] = 'projet8/user/login/logtry/';
        $route['/logout/'] = 'projet8/user/login/logout/';
        $route['/cart\/add\/([0-9]+)/'] = 'projet8/cart/cart/add/$1';
        $route['/cart\/remove\/([0-9]+)/'] = 'projet8/cart/cart/remove/$1';
        $route['/cart\/checkout/'] = 'projet8/cart/cart/checkout/';
        $route['/cart\/confirm/'] = 'projet8/cart/cart/confirm/';
        $route['/order\/([0-9]+)/'] = 'projet8/order/order/show/$1';
        $route['/order\/list/'] = 'projet8/order/order/listing/';

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            $route['/cart\/nb/'] = 'projet8/cart/cart/getNbItems';
            $route['/cart\/update_all/'] = 'projet8/cart/cart/update_all';
        }

        $route['/admin/'] = 'projet8/admin/produits/listing/';
        $route['/admin\/books\/edit\/([0-9]+)/'] = 'projet8/admin/produits/edit/$1';
        $route['/admin\/books\/delete\/([0-9]+)/'] = 'projet8/admin/produits/delete/$1';

        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }
}