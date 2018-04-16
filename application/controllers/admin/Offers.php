<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends MY_ACP_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_OFFERS_MANAGEMENT))
			return $this->noPerms();
	}

	public function index() {
		$this->newest();

		return 1;
	}

	public function newest() {
		$page = $this->uri->segment(4,0) * 25;

		$config = array(
			'total_rows' => $this->Offers->getOffersCount()/25,
			'per_page' => 1,
			'first_link' => 'Początek ',
			'last_link' => " Koniec",
			'num_tag_open' => ' ',
			'num_tag_close' => ' '
			);

		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$data = array(
			'title' => 'Oferty',
			'page' => $page,
			'offers' => $this->Offers->getNewOffers($page, 25),
			'link' => $this->pagination->create_links()
			);


		$this->load->view('admin/header', $data);
		$this->load->view('admin/offers/offers', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function edit($id) {
		$this->load->helper(array('form', 'url'));

		$this->load->model('Currencies_Model', 'Currencies');
		$this->load->model('EmploymentForms_Model', 'EmploymentForms');
		$this->load->model('Categories_Model', 'Categories');

		$data = array(
			'title' => 'Edycja Oferty',
			'offer' => $this->Offers->getOffer($id),
			'currencies' => $this->Currencies->getCurrencies(),
			'employment_forms' => $this->EmploymentForms->getEmploymentForms(),
			'categories' => $this->Categories->getCategories()
			);


		$this->load->view('admin/header', $data);
		$this->load->view('admin/offers/edit', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function accept() {
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

 		$this->form_validation->set_rules('offer', 'Treść Oferty', 'required',
        	array('required' => 'Pole %s jest wymagane!'));   
        $this->form_validation->set_rules('title', 'Tytuł oferty', 'required',
        	array('required' => 'Pole %s jest wymagane!'));       
        $this->form_validation->set_rules('city', 'Lokalizacja', 'required',
        	array('required' => 'Pole %s jest wymagane!'));
        $this->form_validation->set_rules('tags', 'Tagi', 'required',
        	array('required' => 'Pole %s jest wymagane!'));

        if($this->form_validation->run() == FALSE) {
            return $this->edit($this->input->post('offer_id'));

        } else {

        	$data = array(
        		'title' => 'Pomyślnie zaktualizowano post!',
        		'success' => 'Pomyślnie zaktualizowano post '.$this->input->post('title').' (ID: '.$this->input->post('offer_id').').'
        		);

        	$this->load->view('admin/header', $data);
			$this->load->view('admin/success', $data);
			$this->load->view('admin/footer');

        	$post = array(
        		'content' => $this->input->post('offer'),
            	'title' => $this->input->post('title'),
            	'form' => $this->input->post('form'),
            	'salary' => $this->input->post('salary'),
            	'maxsalary' => $this->input->post('maxsalary'),
            	'manhour' => (!empty($this->input->post('manhour'))) ? 1 : 0,
            	'currency' => $this->input->post('currency'),
            	'vat' => $this->input->post('vat'),
            	'category' => $this->input->post('category'),
            	'country' => $this->input->post('country'),
            	'city' => $this->input->post('locality'),
            	'state' => $this->input->post('administrative_area_level_1'),
            	'tags' => $this->input->post('tags')
        		);

        	$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_OFFER_EDIT, $this->input->post('offer_id'));
			return $this->Offers->updateOffer($this->input->post('offer_id'), $post);
        }
	}

	public function status($id, $status) {
		switch($status) {
			case 'deactivate':
				$data['active'] = 0;
				break;

			default:
				return;
		}

		$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_OFFER_STATUS_CHANGE, $id);
		return $this->Offers->updateOffer($id, $data);
	}
}