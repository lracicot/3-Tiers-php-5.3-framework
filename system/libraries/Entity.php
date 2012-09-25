<?php
/**
 * The main entity from which inherits the application databse entities
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore\libraries;

class Entity
{
    public $db = null;
    protected $_errors = array();

    public function getErrors()
    {
        return $this->_errors;
    }
}