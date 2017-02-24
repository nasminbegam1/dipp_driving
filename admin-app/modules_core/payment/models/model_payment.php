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


class Model_payment extends CI_Model {

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


	function allPaymentDB($search_by='', $limit='', $offset=0) {

	    $this->db->select('IP.*,SI.instructor_business_name');
            $this->db->from('dipp_instructor_payment IP');
            $this->db->join('dipp_instructor SI', 'IP.instructor_id = SI.instructor_id');
	    
	    
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('payment_id','ASC');
            //if($search_by <> '')
            //{
            //    $this->db->like('badge_name',$search_by);
            //}
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

	function countPaymentDB($search_by='')
        {

            $this->db->select('count(*) as total_payment',false);
            $this->db->from('dipp_instructor_payment');
            //if($search_by <> '')
            //{
            //    $this->db->like('badge_name',$search_by);
            //}
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_payment'];

	}

        
        
}