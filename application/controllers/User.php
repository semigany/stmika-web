<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function registration()
	{
		if (isset($_SESSION['id'])){
			redirect('home', 'redirect');
		}
		$this->load->model('faculty_model');
		$this->load->model('promotion_model');
		$this->load->model('domain_model');
		$data['contents'] = 'user/registration';
		$data['cgu'] = 'cgu';
		$data['faculties'] = $this->faculty_model->getAll();
		$data['domains'] = $this->domain_model->getAll();
		$data['promotions'] = $this->promotion_model->getAll();
		$this->load->view('template/layout', $data);
	}

	public function submitRegistration()
	{
		if (isset($_SESSION['id'])){
			redirect('home', 'redirect');
		}
		$filename = random_string('alnum', 20);
		$config['upload_path'] = 'uploads/pdp';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '30000';
		$config['file_name'] = $filename;

		$this->load->library('upload', $config);

		$this->load->helper('string');
		$this->load->model('user_model');
		$this->load->model('domain_model');
		$this->load->model('faculty_model');
		$this->load->model('promotion_model');
		$isStudent = empty($this->input->post('student')) ? 0 : 1;
		$isEmployee = empty($this->input->post('employee')) ? 0 : 1;
		$rules = array(
			array(
				'field' => 'first_name',
				'label' => 'Prénom',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Prénom vide'
				)
			),
			array(
				'field' => 'last_name',
				'label' => 'Nom',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Nom vide'
				)
			),
			array(
				'field' => 'email',
				'label' => 'Adresse email',
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => array(
					'required' => 'Email vide',
					'valid_email' => 'Email non valide',
					'is_unique' => 'Cette adresse email est déjà utilisée'
				)
			),
			array(
				'field' => 'start_year',
				'label' => 'Année d\'entrée',
				'rules' => 'required|integer',
				'errors' => array(
					'required' => 'Année d\'entrée manquante',
					'integer' => 'Année d\'entrée non valide'
				)
			),
			array(
				'field' => 'end_year',
				'label' => 'Année de sortie',
				'rules' => "integer|greater_than[" . $this->input->post('start_year') . "]",
				'errors' => array(
					'integer' => 'Année de sortie non valide',
					'greater_than' => "L'année de sortie doit être postérieure à l'année d'entrée"
				)
			),
			array(
				'field' => 'password',
				'label' => 'Mot de passe',
				'rules' => 'required|min_length[8]',
				'errors' => array(
					'required' => 'Mot de passe manquant',
					'min_length' => 'Le mot de passe doit contenir au moins 8 caractères'
				)
			), array(
				'field' => 'passwordconf',
				'label' => 'Confirmation du mot de passe',
				'rules' => 'required|matches[password]',
				'errors' => array(
					'required' => 'Confirmation du mot de passe manquant',
					'matches' => 'Les mots de passe ne sont pas identiques'
				)
			),
			array(
				'field' => 'check-cgu',
				'label' => 'CGU',
				'rules' => "required",
				'errors' => array(
					'required' => 'Vous devez lire et accepter les CGU en cochant sur le checkbox'
				)
			)
		);


		if($isStudent == 1) {
			array_push($rules,
				array(
					'field' => 'faculty_id',
					'label' => 'Filière',
					'rules' => 'is_natural_no_zero',
					'errors' => array(
						'is_natural_no_zero' => 'Veuillez sélectionner votre filière'
					)
				)
			);
		}
		if($isEmployee == 1) {
			array_push($rules,
				array(
					'field' => 'domain_id',
					'label' => 'Secteur d\'activité',
					'rules' => 'is_natural_no_zero',
					'errors' => array(
						'is_natural_no_zero' => 'Veuillez sélectionner votre domaine d\'activité'
					)
				)
			);
		}
		$photo = '';
		if ($this->upload->do_upload('photo')) {
			$this->load->model('user_model');
			$this->load->model('domain_model');
			$this->load->model('faculty_model');
			$this->load->model('promotion_model');
			$uploadData = $this->upload->data();
			if ($uploadData['file_size'] > 1024) {
				$configResize['image_library'] = 'gd2';
				$configResize['maintain_ratio'] = TRUE;
				$configResize['quality'] = 95;
				$configResize['width']         = 400;
				$configResize['source_image'] = $uploadData['full_path'];
				$this->load->library('image_lib', $configResize);
				$this->image_lib->resize();
			}
			$photo = $uploadData['file_name'];
		}
		$data = (object) [
			'identifiant' =>                'cl-' . random_string('alnum', 10),
			'first_name' =>                 $this->input->post('first_name'),
			'last_name' =>                  $this->input->post('last_name'),
			'email' =>                      $this->input->post('email'),
			'phone_number' =>               $this->input->post('phone_number'),
			'birth_date' =>                 $this->input->post('birth_date'),
			'adress' =>                     $this->input->post('adress'),
			'start_year' =>                 $this->input->post('start_year'),
			'end_year' =>                   $this->input->post('end_year'),
			'password' =>                   password_hash($this->input->post('password'), PASSWORD_BCRYPT, ['cost' => 12]),
			'promotion_id' =>               $this->input->post('promotion_id'),
			'student' =>                    $isStudent,
			'photo' =>						$photo,
			'school_name' =>                $this->input->post('school_name'),
			'faculty_id' =>                 $this->input->post('faculty_id'),
			'level' =>                      $this->input->post('level'),
			'employee' =>                   $isEmployee,
			'job_title' =>                  $this->input->post('job_title'),
			'domain_id' =>                  $this->input->post('domain_id'),
			'organization_name' =>               $this->input->post('organization_name'),
			'organization_adress' =>        $this->input->post('organization_adress'),
			'active' =>                    false,
			'request_date' => 				date('Y-m-d'),
			'validation_date' =>			null,
			'validation_note' =>			''
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$this->user_model->insert_entry($data);
			redirect('user/afterSubmission', 'refresh');
		} else {
			$d['faculties'] = $this->faculty_model->getAll();
			$d['promotions'] = $this->promotion_model->getAll();
			$d['domains'] = $this->domain_model->getAll();
			$d['contents'] = 'user/registration';
			$this->load->view('template/layout', $d);
		}
	}

	public function afterSubmission()
	{
		$data['contents'] = 'user/after-registration';
		$this->load->view('template/layout', $data);
	}

	public function signInForm()
	{
		if (isset($_SESSION['id'])){
			redirect('home', 'redirect');
		}
		$data['contents'] = 'user/sign-in';
		$this->load->view('template/layout', $data);
	}

	public function signIn()
	{
		if (isset($_SESSION['id'])){
			redirect('home', 'redirect');
		}
		$this->load->model('user_model');
		$rules = array(
			array(
				'field' => 'emailAddress',
				'label' => 'Adresse email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'required' => 'Adresse email vide',
					'valid_email' => 'Veuillez entrer une adresse email valide'
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
				$user = $this->user_model->getByIdentification($this->input->post('emailAddress'), $this->input->post('password'));
				$_SESSION['id'] = $user->id;
				$_SESSION['first_name'] = $user->first_name;
				$_SESSION['last_name'] = $user->last_name;
				$_SESSION['email'] = $user->email;
				redirect('home', 'refresh');
			} else {
				$data['contents'] = 'user/sign-in';
				$this->load->view('template/layout', $data);
			}
		} catch (Exception $ex) {
			$data['contents'] = 'user/sign-in';
			$data['message'] = $ex;
			$this->load->view('template/layout', $data);
		}
	}

	public function logout()
	{
		unset($_SESSION['id'],
		$_SESSION['first_name'],
		$_SESSION['last_name'],
		$_SESSION['email']);
		redirect('home', 'refresh');
	}

	public function details($id)
	{
		if (!isset($_SESSION['id'])){
			redirect('user/signInForm', 'redirect');
		}
		$this->load->model('user_model');
		$this->load->model('domain_model');
		$this->load->model('faculty_model');
		$user = $this->user_model->getById($id);
		$data['contents'] = 'user/details';
		$data['user'] = $user;
		$data['domain'] = $this->domain_model->getById($user->domain_id);
		$data['faculty'] = $this->faculty_model->getById($user->faculty_id);
		$data['users_in_promotion'] = $this->user_model->getByPromotion($user->promotion_id);
		$this->load->view('template/layout', $data);
	}

	// BO
	public function registration_requests() {
		if (!isset($_SESSION['admin_id'])){
			redirect('admin', 'redirect');
		}
		$this->load->model('user_model');
		$perPage = 20;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$result = $this->user_model->getNewUserRequests("", $perPage, $start_index);
		$total = $this->user_model->getTotalNewRegistrationRequests("");
		$config['base_url'] = base_url('/user/registration_requests');
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

		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['contents'] = 'bo/new-registration-requests';
		$data['users'] = $result;
		$this->load->view('template/bo-layout', $data);
	}

	public function registration_request_detail($id) {
		if (!isset($_SESSION['admin_id'])){
			redirect('admin', 'redirect');
		}
		$this->load->model('user_model');
		$this->load->model('domain_model');
		$this->load->model('faculty_model');
		$user = $this->user_model->getById($id);
		$data['domain'] = $this->domain_model->getById($user->domain_id);
		$data['faculty'] = $this->faculty_model->getById($user->faculty_id);
		$data['registration'] = $user;
		$this->load->view('bo/registration-detail', $data);
	}

	public function reject_registration($id) {
		if (!isset($_SESSION['admin_id'])){
			redirect('admin', 'redirect');
		}
		$this->load->model('user_model');
		$this->user_model->rejectRegistration($id, $this->input->post('message'));

		redirect('user/registration_requests');
	}

	public function accept_registration($id) {
		if (!isset($_SESSION['admin_id'])){
			redirect('admin', 'redirect');
		}
		$this->load->model('user_model');
		$this->user_model->acceptRegistration($id);
		redirect('user/registration_requests');
	}

	public function forgot_password() {
		if (isset($_SESSION['id'])){
			redirect('home', 'redirect');
		}
		$data['contents'] = 'user/forgot_password';
		$this->load->view('template/layout', $data);
	}

	public function send_forgot_password_request() {
		$email = $this->input->post('emailAddress');
		$this->load->model('user_model');
		$rules = array(
			array(
				'field' => 'emailAddress',
				'label' => 'Adresse email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'required' => 'Adresse email vide',
					'valid_email' => 'Veuillez entrer une adresse email valide'
				)
			)
		);
		$this->form_validation->set_rules($rules);
		try {
			if ($this->form_validation->run()) {
				$token = $this->user_model->sendForgotPwdRequest($this->input->post('emailAddress'));

				$this->load->model('PwdResetLink_model');
				$user = $this->PwdResetLink_model->getUserByToken($token);

				$this->load->library('email');

				$this->email->from('support@semigany.org', 'Support semigany.org');
				$this->email->to($user->email);

				$link = base_url('user/password_reset_form').'?t='.$token;

				$mailContent = <<<EOD
				Bonjour $user->last_name, \n
				Vous pouvez réinitialiser votre mot de passe en allant vers le lien ci-dessous.
				$link \n
				Ce lien ne sera plus disponible demain. \n
				ATTENTION !!! NE PARTAGER PAS CE LIEN À D'AUTRE PERSONNE </b>\n
				Support semigany.org
				EOD;

				$this->email->subject('Réinitialisation du mot de passe');
				$this->email->message($mailContent);

				$this->email->send();

				$data['contents'] = 'user/after-forgot-submission';

				$data['message'] = "Un lien de réinitialisation de votre mot de passe a été envoyé à l'adresse email <b>".$email."</b>";
				$this->load->view('template/layout', $data);
			} else {
				$data['contents'] = 'user/forgot_password';
				$this->load->view('template/layout', $data);
			}
		} catch (Exception $ex) {
			$data['contents'] = 'user/forgot_password';
			$data['message'] = $ex;
			$this->load->view('template/layout', $data);
		}
	}

	public function password_reset_form() {
		$token = $this->input->get('t');

		try {
			$this->load->model('PwdResetLink_model');
			$this->PwdResetLink_model->isValidToken($token);
			$user = $this->PwdResetLink_model->getUserByToken($token);
			$data['contents'] = 'user/password-reset-form';
			$data['token'] = $token;
			$data['user'] = $user;
			$this->load->view('template/layout', $data);
		} catch (Exception $ex) {
			$data['contents'] = 'user/password-reset-form';
			$data['message'] = $ex;
			$data['token'] = $token;
			$this->load->view('template/layout', $data);
		}
	}

	public function reset_password() {
		$token = $this->input->get('t');
		$this->load->model('user_model');
		try {
			$rules = array(
				array(
					'field' => 'password',
					'label' => 'Mot de passe',
					'rules' => 'required|min_length[1]',
					'errors' => array(
						'required' => 'Mot de passe manquant',
						'min_length' => 'Le mot de passe doit contenir au moins 8 caractères'
					)
				), array(
					'field' => 'passwordconf',
					'label' => 'Confirmation du mot de passe',
					'rules' => 'required|matches[password]',
					'errors' => array(
						'required' => 'Confirmation du mot de passe manquant',
						'matches' => 'Les mots de passe ne sont pas identiques'
					)
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$this->user_model->updatePassword($this->input->post('password'), $token);
				redirect('user/pass_reset_success', 'refresh');
			} else {
				$data['contents'] = 'user/password-reset-form';
				$data['token'] = $token;
				$this->load->view('template/layout', $data);
			}
		} catch (Exception $ex) {
			$data['contents'] = 'user/password-reset-form';
			$data['message'] = $ex;
			$data['token'] = $token;
			$this->load->view('template/layout', $data);
		}
	}

	public function pass_reset_success() {
		$data['contents'] = 'user/password-reseted';
		$data['message'] = "Votre mot de passe a été mis à jour.
		Vous pouvez vous connecter à présent";
		$this->load->view('template/layout', $data);
	}
}
