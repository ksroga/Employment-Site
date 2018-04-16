<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_Model extends CI_Model {

	public function getAllSettings() {
		$this->db->select('*');

		$query = $this->db->get('settings');
		return $query->result();
	}

	public function getSettings($settings) {
		$this->db->select($settings);

		$query = $this->db->get('settings');
		return $query->result();
	}

	public function getSetting($name) {
		$this->db->select('value');
		$this->db->where('name', $name);

		$query = $this->db->get('settings');
		return $query->row()->value;
	}

	public function updateSettings($settings) {
		foreach($settings as $key => $setting) {
			$data['value'] = $this->security->xss_clean($setting);
			$this->db->where('name', $key);
			$this->db->update('settings', $data);
		}
	}

}