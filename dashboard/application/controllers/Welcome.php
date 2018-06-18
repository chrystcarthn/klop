<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function _construct(){
        session_start();
    }

	public function index()
	{
	    $cek = $this->session->userdata('ID_USER');
	    if(empty($cek)){
	        $this->load->view('welcome_message');
	    }
	    else header('location:'.base_url().'index.php/Main');
		
	}
	
	public function gotoregister(){
	    header('location:'.base_url().'index.php/Register');
	}
}
