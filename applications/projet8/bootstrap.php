<?php

namespace projet8;
use \appLoader;

define('APPPATH', __DIR__);

/**
 * Configurations files
 */
require(BASEPATH.'/applications/projet8/configs/database.php');

/**
 * Libraries
 */
require_once(BASEPATH.'/applications/projet8/libraries/helpers.php');
require_once(BASEPATH.'/applications/projet8/libraries/p8_controller.php');
require_once(BASEPATH.'/applications/projet8/libraries/Database_projet8_autorisation.php');

/**
 * Exceptions
 */
require_once(BASEPATH.'/applications/projet8/libraries/exceptions/validation_exception.php');

/**
 * Models
 */
require_once(APPPATH.'/models/authModel.php');
require_once(APPPATH.'/modules/user/models/user_model.php');
require_once(APPPATH.'/modules/cart/models/cart_model.php');

/**
 * Entities
 */
require_once(APPPATH.'/entities/user.php');

class Loader implements appLoader
{
    private $route;
    private $configs;

    public function __construct($route, $fw_config)
    {
        $this->route = $route;

        $this->_get_configs($fw_config);
    }

    public function load()
    {
        require_once(BASEPATH.'/applications/'.
                $this->route->getApp_name().
                '/modules/'.
                $this->route->getModule_name().
                '/controllers/'.
                $this->route->getClass_name().
                '.php');

        $className = "\\".$this->route->getApp_name()."\\modules\\".$this->route->getClass_name();

        $app = new $className($this->route, $this->configs);

        call_user_func_array(array($app, $this->route->getMethod_name()), $this->route->getParams());
    }

    public function _get_configs($fw_config)
    {
        foreach ((array)$fw_config->getConfigs() AS $key => $value)
        {
            $config->$key = $value;
        }

        $config->database = new configs\database();
        $this->configs = $config;
    }

}