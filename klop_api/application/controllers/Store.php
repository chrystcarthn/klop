<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Store extends REST_Controller{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Store_mod');
    }

	
	public function addstore_post(){
		$id_user = $this->post('id_user');
		$name_store = $this->post('name_store');
	//	$description_store = $this->post('description_store');
		$address_store = $this->post('address_store');
		$phone_store = $this->post('phone_store');
		$latitude = $this->post('latitude');
		$longitude = $this->post('longitude');
		$distance = $this->post('distance');

	//	$manager = $this->post('manager');
	//	$manager_phone = $this->post('manager_phone');
	
		
		$check = $this->Store_mod->CheckPhone($phone_store);

		if($check){
			$message = [
				'status' => 0,
				'message' => 'Salon dengan nomor telepon tersebut sudah terdaftar!',
			];
		}else{
			$data = array(
				'id_user' => $id_user,
				'name_store' => $name_store,
				'address_store' => $address_store,
				'phone_store' => $phone_store,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'is_setmanual' => 'no',
				'status_store' => 'unverified',
				'rate_sum' => 0,
				'is_deleted' => 'false',
				'created' => date('Y-m-d H:i:s'),
			);
			
			if($this->db->insert('store', $data)){
				$message = [
				
					'status' => 1,
					'message' => 'Data salon berhasil dibuat',
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
	
	
	public function updateStore_post(){
		$id_store=$this->post('id_store');
		$name_store=$this->post('name_store');
		$address_store=$this->post('address_store');
		$phone_store=$this->post('phone_store');
		$latitude=$this->post('latitude');
		$longitude=$this->post('longitude');
	
		
		if($id_store != NULL & 
    		$name_store != NULL & 
    		$address_store != NULL & 
    		$phone_store != NULL & 
    		$latitude != NULL &
    		$longitude != NULL){	    
    	
        	$data = array(
				'name_store' => $name_store,
				'address_store' => $address_store,
				'phone_store' => $phone_store,
		        'latitude' => $latitude,
		        'longitude' => $longitude,
		        'updated' => date('Y-m-d H:i:s'),
			);
    		
    	   
			if($this->db->update('store', $data, array('id_store' => $id_store))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data outlet berhasil diedit',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else {
		    $message = [
    					'status' => 3,
    					'message' => 'Data yang diinput tidak valid',
    				];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	
	public function getAllstore_post(){
	    $id_user=$this->post('id_user');
		$latCurrent=$this->post('latCurrent');
		$longCurrent=$this->post('longCurrent');
	    
   	// $id_user = $this->input->get('id_user');
   	// $latCurrent = $this->input->get('latCurrent');
   	// $longCurrent = $this->input->get('longCurrent');
   	
   	if($id_user != NULL){
       	$Store = $this->Store_mod->getAllstore($id_user, $latCurrent, $longCurrent);
       	if($Store != NULL){
    		$message = [
    			'Store' => $Store,
    			'status' => 1,
    			'message' => 'Semua outlet berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Anda belum mendaftarkan outlet.',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	}else{
   	     $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    	];
   	}
   		
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   	public function getAllstoreVerified_post(){
         $id_user=$this->post('id_user');
		$latCurrent=$this->post('latCurrent');
		$longCurrent=$this->post('longCurrent');
   
   	
   	if($id_user != NULL){
       	$Store = $this->Store_mod->getAllstoreVerified($latCurrent, $longCurrent);
       	if($Store != NULL){
    		$message = [
    			'Store' => $Store,
    			'status' => 1,
    			'message' => 'Semua outlet berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Outlet tidak ditemukan',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	    }
   	    else{
   	        $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    		];
   	    }
   	    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function deleteStore_post(){
		$id_store=$this->post('id_store');
		
		if($id_store != NULL){	    
    	
        	$data = array(
				'is_deleted' => 'true',
				'deleted' => date('Y-m-d H:i:s'),
			);
    		
    	  
			if($this->db->update('store', $data, array('id_store' => $id_store))){
            		$message = [
    					'status' => 1,
    					'message' => 'Store berhasil dihapus',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else{
		    $message = [
    					'status' => 3,
    					'message' => 'Data yang diinput tidak valid',
    		];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
   
   	

    
   
   public function searchAllstoreVerifiedByKeyword_post(){
        $id_user=$this->post('id_user');
         $keyword=$this->post('keyword');
		$latCurrent=$this->post('latCurrent');
		$longCurrent=$this->post('longCurrent');
   	
   	if($id_user != NULL){
       	$Store = $this->Store_mod->searchStoreVerifiedByKeyword($keyword, $latCurrent, $longCurrent);
       	
       	if($Store != NULL){
    		$message = [
    			'Store' => $Store,
    			'status' => 1,
    			'message' => 'Semua outlet berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Outlet tidak ditemukan',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	}else{
   	    $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    		];
   	}
   	
   		$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
  
   public function searchAllUserStoreByKeyword_post(){
     $id_user=$this->post('id_user');
        $keyword=$this->post('keyword');
		$latCurrent=$this->post('latCurrent');
		$longCurrent=$this->post('longCurrent');
   	
   	if($id_user != NULL){
       	$Store = $this->Store_mod->searchUserStoreByKeyword($id_user, $keyword, $latCurrent, $longCurrent);
       	
       	if($Store != NULL){
    		$message = [
    			'Store' => $Store,
    			'status' => 1,
    			'message' => 'Semua store berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Store gagal didapatkan, cek kembali koneksi Anda',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	}else{
   	     $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    		];
   	}
   		
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
    
   
   public function getStoreByIdStore_post(){
    $id_store=$this->post('id_store');
		$latCurrent=$this->post('latCurrent');
		$longCurrent=$this->post('longCurrent');
   	
   	$Store = $this->Store_mod->getStore($id_store, $latCurrent, $longCurrent);
   	
   	if($Store != NULL){
		$message = [
			'Store' => $Store,
			'status' => 1,
			'message' => 'Semua store berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'Store gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getCategoryByIdStore_post(){
        $id_store=$this->post('id_store');
       
       $Category = $this->Store_mod->getCategory($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Category != NULL){
           	$message = [
			'Category' => $Category,
			'status' => 1,
			'message' => 'Semua kategori dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Kategori gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function getScheduleByIdStore_post(){
        $id_store=$this->post('id_store');
       
       $Schedule = $this->Store_mod->getSchedule($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Schedule != NULL){
           	$message = [
			'Schedule' => $Schedule,
			'status' => 1,
			'message' => 'Semua jadwal dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Jadwal gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   public function getFacilityByIdStore_post(){
        $id_store=$this->post('id_store');
       
       $Facility = $this->Store_mod->getFacility($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Facility != NULL){
           	$message = [
			'Facility' => $Facility,
			'status' => 1,
			'message' => 'Semua fasilitas dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Jadwal fasilitas didapatkan, cek kembali koneksi Anda',
		];
       }
       
       $this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   public function getTreatmentByIdStore_post(){
        $id_store=$this->post('id_store');
       
       $Treatment = $this->Store_mod->getTreatment($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Treatment != NULL){
           	$message = [
			'Treatment' => $Treatment,
			'status' => 1,
			'message' => 'Semua perawatan dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Perawatan didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function getNewsPub_post(){
        $id_store=$this->post('id_store');
       
       $News = $this->Store_mod->getNews($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($News != NULL){
           	$message = [
			'News' => $News,
			'status' => 1,
			'message' => 'Semua berita dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Tidak ada berita yang dipajang',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function getAllNews_post(){
       $id_store=$this->post('id_store');
       
       $News = $this->Store_mod->getNewsAll($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($News != NULL){
           	$message = [
			'News' => $News,
			'status' => 1,
			'message' => 'Semua berita dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Tidak ada berita',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function searchTr_get(){
    $id_store = $this->input->get('id_store');
   	$keyword = $this->input->get('keyword');
   	
   	if($id_store != NULL){
       	$Treatment = $this->Store_mod->searchTr($keyword);
       	
       	if($Treatment != NULL){
    		$message = [
    			'Treatment' => $Treatment,
    			'status' => 1,
    			'message' => 'Semua perawatan berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Outlet tidak ditemukan',
    		];
    	}
    	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   	}else{
   	    $message = [
    			'status' => 3,
    			'message' => 'Login dahulu',
    		];
   	}
   		
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function getReviewByIdStore_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getReview($id_store);
       $Count = $this->Store_mod->getCountReview($id_store);
       $btg1 = $this->Store_mod->getBtg1($id_store);
        $btg2 = $this->Store_mod->getBtg2($id_store);
         $btg3 = $this->Store_mod->getBtg3($id_store);
          $btg4 = $this->Store_mod->getBtg4($id_store);
           $btg5 = $this->Store_mod->getBtg5($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Review != NULL & $Count != 0){
           	$message = [
			'Review' => $Review,
			'Count' => $Count,
			'Bintang1' => $btg1 + 0,
			'Bintang2' => $btg2 + 0,
			'Bintang3' => $btg3 + 0,
			'Bintang4' => $btg4 + 0,
			'Bintang5' => $btg5 + 0,
			'status' => 1,
			'message' => 'Semua review dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getReview1_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getRev1($id_store);
    
       
       if($Review != NULL){
           	$message = [
			'Review' => $Review,
			'status' => 1,
			'message' => 'Semua review bintang 1 dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   public function getReview2_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getRev2($id_store);
    
       
       if($Review != NULL){
           	$message = [
			'Review' => $Review,
			'status' => 1,
			'message' => 'Semua review bintang 2 dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getReview3_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getRev3($id_store);
    
       
       if($Review != NULL){
           	$message = [
			'Review' => $Review,
			'status' => 1,
			'message' => 'Semua review bintang 3 dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getReview4_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getRev4($id_store);
    
       
       if($Review != NULL){
           	$message = [
			'Review' => $Review,
			'status' => 1,
			'message' => 'Semua review bintang 4 dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getReview5_post(){
        $id_store=$this->post('id_store');
       
       $Review = $this->Store_mod->getRev5($id_store);
    
       
       if($Review != NULL){
           	$message = [
			'Review' => $Review,
			'status' => 1,
			'message' => 'Semua review bintang 5 dari store berhasil didapatkan',
		];
    	}else{
		$message = [
			'status' => 0,
			'message' => 'Review gagal didapatkan, cek kembali koneksi Anda',
		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   
   
	public function getCategoryInDb_get(){
   	$CategoryDb = $this->Store_mod->getCategoryAdded();
   	
   	if($CategoryDb != NULL){
		$message = [
			'CategoryDb' => $CategoryDb,
			'status' => 1,
			'message' => 'Semua ketegori berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'ketegori gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getFacilityInDb_get(){
   	$FacilityDb = $this->Store_mod->getFacilityAdded();
   	
   	if($FacilityDb != NULL){
		$message = [
			'FacilityDb' => $FacilityDb,
			'status' => 1,
			'message' => 'Semua ketegori berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'ketegori gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   public function getCatSetting_get(){
     $id_store = $this->input->get('id_store');
     
     	$CatSetting = $this->Store_mod->getCatSettings($id_store);
     	
    //  	print_r($CatSetting);
    //     die();
     	
     	if($CatSetting != NULL){
		$message = [
			'CatSetting' => $CatSetting,
			'status' => 1,
			'message' => 'Semua ketegori berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'ketegori gagal didapatkan, cek kembali koneksi Anda',
		];
	}
     	$this->set_response($message, REST_Controller::HTTP_CREATED);
  
   }
   
   public function getFacSetting_get(){
     $id_store = $this->input->get('id_store');
     
     	$FacSetting = $this->Store_mod->getFacSettings($id_store);
     	
     	if($FacSetting != NULL){
		$message = [
			'FacSetting' => $FacSetting,
			'status' => 1,
			'message' => 'Semua fasilitas berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'Fasilitas gagal didapatkan, cek kembali koneksi Anda',
		];
	}
     	$this->set_response($message, REST_Controller::HTTP_CREATED);
  
   }
   
   
   	public function getStoreHasCategory_get(){
   	$StoreHasCategory = $this->Store_mod->getStoreHasCategory();
   	
   	if($StoreHasCategory != NULL){
		$message = [
			'StoreHasCategory' => $StoreHasCategory,
			'status' => 1,
			'message' => 'Semua ketegori berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'ketegori gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
   	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function getStoreHasFacility_get(){
   	$StoreHasFacility = $this->Store_mod->getStoreHasFacility();
   	
   	if($StoreHasFacility != NULL){
		$message = [
			'StoreHasFacility' => $StoreHasFacility,
			'status' => 1,
			'message' => 'Semua ketegori berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'ketegori gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
   	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }

    public function deleteCategory_post(){
		$id_store = $this->post('id_store');
		$id_category = $this->post('id_category');
		
		$list_category = explode(',', $id_category);
		foreach($list_category AS $red){
		    $data[] = array(
		        'id_store' => $id_store,
		        'id_category' => $red,
		    );
		}
	
	   if(!empty($id_store) & !empty($id_category)){
           $query = $this->Store_mod->delCat($id_store,$list_category);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete ketegori berhasil dilakukan',
    			];
            }else if(empty($id_store)){
    				$message = [
    					'status' => 3,
    					'message' => 'id store kosong',
    				];
    	    }else if(empty($id_category)){
    				$message = [
    					'status' => 4,
    					'message' => 'id kategori kosong',
    				];
    	    }	
	
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	
	public function deleteFacility_post(){
		$id_store = $this->post('id_store');
		$id_facility = $this->post('id_facility');
		
		$list_facility = explode(',', $id_facility);
		foreach($list_facility AS $red){
		    $data[] = array(
		        'id_store' => $id_store,
		        'id_facility' => $red,
		    );
		}
	
	   if(!empty($id_store) & !empty($id_facility)){
           $query = $this->Store_mod->delFac($id_store,$list_facility);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete fasilitas berhasil dilakukan',
    			];
            }else if(empty($id_store)){
    				$message = [
    					'status' => 3,
    					'message' => 'id store kosong',
    				];
    	    }else if(empty($id_facility)){
    				$message = [
    					'status' => 4,
    					'message' => 'id fasilitas kosong',
    				];
    	    }	
	
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
   
   	public function addStoreCategory_post(){
		$id_store = $this->post('id_store');
		$id_category = $this->post('id_category');
		
		$list_category = explode(',', $id_category);
		foreach($list_category AS $red){
		    $data[] = array(
		        'id_store' => $id_store,
		        'id_category' => $red,
		        'created' => date('Y-m-d H:i:s'),
		    );
		//    $this->db->update('store_has_category', $data, array('id_store' => $id_store));
		}
		
// 		$data[] = array(
// 				'id_store' => $id_store,
// 			    'id_category' => $id_category,
// 			);
		
		if($this->db->insert_batch('store_has_category', $data)){
			$message = [
			
				'status' => 1,
				'message' => 'Kategori salon berhasil dibuat',
			];
		}else{
			$message = [
				
				'status' => 0,
				'message' => 'Data gagal dimasukkan karena kesalahan database',
			];
		}			
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	
   	public function addStoreFacility_post(){
		$id_store = $this->post('id_store');
		$id_facility = $this->post('id_facility');
		
		$list_facility = explode(',', $id_facility);
		foreach($list_facility AS $red){
		    $data[] = array(
		        'id_store' => $id_store,
		        'id_facility' => $red,
		        'created' => date('Y-m-d H:i:s'),
		    );
		//    $this->db->update('store_has_category', $data, array('id_store' => $id_store));
		}
		
// 		$data[] = array(
// 				'id_store' => $id_store,
// 			    'id_category' => $id_category,
// 			);
		
		if($this->db->insert_batch('store_has_facility', $data)){
			$message = [
			
				'status' => 1,
				'message' => 'Kategori salon berhasil dibuat',
			];
		}else{
			$message = [
				
				'status' => 0,
				'message' => 'Data gagal dimasukkan karena kesalahan database',
			];
		}			
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	

    public function addTreatment_post(){
        $id_store = $this->post('id_store');
        $name_treatment = $this->post('name_treatment');
        $description_treatment = $this->post('description_treatment');
        $price_treatment = $this->post('price_treatment');
        
        if(!empty($id_store) & !empty($name_treatment) & !empty($price_treatment)){
            
            $data = array(
				'id_store' => $id_store,
				'name_treatment' => $name_treatment,
				'description_treatment' => $description_treatment,
				'price_treatment' => $price_treatment,
				'created' => date('Y-m-d H:i:s'),
				'isdeleted' => 'false',
			);
            
           if($this->db->insert('treatment', $data)){
				$message = [
					'status' => 1,
					'message' => 'Data salon berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
        }else if(empty($name_treatment)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($price_treatment)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
    
      public function addNews_post(){
        $id_store = $this->post('id_store');
        $title = $this->post('title');
        $content = $this->post('content');
        $status_news = $this->post('status_news');
      
        
        if(!empty($id_store) & !empty($title) & !empty($content)){
            
            $data = array(
				'id_store' => $id_store,
				'title' => $title,
				'content' => $content,
				'published' => $status_news,
				'created' => date('Y-m-d H:i:s'),
		
			);
            
           if($this->db->insert('news', $data)){
				$message = [
					'status' => 1,
					'message' => 'Data berita berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
        }else if(empty($id_store)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($title)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($content)){
				$message = [
					'status' => 5,
					'message' => 'Data input tidak valid',
				];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
     public function updateNews_post(){
		$id_news=$this->post('id_news');
		$title=$this->post('title');
		$content=$this->post('content');
		$status_news=$this->post('status_news');
	
		if($id_news != NULL & $title != NULL & $content != NULL){	    
    	
        	$data = array(
				'title' => $title,
				'content' => $content,
				'published' => $status_news,
				'updated' => date('Y-m-d H:i:s'),
		
			);
    		
    	  
			if($this->db->update('news', $data, array('id_news' => $id_news))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data berita berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else if(empty($title)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($content)){
				$message = [
					'status' => 5,
					'message' => 'Data input tidak valid',
				];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
    
    public function deleteNews_post(){
        $id_news = $this->post('id_news');
     
        if(!empty($id_news)){
           $delete = $this->Store_mod->delNews($id_news);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete berita berhasil dilakukan',
    			];
            }else{
    				$message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
    		}
    		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }

    public function updateSetSch_post(){
		$id_store=$this->post('id_store');
		$is_setmanual=$this->post('is_setmanual');
	
		if($id_store != NULL & $is_setmanual != NULL){	    
    	
        	$data = array(
				'is_setmanual' => $is_setmanual,
				'updated' => date('Y-m-d H:i:s'),
		
			);
    		
    	  
			if($this->db->update('store', $data, array('id_store' => $id_store))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data outlet berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else if(empty($id_store)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($is_setmanual)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}

    public function addSchedule_post(){
        	$days = $this->post('days');
        	$time_open = $this->post('time_open');
    		$time_closed = $this->post('time_closed');
    		$id_store = $this->post('id_store');
    		
    		$list_days = explode(',', $days);
    		$list_timeopen = explode(',', $time_open);
    		$list_timeclosed = explode(',', $time_closed);
            $data = array();
    		
            if(count($list_timeopen) == count($list_timeclosed) && count($list_days) == count($list_timeopen)){
        		foreach($list_days AS $key => $red){
        	        $data[] = array(
	                    'days' => $red,
	                    'time_open' => $list_timeopen[$key],
	                    'time_closed' => $list_timeclosed[$key],
	                    'created' => date('Y-m-d H:i:s'),
	                    'id_store' => $id_store,
	                );
            	}
        
        		
        		if($this->db->insert_batch('schedule', $data)){
        			$message = [
        			
        				'status' => 1,
        				'message' => 'Jadwal salon berhasil dibuat',
        			];
        		}else{
        			$message = [
        				
        				'status' => 0,
        				'message' => 'Data gagal dimasukkan karena kesalahan database',
        			];
        		}			
        		$this->set_response($message, REST_Controller::HTTP_CREATED);
            }else{
            	$message = [
    				
    				'status' => 0,
    				'message' => 'Data yang dikirimkan tidak sesuai',
    			];
                $this->set_response($message, REST_Controller::HTTP_CREATED);
        }
        	
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
     public function updateSchedule_post(){
		$id_schedule=$this->post('id_schedule');
		$days=$this->post('days');
		$time_open=$this->post('time_open');
		$time_closed=$this->post('time_closed');
	
		
		if($id_schedule != NULL & $days != NULL & $time_open != NULL & $time_closed != NULL){	    
    	
        	$data = array(
				'days' => $days,
				'time_open' => $time_open,
				'time_closed' => $time_closed,
				'updated' => date('Y-m-d H:i:s'),
			);
    		
    	  
			if($this->db->update('schedule', $data, array('id_schedule' => $id_schedule))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data jadwal berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else if(empty($id_store)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($days)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($time_open)){
				$message = [
					'status' => 5,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($time_closed)){
				$message = [
					'status' => 6,
					'message' => 'Data input tidak valid',
				];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
    
    
     public function addHarianSch_post(){
        $days = $this->post('days');
        $time_open = $this->post('time_open');
        $time_closed = $this->post('time_closed');
        $id_store = $this->post('id_store');
        
        if(!empty($id_store) & !empty($days) & !empty($time_open) & !empty($time_closed)){
            
            $data = array(
				'days' => $days,
				'time_open' => $time_open,
				'time_closed' => $time_closed,
				'created' => date('Y-m-d H:i:s'),
				'id_store' => $id_store,
			);
            
           if($this->db->insert('schedule', $data)){
				$message = [
					'status' => 1,
					'message' => 'Data jadwal berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
        }else if(empty($id_store)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($days)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($time_open)){
				$message = [
					'status' => 5,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($time_closed)){
				$message = [
					'status' => 6,
					'message' => 'Data input tidak valid',
				];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
    public function delSchedule_post(){
        $id_schedule = $this->post('id_schedule');
     
        if(!empty($id_schedule)){
           $delete = $this->Store_mod->delSchedules($id_schedule);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete jadwal berhasil dilakukan',
    			];
            }else{
    				$message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
    		}
    		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
    public function delAllSchedule_post(){
        $id_store = $this->post('id_store');
     
        if(!empty($id_store)){
           $delete = $this->Store_mod->delAllSchedules($id_store);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete semua jadwal berhasil dilakukan',
    			];
            }else{
    				$message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
    		}
    		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
	
	 public function addReview_post(){
        $id_store = $this->post('id_store');
        $id_user = $this->post('id_user');
        $text_review = $this->post('text_review');
        $rate = $this->post('rate');
       
        
        if(!empty($id_store) & !empty($id_user) & !empty($text_review) & !empty($rate)){
            
            $data = array(
				'id_store' => $id_store,
				'id_user' => $id_user,
				'text_review' => $text_review,
				'rate' => $rate,
				'total_report' => 0,
				'status_review' => 'show',
				'total_likes' => 0,
				'created' => date('Y-m-d H:i:s'),
				
			);
            
           if($this->db->insert('review', $data)){
				$message = [
					'status' => 1,
					'message' => 'Review berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
        }else{
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
	
	public function getLikes_get(){
       	$likes = $this->Store_mod->getAllLikes();
       	
       	if($likes != NULL){
    		$message = [
    			'likes' => $likes,
    			'status' => 1,
    			'message' => 'Semua likes berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Likes gagal didapatkan, cek kembali koneksi Anda',
    		];
    	}
    	
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   
   public function getCheckLikes_get(){
        $id_review = $this->input->get('id_review');
        $id_user = $this->input->get('id_user');
       
       	$likes = $this->Store_mod->getCheckLike($id_review, $id_user);
       	
       	if($likes != NULL){
    		$message = [
    			'likes' => $likes,
    			'status' => 1,
    			'message' => 'Pengguna menyukai review ini',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada likes.',
    		];
    	}
    	
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
	
	 public function addLike_post(){
        $id_review = $this->post('id_review');
        $id_user = $this->post('id_user');
        
        if(!empty($id_review) & !empty($id_user)){
            $data = array(
				'id_review' => $id_review,
				'id_user' => $id_user,
				'created' => date('Y-m-d H:i:s'),
			);
            
           if($this->db->insert('likes', $data)){
				$message = [
					'status' => 1,
					'message' => 'Likes berhasil dibuat',
				];
			}else{
				$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}
        }else{
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
     public function deleteLike_post(){
        $id_review = $this->post('id_review');
        $id_user = $this->post('id_user');
        
     
        if(!empty($id_review) & !empty($id_user)){
           $dislike = $this->Store_mod->dislike($id_review,$id_user);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Dislike berhasil dilakukan',
    			];
            }else{
    				$message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
    		}
    		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }


    public function checkHasStore_post(){
       $id_user=$this->post('id_user');
       
       $count = $this->Store_mod->getCountStore($id_user);
       
       if($count != 0){
           	$message = [
			'status' => 1,
			'message' => 'Pengguna memiliki outlet',
		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Pengguna tidak memiliki outlet',
    		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }

	public function updateRating_post(){
		$id_store=$this->post('id_store');
	//	$rate=$this->post('rate');
	
		if($id_store != NULL){	   
		    
		    $count = $this->Store_mod->getCountRate($id_store);
		    $sumAllRate = $this->Store_mod->getSumRate($id_store);
    	    
    	    if($count != NULL & $sumAllRate != NULL){
    	        
    	        	$data = array(
        				'id_store' => $id_store,
        				'rate_sum' => $sumAllRate / $count,
        			);
    		
        	 	if($this->db->update('store', $data, array('id_store' => $id_store))){
                		$message = [
        					'status' => 1,
        					'message' => 'Data outlet berhasil diedit',
        				];
            	}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			    }  
        	}else{
    		    $message = [
        					'status' => 2,
        					'message' => 'Belum ada rate',
        				];
		        }
    	 }else{
		    $message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
	        }
    	
        
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
    	
	}

	
    public function getLastStoreAddedByIdUser_post(){
    $id_user=$this->post('id_user');
   
   	
   	$Store = $this->Store_mod->getLastStoreByUser($id_user);
   	
   	if($Store != NULL){
		$message = [
			'Store' => $Store,
			'status' => 1,
			'message' => 'Semua store berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'Store gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }


    public function updateTreatment_post(){
		$id_treatment=$this->post('id_treatment');
		$name_treatment=$this->post('name_treatment');
		$description_treatment=$this->post('description_treatment');
		$price_treatment=$this->post('price_treatment');
	
		
		if($id_treatment != NULL & $name_treatment != NULL & $price_treatment != NULL){	    
    	
        	$data = array(
				'name_treatment' => $name_treatment,
				'description_treatment' => $description_treatment,
				'price_treatment' => $price_treatment,
				'updated' => date('Y-m-d H:i:s'),
			);
    		
    	  
			if($this->db->update('treatment', $data, array('id_treatment' => $id_treatment))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data perawatan berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else if(empty($name_treatment)){
				$message = [
					'status' => 3,
					'message' => 'Data input tidak valid',
				];
		}else if(empty($price_treatment)){
				$message = [
					'status' => 4,
					'message' => 'Data input tidak valid',
				];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}

    public function deleteTreatment_post(){
		$id_treatment=$this->post('id_treatment');
		
		if($id_treatment != NULL){	    
    	
        	$data = array(
				'isdeleted' => 'true',
				'deleted' => date('Y-m-d H:i:s'),
			);
    		
    	  
			if($this->db->update('treatment', $data, array('id_treatment' => $id_treatment))){
            		$message = [
    					'status' => 1,
    					'message' => 'Data perawatan berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else{
		    $message = [
    					'status' => 3,
    					'message' => 'Data yang diinput tidak valid',
    		];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}


    public function editStoreAddLogo_post(){
		$id_store=$this->post('id_store');
		$logo_store=$this->post('logo_store');
		$encodedfile=$this->post('encodedfile');
		 
    	$data = array(
		        'logo_store' => 'http://devpanel.xyz/klop_api/image_content/'.$logo_store,
		        'updated' => date('Y-m-d H:i:s'),
			);
	
			$imsrc = base64_decode($encodedfile);
		        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/klop_api/image_content/'.$logo_store.'', 'w');
		        fwrite($fp, $imsrc);
	
		if($this->db->update('store', $data, array('id_store' => $id_store))){
		      	$message = [
					'status' => 1,
					'message' => 'Logo berhasil ditambah',
				];
			}else{
			$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}  
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	 public function editStoreAddBanner_post(){
		$id_store=$this->post('id_store');
		$banner=$this->post('banner');
		$encodedfile=$this->post('encodedfile');
		 
    	$data = array(
		        'banner' => 'http://devpanel.xyz/klop_api/image_content/'.$banner,
		        'updated' => date('Y-m-d H:i:s'),
			);
	
			$imsrc = base64_decode($encodedfile);
		        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/klop_api/image_content/'.$banner.'', 'w');
		        fwrite($fp, $imsrc);
	
		if($this->db->update('store', $data, array('id_store' => $id_store))){
		      	$message = [
					'status' => 1,
					'message' => 'Banner berhasil ditambah',
				];
			}else{
			$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}  
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
 public function useAsBanner_post(){
		$id_store=$this->post('id_store');
		$banner=$this->post('banner');
		
		if($id_store != NULL & $banner != NULL){	    
    	
        	$data = array(
				'banner' => $banner,
				'updated' => date('Y-m-d H:i:s'),
			);
    		
    	  
			if($this->db->update('store', $data, array('id_store' => $id_store))){
            		$message = [
    					'status' => 1,
    					'message' => 'Foto sampul berhasil diubah',
    				];
        			}else{
        			$message = [
        					'status' => 0,
        					'message' => 'Data gagal dimasukkan karena kesalahan database',
        				];
    			}  
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    		
		}else{
		    $message = [
    					'status' => 3,
    					'message' => 'Data yang diinput tidak valid',
    		];
		}
			
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	
	public function addPhotoReview_post(){
		$id_store=$this->post('id_store');
		$file=$this->post('file');
		$encodedfile=$this->post('encodedfile');
		$id_user=$this->post('id_user');
		 
    	$data = array(
    	        'id_store' => $id_store,
		        'file' => 'http://devpanel.xyz/klop_api/image_content/'.$file,
		        'added_by' => $id_user,
		        'created' => date('Y-m-d H:i:s'),
			);
	
			$imsrc = base64_decode($encodedfile);
		        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/klop_api/image_content/'.$file.'', 'w');
		        fwrite($fp, $imsrc);
	
			if($this->db->insert('photo', $data)){
				$message = [
				
					'status' => 1,
					'message' => 'Data foto berhasil dibuat',
				];
			}else{
			$message = [
					'status' => 0,
					'message' => 'Data gagal dimasukkan karena kesalahan database',
				];
			}  
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	
	 public function getPhotoByIdStore_post(){
       $id_store = $this->post('id_store');
       
       $Photo = $this->Store_mod->getPhoto($id_store);
       
    //   print_r($Category);
    //   die();
       
       if($Photo != NULL){
           	$message = [
			'Photo' => $Photo,
			'status' => 1,
			'message' => 'Semua foto dari store berhasil didapatkan',
		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Foto didapatkan, cek kembali koneksi Anda',
    		];
       }
       	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
    public function deletePhoto_post(){
        $id_photo = $this->post('id_photo');
     
        if(!empty($id_photo)){
           $delete = $this->Store_mod->delPhoto($id_photo);
    		
    		$message = [
    				'status' => 1,
    				'message' => 'Delete foto berhasil dilakukan',
    			];
            }else{
    				$message = [
    					'status' => 3,
    					'message' => 'Data input tidak valid',
    				];
    		}
    		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }

   
    public function searchFiltering_post(){
		$treatment = $this->post('treatment');
		$category = $this->post('category');
		$facility = $this->post('facility');
		$days = $this->post('days');
		$price_Min = $this->post('price_Min');
		$price_Max = $this->post('price_Max');
		$rate_sumMin= $this->post('rate_sumMin');
		$rate_sumMax= $this->post('rate_sumMax');
		$latCurrent = $this->post('latCurrent');
       	$longCurrent = $this->post('longCurrent');
		$filter = array();
		
		if($treatment){
			$filter['treatment'] = $treatment;
		}
		
		if($category){
			$list_category = explode(',', $category);
			$filter['category'] = $list_category;
		}
		
		if($category){
			$list_facility = explode(',', $facility);
			$filter['facility'] = $list_facility;
		}
		
		if($days){
			$list_days = explode(',', $days);
			$filter['days'] = $list_days;
		}
		
		if($price_Min){
			$filter['price_Min'] = $price_Min;
		}
		
		if($price_Max){
			$filter['price_Max'] = $price_Max;
		}
			
		if($rate_sumMin){
			$filter['rate_sumMin'] = $rate_sumMin;
		}
		
		if($rate_sumMax){
			$filter['rate_sumMax'] = $rate_sumMax;
		}
		
		$data = $this->Store_mod->_select_store_byfilter($filter, $latCurrent, $longCurrent);
		if($data != NULL){
		    
		   // $data = array_unique($data);
		$message = [
			'Store' => $data,
			'status' => 1,
			'message' => 'Semua store hasil filtering berhasil didapatkan',
		];
		}else{
			$message = [
				'status' => 0,
				'message' => 'Store tidak ditemukan, cek kembali koneksi Anda',
			];
		}

		$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
     
}