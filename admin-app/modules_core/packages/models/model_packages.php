<?php
class Model_packages extends CI_Model {

    function __construct(){
       parent::__construct();
    }

	
	/* GET ALL CMS */

	function allPackagesDB($search_by='', $limit='', $offset=0) {
		$this->db->select('P.*');
		$this->db->from('dipp_package P');
		$this->db->limit($limit, $offset);
		$this->db->order_by('P.package_id','DESC');
		if($search_by <> ''){
			$this->db->like('P.package_name',$search_by);
		}
		$query= $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

	
	/* GET TOTAL CMS NUMBER */

	function countPackagesDB($search_by=''){
		$this->db->select('SUM(IF(P.package_id <> "",1,0)) as total_packages',false);
		$this->db->from('dipp_package P');
		if($search_by <> ''){
			$this->db->like('P.package_name',$search_by);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['total_packages'];
	}
	
    
	/* CHECK CMS EXIST OR NOT */

	function packagesExistsDB($condition_arr=array()) {
		$this->db->select('*');
		$this->db->from('dipp_package');
		$this->db->where($condition_arr);
		$query = $this->db->get();
		$num = $query->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}
	

	/* ADD CMS INTO DATABASE */

	function addPackagesDB($insert_arr=array()) {
		$this->db->insert('dipp_package', $insert_arr);
		return $this->db->insert_id();
	}

	
	/* EDIT CMS INTO DATABASE  */

	function editPackagesDB($update_arr=array(),$condition_arr=array()) {
		$this->db->where($condition_arr);
		$update= $this->db->update('dipp_package', $update_arr);
		//echo $this->db->last_query(); die();
		if($update) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	
	/* DETAILS CMS  */

	function detailsPackagesDB($condition_arr=array()){
		$this->db->select('*');
		$this->db->from('dipp_package');
		$this->db->where($condition_arr);
		$query=$this->db->get();
		return $query->result_array();
	}

	
	/*  CMS STATUS CHANGE */
    
    function statusChangePackagesDB($content_id = 0) {
        $conditionArr   	= array('package_id' => $content_id);
        $packages_detail   	= $this->detailsPackagesDB($conditionArr);
        $content_status   	= $packages_detail[0]['package_status'];
        $status         	= ($content_status == 'Active')?'Inactive':'Active';
        $updateArr      	= array('package_status' => $status);
        $update         	= $this->editPackagesDB($updateArr,$conditionArr);
        
		if( $update ) {
            return TRUE;
        }
		else {
            return FALSE;
        }
    }

	
	/* DELETE CMS  */

	function deletePackageDB($condition_arr=array()) {
		$this->db->where($condition_arr);
		$this->db->delete('dipp_package');
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