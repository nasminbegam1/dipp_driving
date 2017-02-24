<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_learn extends CI_Model
{
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	
    public function step_details($step_id,$course_id=''){

        $sql = "SELECT SM.name,SM.step_type,SM.id from ".STEP_MASTER." as SM where SM.id = '".$step_id."'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()){
            return $rs->result_array();
        }else{
                return false;
        }
    }
	public function topic_details($step_id,$course_id=''){
	        $data = array();
		$sql = "SELECT TM.*,SM.name as step_name,SM.step_type from ".STEP_MASTER." as SM INNER JOIN ".TOPIC_MASTER." as TM where SM.id = '".$step_id."' AND SM.id = TM.step_id AND TM.status = 'Active' ORDER BY sort_order ASC";
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
		    $data = $rs->result_array();
		    return $data;
		}
		return false;
	}
	
	public function getCourseId($condition_arr= array()){
		$this->db->select('id');
		$this->db->from(STEP_MASTER);
		$this->db->where($condition_arr);
		$query= $this->db->get();
		return $query->result_array();
	}
	
	public function getLessionDetails($lesson_id,$student_id){
		$this->db->select('name,description');
		$this->db->from(LESSION_MASTER);
		$this->db->where(array('id'=>$lesson_id));
		$query		= $this->db->get();
		$data 		= $query->result_array();
		$this->db->select('is_read,add_lesson');
		$this->db->from(LESSION_READ);
		$this->db->where(array('lesson_id'=>$lesson_id,'student_id'=>$student_id));
		$query			= $this->db->get();
		$data[0]['is_read'] 	= 'No';
		$data[0]['add_lesson']  = 'No';
		if($query->num_rows() > 0)
		{
			$res 			= $query->row_array();
			$data[0]['is_read'] 	= $res['is_read'];
			$data[0]['add_lesson'] 	= $res['add_lesson'];
			
		}
		return $data;
	}
	public function getLessionDetailsbyTopic($topic_id,$student_id){
		$this->db->select('id,name');
		$this->db->from(LESSION_MASTER);
		$this->db->where(array('topic_id'=>$topic_id));
		$this->db->where(array('status'=>'Active'));
		$query		= $this->db->get();
		$data = $query->result_array();
		foreach($data as $k=>$r){
			
			$this->db->select('*');
			$this->db->from(LESSION_READ);
			$this->db->where(array('lesson_id'=>$r['id'],'student_id'=>$student_id));
			$query		= $this->db->get();
			$data[$k]['is_read'] = 'No';
			$data[$k]['add_lesson']  = 'No';
			if($query->num_rows() > 0)
			{
				$res 			= $query->row_array();
				$data[$k]['is_read'] 	= $res['is_read'];
				$data[$k]['add_lesson'] = $res['add_lesson'];
			}	
		}
		return $data;
	}
	function getMyLesson($table,$table1,$joinCondition,$condition_arr=array(),$order='id',$order_by='desc'){
		$this->db->select('LM.id,LM.name,LM.description,LR.is_read,LR.add_lesson');
		$this->db->from($table);
		$this->db->join($table1, $joinCondition);
		$this->db->where($condition_arr);
		$this->db->order_by($order, $order_by); 
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getReadCount($student_id){
		$this->db->select('COUNT(*)');
		$this->db->from(LESSION_READ);
		$this->db->where(array('student_id'=>$student_id,'add_lesson'=>'Yes'));
		$query= $this->db->get();
		$total_lesson = $query->row_array();
		$data['total_lesson'] = $total_lesson['COUNT(*)'];
		
		$this->db->select('COUNT(*) TOTAL');
		$this->db->from(LESSION_READ);
		$this->db->where(array('student_id'=>$student_id,'add_lesson'=>'Yes','is_read' => 'Yes'));
		$query= $this->db->get();
		$total_read_lesson = $query->row_array();		
		$data['total_read_lesson'] = $total_read_lesson['TOTAL'];
		return $data;
	}
        
        public function getTopicAll(){
		$this->db->select('LM.id,LM.topic_id');
		$this->db->from(LESSION_MASTER.' LM');
		$this->db->where(array('status'=>'Active'));
                $this->db->group_by('LM.topic_id');
		$query= $this->db->get();
		$all_topic = $query->result_array();
                return $all_topic;
		
	}
        public function getCourseComplete($topic_id,$student_id){
             $sql="SELECT t1.topic_id,t1.id FROM ".LESSION_MASTER." AS t1 WHERE t1.topic_id='".$topic_id."' HAVING COUNT(t1.id) = (SELECT COUNT( t2.id ) FROM ".LESSION_READ." as t2,".LESSION_MASTER." AS t1 WHERE t2.lesson_id=t1.id AND t2.is_read = 'Yes' AND t1.topic_id='".$topic_id."' AND t2.student_id='".$student_id."')";
            $query = $this->db->query($sql);
            return $query->result();
	}
        
        public function getModulePass($student_id){
            $sql="SELECT a.module_id,ROUND((SUM(IF(a.is_correct='Yes',1,0))/COUNT(*))*100,2) as answer_percentage FROM ".QUESTION_ANSWER_SET." AS a WHERE a.student_id='".$student_id."' GROUP BY a.module_id HAVING answer_percentage > 25";
            $query = $this->db->query($sql);
            $count=$query->num_rows();
            return $count;
	}
        
        public function getTopicAttemp($condition) {
            $this->db->select('AM.*');
            $this->db->from(QUESTION_ANSWER_SET.' AM');
            $this->db->where($condition);
            $query= $this->db->get();
            //echo $this->db->last_query();
            return $query->num_rows();
        }
        public function getTopicPass($topic_id,$student_id){
            $sql="SELECT a.module_id,ROUND((SUM(IF(a.is_correct='Yes',1,0))/COUNT(*))*100,2) as answer_percentage FROM ".QUESTION_ANSWER_SET." AS a WHERE a.student_id='".$student_id."' AND a.topic_id='".$topic_id."' HAVING answer_percentage > 90";
            $query = $this->db->query($sql);
            $count=$query->num_rows();
            return $count;
	}
        public function getTotalModules($condition){
            $this->db->select('COUNT(*) as TOTAL');
            $this->db->from(MODULE_MASTER.' MM');
            $this->db->where($condition);
            $query= $this->db->get();
            //echo $this->db->last_query();
            $total_modules = $query->row_array();
            $data['total_modules'] = $total_modules['TOTAL'];
	    return $data;
	}
	public function getLessonByTopic($topic_id,$student_id){
		$sql 		= "SELECT * FROM ".LESSION_READ." AS t2, ".LESSION_MASTER." AS t1 WHERE t2.lesson_id = t1.id AND t2.is_read = 'Yes' AND t1.topic_id = '".$topic_id."' AND t2.student_id =".$student_id."";
		$query 		= $this->db->query($sql);
		$count 		= $query->num_rows();
		return $count;
	}
	public function totalTopic($topic_id){
		$this->db->select('COUNT(*) as TOTAL');
		$this->db->from(LESSION_MASTER);
		$this->db->where(array('topic_id'=>$topic_id));
		$query			= $this->db->get();
		$total_lesson 		= $query->row_array();
		return $total_lesson['TOTAL'];
	}
	
	public function getHazardResult($user_id,$start_val){
		$this->db->select('*');
		$this->db->from('dipp_hazard_video');
		$this->db->limit('10',$start_val);
		$query =$this->db->get();
		$res = $query->result_array();
		foreach($res as $k => $r){
			$this->db->select('*');
			$this->db->from('dipp_hazard_answer');
			$this->db->where(array('video_id'=>$r['id'],'user_id'=>$user_id));
			$query = $this->db->get();
			if($query->num_rows()>0){
			$res[$k]['result'] = $query->row();
			}
		}
		return $res;
	}
}