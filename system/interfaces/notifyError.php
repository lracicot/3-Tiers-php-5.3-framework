<?php

interface notifyError
{
    /**
     * This load the requested application controller
     */
    public function notifyError(Exception $ex, $method = '');
}