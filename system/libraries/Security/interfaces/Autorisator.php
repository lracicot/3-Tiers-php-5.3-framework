<?php

namespace lrcore\libraries;

/**
 * @author Louis Racicot
 * @version 1
 * @date 2011-11-30
 */
interface Autorisator
{
    public function get_autorisation($token);
}