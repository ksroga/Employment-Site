<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currencies_Model extends CI_Model {

	public function getCurrencies() {
		$this->db->select('*');
		$query = $this->db->get('currencies');

		return $query->result();
	}

	public function getCurrencyById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);

		$query = $this->db->get('currencies');

		return $query->result()[0];
	}

}