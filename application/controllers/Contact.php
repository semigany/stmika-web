<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function send_email()
	{
		$this->load->library('email');

		$this->email->from('contact.utilisateur@semigany.org', $this->input->post('name'));
		$this->email->to('support@semigany.org');

		$senderEmail = $this->input->post('email');
		$senderName = $this->input->post('name');
		$emailContent = $this->input->post('message');

		$mailContent = <<<EOD
		Informations sur l'Envoyeur
		Nom : $senderName,
		Email : $senderEmail,\n
		Contenu
		$emailContent\n
		Cet email vient d'un utilisateur du site via le formulaire de contact
		EOD;

		$this->email->subject('[Contact utilisateur] - ' . $this->input->post('subject'));
		$this->email->message($mailContent);

		if (!empty($this->input->post('name')) && 
			!empty($this->input->post('email')) && 
			!empty($this->input->post('message')) && 
			!empty($this->input->post('subject'))) {
			$this->email->send();
			redirect('contact/send_email_success', 'refresh');
		} else {
			redirect('contact/send_email_failure', 'refresh');
		}

	}

	public function send_email_failure() {
		$data['contents'] = 'contact/email-failure';
		$data['message'] = "Message non envoyé :|.\nVous devez insérer tout les champs.";
		$this->load->view('template/layout', $data);
	}

	public function send_email_success() {
		$data['contents'] = 'contact/email-sent';
		$data['message'] = "Message envoyé :).";
		$this->load->view('template/layout', $data);
	}
}
