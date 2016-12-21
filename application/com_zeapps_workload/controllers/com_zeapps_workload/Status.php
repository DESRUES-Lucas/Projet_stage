<?php

class Status extends CI_Controller
{
    public function getAll() {

        $this->load->model("zeapps_workload_statuses", "statuses");
        $statuses = $this->statuses->order_by("id")->get_all();

        if ($statuses== false) {
            echo json_encode(array());
        } else {
            echo json_encode($statuses);
        }

    }
}