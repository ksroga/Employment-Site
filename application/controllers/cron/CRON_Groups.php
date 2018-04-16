<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRON_Groups extends CI_Controller {


	public function __construct() {
		parent::__construct();

		

	}
	public function index()
	{
		$this->addNewFeedFromGroups();
		return 1;
	}

	private function addNewFeedFromGroups() {
		$this->load->model(array('Groups_Model', 'Posts_Model', 'FB_Graph_Model'));

		$data['groups'] = $this->Groups_Model->getGroups();

		foreach($data['groups'] as $group) {
			foreach($this->FB_Graph_Model->getGroupFeed($group->group_id) as $post) {
				// echo $post;
				// message -> tresc
				// story -> dane
				// id -> id posta
				// updated_time -> czas
				if(isset($post['message'])) {
					if(!isset($post['story']))
						$post['story'] = '';

					if($this->Posts_Model->checkIsPostExists($post['message'], $post['id']))
						$this->Posts_Model->newPost($post['id'], $post['message'], $post['updated_time']->format('Y-m-d H:i:s'));
				}

			}
		}
		return 1;
	}

}
