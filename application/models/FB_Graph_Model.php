<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_Graph_Model extends CI_Model {

	private $fb;

	private $permissions = array();

	private $callback;



	public function __construct() {
	require_once '././assets/fb_graph_api/src/Facebook/autoload.php';

	  $this->fb = new Facebook\Facebook([
	  'app_id' => 'xxx',
	  'app_secret' => 'xxx',
	  'default_graph_version' => 'v2.10',
	  ]);
	}

	public function getGroup($id) {
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $this->fb->get(
		    $id,
		    $this->fb->getApp()->getAccessToken()
		  );
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		return $response->getGraphNode();
	}

	public function getGroupFeed($id) {
		try {
		  $response = $this->fb->get(
		    '/'.$id.'/feed',
		    $this->fb->getApp()->getAccessToken()
		  );
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		return $response->getGraphEdge();
	}

	public function setPermissions($permissions) {
		$this->permissions = $permissions;
	}

	public function setCallback($callback) {
		$this->callback = $callback;
	}

	public function getLoginUrl() {
		$helper = $this->fb->getRedirectLoginHelper();
		return $helper->getLoginUrl($this->callback, $this->permissions);
	}
}