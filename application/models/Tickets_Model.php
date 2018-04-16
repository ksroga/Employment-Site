<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_Model extends CI_Model {

	public function getCategories() {
		$this->db->select('*');

		$query = $this->db->get('tickets_categories');
		return $query->result();
	}

	public function addTicket($email, $name, $category, $message) {
		$data = array(
			'email' => $this->security->xss_clean($email),
			'name' => $this->security->xss_clean($name),
			'category' => $this->security->xss_clean($category),
			'message' => $this->security->xss_clean($message),
			'active' => 1
			);

		$this->db->insert('tickets', $data);
	}

}