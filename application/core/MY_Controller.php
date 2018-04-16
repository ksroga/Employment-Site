<?php

class MY_ACP_Controller extends CI_Controller {

     public function __construct() {
         parent::__construct();

         $this->load->library('session');
         if(!$this->session->userdata('admin_logged_in'))
            die("Brak uprawnień");

         $this->load->model(array('Groups_Model', 
                                  'Posts_Model', 
                                  'Offers_Model' => 'Offers', 
                                  'Permissions_Model' => 'Permissions',
                                  'Logs_Model' => 'Logs'
                                  ));

         //get your data
         $global_data = array(
         	'groups_count' => sizeof($this->Groups_Model->getGroups()),
         	'new_posts' => $this->Posts_Model->getPostsCount(),
         	'offers_count' => $this->Offers->GetOffersCount()
         	);

         $this->load->vars($global_data);

         if(!$this->Permissions->isAdminAuthorized(PERM_ACP_ACCESS))
            return $this->noPerms();

        return 1;
     }  

     public function noPerms() {
        $data = array(
            'title' => 'Brak uprawnień!',
            'error' => 'Nie masz uprawnień do tej sekcji!'
            );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/error', $data);
        $this->load->view('admin/footer');

        return 1;
     }
}


class MY_Public_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('session');
		$this->load->model(array(
			'Login_Model' => 'Login',
			'Permissions_Model' => 'Permissions',
            'Settings_Model' => 'Settings' 
			));


        if($this->Settings->getSetting('disabled') == 'on' && !$this->Permissions->isAdminAuthorized(PERM_ACP_ACCESS))
            return $this->disabled();

		return 1;
	}

    public function disabled() {

        $data = array(
            'title' => 'Sektor-IT.pl',
            'disabled_message' => $this->Settings->getSetting('disabled-reason')
            );

        $msg = $this->load->view('public/disabled', $data, true);

        die($msg);
    }
}