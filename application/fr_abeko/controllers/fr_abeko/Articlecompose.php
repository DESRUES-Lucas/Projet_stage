<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articlecompose extends CI_Controller
{
    public function modal_search_article_compose()
    {
        $data = array() ;

        $this->load->view('articlecompose/modal_search_article_compose', $data);
    }


    public function search()
    {
        $data = array();

        $this->load->view('articlecompose/search', $data);
    }

    public function view()
    {
        $data = array();

        $this->load->view('articlecompose/view', $data);
    }


    public function getAll()
    {
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        $articles_composes = $this->articles_composes->order_by('nom')->get_all();

        if ($articles_composes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($articles_composes);
        }

    }

    public function get($id)
    {
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        echo json_encode($this->articles_composes->get($id));
    }

    public function save()
    {
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        $this->load->model("fr_abeko_articles_composes_lignes", "articles_composes_lignes");

        // constitution du tableau
        $data = array();

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        $produits = $data["produits"] ;
        unset($data["produits"]);
        
        
        

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->articles_composes->update($data, $data["id"]);
        } else {
            $data["id"] = $this->articles_composes->insert($data);
        }






        // mémorise les données des lignes
        foreach ($produits as $ligne) {
            // creation
            if ($ligne["id"] == 0 && $ligne["delete"] == 'N') {
                $ligne["id_article_compose"] = $data["id"] ;
                $this->articles_composes_lignes->insert($ligne);
            }

            // modification
            if ($ligne["id"] != 0 && $ligne["update"] == 'Y' && $ligne["delete"] == 'N') {
                $this->articles_composes_lignes->update($ligne, $ligne["id"]);
            }


            // suppression
            if ($ligne["id"] != 0 && $ligne["delete"] == 'Y') {
                $this->articles_composes_lignes->delete($ligne["id"]);
            }
        }
        
        
        

        echo json_encode("OK");
    }




    public function delete($id)
    {
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        $this->load->model("fr_abeko_articles_composes_lignes", "articles_composes_lignes");
        $this->articles_composes->delete($id);

        $articles_composes_lignes = $this->articles_composes_lignes->get_all(array('id_article_compose' => $id));
        if(is_array($articles_composes_lignes)) {
            foreach ($articles_composes_lignes as $articles_composes_ligne) {
                $this->articles_composes_lignes->delete($articles_composes_ligne->id);
            }
        }

        echo json_encode("OK");
    }




    public function duplicate($id){
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        $this->load->model("fr_abeko_articles_composes_lignes", "articles_composes_lignes");

        if($id){
            $articles_composes = $this->articles_composes->get($id);
            unset($articles_composes->id);
            $newId = $this->articles_composes->insert($articles_composes);
            $articles_composes_lignes = $this->articles_composes_lignes->get_all(array('id_article_compose' => $id));
            if(is_array($articles_composes_lignes)) {
                foreach ($articles_composes_lignes as $articles_composes_ligne) {
                    unset($articles_composes_ligne->id);
                    $articles_composes_ligne->id_article_compose = $newId;
                    $this->articles_composes_lignes->insert($articles_composes_ligne);
                }
            }
            $articles_composes->id = $newId;
            echo json_encode($articles_composes);
        }

        return;
    }


    public function getLignesAll($idArticle)
    {
        $this->load->model("fr_abeko_articles_composes_lignes", "articles_composes_lignes");
        $this->load->model("fr_abeko_articles", "articles");

        $articles_composes_lignes = $this->articles_composes_lignes->get_all(array("id_article_compose" => $idArticle));


        if ($articles_composes_lignes == false) {
            echo json_encode(array());
        } else {
            $listIdArticles = array();
            for ($i = 0 ; $i < count($articles_composes_lignes) ; $i++) {
                $articles_composes_lignes[$i]->CODE_PRODUIT = "";
                $articles_composes_lignes[$i]->LIBELLE = "";
                $articles_composes_lignes[$i]->tarif_ht = 0;

                $listIdArticles[] = $articles_composes_lignes[$i]->id_produit;
            }



            // charge les produits
            $articles_de_base = $this->articles->get_by_id_article($listIdArticles);

            foreach ($articles_de_base as $produit) {
                foreach ($articles_composes_lignes as $ligne) {
                    if ($produit->id == $ligne->id_produit) {
                        $ligne->reference = $produit->reference ;
                        $ligne->libelle = $produit->libelle ;
                        $ligne->prix_achat_ht = $produit->prix_achat_ht ;
                    }
                }
            }

            echo json_encode($articles_composes_lignes);
        }

    }


}
