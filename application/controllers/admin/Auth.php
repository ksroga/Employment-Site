<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model(array(
			'Login_Model' => 'Login',
			'Logs_Model' => 'Logs'
			));
	}

	public function index($error = NULL) {

		if($this->Login->isAdminLoggedIn())
			return $this->loggedIn();

		$data = array(
			'title' => 'Zaloguj się',
			'error' => $error
			);

		return $this->load->view('admin/auth/login', $data);
	}

	public function login() {


		$this->form_validation->set_rules('username', 'Nazwa użytkownika', 'trim|required',
			array('required' => 'Pole %s jest wymagane!'));
		$this->form_validation->set_rules('password', 'Hasło', 'trim|required',
			array('required' => 'Pole %s jest wymagane!'));

		if($this->form_validation->run() == FALSE) {
			return $this->index();
		} else {
			$data['user_auth'] = $this->Login->Login($this->input->post('username'), $this->input->post('password'));

			if($data['user_auth']) {
				$this->Login->setAdminSession($data['user_auth']);
				$this->load->view('admin/auth/success');
				$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_LOGIN, $this->input->ip_address());
				return 1;
			} else {
				return $this->index('Błędna nazwa użytkownika bądź hasło!');
			}
		}
	}

	public function logout() {
		$this->load->view('admin/auth/logout');
		$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_LOGOUT, $this->input->ip_address());
		return $this->Login->destroyAdminSession();
	}

	private function loggedIn() {
		return redirect('admin/posts/newest/');
	}
}