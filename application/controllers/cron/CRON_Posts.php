<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRON_Posts extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Posts_Model', 'Posts');
	}

	public function index() {
		$this->deleteOldPosts();
	}

	public function deleteOldPosts() {
		$posts = $this->Posts->getPostsByDate(NULL, date("Y-m-d", strtotime('-14 day')));

		foreach($posts as $post) {
			$this->Posts->deletePost($post->id);
		}
	}

}