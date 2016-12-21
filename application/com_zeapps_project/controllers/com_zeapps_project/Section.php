<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('section/search', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('section/form', $data);
    }

    public function modal_section()
    {
        $data = array() ;

        $this->load->view('section/modalSection', $data);
    }








    public function getAll($id_project) {
        $this->load->model("zeapps_project_sections", "project_sections");
        $project_sections = $this->project_sections->order_by("order_section")->get_all(array("id_project" => $id_project));

        if ($project_sections == false) {
            echo json_encode(array());
        } else {
            echo json_encode($project_sections);
        }

    }

    public function get($id) {
        $this->load->model("zeapps_project_sections", "project_sections");
        echo json_encode($this->project_sections->get($id));
    }


    public function updateOrder() {
        $this->load->model("zeapps_project_sections", "project_sections");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        $listIdToUpdate = explode(",", $data["ids"]);
        $order = 0 ;
        foreach($listIdToUpdate as $id) {
            $order++ ;

            $dataTmp = array();
            $dataTmp["order_section"] = $order ;

            $this->project_sections->update($dataTmp, trim($id) * 1);
        }

        echo json_encode("OK");
    }

    public function save() {
        $this->load->model("zeapps_project_sections", "project_sections");


        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }






        // récupère l'ordre de la dernière section
        if (!(isset($data["id"]) && is_numeric($data["id"]))) {
            $order = 1 ;

            $project_section = $this->project_sections->get_max_order($data["id_project"]);
            if (isset($project_section[0]->order_section)) {
                $order = $project_section[0]->order_section * 1;
                $order++;
            }

            $data["order_section"] = $order ;
        }





        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->project_sections->update($data, $data["id"]);
        } else {
            $this->project_sections->insert($data);
        }

        echo json_encode("OK");
    }

    public function delete($id) {
        $this->load->model("zeapps_project_sections", "project_sections");
        $this->load->model("zeapps_project_tasks", "project_tasks");
        $this->project_sections->delete($id);


        // load all task to delete
        $project_tasks = $this->project_tasks->get_all(array("id_section" => $id));
        foreach($project_tasks as $task) {
            $this->project_tasks->delete($task->id);
        }

        echo json_encode("OK");
    }

}
