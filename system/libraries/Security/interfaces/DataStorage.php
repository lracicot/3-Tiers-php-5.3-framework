<?php

namespace lrcore\libraries;

/**
 * @author Louis Racicot
 * @version 1.0
 * @date 2011-11-30
 */
interface DataStorage
{
    public function getData($id);
    public function purgeData($id);
}