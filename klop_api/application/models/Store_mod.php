<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Store_mod extends CI_Model{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	
	function CheckPhone($phone_store = null){
		if(!$phone_store){return false;}
		
		return $this->db
			->select('*')
			->get_where('store', array('phone_store' => $phone_store))
			->row();
	}
	
	function getAllstore($id_user, $latCurrent, $longCurrent){
	 //Get master store
	    $this->db->where('id_user', $id_user);
		$this->db->where('is_deleted', 'false');
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            //Get distance
		    $this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();

			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
			$this->db->order_by('id_storefacility_detail','asc');
			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
			$this->db->join('category','store_has_category.id_category = category.id_category_db');
			$this->db->where('store_has_category.id_store', $row->ID_STORE);
			$this->db->order_by('id_storecategory_detail','asc');
			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,
			'Facilities' => $allFacilitiesofStore,
			'Categories' => $allCategoriesofStore,
			);
		}
		$compare_distance = array();
        foreach ($result as $key => $value)
        {
            $compare_distance[$key] = $value['distanceKilo'];
        }
        array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
	}
	
	
	
	
	function getAllstoreVerified($latCurrent, $longCurrent){
	    //Get master store
		$this->db->where('status_store', 'verified');
		$this->db->where('is_deleted', 'false');
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            //Get distance
		    $this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('status_store', 'verified');
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();

			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
			$this->db->order_by('id_storefacility_detail','asc');
			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
			$this->db->join('category','store_has_category.id_category = category.id_category_db');
			$this->db->where('store_has_category.id_store', $row->ID_STORE);
			$this->db->order_by('id_storecategory_detail','asc');
			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
            'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,
			'Facilities' => $allFacilitiesofStore,
			'Categories' => $allCategoriesofStore,
			);
		}
		$compare_distance = array();
        foreach ($result as $key => $value)
        {
            $compare_distance[$key] = $value['distanceKilo'];
        }
        array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
	}
	

	function searchStoreVerifiedByKeyword($keyword, $latCurrent, $longCurrent){
	       //Get master store
		$this->db->where('status_store', 'verified');
		$this->db->where('is_deleted', 'false');
		$this->db->where("(name_store LIKE '%".$keyword."%' OR address_store LIKE '%".$keyword."%')", NULL, FALSE);
	  
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            //Get distance
		    $this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('status_store', 'verified');
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();

			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
			$this->db->order_by('id_storefacility_detail','asc');
			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
			$this->db->join('category','store_has_category.id_category = category.id_category_db');
			$this->db->where('store_has_category.id_store', $row->ID_STORE);
			$this->db->order_by('id_storecategory_detail','asc');
			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,
			'Facilities' => $allFacilitiesofStore,
			'Categories' => $allCategoriesofStore,
			);
		}
		$compare_distance = array();
        foreach ($result as $key => $value)
        {
            $compare_distance[$key] = $value['distanceKilo'];
        }
        array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
	}
	
	function searchUserStoreByKeyword($id_user, $keyword, $latCurrent, $longCurrent){
	    //Get master store
	    $this->db->where('id_user', $id_user);
		$this->db->where('is_deleted', 'false');
		$this->db->where("(name_store LIKE '%".$keyword."%' OR address_store LIKE '%".$keyword."%')", NULL, FALSE);
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            //Get distance
		    $this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();

			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
			$this->db->order_by('id_storefacility_detail','asc');
			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
			$this->db->join('category','store_has_category.id_category = category.id_category_db');
			$this->db->where('store_has_category.id_store', $row->ID_STORE);
			$this->db->order_by('id_storecategory_detail','asc');
			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,
			'Facilities' => $allFacilitiesofStore,
			'Categories' => $allCategoriesofStore,
			);
		}
		$compare_distance = array();
        foreach ($result as $key => $value)
        {
            $compare_distance[$key] = $value['distanceKilo'];
        }
        array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
	}
	
	function getStore($id_store, $latCurrent, $longCurrent){
    //Get master store
        $this->db->where('id_store',$id_store);
		$this->db->where('is_deleted', 'false');
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            //Get distance
		    $this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();

			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
			$this->db->order_by('id_storefacility_detail','asc');
			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
			$this->db->join('category','store_has_category.id_category = category.id_category_db');
			$this->db->where('store_has_category.id_store', $row->ID_STORE);
			$this->db->order_by('id_storecategory_detail','asc');
			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,
			'Facilities' => $allFacilitiesofStore,
			'Categories' => $allCategoriesofStore,
			);
		}
		$compare_distance = array();
        foreach ($result as $key => $value)
        {
            $compare_distance[$key] = $value['distanceKilo'];
        }
        array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
	}
	
	
	function getCategory($id_store){
        $this->db->select('*');
    	$this->db->from('store_has_category');
    	$this->db->join('category','store_has_category.id_category = category.id_category_db');
    	$this->db->where('store_has_category.id_store', $id_store);
    	$this->db->where('category.published', 'true');
    // 	$this->db->order_by('category.name_category','asc');
    	$query= $this->db->get();
	    
		return $query->result();
	}
	
		
	function getStoreHasCategory(){
        $this->db->select('*');
    	$this->db->from('store_has_category');
    	$query= $this->db->get();
	    
		return $query->result();
	}
	
	function getStoreHasFacility(){
	    $this->db->select('*');
	    $this->db->from('store_has_facility');
	    $query= $this->db->get();
	    
	    return $query->result();
	}
	
	
	function getSchedule($id_store){
   		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->where('id_store', $id_store);
		$this->db->order_by('id_schedule','asc');
		$query= $this->db->get();
	    
		return $query->result();
	}
	
	function getFacility($id_store){
		$this->db->select('*');
		$this->db->from('store_has_facility');
		$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
		$this->db->where('store_has_facility.id_store', $id_store);
		$this->db->where('facility.published', 'true');
		$this->db->order_by('id_storefacility_detail','asc');
		$query= $this->db->get();
	    
		return $query->result();
	}
	
	function dislike($id_review, $id_user){
   	    $this->db->where('id_review', $id_review);
		$this->db->where('id_user', $id_user);
		$this->db->delete('likes'); 
	}
	
	function delCat($id_store,$list_category){
   	    $this->db->where('id_store', $id_store);
		$this->db->where_in('id_category', $list_category);
		$this->db->delete('store_has_category'); 
	}
	
	function delFac($id_store,$list_facility){
   	    $this->db->where('id_store', $id_store);
		$this->db->where_in('id_facility', $list_facility);
		$this->db->delete('store_has_facility'); 
	}
	
	
	  function getReview($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function getRev1($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->where('review.rate', 1);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
		
	function getRev2($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->where('review.rate', 2);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function getRev3($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->where('review.rate', 3);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function getRev4($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->where('review.rate', 4);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function getRev5($id_store){
    	$this->db->select('review.id_review, review.id_store, review.id_user, review.text_review, review.rate,
    	                    review.total_report, review.status_review, review.total_likes, review.created, users.full_name, 
    	                    users.avatar');
		$this->db->from('review');
		$this->db->join('users','review.id_user = users.id_user');
		$this->db->where('review.id_store', $id_store);
		$this->db->where('review.rate', 5);
		$this->db->order_by('review.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	 function getCountStore($id_user){
        $this->db->select('count(*) "total_store"');
		$this->db->from('store');
		$this->db->where('id_user', $id_user);
		$this->db->where('status_store', 'verified');
		$this->db->where('is_deleted', 'false');
		$query= $this->db->get();
		
		return $query->row('total_store');
  }
  
	
	function getCountReview($id_store){
        $this->db->select('count(*) "total_review"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total_review');
	}
	
	function getBtg1($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->where('rate', '1');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getBtg2($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->where('rate', '2');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getBtg3($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->where('rate', '3');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getBtg4($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->where('rate', '4');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getBtg5($id_store){
        $this->db->select('count(*) "total"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$this->db->where('rate', '5');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->row('total');
	}
	
	function getCountRate($id_store){
	    $this->db->select('count(*) "row_rate"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$query= $this->db->get();
		
		return $query->row('row_rate');
	}
	
	function getSumRate($id_store){
	    $this->db->select('sum(rate) "sum_rate"');
		$this->db->from('review');
		$this->db->where('id_store', $id_store);
		$query= $this->db->get();
		
		return $query->row('sum_rate');
	}
	
	function getTreatment($id_store){
	    $this->db->select('*');
		$this->db->from('treatment');
		$this->db->where('id_store', $id_store);
		$this->db->where('isdeleted', 'false');
		$this->db->order_by('name_treatment','asc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function searchTr($keyword){
	    $this->db->select('*');
		$this->db->from('treatment');
		$this->db->where("(name_treatment LIKE '%".$keyword."%')", NULL, FALSE);
		$this->db->where('isdeleted', 'false');
		$this->db->order_by('name_treatment','asc');
		$query= $this->db->get();
		
		return $query->result();
	}

	function getNews($id_store){
	    $this->db->select('*');
		$this->db->from('news');
		$this->db->where('id_store', $id_store);
		$this->db->where('published', 'true');
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function getNewsAll($id_store){
	    $this->db->select('*');
		$this->db->from('news');
		$this->db->where('id_store', $id_store);
		$this->db->order_by('created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}

	function getPhoto($id_store){
	   	$this->db->select('photo.id_photo, photo.id_store, photo.file, photo.added_by, users.full_name, photo.created');
		$this->db->from('photo');
		$this->db->join('users','photo.added_by = users.id_user');
		$this->db->where('photo.id_store', $id_store);
		$this->db->order_by('photo.created','desc');
		$query= $this->db->get();
		
		return $query->result();
	}
	
	function delPhoto($id_photo){
	    $this->db->where('id_photo', $id_photo);
		$this->db->delete('photo'); 
	}
	
	
	function delNews($id_news){
	    $this->db->where('id_news', $id_news);
		$this->db->delete('news'); 
	}
	
	function delSchedules($id_schedule){
	    $this->db->where('id_schedule', $id_schedule);
		$this->db->delete('schedule'); 
	}
	
	function delAllSchedules($id_store){
	    $this->db->where('id_store', $id_store);
		$this->db->delete('schedule'); 
	}
	
	function getCategoryAdded(){
        $this->db->select('*');
    	$this->db->from('category');
    	$this->db->where('published','true');
    	$query= $this->db->get();
	    
		return $query->result();
  }
  
	
  function getCatSettings($id_store){
        $this->db->select('id_category_db, name_category, case when (select id_category from store_has_category where id_category=id_category_db and id_store='.$id_store.') is null then "no" else "yes" end "isChecked" ');
    	$this->db->from('category');
    	$this->db->where('published','true');
    	$query= $this->db->get();
	    
		return $query->result();
  }
  
  
   function getFacSettings($id_store){
        $this->db->select('id_facility_db, name_facility, case when (select id_facility from store_has_facility where id_facility=id_facility_db and id_store='.$id_store.') is null then "no" else "yes" end "isChecked" ');
    	$this->db->from('facility');
    	$this->db->where('published','true');
    	$query= $this->db->get();
	    
		return $query->result();
  }
  
  
  function getLastStoreByUser($id_user){
       //Get master store
        $this->db->where('id_user',$id_user);
		$this->db->where('is_deleted', 'false');
		$this->db->order_by('created', 'desc');
		$query = $this->db->get('store')->result();
		
		$result = array();
		foreach($query as $row) {
            
// 			$this->db->where('id_store', $row->ID_STORE);
// 			$this->db->where('isdeleted', 'false');
// 			$this->db->order_by('id_treatment','asc');
// 			$allTreatment= $this->db->get('treatment')->result();
			
// 			$this->db->where('id_store', $row->ID_STORE);
// 			$this->db->order_by('id_schedule','asc');
// 			$allSchedule= $this->db->get('schedule')->result();

// 			$this->db->where('id_store', $row->ID_STORE);
// 			$this->db->order_by('id_photo','asc');
// 			$allPhoto= $this->db->get('photo')->result();

// 			$this->db->where('id_store', $row->ID_STORE);
// 			$this->db->order_by('id_review','asc');
// 			$allReview= $this->db->get('review')->result();
			
// 			$this->db->where('id_store', $row->ID_STORE);
// 			$this->db->order_by('id_news','asc');
// 			$allNews= $this->db->get('news')->result();

// 			$this->db->join('facility','store_has_facility.id_facility = facility.id_facility_db');
// 			$this->db->where('store_has_facility.id_store', $row->ID_STORE);
// 			$this->db->order_by('id_storefacility_detail','asc');
// 			$allFacilitiesofStore= $this->db->get('store_has_facility')->result();
			
// 			$this->db->join('category','store_has_category.id_category = category.id_category_db');
// 			$this->db->where('store_has_category.id_store', $row->ID_STORE);
// 			$this->db->order_by('id_storecategory_detail','asc');
// 			$allCategoriesofStore= $this->db->get('store_has_category')->result();
			
			$result[] = array(
			'id_store' => $row->ID_STORE,
// 			'id_user' => $row->ID_USER,
// 			'name_store' => $row->NAME_STORE,
//             'logo_store' => $row->LOGO_STORE,
//             'banner' => $row->BANNER,
// 			'address_store' => $row->ADDRESS_STORE,
// 			'phone_store' => $row->PHONE_STORE,
// 			'latitude' => $row->LATITUDE,
// 			'longitude' => $row->LONGITUDE,
// 			'is_setmanual' => $row->IS_SETMANUAL,
// 			'status_store' => $row->STATUS_STORE,
// 			'rate_sum' => $row->RATE_SUM,
// 			'created' => $row->CREATED,
// 			'updated' => $row->UPDATED,
// 			'confirmed_by' => $row->CONFIRMED_BY,
// 			'id_deleted' => $row->IS_DELETED,
// 			'deleted' => $row->DELETED,
// 			'Treatment' => $allTreatment,
// 			'Schedule' => $allSchedule,
// 			'Photo' => $allPhoto,
// 			'Review' => $allReview,
// 			'News' => $allNews,
// 			'Facilities' => $allFacilitiesofStore,
// 			'Categories' => $allCategoriesofStore,
			);
		}
// 		$compare_distance = array();
//         foreach ($result as $key => $value)
//         {
//             $compare_distance[$key] = $value['distanceKilo'];
//         }
//         array_multisort($compare_distance, SORT_ASC, $result);
		
		return $result;
  }
  
  
  function getFacilityAdded(){
        $this->db->select('*');
    	$this->db->from('facility');
    	$this->db->where('published','true');
    	$query= $this->db->get();
	    
		return $query->result();
  }
  
  
   function getAllLikes(){
        $this->db->select('*');
    	$this->db->from('likes');
    	$query= $this->db->get();
	    
		return $query->result();
  }
  
  function getCheckLike($id_review, $id_user){
        $this->db->select('*');
    	$this->db->from('likes');
    	$this->db->where('id_review', $id_review);
    	$this->db->where('id_user', $id_user);
    	$query= $this->db->get();
	    
		return $query->result();
  }
  


//========================================== COBA 4 ===============================================

function _select_store_byfilter($filter = array(), $latCurrent, $longCurrent)
	{
		if(isset($filter['treatment'])){
			$this->db->join('treatment', 'treatment.id_store = store.id_store', 'inner');
			$this->db->group_start();
			$this->db->select("MATCH (treatment.name_treatment) AGAINST ('".$filter['treatment']."' IN NATURAL LANGUAGE MODE) AS score");
			$this->db->where("MATCH (treatment.name_treatment) AGAINST ('".$filter['treatment']."' IN NATURAL LANGUAGE MODE)");
			$this->db->where('treatment.isdeleted', 'false');
			$this->db->group_end();
		}
	
		if(isset($filter['category'])){
			$this->db->join('store_has_category', 'store_has_category.id_store = store.id_store', 'inner');
			$this->db->where_in('store_has_category.id_category', $filter['category']);
		}
		
		if(isset($filter['facility'])){
			$this->db->join('store_has_facility', 'store_has_facility.id_store = store.id_store', 'inner');
			$this->db->where_in('store_has_facility.id_facility', $filter['facility']);
		}
		
		if(isset($filter['days'])){
			$this->db->join('schedule', 'schedule.id_store = store.id_store', 'inner');
			$this->db->where_in('schedule.days', $filter['days']);
		}
		
		if(isset($filter['price_Min'])){
			$this->db->where('treatment.price_treatment >=', $filter['price_Min']);
		}
		
		if(isset($filter['price_Max'])){
			$this->db->where('treatment.price_treatment <=', $filter['price_Max']);
		}
		
		if(isset($filter['rate_sumMin'])){
			$this->db->where('store.rate_sum >=', $filter['rate_sumMin']);
		}
		
		if(isset($filter['rate_sumMax'])){
			$this->db->where('store.rate_sum <=', $filter['rate_sumMax']);
		}
		
		$this->db->where('store.is_deleted', 'false');
		$this->db->where('store.status_store', 'verified');
		$this->db->group_by('store.name_store');
		$this->db->order_by('score', 'DESC');

        $this->db->select('store.*');
    	$query = $this->db->get('store');
    		
		$result = array();
			
		foreach($query->result() as $row) {
    		
    	$this->db->select('*');
    	
    		$this->db->select('ACOS( SIN( RADIANS('.$row->LATITUDE.') ) * SIN( RADIANS('.$latCurrent.') ) + COS( RADIANS('.$row->LATITUDE.') ) * COS( RADIANS('.$latCurrent.')) * COS ( RADIANS('.$row->LONGITUDE.') - RADIANS('.$longCurrent.')) ) * 6380 AS DistanceOutlet');
    	    $this->db->from('store');
    		$this->db->where('id_store', $row->ID_STORE);
    		$this->db->where('is_deleted', 'false');
    		$distanceKm = $this->db->get()->row();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->where('isdeleted', 'false');
			$this->db->order_by('id_treatment','asc');
			$allTreatment= $this->db->get('treatment')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_schedule','asc');
			$allSchedule= $this->db->get('schedule')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_photo','asc');
			$allPhoto= $this->db->get('photo')->result();

			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_review','asc');
			$allReview= $this->db->get('review')->result();
			
			$this->db->where('id_store', $row->ID_STORE);
			$this->db->order_by('id_news','asc');
			$allNews= $this->db->get('news')->result();
    			
    		$result[] = array(
			'id_store' => $row->ID_STORE,
			'id_user' => $row->ID_USER,
			'name_store' => $row->NAME_STORE,
            'logo_store' => $row->LOGO_STORE,
            'banner' => $row->BANNER,
			'address_store' => $row->ADDRESS_STORE,
			'phone_store' => $row->PHONE_STORE,
			'latitude' => $row->LATITUDE,
			'longitude' => $row->LONGITUDE,
			'is_setmanual' => $row->IS_SETMANUAL,
			'status_store' => $row->STATUS_STORE,
			'rate_sum' => $row->RATE_SUM,
			'created' => $row->CREATED,
			'updated' => $row->UPDATED,
			'confirmed_by' => $row->CONFIRMED_BY,
			'id_deleted' => $row->IS_DELETED,
			'deleted' => $row->DELETED,
			'distanceKilo' => $distanceKm->DistanceOutlet,
			'Treatment' => $allTreatment,
			'Schedule' => $allSchedule,
			'Photo' => $allPhoto,
			'Review' => $allReview,
			'News' => $allNews,

    			);
    		}
    		
    		return $result;
	//	return array_unique($result, SORT_REGULAR);
	}
	

}