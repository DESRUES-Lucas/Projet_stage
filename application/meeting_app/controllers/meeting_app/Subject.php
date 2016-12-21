<?php



class Subject extends CI_Controller
{

    /****** Load view called by the http request ******/


    public function plan()
    {
        $data = [];

        $this->load->view('subject/plan', $data);
    }

    public function modalSubject()
    {
        $data = [];

        $this->load->view('subject/modalSubject', $data);
    }

    public function modalParticipant()
    {
        $data = [];

        $this->load->view('subject/modalParticipant', $data);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function save() {

        $this->load->model("meeting_app_subjects", "subject");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");



        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->subject->update($data, $data["id"]);
        } else {
            $this->subject->insert($data);
        }

        echo json_encode("OK");
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Search all projects saved in the BDD **********/

    public function getAll() {
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all();

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Delete a project with id argument **********/

    public function delete($id) {
        $this->load->model("meeting_app_subjects", "subject");
        $this->subject->delete($id);


        echo json_encode("OK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function getSubByProject($id_project){
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all(array("id_project" => $id_project));

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getSubByMeet($id_meet){
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all(array("id_meet" => $id_meet));

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getNoteByMeet($id_meet){
        $this->load->model("meeting_app_notes", "note");
        $this->load->model("meeting_app_participants", "participant");

        $notes = $this->note->order_by(array('position'=>'ASC'))->get_all(array("id_meet" => $id_meet));

        foreach ($notes as $note){
            $note->participants = $this->participant->get_all(array("id_note"=>$note->id));
            if(!$note->participants){
                $note->participants = [];
            }
        }
        if ($notes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($notes);
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function saveNote() {

        $this->load->model("meeting_app_notes", "note");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");




        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->note->update($data, $data["id"]);


        } else {
            //$notes = $this->note->get_all();
            $this->note->updatePositions($data['position'], $data['id_meet'], $data['id_project'], $data['id_subject']);
            $data['id'] = $this->note->insert($data);
        }

        echo json_encode(array("id"=>$data["id"]));

    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getNote() {
        $this->load->model("meeting_app_notes", "note");
        $notes = $this->note->get_all();

        if ($notes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($notes);
        }

    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function get($id) {
        $this->load->model("meeting_app_notes", "note");
        echo json_encode($this->note->get($id));
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteNote($id) {
        $this->load->model("meeting_app_notes", "note");

        $this->note->delete($id);



        echo json_encode("OK");
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function saveNotePosition() {
        $this->load->model("meeting_app_notes", "notes");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");


        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        //echo json_encode($data["idObj"]);

        $note = $this->notes->get($data["idObj"]) ;


        $this->notes->updateOldTable( $note->position);


        $note->position = $data["position"] ;
        $note->id_subject = $data["id_subject"];


        $this->notes->updateNewTable($data["position"]);

        //give good position value to dragged note
        $this->notes->update($note, $note->id);

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function done_note(){
        $this->load->model("meeting_app_notes", "notes");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");

        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->notes->update($data, $data["id"]);
        } else {
            $this->notes->insert($data);
        }

        echo json_encode("OK");

    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getUsers() {
        $this->load->model("zeapps_users", "user");
        $users = $this->user->get_all();

        if ($users == false) {
            echo json_encode(array());
        } else {
            echo json_encode($users);
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addParticipant(){
        $this->load->model("meeting_app_meets", "meets");
        $this->load->model("meeting_app_participants", "participants");
        $this->load->model("zeapps_users", "user");

        $this->load->library('session');

        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        /**** Find the firstname and the lastname in user table who have the same id *****/

        $names = $this->user->fields('firstname,lastname')->get(array("id" => $data["id_participant"]));

        $data["firstname"] = $names -> firstname;
        $data["lastname"]= $names -> lastname;



            if (!$this->participants->get(array("id_participant" => $data["id_participant"], "id_note"=>$data["id_note"]))) {

                $data["id"]=$this->participants->insert($data);
                echo json_encode($data);
            }


    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function loadParticipant($id_meet){
        $this->load->model("meeting_app_participants", "participant");
        $this->load->model("zeapps_users", "user");



        $participants = $this->participant->group_by("id_participant")->get_all(array("id_meet" => $id_meet));

        if ($participants == false) {
            echo json_encode(array());
        } else {
            echo json_encode($participants);
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteParticipant($id){
        $this->load->model("meeting_app_participants", "participant");

        $this->participant->delete($id);



        echo json_encode("OK");
    }



}




