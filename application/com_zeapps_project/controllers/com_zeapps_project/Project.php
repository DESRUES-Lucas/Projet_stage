<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('project/search', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('project/form', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('project/view', $data);
    }

    public function template_treegrid()
    {
        $data = array() ;

        $this->load->view('project/template_treegrid', $data);
    }






    public function get_stat() {
        $this->load->model("zeapps_project_tasks", "project_tasks");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        // charge toutes les taches non terminées
        $tasks = $this->project_tasks->get_all("id_project in (" . str_replace("'", "''", $data["ids_project"]) . ")") ;

        $arrData = array() ;
        foreach($tasks as $task) {

            $indice_project = -1 ;
            for ($i = 0 ; $i < count($arrData) ; $i++) {
                if ($arrData[$i][0] == $task->id_project) {
                    $indice_project = $i ;
                    break;
                }
            }

            if ($indice_project == -1) {
                $arrData[] = array($task->id_project, "", "", 0, 0, false) ;
                $indice_project = count($arrData) - 1 ;
            }








            if ($task->due_date != '0000-00-00') {
                $timestamp = strtotime($task->due_date);
                if ($arrData[$indice_project][1] == "") {
                    $arrData[$indice_project][1] = $task->due_date ;
                    $arrData[$indice_project][2] = date("d/m/Y", $timestamp) ;
                } else {
                    $lastTimestamp = strtotime($arrData[$indice_project][1]);
                    if ($lastTimestamp > $timestamp) {
                        $arrData[$indice_project][1] = $task->due_date ;
                        $arrData[$indice_project][2] = date("d/m/Y", $timestamp) ;
                    }
                }

                if ($timestamp < time()) {
                    $arrData[$indice_project][5] = true ;
                }
            }


            $arrData[$indice_project][3]++ ;

            if ($task->id_assigned_to == 0) {
                $arrData[$indice_project][4]++;
            }
        }

        echo json_encode($arrData) ;

    }





    public function getAll() {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        $this->load->model("zeapps_projects", "projects");
        $projects = $this->projects->get_search($data);

        if ($projects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($projects);
        }

    }

    public function get($id) {
        $this->load->model("zeapps_projects", "projects");
        echo json_encode($this->projects->get($id));
    }

    public function save() {
        $this->load->model("zeapps_projects", "projects");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->projects->update($data, $data["id"]);
        } else {
            $this->projects->insert($data);
        }

        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("zeapps_projects", "projects");
        $this->projects->delete($id);

        echo json_encode("OK");
    }



    public function archived($id) {
        $this->load->model("zeapps_projects", "projects");

        $data = array() ;
        $data["status"] = "99" ;
        $this->projects->update($data, $id);

        echo json_encode("OK");
    }



}
