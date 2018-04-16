<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_Public_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Newsletter_Model', 'Newsletter');
	}

	public function index() {
		return redirect('oferty');
	}

	public function subscribe() {

		if(empty($this->input->post('email')))
			return redirect('oferty');

		if($this->Newsletter->addEmail($this->input->post('email'))) {
			$this->session->set_flashdata('alert', array('type' => 'success', 'message' => 'Pomyślnie zapisałeś się do Newslettera!'));
			return redirect('oferty');
		} else {
			$this->session->set_flashdata('alert', array('type' => 'danger', 'message' => 'Taki adres E-Mail jest już zapisany do Newslettera!'));
			return redirect('oferty');
		}
	}

	public function unsubscribe($email) {
		$email = str_replace('%7Bat%7D', '@', $email);
		$this->Newsletter->deleteEmail($email);
		$this->session->set_flashdata('alert', array('type' => 'info', 'message' => 'Wypisałeś się z Newslettera!'));
		return redirect('oferty');
	}



}