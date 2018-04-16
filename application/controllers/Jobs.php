<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Public_Controller {

		public function __construct() {
				parent::__construct();

				$this->load->model(array(
					'Offers_Model' => 'Offers',
					'EmploymentForms_Model' => 'Employment',
					'Categories_Model' => 'Categories',
					'Currencies_Model' => 'Currencies'
					));
			
		}

		public function index() {
			$this->load->helper(array('form', 'url'));

			$data = array(
				'title' => 'Sektor-IT.pl - Oferty Pracy IT',
				'offers' => $this->Offers->getNewOffers(0, 10),
				'categories' => $this->Categories->getCategories()
				);

			foreach($data['offers'] as $offer) {
				$offer->form = $this->Employment->getEmploymentFormShortNameById($offer->form)->short_name;
				$offer->currency = $this->Currencies->getCurrencyById($offer->currency)->short_name;
				$offer->url = '-'.str_replace(" ", "-",  url_title($offer->title));
			}



			$this->load->view('public/header', $data);
			$this->load->view('public/index', $data);
			$this->load->view('public/footer');
		}

		public function offers($page = 0) {
			$this->load->helper(array('form', 'url'));
			$this->load->library('pagination');

			foreach($this->input->get() as $get)
				$get = $this->security->xss_clean($get);

			$config = array(
					'base_url' => base_url().'jobs/offers',
					'total_rows' => $this->Offers->getOffersCount()/15,
					'per_page' => 1,
					'first_link' => 'Początek ',
					'last_link' => " Koniec",
					'num_tag_open' => ' ',
					'num_tag_close' => ' '
					);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'title' => 'Sektor-IT.pl - Centrum Ofert Pracy IT',
				'categories' => $this->Categories->getCategories(),
				'offers' => $this->Offers->searchOffers($page*15, 15, @$this->input->get('vac'), @$this->input->get('locality'), @$this->input->get('cat')),
				'link' => $this->pagination->create_links(),
				'page' => $page
				);

			foreach($data['offers'] as $offer)
				$offer->url = '-'.str_replace(" ", "-", url_title($offer->title));


			$this->load->view('public/header', $data);
			$this->load->view('public/offers/offers', $data);
			$this->load->view('public/footer');


		}

		public function show($id = NULL) {

			if(empty($id))
				return redirect('oferty');

			if(!is_numeric($id)) {
				$uri = explode('-', $id);
				$id = $uri[0];
				if(!is_numeric($id))
					return redirect('oferty');
			}

			$data = array(
				'title' => 'Sektor-IT.pl - Oferta Pracy',
				'offer' => $this->Offers->getOffer($id)
				);

			if(empty($data['offer']))
				redirect('jobs');

			$data['offer']->currency = $this->Currencies->getCurrencyById($data['offer']->currency)->short_name;
			$data['offer']->category = $this->Categories->getCategoryById($data['offer']->category)->name;
			$data['offer']->form = $this->Employment->getEmploymentFormShortNameById($data['offer']->form)->short_name;

			switch($data['offer']->vat) {
				case 1:
					$data['offer']->vat = "netto";
					break;
				case 2:
					$data['offer']->vat = "brutto";
					break;
				default:
					$data['offer']->vat = "";
					break;
			}

			$data['offer']->tags = explode(" ", $data['offer']->tags);

			$this->load->view('public/header', $data);
			$this->load->view('public/offers/offer', $data);
			$this->load->view('public/footer');

			return 1;
		}

		public function newsletter($param = NULL, $email = NULL) {

			$this->load->model('Newsletter_Model', 'Newsletter');

			if($param == 'unsubscribe') {
				var_dump($email);
			}

			if(empty($this->input->post('email')))
				return redirect('oferty');

			if($this->Newsletter->addEmail($this->input->post('email'))) {
				$this->session->set_flashdata('alert', array('type' => 'success', 'message' => 'Pomyślnie zapisałeś się do Newslettera!'));
				return redirect('oferty');
			} else {
				$this->session->set_flashdata('alert', array('type' => 'danger', 'message' => 'Taki adres E-Mail jest już zapisany do Newslettera!'));
				return redirect('oferty');
			}
		}
}