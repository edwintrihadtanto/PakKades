<?php
date_default_timezone_set('Asia/Jakarta');
class Utama extends CI_Controller {
    public function __construct()
    {
		parent::__construct();        
        $this->load->model('session_apps');
        
        if($this->session_apps->logged_id()){
            //$this->load->view("ui/index");
            //redirect("main");
            redirect(base_url('main'));
        }
	}

	public function index()
	{       
        //$this->load->view("admin/utama");
       $this->load->view("ui/display");     
	}

    
}