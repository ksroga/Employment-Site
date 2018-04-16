<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_ACP_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_USERS_MANAGEMENT))
			return $this->noPerms();
	}

	public function index() {
			$this->show();
			return 1;
	}

	public function show() {
		$this->load->model('Users_Model', 'Users');
		$page = $this->uri->segment(4,0) * 25;

		$config = array(
			'base_url' => 'http://localhost/projekt/index.php/admin/users/list/',
			'total_rows' => $this->Users->getUsersCount()/25,
			'per_page' => 1,
			'first_link' => 'Początek ',
			'last_link' => " Koniec",
			'num_tag_open' => ' ',
			'num_tag_close' => ' '
			);

		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$data = array(
			'title' => 'Użytkownicy',
			'page' => $page,
			'users' => $this->Users->getUsers($page, 25),
			'link' => $this->pagination->create_links()
			);


		$this->load->view('admin/header', $data);
		$this->load->view('admin/users/users', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function add() {
		$this->load->helper(array('form', 'url'));
	        
		$data = array(
			'title' => "Dodawanie użytkownika"
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/users/add', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function accept() {
		if(!$this->input->post())
			return 0;

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('nickname', 'Nazwa nowego użytkownika', 'required',
        	array('required' => 'Pole %s jest wymagane!'));
		$this->form_validation->set_rules('password', 'Hasło', 'required',
        	array('required' => 'Pole %s jest wymagane!'));
		$this->form_validation->set_rules('email', 'Email', 'required',
        	array('required' => 'Pole %s jest wymagane!'));

		if($this->form_validation->run() == FALSE) {

			$this->add();

		} else {

			$data = array(
				'nickname' => $this->input->post('nickname'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'perms' => $this->input->post('perms')
				);

			$this->load->model('Users_Model', 'Users');
			$this->load->view('admin/header', $data);

			if($this->Users->addUser($data['nickname'], $data['password'], $data['email'], $data['perms'])) {
				$data['title'] = "Pomyślnie dodano nowego użytkownika!";
				$data['success'] = "Pomyślnie dodano nowego użytkownika!";
				$this->load->view('admin/success', $data);
				$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_USER_ADD, $data['nickname']);
			} else {
				$data['title'] = "Błąd!";
				$data['error'] = "Użytkownik o podanej nazwie bądź adresie E-Mail już istnieje!";
				$this->load->view('admin/error', $data);
			}
			$this->load->view('admin/footer');
		}

		return 1;
	}

	public function edit($user, $action = FALSE) {

		if(!$action && !$this->input->post())
			return $this->editProfile($user);

		if(!$action && $this->input->post())
			return $this->updateProfile($this->input->post());

		$this->load->model('Users_Model', 'Users');

		switch($action) {

			case 'block':
				$data['active'] = 0;
				$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_USER_BLOCK, $user);
				break;

			case 'unblock':
				$data['active'] = 1;
				$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_USER_UNBLOCK, $user);
				break;

		}

		if(!empty($action))
			return $this->Users->editUser($user, $data);

		return 1;
	}

	private function editProfile($id) {
		$this->load->helper(array('form', 'url'));
		$this->load->model('Users_Model', 'Users');


		$data = array(
			'title' => 'Edycja użytkownika',
			'user' => $this->Users->getUserByID($id)
			);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/users/edit', $data);
		$this->load->view('admin/footer', $data);
	}

	private function updateProfile($post) {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Nazwa użytkownika', 'required',
        	array('required' => 'Pole %s jest wymagane!'));
		$this->form_validation->set_rules('email', 'Email', 'required',
        	array('required' => 'Pole %s jest wymagane!'));

		if(!empty($post['password'])) {

			$this->form_validation->set_rules('password', 'Hasło', 'required',
        	array('required' => 'Pole %s jest wymagane!'));

        	$this->form_validation->set_rules('repeatpassword', 'Powtórz Hasło', 'required|matches[password]',
        	array('required' => 'Pole %s jest wymagane!',
        		   'matches' => 'Podane hasła nie zgadzają się!'));
		}

		if($this->form_validation->run() == FALSE) {
			return $this->editProfile($post['user_id']);
		} else {
			$this->load->model('Users_Model', 'Users');

			$data = array(
				'id' => $post['user_id'],
				'username' => $post['username'],
				'email' => $post['email'],
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'permissions' => $this->Users->parsePerms($post['perms'])
				);

			if(!empty($post['password']))
				$data['password'] = $this->Users->salt($post['password']);

			if($this->Users->editUser($post['user_id'], $data)) {
				$data = array(
					'title' => 'Pomyślnie edytowano profil użytkownika!',
					'success' => 'Pomyślnie edytowano profil użytkownika '.$data['username'].' (ID: '.$data['id'].').'
					);

				$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_USER_EDIT, $post['user_id']);

				$this->load->view('admin/header', $data);
				$this->load->view('admin/success', $data);
				$this->load->view('admin/footer');
			}
		}

	}
}