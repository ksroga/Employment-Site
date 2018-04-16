<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmploymentForms_Model extends CI_Model {

	public function getEmploymentForms() {
		$this->db->select('*');
		$query = $this->db->get('employment_forms');

		return $query->result();
	}

	public function getEmploymentFormShortNameById($id) {
		$this->db->select('short_name');
		$this->db->where('id', $id);
		$query = $this->db->get('employment_forms');

		return $query->result()[0];
	}
}