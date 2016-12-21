<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller
{
    public function form()
    {
        $data = array() ;

        $this->load->view('task/form', $data);
    }

    public function mytask()
    {
        $data = array() ;

        $this->load->view('task/mytask', $data);
    }












    public function getmytask() {
        $this->load->library('session');
        $this->load->model("zeapps_users", "user");
        $this->load->model("zeapps_project_tasks", "project_tasks");
        $this->load->model("zeapps_projects", "project");
        $this->load->model("zeapps_project_sections", "section");
        $this->load->model("zeapps_companies", "company");

        // verifie si la session est active
        if ($this->session->userdata('token')) {
            $user = $this->user->getUserByToken($this->session->userdata('token'));
            if ($user) {
                $project_tasks = $this->project_tasks->order_by('order_section')->get_all(array('id_assigned_to' => $user->id));

                if ($project_tasks) {

                    $id_projects = array();
                    $id_customers = array();
                    $id_sections = array();


                    foreach ($project_tasks as $task) {
                        // recherche tous les projets associés
                        if (!in_array($task->id_project, $id_projects)) {
                            $id_projects[] = $task->id_project;
                        }


                        // recherche toutes les sections
                        if ($task->id_section != 0) {
                            if (!in_array($task->id_section, $id_sections)) {
                                $id_sections[] = $task->id_section;
                            }
                        }
                    }

                    // charge les projets
                    $projets = array();
                    if (count($id_projects) > 0) {
                        //$projets = $this->project->order_by('id')->get_all(array('id' => $id_projects, 'archived_at'=>NULL));
                        $projets = $this->project->order_by('id')->get_by_ids($id_projects);
                        //echo var_dump($projets) ;
                        //exit();


                        foreach ($projets as $projet) {
                            // recherche tous les clients
                            if (!in_array($projet->id_company, $id_customers)) {
                                $id_customers[] = $projet->id_company;
                            }
                        }


                        // charge les clients
                        $companies = $this->company->get_all(array('id' => $id_customers));

                        // charge les clients
                        $sections = $this->section->order_by('order_section')->get_all(array('id' => $id_sections));


                        foreach ($projets as $projet) {
                            foreach ($companies as $company) {
                                if ($projet->id_company == $company->id) {
                                    $projet->company_name = $company->company_name;
                                    break;
                                }
                            }

                            $projet->section_list = array();


                            // ajoute les taches sans section
                            foreach ($project_tasks as $task) {
                                if ($projet->id == $task->id_project && $task->id_section == 0) {
                                    if (!isset($projet->section_list[0])) {
                                        $projet->section_list[0] = array(0, "Sans section", array());
                                    }
                                    $projet->section_list[0][2][] = $task;
                                }
                            }



                            // ajoute les taches avec section
                            foreach ($sections as $section) {
                                if ($projet->id == $section->id_project) {
                                    $index_section_list = -1;

                                    foreach ($project_tasks as $task) {
                                        if ($projet->id == $task->id_project && $task->id_section == $section->id) {
                                            if ($index_section_list == -1) {
                                                $projet->section_list[] = array($section->id, $section->name, array());
                                                $index_section_list = count($projet->section_list) - 1;
                                            }
                                            $projet->section_list[$index_section_list][2][] = $task;
                                        }
                                    }
                                }
                            }



                        }
                    }

                    echo json_encode($projets);
                } else {
                    echo json_encode(false);
                }
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }




        /*
        $project_tasks = $this->project_tasks->order_by("order_section")->get_all(array("id_project" => $id_project));

        if ($project_tasks == false) {
            echo json_encode(array());
        } else {
            echo json_encode($project_tasks);
        }*/
    }




    public function getAll($id_project) {
        $this->load->model("zeapps_project_tasks", "project_tasks");
        $project_tasks = $this->project_tasks->order_by("order_section")->get_all(array("id_project" => $id_project));

        if ($project_tasks == false) {
            echo json_encode(array());
        } else {
            echo json_encode($project_tasks);
        }
    }

    public function get($id) {
        $this->load->model("zeapps_project_tasks", "project_tasks");
        echo json_encode($this->project_tasks->get($id));
    }


    public function updateOrder() {
        $this->load->model("zeapps_project_tasks", "project_tasks");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        $listIdToUpdate = explode(",", $data["ids"]);
        $order = 0 ;
        foreach($listIdToUpdate as $id) {
            $order++ ;

            $dataTmp = array();
            $dataTmp["order_section"] = $order ;

            $this->project_tasks->update($dataTmp, trim($id) * 1);
        }

        echo json_encode("OK");
    }



    public function save() {
        $this->load->model("zeapps_project_tasks", "project_tasks");


        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        if (!isset($data["id_section"])) {
            $data["id_section"] = 0 ;
        }



        // récupère l'ordre de la dernière section
        if (!(isset($data["id"]) && is_numeric($data["id"]))) {
            $data["order_section"] = $this->getNextOrdre($data["id_project"], $data["id_section"]) ;
        } else {
            $oldData = $this->project_tasks->get($data["id"]) ;
            if ($oldData->id_section != $data["id_section"]) {
                $data["order_section"] = $this->getNextOrdre($data["id_project"], $data["id_section"]) ;
            }
        }




        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->project_tasks->update($data, $data["id"]);
        } else {
            $this->project_tasks->insert($data);
        }

        echo json_encode("OK");
    }


    private function getNextOrdre($id_project, $id_section) {
        $this->load->model("zeapps_project_tasks", "project_tasks");

        $order = 1 ;

        $project_tasks = $this->project_tasks->get_max_order($id_project, $id_section);
        if (isset($project_tasks[0]->order_section)) {
            $order = $project_tasks[0]->order_section * 1 ;
            $order++;
        }

        return $order ;
    }



    public function delete($id) {
        $this->load->model("zeapps_project_tasks", "project_tasks");
        $this->project_tasks->delete($id);

        echo json_encode("OK");
    }



    public function completed($id) {
        $this->load->model("zeapps_project_tasks", "project_tasks");


        $data = array() ;
        $data["completed_at"] = date("Y-m-d H:i:s") ;
        $this->project_tasks->update($data, $id);

        echo json_encode("OK");
    }

}
