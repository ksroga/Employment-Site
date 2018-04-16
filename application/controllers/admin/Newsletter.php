<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_ACP_Controller {

	public $email_config;

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_OFFERS_MANAGEMENT))
			return $this->noPerms();

		$this->load->model('Newsletter_Model', 'Newsletter');
	}


	public function index() {
		$this->load->helper('form');

		$data = array(
			'title' => 'Newsletter'
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/newsletter/send', $data);
		$this->load->view('admin/footer');
	}

	public function send() {

		$data = $this->setConfig($this->input->post('newsletter-template'));

		$this->load->library('email', $this->email_config);

		$template = $this->load->view('admin/newsletter/'.$this->input->post('newsletter-template').'_template', $data, true);

		if(empty($this->input->post('newsletter-receiver')))
		{
			foreach($this->Newsletter->getEmails() as $subscriber)
			    $this->sendEmail($data['email'], $data['title'], $subscriber->email, $this->input->post('newsletter-topic'), $this->input->post('newsletter-message'));

		} else {
			$this->sendEmail($data['email'], $data['title'], $this->input->post('newsletter-receiver'), $this->input->post('newsletter-topic'), $template);
		}




        $this->session->set_flashdata('alert', array('message' => "Pomyślnie wysłano Newsletter do odbiorców!", 'type' => 'succes'));
        redirect('admin/newsletter');
        
	}

	private function setConfig($email) {
		switch($email) {
			case 'newsletter':

				$this->email_config = array(
					'protocol' => 'ssmtp',
				    'smtp_host' => 'ssl://smtp.zoho.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'newsletter@sektor-it.pl',
				    'smtp_pass' => 'N3wsl3tt3rIT',
				    'mailtype'  => 'html', 
				    'charset'   => 'iso-8859-1',
					);

				$data = array(
					'email' => 'Newsletter@Sektor-IT.pl',
					'title' => 'Newsletter Sektor-IT.pl'
					);

				return $data;

			case 'contact':

				$this->email_config = array(
					'protocol' => 'ssmtp',
				    'smtp_host' => 'ssl://smtp.zoho.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'kontakt@sektor-it.pl',
				    'smtp_pass' => 'K0nt4ktIT',
				    'mailtype'  => 'html', 
				    'charset'   => 'iso-8859-1',
					);

				$data = array(
					'email' => 'Kontakt@Sektor-IT.pl',
					'title' => 'Kontakt Sektor-IT.pl'
					);

				return $data;
		}
	}

	private function sendEmail($sender, $name, $email, $topic, $message) {
		$this->email->from($sender, $name);
	    $this->email->to($email); 

	    $this->email->subject($topic);
	    $this->email->message($message);  

	    $this->email->send();

	    return 1;
	}



}