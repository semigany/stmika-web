<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
{
  public function index()
  {
        $this->load->model('album_model');
        $data['contents'] = 'albums';
        $data['albums'] = $this->album_model->getAllWithThumb();
        $this->load->view('template/layout', $data);
  }

  public function detail($id)
  {
        $this->load->model('album_model');
        $data['contents'] = 'album-photos';
        $data['album'] = $this->album_model->getById($id);
        $data['photos'] = $this->album_model->getPhotos($id);
        $this->load->view('template/layout', $data);
  }
}
