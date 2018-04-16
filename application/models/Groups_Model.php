<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups_Model extends CI_Model {


	public function getGroups() {
		$this->db->select('*');
		$query = $this->db->get('groups');

		return $query->result();
	}

	public function addGroup($id, $name) {
		if(!$this->checkIfGroupExists($id)) {
			$data = array(
				'group_id' => $id,
				'group_name' => $name
				);
			$this->db->insert('groups', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteGroup($id) {
		$this->db->delete('groups', array('id' => $id));
		return 1;
	}

	public function checkIfGroupExists($id) {
		$this->db->select('COUNT(*) AS isExists');
		$this->db->where('group_id', $id);
		$query = $this->db->get('groups');
		var_dump($query->result()[0]->isExists);

		if(!$query->result()[0]->isExists) {
			return FALSE;
		} else {
			return TRUE;
		}
	}


}