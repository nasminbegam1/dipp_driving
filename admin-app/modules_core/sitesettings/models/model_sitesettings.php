<?php

#########################################################################
#                                                                       #
#			This is Sitesettings model.                     #
#	                                         			#
#									#
#########################################################################


class Model_sitesettings extends CI_Model {

    function __construct()
    {

       parent::__construct();

    }

#########################################################
#              GET ALL SITESETTINGS                     #
#########################################################


    function allSitesettingsDB($search_by='', $limit='', $offset=0)
    {
	$this->db->select('*');
	$this->db->from('dipp_sitesettings');
	if($limit > 0) {
		    $this->db->limit($limit, $offset);
		    }
	$this->db->order_by('sitesettings_id','ASC');
	if($search_by <> '')
	{
	    $this->db->like('sitesettings_lebel',$search_by);
	 }
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();

    }

#########################################################
#              GET TOTAL SITESETTINGS NUMBER            #
#########################################################

    function countSitesettingsDB($search_by='')
    {

	$this->db->select('SUM(IF(sitesettings_id<>"",1,0)) as total_sitesettings',false);
	$this->db->from('dipp_sitesettings');
	if($search_by <> '')
	{
	    $this->db->like('sitesettings_lebel',$search_by);
	}
	$query = $this->db->get();
	//echo $this->db->last_query();
	$result = $query->result_array();
	return $result[0]['total_sitesettings'];

    }


#########################################################
#              EDIT SITESETTINGS INTO DATABASE          #
#########################################################

    function editSitesettingsDB($update_arr=array(),$condition_arr=array())
    {
	$this->db->where($condition_arr);
	$update         = $this->db->update('dipp_sitesettings', $update_arr);
	if($update) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }

#########################################################
#              DETAILS SITESETTINGS                     #
#########################################################

    function detailsSitesettingsDB($condition_arr=array())
    {
	$this->db->select('*');
	$this->db->from('dipp_sitesettings');
	$this->db->where($condition_arr);
	$query=$this->db->get();
	return $query->result_array();
    }

#########################################################
#              SITESETTINGS STATUS CHANGE               #
#########################################################
        
    function statusChangeStepSitesettingsDB($cat_id = 0)
    {
        $conditionArr       = array('cat_id' => $cat_id);
        $category_detail    = $this->detailsCategoryDB($conditionArr);
        $cat_status         = $category_detail[0]['cat_status'];
        $status             =($cat_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('cat_status' => $status);

        $update             = $this->editCategoryDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK SITESETTINGS EXIST OR NOT              #
#########################################################

    function sitesettingsExistsDB($condition_arr=array())
    {
	$this->db->select('*');
	$this->db->from('dipp_sitesettings');
	$this->db->where($condition_arr);
	$query = $this->db->get();
	$num = $query->num_rows();
	return ($num > 0) ? TRUE : FALSE;
    }
    
}