<?php
class Fr_abeko_logos extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}