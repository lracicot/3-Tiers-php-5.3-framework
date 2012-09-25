<?php
/**
 * Apply the routing process: convert the url to something significant for the framwork
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore\libs;

class Route
{
    private $uri = '';
    private $segments = array();

    private $app_name = '';
    private $module_name = '';
    private $class_name = '';
    private $method_name = '';
    private $params = array();

    public function __construct($uri, $config)
    {
        $this->uri = $uri;
        $this->segments = explode('/', $uri);

        $this->_bindConfigs($config);
    }

    private function _bindConfigs($configs)
    {
        $uriString = $this->_matchURI($configs);
        $uriExplode = explode('/', $uriString);

        $this->app_name = $uriExplode[0];
        $this->module_name = $uriExplode[1];
        $this->class_name = $uriExplode[2];
        $this->method_name = $uriExplode[3];
        $this->params = array_slice($uriExplode, 4);
    }

    private function _matchURI($configs)
    {
        $routes = $configs->getRoute();

        foreach (array_reverse(array_keys($routes)) as $pattern)
        {
            if (preg_match($pattern, $this->uri))
            {
                if (strpos($routes[$pattern], '$') === false)
                {
                    return $routes[$pattern];
                }
                
                return preg_replace($pattern, $routes[$pattern], $this->uri);
            }
        }
    }

    public function getUri() {
        return $this->uri;
    }

    public function setUri($uri) {
        $this->uri = $uri;
    }

    public function getSegments() {
        return $this->segments;
    }

    public function setSegments($segments) {
        $this->segments = $segments;
    }

    public function getApp_name() {
        return $this->app_name;
    }

    public function setApp_name($app_name) {
        $this->app_name = $app_name;
    }

    public function getModule_name() {
        return $this->module_name;
    }

    public function setModule_name($module_name) {
        $this->module_name = $module_name;
    }

    public function getClass_name() {
        return $this->class_name;
    }

    public function setClass_name($class_name) {
        $this->class_name = $class_name;
    }

    public function getMethod_name() {
        return $this->method_name;
    }

    public function setMethod_name($method_name) {
        $this->method_name = $method_name;
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams($params) {
        $this->params = $params;
    }
}