<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mymodel extends CI_Model {


	public function select($table)
	{
		return $this->db->get($table);
	}
	
	public function selectwhere($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	function delete($table,$data)
	{
		$this->db->delete($table, $data);
	}
	
	function update($table,$data,$key)
	{
		$this->db->update($table,$data,$key);
	}

    function getcountuser($table){
	    $this->db->select('count(*) "jusers"');
		return $query= $this->db->get($table);
	}
	
	function getcountklien($table){
	    $this->db->select('count(distinct users.ID_USER) "jklien"');
	    $this->db->join('store','users.id_user = store.id_user');
	    $this->db->where('status_store', 'verified');
	    $this->db->where('is_deleted', 'false');
		return $query= $this->db->get($table);
	}

    function getcountaktif($table){
	    $this->db->select('count(*) "jaktif"');
	    $this->db->where('status_store', 'verified');
	    $this->db->where('is_deleted', 'false');
		return $query= $this->db->get($table);
	}


    function getcountnonaktif($table){
	    $this->db->select('count(*) "jnonaktif"');
	    $this->db->where('status_store', 'verified');
	    $this->db->where('is_deleted', 'true');
		return $query= $this->db->get($table);
	}


	function insert($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	
	public function select2($table)
	{
	    $this->db->select('users.ID_USER, users.FULL_NAME, users.PHONE, users.EMAIL, users.CREATED, users.UPDATED, (select count(*) from store where ID_USER = users.ID_USER AND status_store="verified" AND is_deleted="false") "OUTLET"');
	    $this->db->join('store','users.id_user = store.id_user');
	    $this->db->where('status_store', 'verified');
	    $this->db->where('is_deleted', 'false');
	    $this->db->group_by('users.full_name');
		return $this->db->get($table);
	}
	
	public function selectcat($table,$data)
	{
	    $this->db->select('category.name_category');
    	$this->db->join('category','store_has_category.id_category = category.id_category_db');
		$this->db->where('store_has_category.id_store', $data);
		return $this->db->get($table);
	}
	
	public function selectfac($table,$data)
	{
	    $this->db->select('facility.name_facility');
        $this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
		$this->db->where('store_has_facility.id_store', $data);
		return $this->db->get($table);
	}
	
	public function selecttr($table,$data)
	{
	   $this->db->where('id_store', $data);
	   $this->db->where('isdeleted', 'false');
	   return $this->db->get($table);
	}
	
	public function selectph($table,$data)
	{
	   $this->db->where('id_store', $data);
	   return $this->db->get($table);
	}
	
	public function selectnews($table,$data)
	{
	   $this->db->where('id_store', $data);
	   return $this->db->get($table);
	}
	
	public function getClient(){
	    $this->db->select('*');
	    $this->db->from('users');
	  //  $this->db->join('store', 'users.id_user = store.id_user');
	    $query= $this->db->get();
		
		return $query->result();
	}
	
    
	
	public function getlogin($email, $password){
	    $u = $email;
	    $p = $password;
	    
	   
    	    $cek_login = $this->db->get_where('users', array('EMAIL' => $u, 'PASSWORD' => $p));
    	    if($cek_login->num_rows() > 0){
    	        $datauser = $cek_login->row();
    	        if($u == $datauser->EMAIL && $p == $datauser->PASSWORD && $datauser->ID_ROLE == '1'){
    	            $sess = array(
    	                'ID_USER' => $datauser->ID_USER,
    	                'FULL_NAME' => $datauser->FULL_NAME,
    	                'ID_ROLE' => $datauser->ID_ROLE,
    	                );
    	            $this->session->set_userdata($sess);
    	            header('location:'.base_url().'index.php/Main');
    	        } else
    	            header('location:'.base_url());
    	    } else {
    	        echo "<script>alert('Email atau kata sandi salah, silahkan coba lagi');";
    	        echo "windows.location.href = '" .base_url(). "';";
    	        echo "</script>";
    	    }
	   
	}
	
	public function register($nama, $email, $password){
	    $n = $nama;
	    $u = $email;
	    $p = $password;
	    
	  
	    
    	    $cek_user= $this->db->get_where('users', array('EMAIL' => $u));
    	    if($cek_user->num_rows() > 0){
    	        echo "<script>alert('Maaf, email sudah digunakan.');";
    	        echo "windows.location.href = '" .base_url(). "';";
    	        echo "</script>";
    	    } else {
    	       	$data = array(
    				'full_name' => $nama,
    				'email' => $email,
    				'password' => $password,
    				'id_role' => 1,
    				'created' => date('Y-m-d H:i:s'),
    			);
    			
    			if($this->db->insert('users', $data)){
    				echo "<script>alert('Registrasi berhasil. Silahkan masuk dengan akun Anda');";
        	        echo "windows.location.href = '" .base_url(). "';";
        	        echo "</script>";
    			}else{
        			echo "<script>alert('Registrasi gagal');";
        	        echo "windows.location.href = '" .base_url(). "';";
        	        echo "</script>";
    			}
    	    }
	    
	}
	
	public function selectaktif($table)
	{
	    $this->db->select('store.NAME_STORE, store.ADDRESS_STORE, store.PHONE_STORE, store.CREATED, store.STATUS_STORE, store.IS_DELETED, (select FULL_NAME from users where ID_USER = store.ID_USER) "NamaU", store.CONFIRMED, (select FULL_NAME from users where ID_USER = store.CONFIRMED_BY) "NamaA"');
	    $this->db->join('users','store.ID_USER = users.ID_USER');
	    $this->db->where('store.STATUS_STORE', 'verified');
	    $this->db->where('store.IS_DELETED', 'false');
		return $this->db->get($table);
	}
	
	public function selectrejected($table)
	{
	    $this->db->select('store.ID_STORE, store.NAME_STORE, store.ADDRESS_STORE, store.PHONE_STORE, store.CREATED, (select FULL_NAME from users where ID_USER = store.ID_USER) "NamaU" , store.CONFIRMED, (select FULL_NAME from users where ID_USER = store.CONFIRMED_BY) "NamaA", store.STATUS_STORE, store.IS_DELETED');
	    $this->db->join('users','store.ID_USER = users.ID_USER');
	    $this->db->where('store.STATUS_STORE', 'rejected');
		return $this->db->get($table);
	}
	
	public function selectallstore($table)
	{
	    $this->db->select('store.ID_STORE, store.NAME_STORE, store.ADDRESS_STORE, store.PHONE_STORE, store.CREATED, (select FULL_NAME from users where ID_USER = store.ID_USER) "NamaU" , store.CONFIRMED, (select FULL_NAME from users where ID_USER = store.CONFIRMED_BY) "NamaA", store.STATUS_STORE, store.IS_DELETED');
	    $this->db->join('users','store.ID_USER = users.ID_USER');
		return $this->db->get($table);
	}
	
	public function selectwaiting($table)
	{
	    $this->db->select('store.ID_STORE, store.NAME_STORE, store.ADDRESS_STORE, store.PHONE_STORE, store.CREATED, (select FULL_NAME from users where ID_USER = store.ID_USER) "NamaU" , store.CONFIRMED, (select FULL_NAME from users where ID_USER = store.CONFIRMED_BY) "NamaA", store.STATUS_STORE, store.IS_DELETED');
	    $this->db->join('users','store.ID_USER = users.ID_USER');
	    $this->db->where('store.STATUS_STORE', 'unverified');
		return $this->db->get($table);
	}
	
	public function selectadmin($table)
	{
	   
	    $this->db->select('FULL_NAME, STATUS, PHONE, EMAIL, CREATED, (select FULL_NAME from users where ID_USER = CREATED_BY) "NamaAC", UPDATED,(select FULL_NAME from users where ID_USER = UPDATED_BY) "NamaAU"');
		$this->db->where('ID_ROLE', 1);
		return $this->db->get($table);
	}
	
	public function selectcat2($table)
	{
	    $this->db->select('category.ID_CATEGORY_DB, category.NAME_CATEGORY, category.CREATED, (select FULL_NAME from users where ID_USER = category.CREATED_BY) "NamaAC" , category.UPDATED, (select FULL_NAME from users where ID_USER = category.UPDATED_BY) "NamaAU",  category.PUBLISHED');
	    $this->db->join('users','category.CREATED_BY = users.ID_USER');
		return $this->db->get($table);
	}
	
	public function selectfac2($table)
	{
	    $this->db->select('facility.ID_FACILITY_DB, facility.NAME_FACILITY, facility.CREATED, (select FULL_NAME from users where ID_USER = facility.CREATED_BY) "NamaAC" , facility.UPDATED, (select FULL_NAME from users where ID_USER = facility.UPDATED_BY) "NamaAU",  facility.PUBLISHED');
	    $this->db->join('users','facility.CREATED_BY = users.ID_USER');
		return $this->db->get($table);
	}

}