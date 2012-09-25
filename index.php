<?php
/**
 * This is the framework bootstrap
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

use lrcore\Core;

define('BASEPATH', __DIR__);

require('system/core.php');
require('configs/fw_config.php');

$FW_configs = new fw_config();

/**
 * dev|test|prod
 */
$env = 'dev';

try
{
    new Core($env, $_SERVER['REQUEST_URI'], $FW_configs);
}
catch(Exception $e)
{
    die($e);
}
