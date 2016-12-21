<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller
{
    public function search()
    {
        $data = array() ;

        $this->load->view('plan/search', $data);
    }

    public function form()
    {
        $data = array() ;

        $this->load->view('plan/form', $data);
    }

    public function view()
    {
        $data = array() ;

        $this->load->view('plan/view', $data);
    }




    public function downloadPDF() {
        $file_url = FCPATH . 'application/fr_abeko/tmp/test.pdf';
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }


    public function savePDF() {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $cheminFichierImg = FCPATH . 'application/fr_abeko/tmp/test.png' ;

        file_put_contents($cheminFichierImg, base64_decode(explode(",", $data["img"])[1]));


        // construction du fichier PDF
        $dataPDF = array();
        $dataPDF["image"] = $cheminFichierImg;
        $dataPDF["produits"] = $data["produits"];
        $dataPDF["form"] = $data["form"];




        // import du fichier CSS
        $dataPDF["css"] = file_get_contents(FCPATH . "assets/bootstrap-3.3.6/dist/css/bootstrap.min.css") ;



        //load the view and saved it into $html variable
        $html = $this->load->view('plan/PDF', $dataPDF, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = FCPATH . 'application/fr_abeko/tmp/test.pdf';

        //load mPDF library
        $this->load->library('m_pdf');

        // TODO: Get the actual values
        $client = "TrucMachin Chose";
        $typeCiterne = "Citerne en mousse";
        $volume = "1000 m3";
        $typePVC = "CartonMousse";
        $numCommande = "420";

        //set the PDF header
        $this->m_pdf->pdf->SetHeader('Client: '.$client.'<br>Commande n°: '.$numCommande.'|Type de citerne: '.$typeCiterne.'<br>Volume: '.$volume.'<br>Type de PVC :'.$typePVC.'|{DATE d-F-Y}');

        //set the PDF footer
        $this->m_pdf->pdf->SetFooter('{PAGENO}/{nb}');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "F");

        unlink($cheminFichierImg);




        echo json_encode("OK");
    }



    public function getAll() {
        $this->load->model("fr_abeko_plans", "plan");
        $plans = $this->plan->order_by('id', 'DESC')->get_all();

        if ($plans == false) {
            echo json_encode(array());
        } else {
            echo json_encode($plans);
        }

    }

    public function get($id) {
        if($id) {
            $this->load->model("fr_abeko_plans", "plan");
            echo json_encode($this->plan->get($id));
        }
    }

    public function addPosition(){
        $this->load->model("fr_abeko_plan_positions", "plan_position");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if(isset($data)){
            $id = $this->plan_position->insert($data);
            echo json_encode($id);
        }
        return;
    }

    public function updatePosition(){
        $this->load->model("fr_abeko_plan_positions", "plan_position");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if(isset($data['positions']) && is_array($data['positions'])) {
            foreach ($data['positions'] as $positionArr) {
                if (is_array($positionArr)) {
                    for ($i = 0; $i < sizeof($positionArr); $i++) {
                        $this->plan_position->update($positionArr[$i], $positionArr[$i]['id']);
                    }
                }
            }
            return;
        }
    }

    public function delPosition($id = null){
        if($id){
            $this->load->model("fr_abeko_plan_positions", "plan_position");

            $res =  $this->plan_position->delete($id);

            echo json_encode($res);
        }
        return;
    }

    public function addProduit(){
        $this->load->model("fr_abeko_plan_produits", "plan_produit");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if(isset($data)){
            $id = $this->plan_produit->insert($data);
            echo json_encode($id);
        }
        return;
    }

    public function delProduit($id = null){
        if($id){
            $this->load->model("fr_abeko_plan_produits", "plan_produit");

            $res =  $this->plan_produit->delete($id);

            echo json_encode($res);
        }
        return;
    }

    public function save() {
        $this->load->model("fr_abeko_plans", "plan");
        $this->load->model("fr_abeko_plan_produits", "plan_produits");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->plan->update($data, $data["id"]);
        } else {
            $data["id"] = $this->plan->insert($data);
        }

        echo json_encode($data["id"]);
    }

    public function delete($id) {
        $this->load->model("fr_abeko_plans", "plan");
        $this->plan->delete($id);

        echo json_encode("OK");
    }


    public function getPositions($idPlan = null){
        $this->load->model("fr_abeko_plan_positions", "plan_positions");

        if($idPlan){
            $positions = $this->plan_positions->get_all(array('id_plan' => $idPlan));
            echo json_encode($positions);
        }
        return;
    }

    public function getProduits($idPlan = null){
        $this->load->model("fr_abeko_plan_positions", "plan_positions");
        $this->load->model("fr_abeko_plan_produits", "plan_produits");
        $this->load->model("fr_abeko_articles_composes", "articles_composes");

        if($idPlan){
            $produits = $this->plan_produits->get_all(array('id_plan' => $idPlan));
            if(is_array($produits)) {
                foreach ($produits as $produit) {
                    $produit->article = $this->articles_composes->get($produit->id_article_compose);
                    if ($produit->id_position > 0) {
                        $position = $this->plan_positions->get($produit->id_position);
                        if($position) {
                            $produit->type_position = $position->type_position;
                        }
                    }
                }
                echo json_encode($produits);
            }
        }
        return;
    }
}
