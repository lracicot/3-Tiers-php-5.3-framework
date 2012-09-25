<?php
/**
 * Mainpiece of the framwork. It load the routes, the configs and the app.
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore;

define('SYSPATH', __DIR__);

/**
 * Libraries
 */
require('libraries/Loader.php');
require('libraries/Route.php');
require('libraries/Configs.php');
require('libraries/Controller.php');
require('libraries/Session.php');
require('libraries/Entity.php');
require('libraries/Security/Authentification.php');

/**
 * Interfaces
 */
require('interfaces/appLoader.php');

class Core
{
    private $env;
    private $load;

    public function __construct($env = 'prod', $uri = '', $fw_configs = false)
    {
        $this->env = $env;
        $this->load = new libs\Loader();

        // Find the routing
        $route = $this->_get_route(substr($uri, strlen($fw_configs->base_uri)));

        // Generate app config (global config + app config)
//        $configs = $this->_get_config($route);

        // Run app
        $this->load->app($route, $fw_configs);
    }

    private function _get_route($uri)
    {
        return $this->load->route($uri);
    }

//    private function _get_config($route)
//    {
//        return $this->load->config($route->getApp_name());
//    }

}