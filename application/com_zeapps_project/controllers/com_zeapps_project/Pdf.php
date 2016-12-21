<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller
{
    public function task_project($id_project)
    {
        $dataPDF = array();




        // charge le projet
        $this->load->model("zeapps_projects", "projects");
        $dataPDF["project"] = $this->projects->get($id_project);



        // charge toutes les sections du projet
        $this->load->model("zeapps_project_sections", "project_sections");
        $dataPDF["sections"] = $this->project_sections->order_by("order_section")->get_all(array("id_project" => $id_project));




        // charge toutes les taches du projet
        $this->load->model("zeapps_project_tasks", "project_tasks");
        $dataPDF["tasks"] = $this->project_tasks->order_by("order_section")->get_all(array("id_project" => $id_project));











        // import du fichier CSS
        //$dataPDF["css"] = file_get_contents(FCPATH . "assets/bootstrap-3.3.6/dist/css/bootstrap.min.css") ;



        //load the view and saved it into $html variable
        $html = $this->load->view('pdf/task_project', $dataPDF, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = FCPATH . 'application/com_zeapps_project/tmp/test.pdf';

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "F");
    }

    public function downloadPDF() {
        $file_url = FCPATH . 'application/com_zeapps_project/tmp/test.pdf';
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}
