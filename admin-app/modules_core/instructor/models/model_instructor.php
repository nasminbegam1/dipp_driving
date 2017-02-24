<?php

#########################################################################
#                                                                       #
#			This is User model.                             #
#	                                         			#
#									#
#									#
#									#
#									#
#									#
#########################################################################


class Model_instructor extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL USER                             #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allInstructorDB($search_by='', $limit='', $offset=0) {

            $this->db->select('I.*,P.package_name');
            $this->db->from('dipp_instructor I');
            $this->db->join('dipp_package P', 'P.package_id = I.package_id','LEFT');
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('I.instructor_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('I.instructor_business_name',$search_by);
                $this->db->or_like('I.instructor_fname',$search_by);
                $this->db->or_like('I.instructor_lname',$search_by);
                $this->db->or_like('P.package_name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
	    //pr($query->result_array());
            return $query->result_array();

	}

#########################################################
#              GET TOTAL USER NUMBER                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function countInstructorDB($search_by='')
        {

            $this->db->select('SUM(IF(I.instructor_id<>"",1,0)) as total_instructor',false);
            $this->db->from('dipp_instructor I');
            $this->db->join('dipp_package P', 'P.package_id = I.package_id','LEFT');
            if($search_by <> '')
            {
                $this->db->like('I.instructor_business_name',$search_by);
                $this->db->or_like('I.instructor_fname',$search_by);
                $this->db->or_like('I.instructor_lname',$search_by);
                $this->db->or_like('P.package_name',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_instructor'];

	}
#########################################################
#          CHECK USER EXIST OR NOT                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function instructorExistsDB($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('dipp_instructor');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#              ADD INSTRUCTOR INTO DATABASE                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addInstructorDB($insert_arr=array()) {
            $this->db->insert('dipp_instructor', $insert_arr);
            return $this->db->insert_id();

	}

#########################################################
#              EDIT USER INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function editInstractorDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dipp_instructor', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS USER                             #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function detailsInstructorDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_instructor');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
	
	
	function packageList($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_package');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
	
	function courseList($condition_arr=array()){
	    $this->db->select('*');
            $this->db->from('dipp_course_master');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
	}
#########################################################
#              USER STATUS CHANGE                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        
    function statusChangeInstructorDB($instructor_id = 0) {
        $conditionArr       = array('instructor_id' => $instructor_id);
        $inst_detail        = $this->detailsInstructorDB($conditionArr);
        $inst_status        = $inst_detail[0]['instructor_status'];
        $status             =($inst_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('instructor_status' => $status);

        $update             = $this->editInstractorDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


#########################################################
#              DELETE USER                              #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    function deleteInstructorDB($condition_arr=array()) {
	$this->db->where($condition_arr);
	$this->db->delete('dipp_instructor');
	if($this->db->affected_rows() > 0) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }

    ####################### DELETE INSTRUCTOE BANNER ##################################
function deleteInstructorBannerDB($condition_arr=array()) 
{
    $this->db->where($condition_arr);
    $this->db->delete('dipp_instructor_banner');
    if($this->db->affected_rows() > 0)
     {
        return TRUE;
     } 
    else
     {
        return FALSE;
      }
}
####################### COUNT NUMBER OF INSTRUCTOE BANNER ##################################   
     function noInstructorBannerDB() {
            $this->db->select('*');
            $this->db->from('dipp_instructor_banner');
            $query = $this->db->get();
            $num = $query->num_rows();
            return $num;
        }  
####################### LISTING ALL  INSTRUCTOR BANNER ##################################   
function allInstructorBannerDB($limit='', $offset=0)
    {
        $this->db->select('IB.*');
        $this->db->from('dipp_instructor_banner IB');
        if($limit > 0) 
        {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('IB.banner_id','DESC');
        
        $query=$this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
####################### ADD INSTRUCTOR BANNER ################################## 
function addInstructorBannerDB($insert_arr=array()) {
            $this->db->insert('dipp_instructor_banner', $insert_arr);
            return $this->db->insert_id();

    }
####################### EDIT INSTRUCTOR BANNER ################################## 
function editInstructorBannerDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dipp_instructor_banner', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
    }

####################### GET DETAILS OF A PARTICULAR INSTRUCTOR BANNER ##################################        
function detailsInstructorBannerDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_instructor_banner');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
####################### SEARCH INSTRUCTOR BANNER ################################## 
    function searchInstructorBannerDB($search_by='') {

           
            $this->db->select('BM.*');
            $this->db->from('dipp_instructor_banner BM');
            if($search_by <> '')
            {
                $this->db->like('BM.banner_title',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

    }        
        
}