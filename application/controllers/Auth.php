<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Public_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model(array(
			'Logs_Model' => 'Logs'
			));

		return 1;
	}

	public function index() {
		if($this->Login->isUserLoggedIn())
			return $this->loggedIn();

		return $this->login();
	}

	public function login($error = NULL) {
		if(!$error && !empty($this->input->post('username')) && !empty($this->input->post('password'))) {
			return $this->check();
		} else {
			return die("error");
		}

	}

	public function logout() {
		if(!$this->session->user_logged_in)
			return 0;

		$this->session->set_flashdata('alert', array('type' => 'success', 'message' => 'Pomyślnie się wylogowałeś!'));
		
		$this->Logs->addLog($this->session->user_logged_in['id'], LOG_USER_LOGOUT, $this->input->ip_address());
		$this->Login->destroyUserSession();

		return redirect('jobs');
	}

	public function register() {
		if($this->session->user_logged_in)
			return redirect();

		$data = array(
			'title' => 'Sektor-IT.pl - Rejestracja'
			);

		$this->load->view('public/header', $data);
		$this->load->view('public/login/register', $data);
		$this->load->view('public/footer');



	}

	private function check() {

		$data['user_auth'] = $this->Login->Login($this->input->post('username'), $this->input->post('password'));

		if($data['user_auth']) {
			$this->Login->setUserSession($data['user_auth']);
			$this->session->set_flashdata('alert', array('type' => 'success', 'message' => 'Pomyślnie się zalogowałeś!<br><b>Dziękujemy, że jesteś z nami!</b>'));
			$this->Logs->addLog($this->session->user_logged_in['id'], LOG_USER_LOGIN, $this->input->ip_address());
			return redirect();
		} else {
			$this->Logs->addLog(-1, LOG_USER_LOGIN_BAD_DATA, $this->input->ip_address());
			$this->session->set_flashdata('alert', array('type' => 'danger', 'message' => 'Niepoprawna nazwa użytkownika bądź hasło!'));
			return redirect();
		}
	}

	private function loggedIn() {
		return die("Najpierw się wyloguj!");
	}
}
