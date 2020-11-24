<?php
    class Faculty_model extends CI_Model {
        public function getAll (){
            $query = $this->db->get('faculties');
            return $query->result();

        }
        public function getById($id) {
            $this->db->where('id', $id);
            $query = $this->db->get('faculties');
            return $query->row();
        }
    }
?>