<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_ACP_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_GROUPS_MANAGEMENT))
			return $this->noPerms();
	}


	public function index() {
		$data = array(
			'title' => 'Grupy',
			'groups' => $this->Groups_Model->getGroups(),
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/groups/groups', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function add()
	{
		if($this->uri->segment(4, 0) == 'new' && !empty($this->uri->segment(4, 0)))
			return $this->process();

		$this->load->helper('form');

		$data = array(
			'title' => 'Dodaj Grupę',
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/groups/group_add');
		$this->load->view('admin/footer');

		return 1;
	}

	public function delete() {
		if(empty($this->uri->segment(4, 0)))
			return 0;

		$this->Groups_Model->deleteGroup($this->uri->segment(4, 0));
		$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_GROUP_DELETE);
		return 1;
	}

	public function process() {
		if(!isset($_POST) || empty($_POST))
			return 0;

		if($this->Groups_Model->addGroup($_POST['groupid'], $_POST['groupname'])) {

			$data = array(
				'title' => 'Dodano grupę',
				'success' => 'Pomyślnie dodano grupę '.$_POST['groupname'].' ('.$_POST['groupid'].') do bazy danych!',
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/success', $data);
			$this->load->view('admin/footer');
			$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_GROUP_ADD);

		} else {
			$data = array(
				'title' => 'Wystąpił błąd!',
				'error' => 'Taka grupa już istnieje w bazie danych!',
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/error', $data);
			$this->load->view('admin/footer');
		}

		return 1;
	}

	public function status() {
		$this->load->model('fb_graph_model');
		var_dump($this->fb_graph_model->getGroupFeed($this->uri->segment(4, 0)));
	}

	public function check() {
		$data['groupid'] = $this->uri->segment(4, 0);
		if(!isset($data['groupid']) || empty($data['groupid']))
			die("Niepoprawne ID!");

		$this->load->model('fb_graph_model');

		foreach($this->fb_graph_model->getGroup($data['groupid']) as $elem) {
			echo $elem.'|';
		}

		return 1;
	}

}
