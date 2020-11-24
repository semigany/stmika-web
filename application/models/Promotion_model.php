<?php
    class Promotion_model extends CI_Model {
        public function getAll (){
            $this->db->order_by('release_year', 'ASC');
            $query = $this->db->get('promotions');
            return $query->result();
        }

    }
?>