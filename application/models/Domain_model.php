<?php
    class Domain_model extends CI_Model {
        public function getAll (){
            $query = $this->db->get('domains');
            return $query->result();
        }

        public function getById($id) {
            $this->db->where('id', $id);
            $query = $this->db->get('domains');
            return $query->row();
        }
    }
?>