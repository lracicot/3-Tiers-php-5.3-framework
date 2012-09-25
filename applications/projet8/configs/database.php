<?php

namespace projet8\configs;

class database
{
    private $username;
    private $database;
    private $server;
    private $password;

    public function __construct()
    {
        $this->username = 'cegep';
        $this->database = 'boutique';
        $this->server = 'localhost';
        $this->password = 'qwerty';
    }

    public function getUsername() {
        return $this->username;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getServer() {
        return $this->server;
    }

    public function getPassword() {
        return $this->password;
    }


}