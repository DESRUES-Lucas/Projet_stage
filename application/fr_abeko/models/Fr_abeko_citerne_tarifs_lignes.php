<?php
class Fr_abeko_citerne_tarifs_lignes extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}