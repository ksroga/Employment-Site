<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers_Model extends CI_Model {

	public function addOffer($data) {
		if(!isset($data['date']) && empty($data['date']))
			$data['date'] = date('Y-m-d H:i:s');

		$this->db->insert('offers', $data);
		return 1;
	}

	public function getOffersCount() {
		$this->db->select('COUNT(*) as count');
		$this->db->where('active', 1);
		$query = $this->db->get('offers');

		return $query->result()[0]->count;
	}

	public function getNewOffers($limit, $offset) {
		$this->db->select('*');
		$this->db->where('active', 1);
		$this->db->order_by('date', 'DESC');
		$this->db->limit($offset, $limit);
		$query = $this->db->get('offers');
		return $query->result();
	}

	public function searchOffers($limit, $offset, $vac = NULL, $locality = NULL, $cat = NULL, $sort = NULL) {
		$searched = FALSE;
		$this->db->select('*');
		$this->db->where('active', 1);

		if(!empty($vac)) {
			$vac = explode(" ", $vac);

			foreach($vac as $word) {
				if(!$searched) {
					$this->db->like('title', $word, 'both');
					$this->db->or_like('tags', $word, 'both');
					$searched = TRUE;
				} else {
					$this->db->or_like('title', $word, 'both');
					$this->db->or_like('tags', $word, 'both');
				}

			}
		}

		if(!empty($locality))
			$this->db->like('city', $locality);

		if(!empty($cat))
			$this->db->where('category', $cat);

		if(!empty($sort) && $sort == 'asc') {
			$this->db->order_by('date', 'ASC');
		} else {
			$this->db->order_by('date', 'DESC');
		}

		$this->db->limit($offset, $limit);

		$query = $this->db->get('offers');
		return $query->result();
	}

	public function getOffer($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('offers');

		return $query->result()[0];
	}

	public function updateOffer($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('offers');
		return 1;
	}

}