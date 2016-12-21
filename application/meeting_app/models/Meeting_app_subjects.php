<?php

class Meeting_app_subjects extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }

    public function get_all_distinct(){

        return $this->db->query(Select );
    }


}