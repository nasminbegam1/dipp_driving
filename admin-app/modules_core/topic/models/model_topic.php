<?php

#########################################################################
#                                                                       #
#			This is Topic model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_topic extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL TOPICS                          #
#########################################################


	function allTopicDB($search_by='', $limit='', $offset=0,$condition_arr=array()) {

           
            $this->db->select('TM.*,SM.name as step_name,CM.name as course_name,CM.id as course_id');
            $this->db->from('dipp_topic_master TM');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($limit > 0) 
            {
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('TM.id','DESC');
            if($search_by <> '')
            {
                $this->db->like('TM.name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL TOPIC NUMBER                	#
#########################################################

	function countTopicDB($search_by='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(TM.id<>"",1,0)) as total_topic',false);
            $this->db->from('dipp_topic_master TM');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
                $this->db->like('TM.name',$search_by);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_topic'];

	}

#########################################################
#              ADD TOPIC INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addTopicDB($insert_arr=array()) {
            $this->db->insert('dipp_topic_master', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT TOPIC INTO DATABASE              #
#########################################################

        function editTopicDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update   = $this->db->update('dipp_topic_master', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS TOPIC                         #
#########################################################

        function detailsTopicDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_topic_master');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              CATEGORY STATUS CHANGE                   #
#########################################################
        
    function statusChangeTopicDB($topic_id = 0) {
        $conditionArr       = array('id' => $topic_id);
        $topic_detail       = $this->detailsTopicDB($conditionArr);
        $topic_status       = $topic_detail[0]['status'];
        $status             = ($topic_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('status' => $status);

        $update             = $this->editTopicDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK TOPIC EXIST OR NOT                     #
#########################################################

        function topicExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_topic_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	
########################################################
#		GET ALL TOPIC				#
########################################################

    function getAllTopicDB($condition_arr = array(), $limit=''){
        $this->db->select('TM.*');
				$this->db->from('dipp_topic_master TM');
				if(count($condition_arr) > 0) {
						$this->db->where($condition_arr); 
				}
				if($limit > 0){
						$this->db->limit($limit, $offset);
				}
				$this->db->order_by('TM.id','DESC');
	
				$query=$this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
    }
		
		public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0) {
	   
		 //echo $FieldNames;
		  if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
		
	    if($OrderBy != '') {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 ) {
		$sql .= " LIMIT 0, $Limit";
	    }
	    echo $sql; echo "<br>";//exit;
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
	    if($rs->num_rows()) {
			    $rec = $rs->result_array();
	    }else{
		$rec = FALSE;
	    }
	    return $rec;
	}
	
	
	
		public function getValue_condition($TableName, $FieldName, $AliasFieldName, $Condition=''){
		if($Condition=="")
                    $Condition="";
		else
                    $Condition=" WHERE ".$Condition;

		if($AliasFieldName == ''){
			$getField = $FieldName;
		}
		else{
			$getField = $AliasFieldName;
			$FieldName = $FieldName ." AS ".$AliasFieldName;
		}

		$sql = "SELECT ".$FieldName." FROM ".$TableName.$Condition;
                //echo $sql; exit;
		$rs = $this->db->query($sql);

		if($rs->num_rows())
		{
			$rec = $rs->row();

			if(is_numeric($rec->$getField))
			{
				if($rec->$getField > 0)
					return $rec->$getField;
				else
					return "0";
			}
			else{
				return $rec->$getField;
			}
		}else{
			return false;
		}
	}


		
}