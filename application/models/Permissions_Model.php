<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_Model extends CI_Model {

	/*
	Defined permissions:

	PERM_ACP_ACCESS 		=> admin control panel access
	PERM_POSTS_MANAGEMENT 	=> posts management
	PERM_OFFERS_MANAGEMENT 	=> offers management
	PERM_GROUPS_MANAGEMENT 	=> groups management
	PERM_USERS_MANAGEMENT 	=> users management
	PERM_SETTINGS_CHANGE 	=> change settings (not used at now)
	PERM_OFFERS_EDIT 		=> offers edit (without acp)
	*/

	public function isAdminAuthorized($perm) {
		if(!empty($this->session->admin_logged_in) && strstr($this->session->admin_logged_in['perms'], $perm))
			return 1;

		return 0;
	}

}