<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_Model extends CI_Model {

	public function newPost($post_id, $msg, $date) {
		$data = array(
			'post_id' => $post_id,
			'message' => $msg,
			'date' => $date
		);
		$this->db->insert('posts', $data);
		return 1;
	}

	public function getNewPosts($limit, $offset) {
		$this->db->select('*');
		$this->db->where('active', 1);
		$this->db->order_by('date', 'ASC');
		$this->db->limit($offset, $limit);
		$query = $this->db->get('posts');
		return $query->result();
	}

	public function getPostsCount() {
		$this->db->select('COUNT(*) as count');
		$this->db->where('active', 1);
		$query = $this->db->get('posts');

		return $query->result()[0]->count;
	}

	public function getPostById($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('posts');

		return $query->result()[0];
	}

	public function getPostsByDate($from_date = NULL, $to_date = NULL) {
		$this->db->select('*');

		if(!empty($from_date))
			$this->db->where('date >=', $from_date);

		if(!empty($to_date))
			$this->db->where('date <=', $to_date);

		$query = $this->db->get('posts');
		return $query->result();
	}

	public function deactivatePost($post_id) {
		$this->db->set('active', 0);
		$this->db->where('id', $post_id);
		$this->db->update('posts');
		return 1;
	}

	public function deletePost($post_id) {
		$this->db->where('id', $post_id);
		$this->db->delete('posts');
	}

	public function checkIsPostExists($msg, $post_id) {
		$this->db->select('COUNT(*) as count');
		$this->db->where('message', $msg);
		$this->db->or_where('post_id', $post_id);
		$query = $this->db->get('posts');


		if($query->result()[0]->count == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}