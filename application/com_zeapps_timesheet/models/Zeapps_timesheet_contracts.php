<?php

/**
 * Created by PhpStorm.
 * User: nous
 * Date: 07/10/2016
 * Time: 12:05
 */
class Zeapps_timesheet_contracts extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}