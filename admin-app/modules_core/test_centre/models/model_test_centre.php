<?php
class Model_test_centre extends CI_Model {

    function __construct(){
       parent::__construct();
    }

	
	/* GET ALL CMS */

	function allCentreDB($search_by='', $limit='', $offset=0) {
		$this->db->select('TC.*');
		$this->db->from('dipp_test_centre TC');
		$this->db->limit($limit, $offset);
		$this->db->order_by('TC.id','DESC');
		if($search_by <> ''){
			$this->db->where('TC.name LIKE', '%'.$search_by.'%');
			$this->db->or_where('TC.zip_code',$search_by);
		}
		$query= $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}

	
	/* GET TOTAL CMS NUMBER */

	function countCentreDB($search_by=''){
		$this->db->select('SUM(IF(TC.id <> "",1,0)) as total_centre',false);
		$this->db->from('dipp_test_centre TC');
		if($search_by <> ''){
			
			$this->db->where('TC.name LIKE', '%'.$search_by.'%');
			$this->db->or_where('TC.zip_code',$search_by);
			
		}
		$query = $this->db->get();
		//echo 'fff'.$this->db->last_query();exit;
		$result = $query->result_array();
		return $result[0]['total_centre'];
	}
	
    
	/* CHECK CMS EXIST OR NOT */

	function centreExistsDB($condition_arr=array()) {
		$this->db->select('*');
		$this->db->from('dipp_test_centre');
		$this->db->where($condition_arr);
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
	

	/* ADD CMS INTO DATABASE */

	function addCentreDB($insert_arr=array()) {
		$this->db->insert('dipp_test_centre', $insert_arr);
		return $this->db->insert_id();
	}

	
	/* EDIT CMS INTO DATABASE  */

	function editCentreDB($update_arr=array(),$condition_arr=array()) {
		$this->db->where($condition_arr);
		$update= $this->db->update('dipp_test_centre', $update_arr);
		//echo $this->db->last_query(); die();
		if($update) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	
	/* DETAILS CMS  */

	function detailsCentreDB($condition_arr=array()){
		$this->db->select('*');
		$this->db->from('dipp_test_centre');
		$this->db->where($condition_arr);
		$query=$this->db->get();
		return $query->result_array();
	}

	
	/*  CMS STATUS CHANGE */
    
    function statusChangeCentreDB($content_id = 0) {
        $conditionArr   	= array('id' => $content_id);
        $news_detail   		= $this->detailsCentreDB($conditionArr);
        $content_status   	= $news_detail[0]['status'];
        $status         	= ($content_status == 'Active')?'Inactive':'Active';
        $updateArr      	= array('status' => $status);
        $update         	= $this->editCentreDB($updateArr,$conditionArr);
        
		if( $update ) {
            return TRUE;
        }
		else {
            return FALSE;
        }
    }

	
    /* DELETE CMS  */

    function deleteCentreDB($condition_arr=array()) {
	    $this->db->where($condition_arr);
	    $this->db->delete('dipp_test_centre');
	    if($this->db->affected_rows() > 0) {
		    return TRUE;
	    }
	    else {
		    return FALSE;
	    }
    }
}