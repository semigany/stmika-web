<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Errors extends CI_Controller
{
  public function not_found()
  {
    $data['heading'] = '404 not found';
    $data['message'] = 'The page you requested is not available';
    $this->load->view('errors/html/error_404', $data);
  }

}
