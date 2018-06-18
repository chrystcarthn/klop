<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_mod extends CI_Model{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	
		function getAllBooked($id_user){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	
	
	function getAllReservation($id_user){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->join('store','booking.id_store = store.id_store');
		$this->db->where('store.id_user', $id_user);
		$this->db->order_by('booking.created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	function getWaitRes($id_store){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'waiting');
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	function getAppRes($id_store){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'approved');
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	function getCancelRes($id_store){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'canceled');
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	
	function getRejectRes($id_store){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'declined');
		$this->db->or_where('status_booking', 'dropped');
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	
	
	function getAllReservationByStore($id_store){
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
	}
	
	function getWaiting($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'waiting');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getApproved($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'approved');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getCanceled($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'canceled');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getDeclined($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'declined');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getDropped($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->where('status_booking', 'dropped');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getCountReservation($id_store){
    $this->db->select('count(*) "total_booking"');
		$this->db->from('booking');
		$this->db->where('id_store', $id_store);
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total_booking');
	}
	
	
	
	function getAllDetail($id_booking){
		$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $id_booking);
		$query= $this->db->get();
	    
	    return $query->result();
	}
	
	function getCountBooking($id_user){
    $this->db->select('count(*) "total_booking"');
		$this->db->from('booking');
		$this->db->where('id_user', $id_user);
		$this->db->where('status_booking', 'waiting');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total_booking');
	}
	
	function getLastBooking($id_user){
       	$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('created','desc');
		
		$query = $this->db->get();
		
		$result = array();
			
		foreach($query->result() as $row) {
		    
	        $this->db->select('*');
			$this->db->from('store');
			$this->db->where('id_store', $row->ID_STORE);
			$detailStore= $this->db->get();

	        $this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $row->ID_USER);
			$detailUser= $this->db->get();


			$this->db->select('booking_detail.id_booking_detail,booking_detail.id_booking, booking_detail.id_treatment,treatment.name_treatment,booking_detail.quantity,booking_detail.price_now,booking_detail.sub_total');
			$this->db->from('booking_detail');
			$this->db->join('treatment','booking_detail.id_treatment = treatment.id_treatment');
			$this->db->where('booking_detail.id_booking', $row->ID_BOOKING);
		
			$detailBook= $this->db->get();
			
		
			$result[] = array(
			'id_booking' => $row->ID_BOOKING,
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
            'dates' => $row->DATES,
			'times' => $row->TIMES,
			'guest_name' => $row->GUEST_NAME,
			'guest_phone' => $row->GUEST_PHONE,
			'status_booking' => $row->STATUS_BOOKING,
			'created' => $row->CREATED,
			'sum_of_people' => $row->SUM_OF_PEOPLE,
			'total_payment' => $row->TOTAL_PAYMENT,

        	'StoreDetail' => $detailStore->result(),
        	'UserDetail' => $detailUser->result(),
			'BookingDetail' => $detailBook->result(),
	
			);
		}
		
		return $result;
  }
  
 
  
}