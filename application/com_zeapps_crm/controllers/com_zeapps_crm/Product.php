<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function view()
    {
        $data = array() ;

        $this->load->view('product/view', $data);
    }

    public function details()
    {
        $data = array() ;

        $this->load->view('product/details', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('product/form', $data);
    }

    public function form_category()
    {
        $data = array() ;

        $this->load->view('product/form_category', $data);
    }







    public function get_categories_tree(){
        $this->load->model("Com_zeapps_crm_product_categories", "categories");
        $categories = $this->categories->order_by('sort')->get_all();
        if ($categories == false) {
            echo json_encode(array());
        } else {
            $result = $this->build_tree($categories);
            echo json_encode($result);
        }
    }

    public function get_category($id = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $category = $this->categories->get($id);
            if($this->db->error()['code'] == 0) {
                echo json_encode($category);
                return;
            }
            else{
                echo json_encode(array('error'=>'The category you asked for doesn\'t seem to exist in the Database, please try again ! If the problem persists make sure you are using a valid url or contact the administrator of this website.'));
                return;
            }
        }
        else
            return;
    }

    public function update_categories_order(){
        $this->load->model("Com_zeapps_crm_product_categories", "categories");

        $error = NULL;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);

            if($error === NULL) {
                if (count($data['categories']) > 1) {
                    foreach ($data['categories'] as $category) {
                        $this->categories->update(array('sort' => intval($category['sort'])), array('id' => intval($category['id'])));
                    }
                }
            }
        }

        echo json_encode(array('error'=>$error));

        return;
    }

    public function getSubCategoriesOf($id = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $categories = $this->categories->get_all("id_parent", $id);
            if($this->db->error()['code'] == 0) {
                echo json_encode($categories);
                return;
            }
            else{
                echo json_encode(array('error'=>'There was an error while accessing the Database, please try again ! If the problem persists contact the administrator of this website.'));
                return;
            }
        }
        else
            return;
    }

    public function save_category() {
        $this->load->model("Com_zeapps_crm_product_categories", "categories");

        $error = NULL;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);

            $error = $this->categories->test($data);

            if($error === NULL) {
                if (isset($data["id"]) && is_numeric($data["id"])) {
                    $this->categories->failproof_update($data, $data["id"]);
                    if ($this->db->error()['code'] == 0) {
                        echo json_encode("OK");
                        return;
                    }
                    else {
                        $error = 'There was an error when trying to access the Database, please try again ! If the problem persists contact the administrator of this website.';
                    }
                } else {
                    $this->categories->insert($data);
                    if ($this->db->error()['code'] == 0) {
                        $this->categories->newProductIn($data['category']);
                        echo json_encode("OK");
                        return;
                    }
                    else {
                        $error = 'There was an error when trying to access the Database, please try again ! If the problem persists contact the administrator of this website.';
                    }
                }
            }
        }
        else {
            $error = 'The data sent was not in a JSON format or had the wrong headers, cannot process the request.';
        }

        echo json_encode(array('error'=>$error));

        return;

    }

    public function delete_category($id = NULL, $force_delete = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $category = $this->categories->get($id);
            if( (intval($category->nb_products_r) > 0 || intval($category->nb_products) > 0) && !isset($force_delete) ){
                echo json_encode(array('hasProducts' => true));
                return;
            }
            else {
                if ((intval($category->nb_products_r) == 0 && intval($category->nb_products) == 0) || (isset($force_delete) && $force_delete === "true")) {
                    $this->force_delete($id);
                    return;
                } else if (isset($force_delete) && $force_delete === "false") {
                    echo '2';
                    $this->safe_delete($id);
                    return;
                }
            }

            return;
        }
        else
            return;
    }




    public function get_product($id = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_products", "products");
            $product = $this->products->get($id);
            if($this->db->error()['code'] == 0) {
                echo json_encode($product);
                return;
            }
            else{
                echo json_encode(array('error'=>'The product you asked for doesn\'t seem to exist in the Database, please try again ! If the problem persists make sure you are using a valid url or contact the administrator of this website.'));
                return;
            }
        }
        else
            return;
    }

    public function getProductsOf($id = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_products", "products");
            $products = $this->products->get_all(array('category' => intval($id)));
            if($this->db->error()['code'] == 0) {
                echo json_encode($products);
                return;
            }
            else{
                echo json_encode(array('error'=>'There was an error while accessing the Database, please try again ! If the problem persists contact the administrator of this website.'));
                return;
            }
        }
        else
            return;
    }

    public function save_product() {
        $this->load->model("Com_zeapps_crm_product_products", "products");
        $this->load->model("Com_zeapps_crm_product_categories", "categories");

        $error = NULL;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);

            $error = $this->products->test($data);

            if($error === NULL) {
                if (isset($data["id"]) && is_numeric($data["id"])) {
                    $legacy = $this->products->get($data["id"]);
                    $this->products->update($data, $data["id"]);
                    if ($this->db->error()['code'] == 0) {
                        if($data["category"] != $legacy->category) {
                            $this->categories->newProductIn($data['category']);
                            if($legacy->category > 0)
                                $this->categories->removeProductIn($legacy->category);
                        }
                        echo json_encode("OK");
                        return;
                    }
                    else {
                        $error = 'There was an error when trying to access the Database, please try again ! If the problem persists contact the administrator of this website.';
                    }
                } else {
                    $this->products->insert($data);
                    if ($this->db->error()['code'] == 0) {
                        $this->categories->newProductIn($data['category']);
                        echo json_encode("OK");
                        return;
                    }
                    else {
                        $error = 'There was an error when trying to access the Database, please try again ! If the problem persists contact the administrator of this website.';
                    }
                }
            }
        }
        else {
            $error = 'The data sent was not in a JSON format or had the wrong headers, cannot process the request.';
        }

        echo json_encode(array('error'=>$error));

        return;

    }

    public function delete_product($id = NULL){
        if(isset($id)){
            $this->load->model("Com_zeapps_crm_product_products", "products");
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $product = $this->products->get($id);
            $this->products->delete($id);
            if($this->db->error()['code'] == 0) {
                if($product->category > 0)
                    $this->categories->removeProductIn($product->category);
                return;
            }
            else{
                echo json_encode(array('error'=>'There was an error when deleting the product, please try again ! If the problem persists make sure you are using a valid url or contact the administrator of this website.'));
                return;
            }
        }
        else
            return;
    }





    private function build_tree($categories, $id = -2){
        $result = array();

        foreach($categories as $category){
            if($category->id_parent == $id){

                $tmp = $category;
                $res = $this->build_tree($categories, $category->id);
                if(!empty($res)) {
                    $tmp->branches = $res;
                }
                $tmp->open = false;
                $result[] = $tmp;
            }
        }

        return $result;
    }



    private function force_delete($id = NULL){
        if($id){
            $this->load->model("Com_zeapps_crm_product_products", "products");
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $category = $this->categories->get($id);
            $id_arr = $this->categories->delete_r($id);
            if( intval($category->nb_products_r) > 0 || intval($category->nb_products) > 0 ) {
                $this->categories->removeProductIn($category->id_parent, true, intval($category->nb_products_r) + intval($category->nb_products));
                foreach($id_arr as $id) {
                    $this->products->delete(array('category' => $id));
                }
            }
            return;
        }
        return;
    }

    private function safe_delete($id = NULL){
        if($id){
            $this->load->model("Com_zeapps_crm_product_products", "products");
            $this->load->model("Com_zeapps_crm_product_categories", "categories");
            $category = $this->categories->get($id);
            $id_arr = $this->categories->delete_r($id);
            if( intval($category->nb_products_r) > 0 || intval($category->nb_products) > 0 ) {
                $this->categories->removeProductIn($category->id_parent, true, intval($category->nb_products_r) + intval($category->nb_products));
                $this->products->archive_products($id_arr);
            }
            return;
        }
        return;
    }
}