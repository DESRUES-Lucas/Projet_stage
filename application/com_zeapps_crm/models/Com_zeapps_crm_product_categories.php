<?php
class Com_zeapps_crm_product_categories extends MY_Model {

    private $root;
    private $archive;

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;

        $this->init_default_categories();
    }

    private function init_default_categories(){
        $this->root = new stdClass();
        $this->root->name = 'racine';
        $this->root->id = '0';
        $this->root->id_parent = '-2';
        $this->root->open = false;

        $this->archive = new stdClass();
        $this->archive->name = 'archive';
        $this->archive->id = '-1';
        $this->archive->id_parent = '-2';
        $this->archive->open = false;

        return;
    }

    public function test($data = NULL){
        if($data){
            //Tests to see if the data we receive fits what we want
            if(!isset($data['name']) || empty($data['name']) || !is_string($data['name']) || strlen($data['name']) > 255){
                echo 'There\'s an error with the name of the category, make sure it\'s a string of characters shorter than 256 characters.';
                return;
            }
            else if(!isset($data['id_parent']) || empty($data['id_parent']) || !is_numeric($data['id_parent']) || strlen($data['id_parent']) > 11){
                echo 'There\'s an error with the parent category, make sure to select a category from the list.';
                return;
            }
            else{
                return NULL;
            }
        }
        else{
            return 'no data sent';
        }
        return;
    }

    public function get($where = NULL){
        if($where == 0){
            return $this->root;
        }
        else if($where == -1){
            return $this->archive;
        }
        else{
            return parent::get($where);
        }
        return;
    }

    public function get_all($where = NULL){

        $res = parent::get_all($where);
        if($res)
            array_unshift($res, $this->root, $this->archive);
        else
            $res = array($this->root, $this->archive);

        return $res;
    }

    public function newProductIn($id = NULL, $parent = false){
        if($id) {
            $res = $this->get($id);
            if(!$parent) {
                $data = Array('nb_products' => ($res->nb_products + 1));
                $this->update($data, $id);
            }
            else{
                $data = Array('nb_products_r' => ($res->nb_products_r + 1));
                $this->update($data, $id);
            }
            if($res->id_parent > 0){
                $this->newProductIn($res->id_parent, true);
            }
        }
        return;
    }

    public function removeProductIn($id = NULL, $parent = false, $qty = 1){
        if($id) {
            $res = $this->get($id);
            if(!$parent) {
                $data = Array('nb_products' => ($res->nb_products - $qty));
                $this->update($data, $id);
            }
            else{
                $data = Array('nb_products_r' => ($res->nb_products_r - $qty));
                $this->update($data, $id);
            }
            if($res->id_parent > 0){
                $this->removeProductIn($res->id_parent, true, $qty);
            }
        }
        return;
    }

    public function delete_r($id = NULL, $categories = NULL){
        if($id){
            if(!$categories){
                $categories = $this->get_all();
            }
            $id_arr = array($id);
            foreach($categories as $category){
                if($category->id_parent == $id){
                    $res = $this->delete_r($category->id, $categories);
                    foreach($res as $entry){
                        array_push($id_arr, $entry);
                    }
                }
            }
            $this->delete($id);
            return $id_arr;
        }
        return;
    }
}