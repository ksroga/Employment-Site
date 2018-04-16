<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Public_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Tickets_Model', 'Tickets');
		$this->load->helper('form');
		$this->load->library('recaptcha');
	}

	public function index() {
		return $this->create();
	}

	public function create() {

		$data = array(
			'title' => 'Sektor-IT.pl - Skontaktuj się z nami!',
			'categories' => $this->Tickets->getCategories()
			);

		$this->load->view('public/header', $data);
		$this->load->view('public/pages/contact');
		$this->load->view('public/footer');
	}

	public function send() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email',
			array(
				'required' => 'Pole %s jest wymagane',
				'valid_email' => 'Pole %s nie jest poprawne!'
				));

		$this->form_validation->set_rules('fname', 'Imię', 'required|max_length[32]',
			array(
				'required' => 'Pole %s jest wymagane!',
				'max_length' => 'Pole %s nie może mieć więcej niż 32 znaki!'
				));

		$this->form_validation->set_rules('message', 'Treść', 'required|max_length[4096]',
			array(
				'required' => 'Pole %s jest wymagane!',
				'max_length' => 'Pole %s nie może mieć więcej niż 4096 znaki!'
				));


		if($this->form_validation->run() === FALSE) {

			$this->session->set_flashdata('alert', array('type' => 'danger', 'message' => "Coś poszło nie tak!<br>Wszystkie pola są wymagane!"));
			return redirect('kontakt');

		} else {

			if(!empty($this->input->post('captcha'))) {

				$this->Tickets->addTicket($this->input->post('email'), $this->input->post('fname'), $this->input->post('category'), $this->input->post('message'));
				$this->session->set_flashdata('alert', array('type' => 'success', 'message' => 'Dziękujemy za kontakt z nami! Odpowiemy najszybciej, jak to jest możliwe!'));
				return redirect('oferty');

			} else {

				$this->session->set_flashdata('alert', array('type' => 'danger', 'message' => 'CAPTCHA jest wymagane!'));
				return redirect('kontakt');

			}
		}
	}

}