<?php
class Zeapps_project_tasks extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->soft_deletes = TRUE;
    }



    /**
     * public function get_all()
     * Retrieves rows from table.
     * @param null $where
     * @return mixed
     */
    public function get_all($where = NULL)
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


            $this->_database->where('completed_at IS NULL', NULL, FALSE);


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


    public function get_max_order($id_project, $id_section)
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


            //$where = "id_project = " . $id_project;
            //$where .= " AND id_section = " . $id_section;
            $where = array() ;
            $where["id_project"] = $id_project ;
            $where["id_section"] = $id_section ;


            $this->where('completed_at IS NULL', NULL, FALSE);


            $this->_select = "max(order_section) as order_section" ;

            if(isset($where))
            {
                $this->where($where, NULL, NULL, FALSE, FALSE, true);
                //$this->where($where);
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

            echo var_dump($query);

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