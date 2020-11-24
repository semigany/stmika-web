<?php
class Event_model extends CI_Model
{
  public function getAll()
  {
    $query = $this->db->get('events');
    return $query->result();
  }

  public function getFive() {
    $this->db->order_by('start_at', 'DESC');
    $this->db->limit(5);
    $query = $this->db->get('events');
    return $query->result();
  }
}
