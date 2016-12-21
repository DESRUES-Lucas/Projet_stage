<?php
class Zeapps_projects extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }





    public function get_search($data_filter)
    {
        $data = $this->_get_from_cache();

        if(isset($data) && $data !== FALSE)
        {
            $this->_database->reset_query();
            return $data;
        }
        else
        {
            $this->trigger('before_get');


            $where_tmp = "" ;

            if (isset($data_filter["filter_priority"]) && count($data_filter["filter_priority"]) > 0) {
                if ($where_tmp != "") {
                    $where_tmp .= " AND " ;
                }
                $where_tmp .= " priority IN (" ;
                $where_in = "" ;
                foreach ($data_filter["filter_priority"] as $priority) {
                    if ($where_in != "") {
                        $where_in .= ", " ;
                    }
                    $where_in .= $priority ;
                }
                $where_tmp .= $where_in . ") " ;
            }

            if (isset($data_filter["filter_status"]) && count($data_filter["filter_status"]) > 0) {
                if ($where_tmp != "") {
                    $where_tmp .= " AND " ;
                }
                $where_tmp .= " status IN (" ;
                $where_in = "" ;
                foreach ($data_filter["filter_status"] as $status) {
                    if ($where_in != "") {
                        $where_in .= ", " ;
                    }
                    $where_in .= $status ;
                }
                $where_tmp .= $where_in . ") " ;
            }


            if ($where_tmp != "") {
                $where_tmp .= " AND " ;
            }
            $where_tmp .= " deleted_at IS NULL" ;




            if ($where_tmp != '') {
                $this->_database->where($where_tmp, NULL, FALSE);
            }



            for ($champs = 1 ; $champs <= 4 ; $champs++) {
                if (isset($data_filter["critere_affichage_" . $champs]) && $data_filter["critere_affichage_" . $champs] != "0") {
                    if ($data_filter["critere_affichage_" . $champs] == "1") {
                        $this->_database->order_by('status', 'ASC');
                    } else if ($data_filter["critere_affichage_" . $champs] == "2") {
                        $this->_database->order_by('priority', 'DESC');
                    } else if ($data_filter["critere_affichage_" . $champs] == "3") {
                        $this->_database->order_by('name_user_project_manager', 'ASC');
                    } else if ($data_filter["critere_affichage_" . $champs] == "4") {
                        $this->_database->order_by('company_name', 'ASC');
                    }
                }
            }



            if(isset($where))
            {
                $this->where($where);
            }
            elseif($this->soft_deletes===TRUE)
            {
                $this->_where_trashed();
            }
            if(isset($this->_select))
            {
                $this->_database->select($this->_select);
            }
            if(!empty($this->_requested))
            {
                foreach($this->_requested as $requested)
                {
                    $this->_database->select($this->_relationships[$requested['request']]['local_key']);
                }
            }
            $query = $this->_database->get($this->table);
            if($query->num_rows() > 0)
            {
                $data = $query->result_array();
                $data = $this->trigger('after_get', $data);
                $data = $this->_prep_after_read($data,TRUE);
                $this->_write_to_cache($data);
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
    }




    public function get_by_ids($ids_list = array())
    {
        $data = $this->_get_from_cache();

        if(isset($data) && $data !== FALSE)
        {
            $this->_database->reset_query();
            return $data;
        }
        else
        {
            $this->trigger('before_get');
            
            if (count($ids_list)> 0) {
                $valueIn = "" ;

                foreach ($ids_list as $id) {
                    if ($valueIn != "") {
                        $valueIn .= ", " ;
                    }
                    $valueIn .= $id ;
                }


                $this->_database->where('id in (' . $valueIn . ') AND archived_at IS NULL', NULL, FALSE);
            } else {
                $this->_database->where('archived_at IS NULL', NULL, FALSE);
            }



            if(isset($where))
            {
                $this->where($where);
            }
            elseif($this->soft_deletes===TRUE)
            {
                $this->_where_trashed();
            }
            if(isset($this->_select))
            {
                $this->_database->select($this->_select);
            }
            if(!empty($this->_requested))
            {
                foreach($this->_requested as $requested)
                {
                    $this->_database->select($this->_relationships[$requested['request']]['local_key']);
                }
            }
            $query = $this->_database->get($this->table);
            if($query->num_rows() > 0)
            {
                $data = $query->result_array();
                $data = $this->trigger('after_get', $data);
                $data = $this->_prep_after_read($data,TRUE);
                $this->_write_to_cache($data);
                return $data;
            }
            else
            {
                return FALSE;
            }
        }
    }
}