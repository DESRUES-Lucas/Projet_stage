<?php

class Meeting_app_projects extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}