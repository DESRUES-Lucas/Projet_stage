<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Logo extends CI_Controller
{
    public function search()
    {
        $data = array();

        $this->load->view('logo/search', $data);
    }

    public function form()
    {
        $data = array();

        $this->load->view('logo/form', $data);
    }

    public function save()
    {
        $this->load->model("fr_abeko_logos", "logos");

        // constitution du tableau
        $data = array();

       // if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
           // $data = json_decode(file_get_contents('php://input'), true);
        //}

        $data["libelle"]= $this->input->post("libelle");
        $file = $_FILES['file'];

        $path = '/assets/upload/logo/';

        $arr=explode(".", $file["name"]);

        $extension = end($arr);

        $data['path'] = $path.ltrim(str_replace(' ', '', microtime()), '0.').".".$extension;


        move_uploaded_file($file["tmp_name"], FCPATH.$data['path']);


        $data["id"] = $this->logos->insert($data);

        echo json_encode($data);
    }


    public function getAll() {
        $this->load->model("fr_abeko_logos", "logos");
        $logos = $this->logos->get_all();

        if ($logos == false) {
            echo json_encode(array());
        } else {
            echo json_encode($logos);
        }

    }


    public function getFile($id)
    {
        $this->load->model("fr_abeko_logos", "logos");
        echo json_encode($this->logos->get($id));

    }



    public function delete($id) {
        $this->load->model("fr_abeko_logos", "logo");
        $logo = $this->logo->get($id);

        if($logo){
            if(unlink(FCPATH.$logo->path)){
                $this->logo->delete($id);
           }
        }

        echo json_encode("OK");
    }
}