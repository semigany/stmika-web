<?php
class Actus_model extends CI_Model
{
  public function getAll()
  {
    $query = $this->db->get('actus');
    return $query->result();
  }

  public function getThree() {
    $this->db->order_by('date', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get('actus');
    return $query->result();
  }

  public function getById($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('actus');
    return $query->row();
  }
}
