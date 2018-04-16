<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_Model extends CI_Model {

	public function addEmail($mail) {
		if(!empty($this->getEmail($this->security->xss_clean($mail))))
			return false;

		$data['email'] = $this->security->xss_clean($mail);

		$this->db->insert('newsletter', $data);
		return true;
	}

	public function deleteEmail($mail) {
		$this->db->where('email', $this->security->xss_clean($mail));
		$this->db->delete('newsletter');
	}

	public function getEmail($mail) {
		$this->db->select('*');
		$this->db->where('email', $mail);

		$query = $this->db->get('newsletter');
		return $query->result()[0]->email;
	}

	public function getEmails() {
		$this->db->select('email');

		$query = $this->db->get('newsletter');
		return $query->result();
	}

}