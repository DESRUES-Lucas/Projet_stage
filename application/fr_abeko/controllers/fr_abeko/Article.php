<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
    public function modal_search_article()
    {
        $data = array() ;

        $this->load->view('article/modal_search_article', $data);
    }


    public function search()
    {
        $data = array();

        $this->load->view('article/search', $data);
    }

    public function view()
    {
        $data = array();

        $this->load->view('article/view', $data);
    }


    public function getAll()
    {
        $this->load->model("fr_abeko_articles", "articles");
        $articles = $this->articles->order_by('libelle')->get_all();

        if ($articles == false) {
            echo json_encode(array());
        } else {
            echo json_encode($articles);
        }

    }

    public function get($id)
    {
        $this->load->model("fr_abeko_articles", "articles");
        echo json_encode($this->articles->get($id));
    }

    public function save()
    {
        $this->load->model("fr_abeko_articles", "articles");

        // constitution du tableau
        $data = array();

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->articles->update($data, $data["id"]);
        } else {
            $data["id"] = $this->articles->insert($data);
        }


        echo json_encode("OK");
    }




    public function delete($id)
    {
        $this->load->model("fr_abeko_articles", "articles");
        $this->articles->delete($id);

        echo json_encode("OK");
    }

    public function duplicate($id){

        $this->load->model("fr_abeko_articles", "articles");

        if($id){
            $article = $this->articles->get($id);
            unset($article->id);
            $newId = $this->articles->insert($article);
            $article->id = $newId;
            echo json_encode($article);
        }
        return;
    }
    
}
