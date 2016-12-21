<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Typebache extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('typebache/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('typebache/view', $data);
    }




    public function getAll() {
        $this->load->model("fr_abeko_baches", "baches");
        $baches = $this->baches->order_by('nom')->get_all();

        if ($baches == false) {
            echo json_encode(array());
        } else {
            echo json_encode($baches);
        }

    }

    public function get($id) {
        $this->load->model("fr_abeko_baches", "baches");
        echo json_encode($this->baches->get($id));
    }

    public function save() {
        $this->load->model("fr_abeko_baches", "baches");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->baches->update($data, $data["id"]);
        } else {
            $this->baches->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("fr_abeko_baches", "baches");
        $this->baches->delete($id);

        echo json_encode("OK");
    }

}
