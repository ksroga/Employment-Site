<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_ACP_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->Permissions->isAdminAuthorized(PERM_POSTS_MANAGEMENT))
			return $this->noPerms();
	}

	public function index() {
		return $this->newest();
	}

	public function newest() {
		$page = $this->uri->segment(4,0) * 25;

		$config = array(
			'base_url' => 'http://localhost/projekt/index.php/admin/posts/newest/',
			'total_rows' => $this->Posts_Model->getPostsCount()/25,
			'per_page' => 1,
			'first_link' => 'Początek ',
			'last_link' => " Koniec",
			'num_tag_open' => ' ',
			'num_tag_close' => ' '
			);

		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$data = array(
			'title' => 'Nowe posty',
			'page' => $page,
			'posts' => $this->Posts_Model->getNewPosts($page, 25),
			'link' => $this->pagination->create_links()
			);


		$this->load->view('admin/header', $data);
		$this->load->view('admin/posts/posts', $data);
		$this->load->view('admin/footer');

		return 1;
	}

	public function show($post_id = NULL) {
		if(!$post_id && !$this->uri->segment(4,0) || !is_numeric($this->uri->segment(4,0)))
			return 0;

		if($post_id == NULL && is_numeric($this->uri->segment(4,0)))
			$post_id = $this->uri->segment(4,0);

		$this->load->model('Currencies_Model', 'Currencies');
		$this->load->model('EmploymentForms_Model', 'EmploymentForms');
		$this->load->model('Categories_Model', 'Categories');

		$data = array(
			'title' => 'Zatwierdź post',
			'post' => $this->Posts_Model->getPostById($post_id),
			'currencies' => $this->Currencies->getCurrencies(),
			'employment_forms' => $this->EmploymentForms->getEmploymentForms(),
			'categories' => $this->Categories->getCategories()
			);

		$this->load->helper('form');

		$this->load->view('admin/header', $data);
		$this->load->view('admin/posts/view', $data);
		$this->load->view('admin/footer');
	}

	public function accept() {
		if(!$_POST)
			return 0;

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
            $this->show($_POST['post_id']);
        } else {
            $data = array(
            	'post_id' => $_POST['fb_post_id'],
            	'content' => $_POST['offer'],
            	'title' => $_POST['title'],
            	'form' => $_POST['form'],
            	'salary' => $_POST['salary'],
            	'maxsalary' => $_POST['maxsalary'],
            	'manhour' => (isset($_POST['manhour'])) ? 1 : 0,
            	'currency' => $_POST['currency'],
            	'vat' => $_POST['vat'],
            	'category' => $_POST['category'],
            	'country' => $_POST['country'],
            	'city' => $_POST['locality'],
            	'state' => $_POST['administrative_area_level_1'],
            	'tags' => $_POST['tags']
            	);

            $data = $this->security->xss_clean($data);
            $this->load->model('Offers_Model', 'Offers');

            if($this->Offers->addOffer($data)) {
            	$this->Posts_Model->deactivatePost($_POST['post_id']);
            	$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_POST_ACCEPT, $this->input->post('post_id'));
            	$data['success'] = 'Pomyślnie zaakceptowano i dodano ofertę pracy!';
            	$this->load->view('admin/header', $data);
				$this->load->view('admin/success', $data);
				$this->load->view('admin/footer');
            } else {
            	$data['error'] = 'Nie udało się dodać oferty. Spróbuj ponownie później.';
            	$this->load->view('admin/header', $data);
				$this->load->view('admin/error', $data);
				$this->load->view('admin/footer');
            }
        }
	}

	public function decline() {
		if(!$this->uri->segment(4,0))
			return 0;

		$data['success'] = 'Pomyślnie dezaktywowano post.';
        $this->load->view('admin/header', $data);
		$this->load->view('admin/success', $data);
		$this->load->view('admin/footer');
		$this->Logs->addLog($this->session->admin_logged_in['id'], LOG_ADMIN_POST_DECLINE, $this->uri->segment(4,0));
		return $this->Posts_Model->deactivatePost($this->uri->segment(4,0));
	}

}