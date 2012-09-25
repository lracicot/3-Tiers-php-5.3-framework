<?php

/**
 * Check if the http request method is POST
 *
 * @return <bool>
 */
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function log_message($level, $msg)
{

}

function show_error($message, $status_code)
{
    die('Error '.$status_code . '<br />' . "\n" . $message);
}