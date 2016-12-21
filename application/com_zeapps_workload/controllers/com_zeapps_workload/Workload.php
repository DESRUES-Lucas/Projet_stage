<?php

/**
 * Created by PhpStorm.
 * User: nous
 * Date: 27/09/2016
 * Time: 10:41
 */
class Workload extends CI_Controller
{
    public function form()
    {
        $data = [];

        $this->load->view('workload/form', $data);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function plan()
    {
        $data = [];

        $this->load->view('workload/plan', $data);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function save() {
        $this->load->model("zeapps_workload_workloads", "workloads");


        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);

            $data["status"] = intval($data["status"]);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $workload = $this->workloads->get($data["id"]) ;

            if ($workload->status != $data["status"]) {
                // mise à jour du tableau
                $this->workloads->updateOldTable($workload->status, $workload->position);

                // recherche la position la plus élevé dans le nouveau tableau
                $workloads = $this->workloads->order_by("position", "DESC")->get_all(array("status"=>$data["status"]));

                $data["position"] = 0 ;
                if ($workloads && count($workloads) > 0) {
                    $data["position"] = intval($workloads[0]->position) + 1 ;
                }
            }

            $this->workloads->update($data, $data["id"]);
        } else {
            // recherche la position la plus élevé dans le nouveau tableau
            $workloads = $this->workloads->order_by("position", "DESC")->get_all(array("status"=>$data["status"]));
            echo json_encode($workloads);

            $data["position"] = 0 ;
            if ($workloads && count($workloads) > 0) {
                $data["position"] = $workloads[0]->position + 1 ;
            }

            $this->workloads->insert($data);
        }

        echo json_encode("OK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function delete($id) {
        $this->load->model("zeapps_workload_workloads", "workloads");

        $workload = $this->workloads->get($id) ;


        // mise à jour du tableau
        $this->workloads->updateOldTable($workload->status, $workload->position);


        $this->workloads->delete($id);

        echo json_encode("OK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function getAll() {
        // constitution du tableau
        /*$data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }*/


        $this->load->model("zeapps_workload_workloads", "workloads");
        $workloads = $this->workloads->order_by("position")->get_all();

        if ($workloads== false) {
            echo json_encode(array());
        } else {
            echo json_encode($workloads);
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function get($id) {
        $this->load->model("zeapps_workload_workloads", "workloads");
        echo json_encode($this->workloads->get($id));
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function save_position() {
        $this->load->model("zeapps_workload_workloads", "workloads");


        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        //echo json_encode($data["idObj"]);

        $workload = $this->workloads->get($data["idObj"]) ;




        // mise à jour de l'ancien tableau
        $this->workloads->updateOldTable($workload->status, $workload->position);


        // mise à jour du nouveau tableau
        $this->workloads->updateNewTable($data["typeTableauDestination"], $data["position"]);



        // mise à jour de l'objet
        $workload->status = $data["typeTableauDestination"] ;
        $workload->position = $data["position"] ;
        $this->workloads->update($workload, $workload->id);

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

