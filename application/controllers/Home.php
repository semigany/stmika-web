<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function index()
  {
    $this->load->model('event_model');
    $this->load->model('actus_model');
    $this->load->model('album_model');
    $data['contents'] = 'home';
    $data['events'] = $this->event_model->getFive();
    $data['actus'] = $this->actus_model->getThree();
    $data['photos'] = $this->album_model->getTenRandom();
    $this->load->view('template/layout', $data);
  }

  public function historique() {
    $data['contents'] = 'historique';
    $this->load->view('template/layout', $data);
  }
}
