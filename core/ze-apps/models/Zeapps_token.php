<?php

class Zeapps_token extends MY_Model
{
    private $typeHash = 'sha256';

    public function __construct()
    {
        $this->table = 'zeapps_token' ;

        parent::__construct();
    }

}