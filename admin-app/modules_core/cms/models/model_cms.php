<?php
class Model_cms extends CI_Model {

    function __construct(){
       parent::__construct();
    }

	
	/* GET ALL CMS */

	function allCmsDB($search_by='', $limit='', $offset=0) {
		$this->db->select('CM.*');
		$this->db->from('dipp_cms CM');
		$this->db->limit($limit, $offset);
		$this->db->order_by('CM.cms_id','DESC');
		if($search_by <> ''){
			$this->db->like('CM.cms_title',$search_by);
		}
		$query= $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

	
	/* GET TOTAL CMS NUMBER */

	function countCmsDB($search_by=''){
		$this->db->select('SUM(IF(CM.cms_id <> "",1,0)) as total_cms',false);
		$this->db->from('dipp_cms CM');
		if($search_by <> ''){
			$this->db->like('CM.cms_title',$search_by);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['total_cms'];
	}
	
    
	/* CHECK CMS EXIST OR NOT */

	function cmsExistsDB($condition_arr=array()) {
		$this->db->select('*');
		$this->db->from('dipp_cms');
		$this->db->where($condition_arr);
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
	

	/* ADD CMS INTO DATABASE */

	function addCmsDB($insert_arr=array()) {
		$this->db->insert('dipp_cms', $insert_arr);
		return $this->db->insert_id();
	}

	
	/* EDIT CMS INTO DATABASE  */

	function editCmsDB($update_arr=array(),$condition_arr=array()) {
		$this->db->where($condition_arr);
		$update= $this->db->update('dipp_cms', $update_arr);
		//echo $this->db->last_query(); die();
		if($update) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	
	/* DETAILS CMS  */

	function detailsCmsDB($condition_arr=array()){
		$this->db->select('*');
		$this->db->from('dipp_cms');
		$this->db->where($condition_arr);
		$query=$this->db->get();
		return $query->result_array();
	}

	
	/*  CMS STATUS CHANGE */
    
    function statusChangeCmsDB($content_id = 0) {
        $conditionArr   = array('cms_id' => $content_id);
        $cms_detail   = $this->detailsCmsDB($conditionArr);
        $content_status   = $cms_detail[0]['cms_status'];
        $status         =($content_status == 'Active')?'Inactive':'Active';
        $updateArr      = array('cms_status' => $status);
        $update         = $this->editCmsDB($updateArr,$conditionArr);
        
		if( $update ) {
            return TRUE;
        }
		else {
            return FALSE;
        }
    }

	
	/* DELETE CMS  */

	function deleteCmsDB($condition_arr=array()) {
		$this->db->where($condition_arr);
		$this->db->delete('dipp_cms');
		if($this->db->affected_rows() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	/* CHECK UNIQUE NAME OF CMS */
	
	function cmsUniqueDB($condition_arr=array(),$content_id=0) {
		$this->db->select('*');
		$this->db->from('dipp_cms');
		$this->db->where($condition_arr);
		if($content_id > 0) {
			$this->db->where('cms_id !=', $content_id);
		}
		//echo $this->db->last_query(); die();
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
}