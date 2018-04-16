<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_Model extends CI_Model {

	public function addLog($user, $action, $value = NULL) {
		$data = array(
			'user_id' => $user,
			'action_id' => $action,
			'value' => ((!empty($value)) ? $value : '')
			);

		return $this->db->insert('logs', $data);
	}

}