<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('companies/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('companies/view', $data);
    }



        public function form()
    {
        $data = array() ;

        $this->load->view('companies/form', $data);
    }

    public function modal_company()
    {
        $data = array() ;

        $this->load->view('companies/modalCompany', $data);
    }










    public function getAll() {
        $this->load->model("zeapps_companies", "companies");
        $companies = $this->companies->get_all();

        if ($companies == false) {
            echo json_encode(array());
        } else {
            echo json_encode($companies);
        }
    }

    public function get($id) {
        $this->load->model("zeapps_companies", "companies");
        echo json_encode($this->companies->get($id));
    }

    public function save() {
        $this->load->model("zeapps_companies", "companies");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->companies->update($data, $data["id"]);
        } else {
            $this->companies->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("zeapps_companies", "companies");
        $this->companies->delete($id);

        echo json_encode("OK");
    }

}
