<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Member extends REST_Controller{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
	
		$this->load->model('Member_mod');
    }
	
	public function login_post(){
		$phone = $this->post('phone');
		$password = $this->post('password');
		
		$check = $this->Member_mod->Login($phone, $password);
	
		if($check){
			$messages = [
				'Users' => $check,
				'status' => 1,
				'message' => 'Login berhasil',
			];
		}else{
			$messages = [
				'Users' => $check,
				'status' => 0,
				'message' => 'Login gagal, cek kembali email dan password',
			];
		}
		
		$this->set_response($messages, REST_Controller::HTTP_CREATED);
	}

    public function register_post(){
		$full_name = $this->post('full_name');
		$phone = $this->post('phone');
		$password = $this->post('password');
		date_default_timezone_set('Asia/Jakarta');
		
		$check = $this->Member_mod->CheckPhone($phone);
      
		if($check){
		    $message = [
    				'status' => 0,
    				'message' => 'Nomor telepon sudah digunakan',
    			];
		}else{
			$data = array(
				'full_name' => $full_name,
				'phone' => $phone,
				'password' => $password,
				'id_role' => 2,
				'created' => date('Y-m-d H:i:s'),
			);
			
			if($this->db->insert('users', $data)){
				$message = [
					'status' => 1,
					'message' => 'Data pengguna berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
		}			
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	
	public function getUserByIdUser_get(){
   	$id_user = $this->input->get('id_user');
   	
   	if($id_user != NULL){
       	$Users = $this->Member_mod->getUser($id_user);
       	if($Users != NULL){
    		$message = [
    			'Users' => $Users,
    			'status' => 1,
    			'message' => 'Semua user berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'User tidak ditemukan',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	    }else{
   	        $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    		];
   	    }
   }
	
	
	public function edituser_post(){
		$id_user=$this->post('id_user');
		$full_name=$this->post('full_name');
		$password=$this->post('password');
		$phone=$this->post('phone');
		$email=$this->post('email');
		$avatar=$this->post('avatar');
		$encodedfile=$this->post('encodedfile');
		
		if($full_name != NULL & $password != NULL & $phone != NULL & $avatar != NULL & $encodedfile != NULL){	    
    	
        	$data = array(
				'full_name' => $full_name,
				'password' => $password,
				'email' => $email,
		        'phone' => $phone,
		        'avatar' => 'http://devpanel.xyz/klop_api/image_content/'.$avatar,
		        'updated' => date('Y-m-d H:i:s'),
			);
    		
    	    $imsrc = base64_decode($encodedfile);
    	        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/klop_api/image_content/'.$avatar.'', 'w');
    	        fwrite($fp, $imsrc);
    
			if($this->db->update('users', $data, array('id_user' => $id_user))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data pengguna berhasil diedit',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else if($full_name != NULL & $password != NULL & $phone != NULL & $avatar == NULL){
		    	$data = array(
				'full_name' => $full_name,
				'password' => $password,
				'email' => $email,
		        'phone' => $phone,
		        'updated' => date('Y-m-d H:i:s'),
			);
    
			if($this->db->update('users', $data, array('id_user' => $id_user))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data pengguna berhasil diedit',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
		}	else{
		    $message = [
    					'status' => 3,
    					'message' => 'Data yang diinput tidak valid',
    				];
		}
	}
	
	
}
