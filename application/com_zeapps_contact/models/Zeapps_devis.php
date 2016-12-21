<?php
/**
 * Created by PhpStorm.
 * User: nous
 * Date: 26/09/2016
 * Time: 12:00
 */

class Zeapps_devis extends MY_Model {
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}