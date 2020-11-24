<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    if (!isset($_SESSION['admin_id'])){
			redirect('admin', 'redirect');
    } 
    
    $this->load->library('grocery_CRUD');
    $this->load->library('image_crud');
    
  }

  public function actus()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('actus');
    $crud->set_field_upload('photo','uploads/actus');

    $data['contents'] = 'bo/actus';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }
  
  public function albumsPhotos()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('albums');

    $data['contents'] = 'bo/albums-crud';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }

  public function promotions()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('promotions');

    $data['contents'] = 'bo/promotions';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }

  public function domains()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('domains');

    $data['contents'] = 'bo/domains';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }

  public function events()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('events');

    $crud->set_field_upload('photo','uploads/events');
    $data['contents'] = 'bo/events';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }

  public function faculties()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('faculties');

    $data['contents'] = 'bo/faculties';
    $data['crud'] = $crud->render();
    $this->load->view('template/bo-layout', $data);
  }

  public function albums() {
    $this->load->model('album_model');
    $data['contents'] = 'bo/albums';
    $data['albums'] = $this->album_model->getAll();
    $this->load->view('template/bo-layout', $data);
  }

  public function photos($album_id)
  {
    $this->load->model('album_model');
    
    $image_crud = new Image_crud();

    $image_crud->set_primary_key_field('id');
    $image_crud->set_url_field('url');
    $image_crud->set_table('photos')->set_image_path('uploads/galerie');
    $image_crud->set_title_field('title');
    $image_crud->set_relation_field('album_id');

    $data['contents'] = 'bo/photos';
    $data['crud'] = $image_crud->render();
    $data['album'] = $this->album_model->getById($album_id);
    $this->load->view('template/bo-layout', $data);
  }
}
