<?php
/**
 * The authentification library. It use the session class.
 *
 * @author Louis Racicot
 * @copyright 2011 Louis Racicot
 * @version 0.1 alpha
 * @license http://www.opensource.org/licenses/mit-license.php
 */


namespace lrcore\libraries;

require_once(SYSPATH.'/libraries/Security/interfaces/Autorisator.php');
require_once(SYSPATH.'/libraries/Security/interfaces/DataStorage.php');

/**
 * @author Louis Racicot
 * @version 1.0
 * @date 2011-11-30
 */
class Authentification extends Session
{
    private $autorisation;
    private $authData;

    public function __construct(DataStorage $authData = null, Autorisation $autorisation = null)
    {
        parent::__construct();
        $this->autorisation = $autorisation;
        $this->authData = $authData;

    }

    public function authentificate($token)
    {
        if (!$this->autorisation)
        {
            show_error('Access denied. No autorisation method.', 403);
        }

        try
        {
            if (($userdata = $this->autorisation->get_authentification($token)))
            {
                return $userdata;
            }
        }
        catch(Exception $ex)
        {
            log_message('error', $ex->getMessage());
        }

        return false;
    }

    public function is_autorised()
    {
        if($this->authData->getData($this->userdata('session_id'))
                && $this->authData->getData($this->userdata('session_id')))
        {
            return true;
        }
        else
        {
            $this->revokeauthentification();
            return false;
        }
    }

    public function revokeauthentification()
    {
        if ($this->authData->getData($this->userdata('session_id')))
        {
            $this->authData->purgeData($this->userdata('session_id'));
        }
    }

    public function setauthentification(Authentificator $authentification)
    {
        $this->autorisation = $authentification;
    }

    public function setAuthData(DataStorage $authData = null)
    {
        $this->authData = $authData;
    }

    public function getAuthData()
    {
//        if ($this->userdataExist('users_id'))
//        {
            return $this->authData->getData();
//        }

//        return false;
    }
}
