<?php

#########################################################################
#                                                                       #
#			This is Category model.                         #
#	                                         			#
#									#
#									#
#									#
#									#
#									#
#########################################################################


class Model_category extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL CATEGORY                         #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allCategoryDB($search_by='', $limit='', $offset=0) {


            $this->db->select('CM.*');
            $this->db->from('category_master CM');
            if($limit > 0) {
			$this->db->limit($limit, $offset);
			}
            $this->db->order_by('CM.cat_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('CM.cat_name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL Category NUMBER                #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function countCategoryDB($search_by='')
        {

            $this->db->select('SUM(IF(CM.cat_id<>"",1,0)) as total_category',false);
            $this->db->from('category_master CM');
            if($search_by <> '')
            {
                $this->db->like('CM.cat_name',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_category'];

	}
#########################################################
#          CHECK CATEGORY EXIST OR NOT                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function categoryExistsDB($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('category_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#              ADD CATEGORY INTO DATABASE               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addCategoryDB($insert_arr=array()) {
            $this->db->insert('category_master', $insert_arr);
            return $this->db->insert_id();

	}

#########################################################
#              EDIT CATEGORY INTO DATABASE              #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function editCategoryDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('category_master', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS CATEGORY                         #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function detailsCategoryDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('category_master');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              CATEGORY STATUS CHANGE                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        
    function statusChangeCategoryDB($cat_id = 0) {
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
#          CHECK CATEGORY UNIQUE                        #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function categoryUniqueDB($condition_arr=array(),$cat_id=0) {
            $this->db->select('*');
            $this->db->from('category_master');
            $this->db->where($condition_arr);
            if($cat_id > 0) {
                $this->db->where('cat_id !=', $cat_id);
            }
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#              DELETE CATEGORY                          #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function deleteCategoryDB($condition_arr=array()) {
            $this->db->where($condition_arr);
            $this->db->delete('category_master');
            if($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
	}
        
        
}