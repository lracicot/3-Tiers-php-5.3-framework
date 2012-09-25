<?php
/**
 * The main controller from which inherits the application controllers
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore\libs;
use lrcore\libraries\Authentification;

require_once(BASEPATH.'/system/interfaces/notifyError.php');

class Controller implements \notifyError
{
    private $route;
    private $configs;
    protected $layout = 'default';
    protected $autorisation = null;
    protected $authentification = null;

    public function __construct($route, $configs)
    {
        $this->route = $route;
        $this->configs = $configs;

        $this->_configure($configs);

        // Get security data (authentification, autorisations)
        $this->_get_authentification();
    }

    private function _configure($configs)
    {
        $this->db = new \PDO('mysql:dbname='.$configs->database->getDatabase().
                ';host='.$configs->database->getServer().
                ';charset=UTF8',
                $configs->database->getUsername(), $configs->database->getPassword());
    }

    private function _get_authentification()
    {
        $this->authentification = new Authentification();
    }

    public function notifyError(Exception $ex, $method = false)
    {
        if (!$method)
            $method = __METHOD__;

        die($ex->__toString() . ' in ' . $method);
    }

    protected function output($name, $data)
    {
        extract($data);
        
        $filename1 = BASEPATH.'/applications/'.$this->route->getApp_name().'/modules/'.$this->route->getModule_name().'/views/'.$name.'.php';
        $filename2 = BASEPATH.'/applications/'.$this->route->getApp_name().'/views/'.$name.'.php';

        if (file_exists($filename1))
        {
            $_output = get_include_contents($filename1, $data);
        }
        elseif(file_exists($filename2))
        {
            $_output = get_include_contents($filename2, $data);
        }
        else
        {
            throw new \Exception('The view '.$name.' does not exist.');
        }

        $layout1 = BASEPATH.'/applications/'.$this->route->getApp_name().'/modules/'.$this->route->getModule_name().'/views/layouts/'.$this->layout.'.php';
        $layout2 = BASEPATH.'/applications/'.$this->route->getApp_name().'/views/layouts/'.$this->layout.'.php';


        if (file_exists($layout1))
        {
            include($layout1);
        }
        elseif(file_exists($layout2))
        {
            include($layout2);
        }
        else
        {
            throw new \Exception('The layouts '.$this->layouts.' does not exist.');
        }
    }

}

function get_include_contents($filename, $data) {
    if (is_file($filename)) {
        extract($data);
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}