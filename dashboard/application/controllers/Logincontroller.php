<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincontroller extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
    }

    public function loginaction(){
        
        
        // $u=$this->input->post('email');
        // $p=$this->input->post('password');
        // if(!empty($this->Mymodel->Login($u, $p))){
        //     $where= array('status_store'=>'verified');
    	   //$data['outlet']=$this->Mymodel->selectwhere('store',$where);
    	   //$data['content']='tampil/verified';
    	   //$this->load->view('tampil/main',$data);
        // }
        
         $where= array('status_store'=>'verified');
    	   $data['outlet']=$this->Mymodel->selectwhere('store',$where);
    	   $data['content']='tampil/verified';
    	   $this->load->view('tampil/main',$data);
    }
    
}