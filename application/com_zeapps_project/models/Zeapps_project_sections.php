<?php
class Zeapps_project_sections extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }


    public function get_max_order($id_project)
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


            $where = array("id_project" => $id_project) ;
            $this->_select = "max(order_section) as order_section" ;

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