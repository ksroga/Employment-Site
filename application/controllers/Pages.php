<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Public_Controller {

	public function __construct() {
			parent::__construct();


	}

	public function index() {
		return redirect();
	}

	public function employer() {

		$data = array(
			'title' => 'Sektor-IT.pl - Dla Pracodawcy'
			);

		$this->load->view('public/header', $data);
		$this->load->view('public/pages/employer', $data);
		$this->load->view('public/footer');
	}


}