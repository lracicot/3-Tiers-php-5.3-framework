<?php

namespace projet8\libraries;
use \lrcore\libraries\Autorisator;

class Database_projet8_autorisation implements Autorisator
{
    private $authModel;

    public function __construct($authModel)
    {
        $this->authModel = $authModel;
    }

    public function get_autorisation($token)
    {
        return true;
    }

}