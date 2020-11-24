<?php
class Album_model extends CI_Model
{
  public function getAll()
  {
    $query = $this->db->get('albums');
    return $query->result();
  }

  public function getAllWithThumb() {
    
    $query = $this->db->get('albums_view');
    return $query->result();
  }

  public function getById($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('albums');
    return $query->row();
  }

  public function getPhotos($album_id) {
    $this->db->where('album_id', $album_id);
    $query = $this->db->get('photos');
    return $query->result();
  }

  public function getTenRandom() {
    $this->db->order_by('rand()');
    $this->db->limit(8);
    $query = $this->db->get('photos');
    return $query->result();
  }
}
