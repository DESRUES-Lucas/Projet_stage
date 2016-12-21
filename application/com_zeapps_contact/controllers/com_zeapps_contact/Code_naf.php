<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_naf extends CI_Controller
{
    public function modal_code_naf()
    {
        $data = array() ;

        $this->load->view('code_naf/modalCode_naf', $data);
    }











    public function getAll() {
        $this->load->model("zeapps_code_naf", "code_naf");
        $code_naf = $this->code_naf->get_all();

        if ($code_naf == false) {
            echo json_encode(array());
        } else {
            echo json_encode($code_naf);
        }

    }

    public function get($id) {
        $this->load->model("zeapps_code_naf", "code_naf");
        echo json_encode($this->code_naf->get($id));
    }



}
