<?php

class Meeting_app_participants extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}