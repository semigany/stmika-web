<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
  public function index()
  {
    $this->load->model('event_model');
    $data['contents'] = 'events';
    $data['events'] = $this->event_model->getAll();
    $this->load->view('template/layout', $data);
  }
}
