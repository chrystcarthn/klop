<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Booking extends REST_Controller{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Booking_mod');
    }
    
	public function getCountBook_post(){
       	$id_user = $this->post('id_user');
       	$count = $this->Booking_mod->getCountBooking($id_user);
       	
       	if($count >= 3){
			$message = [
				'status' => 0,
				'message' => 'Anda mencapai jumlah batas maksimal untuk melakukan reservasi. Mohon menyelesaikan reservasi sebelumnya',
			];
		}else{
			$message = [
				'status' => 1,
				'message' => 'Lanjut reservasi',
			];
	
		}			
		$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    
    
    public function getAllBookedByUser_post(){
   	$id_user = $this->post('id_user');
   	
   	if($id_user != NULL){
       	$Booking = $this->Booking_mod->getAllBooked($id_user);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua booking berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Booking tidak ditemukan',
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
   }
   
   
    public function getAllReservation_post(){
   	$id_user = $this->post('id_owner');
   	
   	if($id_user != NULL){
       	$Booking = $this->Booking_mod->getAllReservation($id_user);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   public function getWaitingRes_post(){
   	$id_store = $this->post('id_store');
   	
   	if($id_store != NULL){
       	$Booking = $this->Booking_mod->getWaitRes($id_store);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   public function getApprovedRes_post(){
   	$id_store = $this->post('id_store');
   	
   	if($id_store != NULL){
       	$Booking = $this->Booking_mod->getAppRes($id_store);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   public function getCanceledRes_post(){
   	$id_store = $this->post('id_store');
   	
   	if($id_store != NULL){
       	$Booking = $this->Booking_mod->getCancelRes($id_store);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   public function getRejectedRes_post(){
   	$id_store = $this->post('id_store');
   	
   	if($id_store != NULL){
       	$Booking = $this->Booking_mod->getRejectRes($id_store);
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   
   
    public function getAllReservationByStore_post(){
   	$id_store = $this->post('id_store');
   	
   	if($id_store != NULL){
       	$Booking = $this->Booking_mod->getAllReservationByStore($id_store);
       	$countBooking = $this->Booking_mod->getCountReservation($id_store);
       	$waiting = $this->Booking_mod->getWaiting($id_store);
       	$approved = $this->Booking_mod->getApproved($id_store);
       	$canceled = $this->Booking_mod->getCanceled($id_store);
       	$declined = $this->Booking_mod->getDeclined($id_store);
       	$dropped = $this->Booking_mod->getDropped($id_store);
       	
       	if($Booking != NULL){
    		$message = [
    			'Booking' => $Booking,
    			'count'=> $countBooking,
    			'Menunggu' => $waiting + 0,
    			'Diterima' => $approved + 0,
    			'Dibatalkan' => $canceled + 0,
    			'Ditolak' => $declined + $dropped,
    			'status' => 1,
    			'message' => 'Semua reservasi yang masuk berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Tidak ada reservasi',
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
   }
   
   
   
   
    public function getAllDetailByBooking_post(){
   	$id_booking = $this->post('id_booking');
   	
   	if($id_booking != NULL){
       	$BookingDetail = $this->Booking_mod->getAllDetail($id_booking);
       	if($BookingDetail != NULL){
    		$message = [
    			'BookingDetail' => $BookingDetail,
    			'status' => 1,
    			'message' => 'Semua detail berhasil didapatkan',
    		];
    	}else{
    		$message = [
    			'status' => 0,
    			'message' => 'Detail tidak ditemukan',
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
   }
   
   
   	public function makeBooking_post(){
	
		$id_store = $this->post('id_store');
		$id_user = $this->post('id_user');
		$dates = $this->post('dates');
		$times = $this->post('times');
		$guest_name = $this->post('guest_name');
		$guest_phone = $this->post('guest_phone');
		$sum_of_people = $this->post('sum_of_people');
		$total_payment = $this->post('total_payment');
	
		
	    $count = $this->Booking_mod->getCountBooking($id_user);

		if($count >= 3){
			$message = [
				'status' => 0,
				'message' => 'Anda mencapai jumlah batas maksimal untuk melakukan reservasi. Mohon menyelesaikan reservasi sebelumnya',
			];
		}else{
			$data = array(
			    'id_store' => $id_store,
				'id_user' => $id_user,
				'dates' => $dates,
				'times' => $times,
				'guest_name' => $guest_name,
				'guest_phone' => $guest_phone,
				'status_booking' => 'waiting',
				'created' => date('Y-m-d H:i:s'),
				'sum_of_people' => $sum_of_people,
				'total_payment' => $total_payment,
			);
			
			if($this->db->insert('booking', $data)){
				$message = [
				
					'status' => 1,
					'message' => 'Data booking berhasil dibuat',
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
	
	public function addDetailBooking_post(){
		$id_booking = $this->post('id_booking');
		$id_treatment = $this->post('id_treatment');
		$quantity = $this->post('quantity');
		$price_now = $this->post('price_now');
		$sub_total = $this->post('sub_total');
	
	
	   	$list_tr = explode(',', $id_treatment);
		$list_qty = explode(',', $quantity);
		$list_price = explode(',', $price_now);
		$list_sub = explode(',', $sub_total);
        $data = array();
		
		
        if($id_booking != null && 
        count($list_tr) == count($list_qty) && 
        count($list_tr) == count($list_price) && 
        count($list_tr) == count($list_sub))
        {
    		foreach($list_tr AS $key => $red){
    	        $data[] = array(
    	            'id_booking' => $id_booking,
                    'id_treatment' => $red,
                    'quantity' => $list_qty[$key],
                    'price_now' => $list_price[$key],
                    'sub_total' => $list_sub[$key],
                );
        	}
        
        		
    		if($this->db->insert_batch('booking_detail', $data)){
    			$message = [
    			
    				'status' => 1,
    				'message' => 'Detil reservasi berhasil dibuat',
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
    }
	
	public function getLastBookingByUser_post(){
    $id_user = $this->post('id_user');
   	
   	$Booking = $this->Booking_mod->getLastBooking($id_user);
   	
   	if($Booking != NULL){
		$message = [
			'Booking' => $Booking,
			'status' => 1,
			'message' => 'Reservasi berhasil didapatkan',
		];
	}else{
		$message = [
			'status' => 0,
			'message' => 'Reservasi gagal didapatkan, cek kembali koneksi Anda',
		];
	}
	
	$this->set_response($message, REST_Controller::HTTP_CREATED);
   }
   
   public function approve_post(){
		$id_booking=$this->post('id_booking');
	
		if($id_booking != NULL){	    
    	
        	$data = array(
				'status_booking' => 'approved',
			);
    
			if($this->db->update('booking', $data, array('id_booking' => $id_booking))){
            		$message = [
    					'status' => 1,
    					'message' => 'Reservasi telah diterima',
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
    					'message' => 'Tidak ada reservasi yang dipilih',
    				];
		}
	}
	
    public function decline_post(){
		$id_booking=$this->post('id_booking');
	
		if($id_booking != NULL){	    
    	
        	$data = array(
				'status_booking' => 'declined',
			);
    
			if($this->db->update('booking', $data, array('id_booking' => $id_booking))){
            		$message = [
    					'status' => 1,
    					'message' => 'Reservasi telah ditolak',
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
    				    'message' => 'Tidak ada reservasi yang dipilih',
    				];
		}
	}
	
    public function cancel_post(){
		$id_booking=$this->post('id_booking');
	
		if($id_booking != NULL){	    
    	
        	$data = array(
				'status_booking' => 'canceled',
			);
    
			if($this->db->update('booking', $data, array('id_booking' => $id_booking))){
            		$message = [
    					'status' => 1,
    					'message' => 'Reservasi telah dibatalkan oleh pemesan',
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
    					'message' => 'Tidak ada reservasi yang dipilih',
    				];
		}
	}
	
	public function drop_post(){
		$id_booking=$this->post('id_booking');
	
		if($id_booking != NULL){	    
    	
        	$data = array(
				'status_booking' => 'dropped',
			);
    
			if($this->db->update('booking', $data, array('id_booking' => $id_booking))){
            		$message = [
    					'status' => 1,
    					'message' => 'Reservasi telah dibatalkan oleh pihak outlet',
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
    					'message' => 'Tidak ada reservasi yang dipilih',
    				];
		}
	}
	
}