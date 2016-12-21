<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('contacts/search', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('contacts/form', $data);
    }





    public function getAll() {
        $this->load->model("zeapps_contacts", "contacts");
        $contacts = $this->contacts->get_all();

        if ($contacts == false) {
            echo json_encode(array());
        } else {
            echo json_encode($contacts);
        }

    }

    public function get($id) {
        $this->load->model("zeapps_contacts", "contacts");
        echo json_encode($this->contacts->get($id));
    }

    public function save() {
        $this->load->model("zeapps_contacts", "contacts");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->contacts->update($data, $data["id"]);
        } else {
            $this->contacts->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("zeapps_contacts", "contacts");
        $this->contacts->delete($id);

        echo json_encode("OK");
    }

}
