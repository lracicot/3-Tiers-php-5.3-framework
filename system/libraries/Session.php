<?php
/**
 * Make it easier to use the PHP sessions
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */

namespace lrcore\libraries;

session_start();

class Session
{
    private $sess_data = array();

    public function __construct()
    {
        if (!isset($_SESSION['userdata']))
        {
            $this->sess_data['session_id'] = session_id();
            $this->_update_php_session();
        }
        else
        {
            $this->sess_data = $_SESSION['userdata'];
        }
    }

    public function userdata($var = false)
    {
        if (!isset($this->sess_data[$var]))
        {
            throw new \Exception('Key ' . $var . ' does not exist in the session.');
        }
        return $this->sess_data[$var];
    }

    public function userdataExist($var)
    {
        return isset($this->sess_data[$var]);
    }

    public function set_userdata($key, $value)
    {
        $this->sess_data[$key] = $value;
        $this->_update_php_session();
    }

    private function _update_php_session()
    {
        $_SESSION['userdata'] = $this->sess_data;
    }
}