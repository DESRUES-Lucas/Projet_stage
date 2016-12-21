<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller
{

    public function search()
    {
        $data = [];

        $this->load->view('contract/search', $data);
    }

    public function form()
    {
        $data = [];

        $this->load->view('contract/form', $data);
    }



    public function save() {

        $this->load->model("zeapps_timesheet_contracts", "contract");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");

        $user = $this->user->getUserByToken($this->session->userdata('token'));

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $data["user_id"] = $user->id;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->contract->update($data, $data["id"]);
        } else {
            $this->contract->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("zeapps_timesheet_contracts", "contract");
        $this->contract->delete($id);

        echo json_encode("OK");
    }


    public function getAll() {


        $this->load->model("zeapps_timesheet_contracts", "contract");
        $this->load->model("zeapps_timesheet_timesheets", "timesheet");

        $contracts = $this->contract->get_all();

        if(is_array($contracts)){
            foreach ($contracts as $contract){
                $timesheets = $this->timesheet->get_all(array("contract_id"=>$contract->id));
                $warning = "";
                if(is_array($timesheets)){
                    $tempTotal = 0;
                    foreach ($timesheets as $timesheet){
                        $tempTotal += intval($timesheet->time_spent);
                    }
                    $tempsrestant = intval($contract->time)-$tempTotal;

                    if ($tempsrestant < intval($contract->alert)){
                        $warning = "warning";
                    }
                    if($tempsrestant < 0){
                        $warning = "danger";
                    }
                }
                $contract->warning = $warning;
            }
        }
        if ($contracts == false) {
            echo json_encode(array());
        } else {
            echo json_encode($contracts);
        }



    }

    public function get($id) {
        $this->load->model("zeapps_timesheet_contracts", "contract");
        echo json_encode($this->contract->get($id));
    }


}