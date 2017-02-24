<?php
class Model_news extends CI_Model {

    function __construct(){
       parent::__construct();
    }

	
	/* GET ALL CMS */

	function allNewsDB($search_by='', $limit='', $offset=0) {
		$this->db->select('N.*');
		$this->db->from('dipp_news N');
		$this->db->limit($limit, $offset);
		$this->db->order_by('N.id','DESC');
		if($search_by <> ''){
			$this->db->like('N.title',$search_by);
		}
		$query= $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

	
	/* GET TOTAL CMS NUMBER */

	function countNewsDB($search_by=''){
		$this->db->select('SUM(IF(N.id <> "",1,0)) as total_news',false);
		$this->db->from('dipp_news N');
		if($search_by <> ''){
			$this->db->like('N.title',$search_by);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['total_news'];
	}
	
    
	/* CHECK CMS EXIST OR NOT */

	function newsExistsDB($condition_arr=array()) {
		$this->db->select('*');
		$this->db->from('dipp_news');
		$this->db->where($condition_arr);
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
	

	/* ADD CMS INTO DATABASE */

	function addNewsDB($insert_arr=array()) {
		$this->db->insert('dipp_news', $insert_arr);
		return $this->db->insert_id();
	}

	
	/* EDIT CMS INTO DATABASE  */

	function editNewsDB($update_arr=array(),$condition_arr=array()) {
		$this->db->where($condition_arr);
		$update= $this->db->update('dipp_news', $update_arr);
		//echo $this->db->last_query(); die();
		if($update) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	
	/* DETAILS CMS  */

	function detailsNewsDB($condition_arr=array()){
		$this->db->select('*');
		$this->db->from('dipp_news');
		$this->db->where($condition_arr);
		$query=$this->db->get();
		return $query->result_array();
	}

	
	/*  CMS STATUS CHANGE */
    
    function statusChangeNewsDB($content_id = 0) {
        $conditionArr   	= array('id' => $content_id);
        $news_detail   		= $this->detailsNewsDB($conditionArr);
        $content_status   	= $news_detail[0]['status'];
        $status         	= ($content_status == 'Active')?'Inactive':'Active';
        $updateArr      	= array('status' => $status);
        $update         	= $this->editNewsDB($updateArr,$conditionArr);
        
		if( $update ) {
            return TRUE;
        }
		else {
            return FALSE;
        }
    }

	
    /* DELETE CMS  */

    function deleteNewsDB($condition_arr=array()) {
	    $this->db->where($condition_arr);
	    $this->db->delete('dipp_news');
	    if($this->db->affected_rows() > 0) {
		    return TRUE;
	    }
	    else {
		    return FALSE;
	    }
    }
}