<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Member_mod extends CI_Model{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	
	function Login($phone = null, $password = null){
		if(!$phone){return false;}
		if(!$password){return false;}
		
		return $this->db
			->select('*')
			->get_where('users', array('phone' => $phone, 'password' => $password))
			->result_array(); //row kalo keluarannya 1 row,
					//kalau banyak row pake result_array
	}
 
	function CheckPhone($phone = null){
		if(!$phone){return false;}
		
		return $this->db
			->select('*')
			->get_where('users', array('phone' => $phone))
			->row();
	}
	
	
			
	function getUser($id_user){
        $this->db->select('*');
        $this->db->where('id_user',$id_user);
    	$this->db->from('users');
    	$query= $this->db->get();
	    
		return $query->result();
	}
	
	
    function editUser($id_user = null, $full_name = null, $password = null, $phone = null, $email = null){
      if(!$id_user){return false;}
         if(!$full_name){return false;}
          if(!$password){return false;}
           if(!$phone){return false;}
            if(!$email){return false;}
            
    	$data = array(
				'full_name' => $full_name,
				'password' => $password,
				'email' => $email,
		        'phone' => $phone,
			);
		
		return $this->db
		            ->update('users', $data, array('id_user' => $id_user));
    }
}