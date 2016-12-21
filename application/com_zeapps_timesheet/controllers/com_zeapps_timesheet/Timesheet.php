<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller {

    public function search()
    {
        $data = [];

        $this->load->view('timesheet/search', $data);
    }

    public function form()
    {
        $data = [];

        $this->load->view('timesheet/form', $data);
    }


    public function save() {

        $this->load->model("zeapps_timesheet_timesheets", "timesheet");

        //Recover the session of the actual user connected
        $this->load->library('session');
        $this->load->model("zeapps_users", "user");
        $user = $this->user->getUserByToken($this->session->userdata('token'));


        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }
        //Push user id in the $data tab

        $data["user_id"] = $user->id;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->timesheet->update($data, $data["id"]);
        } else {
            $this->timesheet->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("zeapps_timesheet_timesheets", "timesheet");
        $this->timesheet->delete($id);

        echo json_encode("OK");
    }


    public function getTimesheetByUser($contract_id = null){
        if($contract_id) {
            $this->load->model("zeapps_timesheet_timesheets", "timesheet");
            $this->load->model("zeapps_timesheet_contracts", "contract");

            $this->load->library('session');
            $this->load->model("zeapps_users", "user");
            $user = $this->user->getUserByToken($this->session->userdata('token'));


            if ($user) {
                $user_id = $user->id;
                $contract = $this->contract->get(array("id"=>$contract_id));

                if($contract->user_id == $user_id){
                    $res = $this->timesheet->get_all(array('contract_id'=> $contract_id));
                } else{
                    $res = $this->timesheet->get_all(array('user_id' => $user_id, 'contract_id'=> $contract_id));
                }

                // surcharge timesheet avec le nom d'utilisateur
                if(is_array($res)){
                    foreach ($res as $line){
                        $temp = $this->user->get($line->user_id);
                        $line->user_name = $temp->lastname ." ".$temp->firstname;
                    }
                }
                echo json_encode($res);
            }
        }
        return;
    }

    public function get($id) {
        $this->load->model("zeapps_timesheet_timesheets", "timesheet");
        echo json_encode($this->timesheet->get($id));
    }



}