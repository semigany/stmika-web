<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annuaire extends CI_Controller {
	public function index()
	{
		if (!isset($_SESSION['id'])){
			redirect('user/signInForm', 'redirect');
		} 
		$this->load->library('pagination');
		$this->load->model('user_model');
		$this->load->model('domain_model');
		$this->load->model('promotion_model');
		$this->load->model('faculty_model');

		$perPage = 20;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$result = $this->user_model->get_current_page_records(
			$perPage,
			$start_index,
			$this->input->get('search'),
			$this->input->get('promotion_id'),
			$this->input->get('domain_id'),
			$this->input->get('faculty_id'),
			$this->input->get('start_year'),
			$this->input->get('end_year')
		);

		$total = $result->rows;

		$config['base_url'] = base_url('/annuaire/index');
		$config['total_rows'] = $total;
		$config['per_page'] = $perPage;
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="page-item page-link">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item page-link">';
		$config['last_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';


		$this->pagination->initialize($config);

		$data['contents'] = 'list';
		$data['users'] = $result->users;
		$data['domains'] = $this->domain_model->getAll();
		$data['promotions'] = $this->promotion_model->getAll();
		$data['faculties'] = $this->faculty_model->getAll();
		$data['search'] = $this->input->get('search');
		$data['promotion_id'] = $this->input->get('promotion_id');
		$data['faculty_id'] = $this->input->get('faculty_id');
		$data['domain_id'] = $this->input->get('domain_id');
		$data['start_year'] = $this->input->get('start_year');
		$data['end_year'] = $this->input->get('end_year');
		$this->load->view('template/layout', $data);
	}
}
