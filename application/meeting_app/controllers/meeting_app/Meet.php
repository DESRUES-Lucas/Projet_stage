<?php



class Meet extends CI_Controller
{

    /****** Load view called by the http request ******/



    public function modalAddMeet()
    {
        $data = [];

        $this->load->view('meet/modalAddMeet', $data);
    }

    public function plan()
    {
        $data = [];

        $this->load->view('meet/plan', $data);
    }


    public function save() {

        $this->load->model("meeting_app_meets", "meet");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");



        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->meet->update($data, $data["id"]);
        } else {
            $this->meet->insert($data);
        }

        echo json_encode("OK");
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Search all meets saved in the BDD ***********/

    public function getAll() {
        $this->load->model("meeting_app_meets", "meet");
        $meets = $this->meet->get_all();

        if ($meets == false) {
            echo json_encode(array());
        } else {
            echo json_encode($meets);
        }

    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Delete a meet with id argument **********/

    public function delete($id) {
        $this->load->model("meeting_app_meets", "meet");
        $this->meet->delete($id);


        echo json_encode("OK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function getMeetByProject($id_project){
        $this->load->model("meeting_app_meets", "meet");
        $meets = $this->meet->get_all(array("id_project" => $id_project));


        if ($meets == false) {
            echo json_encode(array());
        } else {
            echo json_encode($meets);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get($id) {
        $this->load->model("meeting_app_meets", "meet");
        echo json_encode($this->meet->get($id));
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}





