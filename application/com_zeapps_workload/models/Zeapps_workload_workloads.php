<?php

/**
 * Created by PhpStorm.
 * User: nous
 * Date: 27/09/2016
 * Time: 10:03
 */
class Zeapps_workload_workloads extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }

    public function updateOldTable($status, $position) {
        $this->db->query('UPDATE zeapps_workload_workloads SET position = (position-1) WHERE status = ' . $status . ' AND position > ' . $position);
    }

    public function updateNewTable($status, $position) {
        $this->db->query('UPDATE zeapps_workload_workloads SET position = (position+1) WHERE status = ' . $status . ' AND position >= ' . $position);
    }
}