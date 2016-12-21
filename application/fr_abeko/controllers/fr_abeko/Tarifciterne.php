<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifciterne extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('tarifciterne/search', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('tarifciterne/view', $data);
    }





    public function get_by_id_tarif($argIdTarif) {
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");

        $idsTarif = explode(',', $argIdTarif);
        if(is_array($idsTarif)){
            $tarifs = [];
            foreach($idsTarif as $idTarif){
                array_push($tarifs, $this->tarifs->order_by('nom')->get($idTarif));
            }
        }
        else{
            $tarifs = $this->tarifs->order_by('nom')->get($idsTarif);
        }

        if ($tarifs == false) {
            echo json_encode(array());
        } else {
            echo json_encode($tarifs);
        }

    }

    public function getAll() {
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");
        $tarifs = $this->tarifs->order_by('nom')->get_all();

        if ($tarifs == false) {
            echo json_encode(array());
        } else {
            echo json_encode($tarifs);
        }

    }

    public function get($id) {
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");
        echo json_encode($this->tarifs->get($id));
    }

    public function save() {
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        $ligne_tarif = $data["ligne_tarifs"] ;
        unset($data["ligne_tarifs"]);


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->tarifs->update($data, $data["id"]);
        } else {
            $data["id"] = $this->tarifs->insert($data);
        }




        // mémorise les données des lignes
        $this->load->model("fr_abeko_citerne_tarifs_lignes", "tarifs_lignes");
        foreach ($ligne_tarif as $ligne) {
            // creation
            if ($ligne["id"] == 0 && $ligne["delete"] == 'N') {
                $ligne["id_tarif"] = $data["id"] ;
                $this->tarifs_lignes->insert($ligne);
            }

            // modification
            if ($ligne["id"] != 0 && $ligne["update"] == 'Y' && $ligne["delete"] == 'N') {
                $this->tarifs_lignes->update($ligne, $ligne["id"]);
            }


            // suppression
            if ($ligne["id"] != 0 && $ligne["delete"] == 'Y') {
                $this->tarifs_lignes->delete($ligne["id"]);
            }
        }




        echo json_encode("OK");
    }


    public function delete($id) {
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");
        $this->load->model("fr_abeko_citerne_tarifs_lignes", "tarifs_lignes");
        $this->tarifs->delete($id);

        $tarif_lignes = $this->tarifs_lignes->get_all(array('id_tarif' => $id));
        if(is_array($tarif_lignes)) {
            foreach ($tarif_lignes as $tarif_ligne) {
                $this->tarifs_lignes->delete($tarif_ligne->id);
            }
        }

        echo json_encode("OK");
    }







    public function duplicate($id){
        $this->load->model("fr_abeko_citerne_tarifs", "tarifs");
        $this->load->model("fr_abeko_citerne_tarifs_lignes", "tarifs_lignes");

        if($id){
            $tarif = $this->tarifs->get($id);
            unset($tarif->id);
            $newId = $this->tarifs->insert($tarif);
            $tarif_lignes = $this->tarifs_lignes->get_all(array('id_tarif' => $id));
            if(is_array($tarif_lignes)) {
                foreach ($tarif_lignes as $tarif_ligne) {
                    unset($tarif_ligne->id);
                    $tarif_ligne->id_tarif = $newId;
                    $this->tarifs_lignes->insert($tarif_ligne);
                }
            }
            $tarif->id = $newId;
            echo json_encode($tarif);
        }

        return;
    }

    public function getLignesAll($idTarif) {
        $this->load->model("fr_abeko_citerne_tarifs_lignes", "tarifs_lignes");
        $tarifs_lignes = $this->tarifs_lignes->order_by('m3')->get_all(array("id_tarif"=>$idTarif));

        if ($tarifs_lignes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($tarifs_lignes);
        }

    }
}
