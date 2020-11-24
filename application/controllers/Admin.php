<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('bo/sign-in');
	}

	public function signIn()
	{
		$this->load->model('user_model');
		$rules = array(
			array(
				'field' => 'username',
				'label' => 'Nom d\'utilisateur',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Nom d\'utilisateur vide'
				)
			),
			array(
				'field' => 'password',
				'label' => 'Mot de passe',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Veuillez entrer le mot de passe'
				),
			),
		);
		$this->form_validation->set_rules($rules);
		try {
			if ($this->form_validation->run()) {
				$user = $this->user_model->administratorCredentials($this->input->post('username'), $this->input->post('password'));
				$_SESSION['admin_id'] = $user->id;
				$_SESSION['admin_first_name'] = $user->first_name;
				$_SESSION['admin_last_name'] = $user->last_name;
				$_SESSION['admin_username'] = $user->username;
				redirect('crud/actus', 'refresh');
			} else {
				redirect('admin');
			}
		} catch (Exception $ex) {
			redirect('admin');
		}
	}

	public function logout()
	{
		unset($_SESSION['admin_id'],
		$_SESSION['admin_first_name'],
		$_SESSION['admin_last_name'],
		$_SESSION['admin_username']);
		redirect('admin', 'refresh');
    }
}
