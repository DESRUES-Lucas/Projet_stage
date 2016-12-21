<?php
class Fr_abeko_plan_produits extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }
}