<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_Model extends CI_Model {

	public function getCategories() {
		$this->db->select('*');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('categories');

		return $query->result();
	}

	public function getCategoryById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);

		$query = $this->db->get('categories');

		return $query->result()[0];
	}
}