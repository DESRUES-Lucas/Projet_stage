<?php



class Project extends CI_Controller
{

    /****** Load view called by the http request ******/

    public function form()
    {
        $data = [];

        $this->load->view('project/form', $data);
    }



    public function plan()
    {
        $data = [];

        $this->load->view('project/plan', $data);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function save() {

        $this->load->model("meeting_app_projects", "project");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");


        $user = $this->user->getUserByToken($this->session->userdata('token'));


        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        $data["id_user"] = $user->id;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->project->update($data, $data["id"]);
        } else {
            $this->project->insert($data);
        }

        echo json_encode("OK");
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /********* Search all projects saved in the BDD **********/

    public function getAll()
    {
        $this->load->model("meeting_app_projects", "project");
        $this->load->model("meeting_app_meets", "meet");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");
        $user = $this->user->getUserByToken($this->session->userdata('token'));

        if ($user) {
            $user_id = $user->id;

            if ($projects = $this->project->get_all(array("id_user"=> $user_id))) {
                foreach ($projects as $project) {
                    $meets = $this->meet->get_all(array("id_project" => $project->id));
                    if ($meets && is_array($meets))
                        $project->nbMeets = sizeof($meets);
                    else
                        $project->nbMeets = 0;
                }
            }
        }

        if ($projects == false) {
            echo json_encode(array());
        } else {
            foreach ($projects as &$project){
                $project->advancement = $this->_countNotesByProject($project->id);
            }
            echo json_encode($projects);
        }

    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /********* Delete a project with id argument **********/

    public function delete($id) {
        $this->load->model("meeting_app_projects", "project");
        $this->load->model("meeting_app_subjects", "subject");
        $this->load->model("meeting_app_meets", "meet");

        $meets = $this->meet->get_all(array("id_project" => $id));

        foreach ($meets as $meet){
            $this->meet->delete($meet->id);
        }
        $subjects = $this->subject->get_all(array("id_project" => $id));
        foreach ($subjects as $subject){
            $this->subject->delete($subject->id);
        }

        $this->project->delete($id);

        echo json_encode("OK");
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get($id) {
        $this->load->model("meeting_app_projects", "project");
        echo json_encode($this->project->get($id));
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function _countNotesByProject($id_project = null){
        $this->load->model("meeting_app_notes", "notes");

        if ($id_project){

                $countNote = $this->notes->countNotesByProject(intval($id_project));

                $countNote = sizeof($countNote);



                $countDoneNote = $this->notes->countDoneNotesByProject($id_project);

                $countDoneNote = sizeof($countDoneNote);


                if ($countNote > 0){
                    $results = round($countDoneNote / $countNote * 100) ;
                }
                else
                    $results = 0;

            return $results;

        }

        return 0;


    }





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
    public function getProjectByUser($project_id = null){
        if($project_id) {

            $this->load->model("meeting_app", "project");

            $this->load->library('session');
            $this->load->model("zeapps_users", "user");
            $user = $this->user->getUserByToken($this->session->userdata('token'));


            if ($user) {
                $user_id = $user->id;
                $contract = $this->contract->get(array("id"=>$project_id));


            }
        }
        return;
    }
**/


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}





