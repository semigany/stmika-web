<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actus extends CI_Controller
{
  public function index()
  {
    $this->load->model('actus_model');
    $data['contents'] = 'actus';
    $data['actus'] = $this->actus_model->getAll();
    $this->load->view('template/layout', $data);
  }

  public function detail($id)
  {
    $this->load->model('actus_model');
    $data['contents'] = 'actus-detail';
    $data['actu'] = $this->actus_model->getById($id);
    $this->load->view('template/layout', $data);

  }

}
