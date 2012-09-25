<?php
/**
 * This load your application
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore\libs;

require(BASEPATH.'/configs/fw_route.php');

class Loader
{
    public function route($uri)
    {
        $configs = new \fw_route();
        $route = new Route($uri, $configs);

        return $route;
    }

    public function app($route, $config = false)
    {
        require(BASEPATH.'/applications/'.$route->getApp_name().'/bootstrap.php');
        
        $loaderName = "\\".$route->getApp_name()."\\Loader";
        $loader = new $loaderName($route, $config);

        $loader->load();
    }
}