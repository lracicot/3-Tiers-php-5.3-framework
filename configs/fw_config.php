<?php

class fw_config
{
    private $configs;

    public function __construct()
    {
        $configs = new stdClass();

        /**
         * Default: $configs->base_url = 'http://localhost';'
         */
        $configs->base_url = 'http://website.localhost';

        /**
         * Default: $configs->base_uri = '/'
         */
        $configs->base_uri = '/projet8/';

        $this->configs = $configs;
    }

    public function __get($property)
    {
        return $this->configs->$property;
    }

    public function getConfigs()
    {
        return $this->configs;
    }
}