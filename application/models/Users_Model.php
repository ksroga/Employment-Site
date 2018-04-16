<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

	/**
 	* addUser
 	*
 	* Method adds user's records to database
 	* and salts password.
 	* Before adding method checks that user exists.
 	* 
 	* Parameters:
 	* @param String $nickname - User's name
 	* @param String $password - User's pasword (non crypted and non salted)
 	* @param String $email - User's email
 	* @param Array $perms - User's permissions
 	* @return (Boolean) - True (when success) or False (when failed)
 	*/

	public function addUser($nickname, $password, $email, $perms) {
		$data = array(
			'username' => $nickname,
			'password' => $this->salt($password),
			'email' => $email,
			'permissions' => $this->parsePerms($perms)
			);

		if($this->checkIsUserExists($data['username'], $data['email'])) {
			$this->db->insert('users', $data);
			return 1;
		}
		return 0;
	}


	/**
 	* editUser
 	*
 	* Method updates user's records in database.
 	* 
 	* Parameters:
 	* @param Int $id - user's id
 	* @param Array $values - values to update: $key = column.
 	* @return (boolean)
 	*/

	public function editUser($id, $values) {
		$this->db->set($values);
		$this->db->where('id', $id);
		$this->db->update('users');
		return 1;
	}


	/**
 	* getUsers
 	*
 	* Method gets users from database with limit and offset.
 	* 
 	* Parameters:
 	* @param Int $limit - limit
 	* @param Int $offset - offset
 	* @return (Array) - value of returned data from database
 	*/

	public function getUsers($limit, $offset) {
		$this->db->select('*');
		$this->db->limit($offset, $limit);
		$query = $this->db->get('users');
		return $query->result();
	}


	/**
 	* getUsersCount
 	*
 	* Method returns count of users in database.
 	* 
 	* @return (Int) - count of users in db.
 	*/

	public function getUsersCount() {
		$this->db->select('COUNT(*) AS count');
		$query = $this->db->get('users');
		return $query->result()[0]->count;
	}


	/**
 	* checkIsUserExists
 	*
 	* Method checks that user (nickname or email) exists in database
 	* by private methods: getUserByName and getUserByEmail.
 	* 
 	* Parameters:
 	* @param String $nickname
 	* @param String $email
 	* @return (Boolean) - True (when user not exists) or False (when exists)
 	*/

	private function checkIsUserExists($nickname, $email) {
		if(sizeof($this->getUserByName($nickname)) == 0 && sizeof($this->getUserByEmail($email)) == 0)
			return 1;

		return 0;
	}


	/**
 	* getUserByID
 	*
 	* Method gets record from database by primary key in database.
 	* 
 	* Parameters:
 	* @param Int $id - user's id
 	* @return (Array) - value of returned data from database
 	*/

	public function getUserByID($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		return $query->result()[0];
	}

	/**
 	* getUserByName
 	*
 	* Method gets record from database by nickname.
 	* 
 	* Parameters:
 	* @param String $nickname
 	* @return (Array) - value of returned data from database
 	*/

	private function getUserByName($nickname) {
		$this->db->select('*');
		$this->db->where('username', $nickname);
		$query = $this->db->get('users');

		return $query->result();
	}


	/**
 	* getUserByEmail
 	*
 	* Method gets record from database by email.
 	* 
 	* Parameters:
 	* @param String $email
 	* @return (Array) - value of returned data from database
 	*/

	private function getUserByEmail($email) {
		$this->db->select('*');
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		return $query->result();
	}


	/**
 	* parsePerms
 	*
 	* Method parses permissions from array to string.
 	* Before parsing checks that parameter is array.
 	* 
 	* Parameters:
 	* @param Array $perms - user's permissions.
 	* @return (String) - permissions or null;
 	*/

	public function parsePerms($perms) {
		if(!empty($perms) && is_array($perms)) {
			$permissions = '';
			foreach($perms as $perm) {
					$permissions .= $perm;
			}
			return $permissions;
		}
		return;
	}


	/**
 	* salt
 	*
 	* Method crypts (md5) and salts password.
 	* 
 	* Parameters:
 	* @param String $password - password to salt
 	* @return (String) - md5 crypted and saldet password
 	*/

	public function salt($password) {
		return substr(sha1(mt_rand() . microtime()), mt_rand(0,35), PASS_SALT_LENGTH) . md5($password) . substr(sha1(mt_rand() . microtime()), mt_rand(0,35), PASS_SALT_LENGTH);
	}
}