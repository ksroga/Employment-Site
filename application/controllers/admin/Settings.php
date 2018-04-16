<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_ACP_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_OFFERS_MANAGEMENT))
			return $this->noPerms();

		$this->load->model('Settings_Model', 'Settings');
	}


	public function index() {
		$this->load->helper('form');

		$data = array(
			'title' => 'Ustawienia',
			'settings' => $this->Settings->getAllSettings()
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/settings/settings', $data);
		$this->load->view('admin/footer');
	}

	public function update() {
		if(!$this->input->post())
			return 0;

		if(!$this->input->post('disabled')) {
			$data = array(
				'disabled' => 'off'
				);
			$this->Settings->updateSettings($data);
		}

		$this->Settings->updateSettings($this->input->post());
		redirect('admin/settings');
	}

}