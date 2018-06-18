<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OutletDashboard extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
	    $data['outlet']=$this->Mymodel->select('store');
		$this->load->view('Outlet', $data);
	}
	
	public function manage_category()
	{
	    $data['kategori']=$this->Mymodel->select('category');
		$this->load->view('mngCategory', $data);
	}
	
	public function manage_facility()
	{
	    $data['fasilitas']=$this->Mymodel->select('facility');
		$this->load->view('mngFacility', $data);
	}
	
	public function add_category()
	{
	    $data['name_category']=$this->input->post('namedata');
	    $data['created']= date('Y-m-d H:i:s');
	    $this->Mymodel->insert('category',$data);
	   	$data['kategori']=$this->Mymodel->select('category');
		$this->load->view('mngCategory', $data);
	
	}
	
	public function add_facility()
	{
	    $data['name_facility']=$this->input->post('namedata');
	    $data['created']= date('Y-m-d H:i:s');
	    $this->Mymodel->insert('facility',$data);
	    $data['fasilitas']=$this->Mymodel->select('facility');
		$this->load->view('mngFacility', $data);
	
	}
	
	public function delete_facility()
	{
	    $id=$this->uri->segment(3);
	    $delete=array('id_facility_db'=>$id);
	    $this->Mymodel->delete('facility',$delete);
	    
	    $data['fasilitas']=$this->Mymodel->select('facility');
		$this->load->view('mngFacility', $data);
		
	}
	
	public function delete_category()
	{
	    $id=$this->uri->segment(3);
	    $delete=array('id_category_db'=>$id);
	    $this->Mymodel->delete('category',$delete);
	    
	   	$data['kategori']=$this->Mymodel->select('category');
		$this->load->view('mngCategory', $data);
		
	}
	
	public function verifikasi()
	{
	    $idStore=$this->input->post('idStore');
	    $where= array('id_store'=>$idStore);
	 
	    $data['status_store']='verified';
	    $this->Mymodel->update('store',$data, $where);
	    
	    $data['outlet']=$this->Mymodel->select('store');
		$this->load->view('Outlet', $data);
		
	}

	public function update_category()
	{
	    $idCat=$this->input->post('idCat');
	    $where= array('id_category_db'=>$idCat);
	    
	    $data['name_category']=$this->input->post('nmCat');
	    $this->Mymodel->update('category',$data, $where);
	    
	    $data['kategori']=$this->Mymodel->select('category');
		$this->load->view('mngCategory', $data);
		
	}

	public function update_facility()
	{
	    $idFac=$this->input->post('idFac');
	    $where= array('id_facility_db'=>$idFac);
	    
	    $data['name_facility']=$this->input->post('nmFac');
	    $this->Mymodel->update('facility',$data, $where);
	    
	    $data['fasilitas']=$this->Mymodel->select('facility');
		$this->load->view('mngFacility', $data);
		
	}
}
