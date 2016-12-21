<?php


class Zeapps_timesheet_timesheets extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }

    /*
    public function filterUser($user_id)
    {
        return $this->db->query('SELECT * FROM zeapps_timesheet_timesheets WHERE user_id ='.$user_id);

    }
    */
}