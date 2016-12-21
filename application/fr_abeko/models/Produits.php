<?php
class Produits extends MY_Model {
    public $table = 'produit';
    public $primary_key = 'C_PRODUIT';

    public function __construct()
    {
        parent::__construct();

        $this->on("grc");
    }
}