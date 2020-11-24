<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Association extends CI_Controller {
  public function index() {
    $data['contents'] = 'association';
    $this->load->view('template/layout', $data);
  }
}