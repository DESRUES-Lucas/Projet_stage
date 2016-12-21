<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citernetype extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('citernetype/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('citernetype/view', $data);
    }







    public function getAll() {
        $this->load->model("fr_abeko_citernes_types", "citernes_types");
        $citernes_types = $this->citernes_types->order_by('nom')->get_all();

        if ($citernes_types == false) {
            echo json_encode(array());
        } else {
            echo json_encode($citernes_types);
        }

    }

    public function get($id) {
        $this->load->model("fr_abeko_citernes_types", "citernes_types");
        echo json_encode($this->citernes_types->get($id));
    }

    public function save() {
        $this->load->model("fr_abeko_citernes_types", "citernes_types");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        $produits = $data["produits"] ;
        unset($data["produits"]);


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->citernes_types->update($data, $data["id"]);
        } else {
            $data["id"] = $this->citernes_types->insert($data);
        }




        // mémorise les données des articles liés
        $this->load->model("fr_abeko_citernes_types_articles", "citernes_types_articles");

        foreach ($produits as $ligne) {
            $data_ligne = array() ;

            $data_ligne["type_point"] = $ligne["type_point"] ;

            // creation
            if ($ligne["id"] == 0 && $ligne["delete"] == 'N') {
                $data_ligne["id_citerne_type"] = $data["id"] ;
                $data_ligne["id_article_compose"] = $ligne["id_article_compose"] ;
                $this->citernes_types_articles->insert($data_ligne);
            }

            // modification
            if ($ligne["id"] != 0 && $ligne["update"] == 'Y' && $ligne["delete"] == 'N') {
                $this->citernes_types_articles->update($data_ligne, $ligne["id"]);
            }


            // suppression
            if ($ligne["id"] != 0 && $ligne["delete"] == 'Y') {
                $this->citernes_types_articles->delete($ligne["id"]);
            }
        }




        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("fr_abeko_citernes_types", "citernes_types");
        $this->citernes_types->delete($id);

        echo json_encode("OK");
    }






    public function getLignesAll($idCiterne, $detail = 'N')
    {
        $this->load->model("fr_abeko_articles_composes", "articles_composes");
        $this->load->model("fr_abeko_citernes_types_articles", "citernes_types_articles");
        $this->load->model("fr_abeko_articles", "articles");


        $citernes_types_articles = $this->citernes_types_articles->get_all(array("id_citerne_type" => $idCiterne));


        if ($citernes_types_articles == false) {
            echo json_encode(array());
        } else {
            $listIdArticle = array();
            for ($i = 0 ; $i < count($citernes_types_articles) ; $i++) {
                $citernes_types_articles[$i]->ref = "";
                $citernes_types_articles[$i]->nom = "";
                $citernes_types_articles[$i]->tarif_ht = 0;

                $listIdArticle[] = $citernes_types_articles[$i]->id_article_compose;
            }


            // charge les produits
            $articles = $this->articles_composes->get_by_id_article($listIdArticle);




            $articles_lignes = array() ;
            $produits = array();
            if ($detail == 'Y') {
                $this->load->model("fr_abeko_articles_composes_lignes", "articles_composes_lignes");
                
                $articles_lignes = $this->articles_composes_lignes->get_by_id_article($listIdArticle);


                $listIdProduit = array();
                for ($i = 0 ; $i < count($articles_lignes) ; $i++) {
                    if (!in_array($articles_lignes[$i]->id_produit, $listIdProduit)) {
                        $listIdProduit[] = $articles_lignes[$i]->id_produit ;
                    }
                }



                $produits = $this->articles->get_by_id_article($listIdProduit);
            }


            foreach ($articles as $article) {
                foreach ($citernes_types_articles as $ligne) {
                    if ($article->id == $ligne->id_article_compose) {
                        $ligne->ref = $article->ref ;
                        $ligne->nom = $article->nom ;
                        $ligne->prix_ht = $article->prix_ht ;
                    }
                }
            }


            if ($detail == 'Y') {
                foreach ($citernes_types_articles as $ligne) {
                    $ligne->produits = array() ;
                    foreach ($articles_lignes as $article_ligne) {
                        if ($article_ligne->id_article_compose == $ligne->id_article_compose) {
                            $dataProduit = new stdClass() ;
                            $dataProduit->quantite = $article_ligne->quantite ;

                            foreach ($produits as $produit) {
                                if ($produit->id == $article_ligne->id_produit) {
                                    $dataProduit->id_produit = $article_ligne->id_produit ;
                                    $dataProduit->ref = $produit->reference ;
                                    $dataProduit->nom = $produit->libelle ;
                                    $dataProduit->prix_unitaire_ht = $produit->prix_achat_ht ;

                                    $ligne->produits[] = $dataProduit ;
                                    break ;
                                }
                            }
                        }
                    }
                }
            }



            echo json_encode($citernes_types_articles);
        }
    }
}
