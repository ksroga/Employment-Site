<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

	public function Login($username, $password) {
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('active', 1);
		$this->db->limit(1);

		$query = $this->db->get('users');

		if(!empty($query->result()) && $this->unsaltPassword($query->result()[0]->password) == md5($password)) {
			return $query->result()[0];
		} else {
			return 0;
		}
	}

	public function setAdminSession($profile) {
		$session_data = array(
			'id' => $profile->id,
			'username' => $profile->username,
			'perms' => $profile->permissions
			);

		$this->updateLastLogon($session_data['id']);

		return $this->session->set_userdata('admin_logged_in', $session_data);
	}

	public function destroyAdminSession() {
		return $this->session->unset_userdata('admin_logged_in');
	}

	public function isAdminLoggedIn() {
		if(!empty($this->session->admin_logged_in))
			return 1;

		return 0;
	}

	public function setUserSession($profile) {
		$session_data = array(
			'id' => $profile->id,
			'username' => $profile->username,
			'perms' => $profile->permissions
			);

		$this->updateLastLogon($session_data['id']);
		return $this->session->set_userdata('user_logged_in', $session_data);
	}

	public function destroyUserSession() {
		return $this->session->unset_userdata('user_logged_in');
	}

	public function isUserLoggedIn() {
		if(!empty($this->session->user_logged_in))
			return 1;

		return 0;
	}

	private function updateLastLogon($id) {
		$data['last_logon'] = date('Y-m-d H:i:s');
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('users');

		return 1;
	}

	private function unsaltPassword($password) {
		return substr($password, 3, -3);
	}

}