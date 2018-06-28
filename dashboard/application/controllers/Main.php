<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
	   $cek = $this->session->userdata('ID_USER');
	   
	   if(!empty($cek)){
	       $data['content']='tampil/report';
	        
	       $data['juser'] = $this->Mymodel->getcountuser('users');
	       $data['jklien'] = $this->Mymodel->getcountklien('users');
	       $data['jaktif'] = $this->Mymodel->getcountaktif('store');
	       $data['jnonaktif'] = $this->Mymodel->getcountnonaktif('store');
	        
	       $where= array('id_role'=>'2');
    	   $data['users']=$this->Mymodel->selectwhere('users',$where);
    	   
    	   $data['klien'] = $this->Mymodel->select2('users');
    	   
    	   //$where= array('status_store'=>'verified',
    	   //                 'is_deleted'=>'false');
	      // $data['outlet']=$this->Mymodel->selectwhere('store',$where);
           $data['outlet']=$this->Mymodel->selectaktif('store');

            $where= array('status_store'=>'verified',
    	                    'is_deleted'=>'true');
	       $data['outletnon']=$this->Mymodel->selectwhere('store',$where);

            

    	   $data['loggedin']= $this->session->userdata('FULL_NAME');
    	   $this->load->view('tampil/main', $data); 
    	   
    	   
	   } else {
	       header("location:".base_url());
	   }
	    
	  
	}
	
	public function admin()
	{
	   $data['admin']=$this->Mymodel->selectadmin('users');
	   $data['content']='tampil/admin';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function allstore()
	{
	   $data['outlet']=$this->Mymodel->selectallstore('store');
	   $data['content']='tampil/verified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data); 
	   
	}
	

	public function waiting()
	{
	   $data['outlet']=$this->Mymodel->selectwaiting('store');
	   $data['content']='tampil/unverified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	
	public function rejected()
	{
	   $data['outlet']=$this->Mymodel->selectrejected('store');
	   $data['content']='tampil/rejected';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function users()
	{
	   $where= array('id_role'=>'2');
	   $data['users']=$this->Mymodel->selectwhere('users',$where);
	   $data['content']='tampil/users';
	    $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	
	public function category()
	{
	   $data['kategori']=$this->Mymodel->select('category');
	   $data['content']='tampil/category';
	    $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function gotologin()
	{
	  header("location:".base_url());
	}

    public function gotoregister()
	{
	  $this->load->view('tampil/register');
	}


    public function update_cat()
	{
	   $id=$this->uri->segment(3);
	   $data['dataupdate']=$this->db->query("SELECT * FROM category where id_category_db='$id' ");
	   $data['side']='tampil/side';
	   $data['content']='tampil/update_category';
	    $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main', $data);
	}
	
	public function update_category()
	{
	    $idCat=$this->input->post('id');
	    $where= array('id_category_db'=>$idCat);
	    
	    $data['name_category']=$this->input->post('namecategory');
	   
	    if($pubtemp = $this->input->post('published') == "Ya")
	    {
	        $data['published']= "true";
	    }else $data['published']= "false";
	    
	    $data['updated']= date('Y-m-d H:i:s');
	    $data['updated_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('category',$data, $where);
	    
	   $data['kategori']=$this->Mymodel->select('category');
	   $data['content']='tampil/category';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	


	public function facility()
	{
	   $data['fasilitas']=$this->Mymodel->select('facility');
	   $data['content']='tampil/facility';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function update_fac()
	{
	   $id=$this->uri->segment(3);
	   $data['dataupdate']=$this->db->query("SELECT * FROM facility where id_facility_db='$id' ");
	   $data['content']='tampil/update_facility';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main', $data);
	}
	
	public function update_facility()
	{
	    $idFac=$this->input->post('id');
	    
	    $where= array('id_facility_db'=>$idFac);
    	    
    	$data['name_facility']=$this->input->post('namefacility');
    	
	   // $data['published'] = $this->input->post('published');
	    if($pubtemp = $this->input->post('published') == "Ya")
	    {
	        $data['published']= "true";
	    }else $data['published']= "false";
	    
	    $data['updated']= date('Y-m-d H:i:s');
	    $data['updated_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('facility',$data, $where);
	    
	   $data['fasilitas']=$this->Mymodel->select('facility');
	   $data['content']='tampil/facility';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	   
	}
	
	public function approve()
	{
	    $id=$this->uri->segment(3);
	    
	    $where= array('id_store'=>$id);
	    
	    $data['status_store']= "verified";
	    $data['confirmed']= date('Y-m-d H:i:s');
	    $data['confirmed_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('store',$data, $where);
	    
	   $data['outlet']=$this->Mymodel->selectwaiting('store');
	   $data['content']='tampil/unverified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function approve2($id = null)
	{
	    $where= array('id_store'=>$id);
	    
	    $data['status_store']= "verified";
	    $data['confirmed']= date('Y-m-d H:i:s');
	    $data['confirmed_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('store',$data, $where);
	    
	   $data['outlet']=$this->Mymodel->selectwaiting('store');
	   $data['content']='tampil/unverified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data); 
	   
	}
	
	public function reject()
	{
	  $id=$this->uri->segment(3);
	    
	    $where= array('id_store'=>$id);
	    
	    $data['status_store']= "rejected";
	    $data['confirmed']= date('Y-m-d H:i:s');
	    $data['confirmed_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('store',$data, $where);
	    
	   $data['outlet']=$this->Mymodel->selectwaiting('store');
	   $data['content']='tampil/unverified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
	public function reject2($id = null)
	{
	    $where= array('id_store'=>$id);
	    
	    $data['status_store']= "rejected";
	    $data['confirmed']= date('Y-m-d H:i:s');
	    $data['confirmed_by']= $this->session->userdata('ID_USER');
	    
	    $this->Mymodel->update('store',$data, $where);
	    
	   $data['outlet']=$this->Mymodel->selectwaiting('store');
	   $data['content']='tampil/unverified';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	   
	}
	
	public function add_new_fac()
	{
	   $data['content']='tampil/add_facility';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main', $data);
	}
	
	public function add_new_cat()
	{
	   $data['content']='tampil/add_category';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main', $data);
	}
	
	public function add_facility(){
	    $data['name_facility']=$this->input->post('namefacility');
	    
	    $data['created']= date('Y-m-d H:i:s');
	    $data['created_by']= $this->session->userdata('ID_USER');
	    
	    if($pubtemp = $this->input->post('published') == "Ya")
	    {
	        $data['published']= "true";
	    }else $data['published']= "false";
	    
	  
	    $this->Mymodel->insert('facility',$data);
	   
	   
	   $data['fasilitas']=$this->Mymodel->select('facility');
	   $data['content']='tampil/facility';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
    	   
	   
	}
	
	public function add_category(){
	    $data['name_category']=$this->input->post('namecategory');
	    $data['created']= date('Y-m-d H:i:s');
	    $data['created_by']= $this->session->userdata('ID_USER');
	    
	    if($pubtemp = $this->input->post('published') == "Ya")
	    {
	        $data['published']= "true";
	    }else $data['published']= "false";
	    
	  
	    $this->Mymodel->insert('category',$data);
	   
	   
	   $data['kategori']=$this->Mymodel->select('category');
	   $data['content']='tampil/category';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);
	}
	
    public function vdetail_outlet()
	{
	   $id=$this->uri->segment(3);
	    
	   $where= array('id_store'=>$id);
	   $data['outlet']=$this->Mymodel->selectwhere('store',$where);
       $data['schedule']=$this->Mymodel->selectwhere('schedule',$where);
	   $data['category']=$this->Mymodel->selectcat('store_has_category',$id);
	   $data['facility']=$this->Mymodel->selectfac('store_has_facility',$id);
	   $data['treatment']=$this->Mymodel->selecttr('treatment',$id);
	   $data['photorev']=$this->Mymodel->selectph('photo',$id);
	   $data['news']=$this->Mymodel->selectnews('news',$id);
	  
	  
	  
	   $data['content']='tampil/detail_outlet';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);

	}
	
	public function vdetail_waitingoutlet()
	{
	   $id=$this->uri->segment(3);
	    
	   $where= array('id_store'=>$id);
	   $data['outlet']=$this->Mymodel->selectwhere('store',$where);
       $data['schedule']=$this->Mymodel->selectwhere('schedule',$where);
	   $data['category']=$this->Mymodel->selectcat('store_has_category',$id);
	   $data['facility']=$this->Mymodel->selectfac('store_has_facility',$id);

	  
	   $data['content']='tampil/detail_waitingoutlet';
	   $data['loggedin']= $this->session->userdata('FULL_NAME');
	   $this->load->view('tampil/main',$data);

	}
	
}
