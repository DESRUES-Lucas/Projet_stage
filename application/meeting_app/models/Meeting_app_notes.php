<?php

class Meeting_app_notes extends MY_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }

    public function updatePositions($position, $id_meet, $id_project, $id_subject) {
        return $this->db->query("UPDATE Meeting_app_notes SET position = (position+1) WHERE position >= "
            .$position." AND id_meet = ".$id_meet." AND id_project = ".$id_project." AND id_subject = ".$id_subject);
    }

    public function updateOldTable($position) {
        return $this->db->query("UPDATE Meeting_app_notes SET position = (position-1) WHERE position > ".$position);
    }

    public function updateNewTable($position) {
        return $this->db->query("UPDATE Meeting_app_notes SET position = (position+1) WHERE position >= ".$position);
    }

    //Must think about soft delete for don't count deleted notes

    public function countNotesByProject($id_project){
        return $this->db->query("SELECT status FROM meeting_app_notes WHERE id_project = ".$id_project." AND deleted_at IS NULL")->result();
    }

    public function countDoneNotesByProject($id_project){
        return $this->db->query("SELECT status FROM meeting_app_notes WHERE status = 1 AND id_project = ".$id_project." AND deleted_at IS NULL")->result();
    }

}