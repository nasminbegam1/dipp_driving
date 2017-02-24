<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_practice extends CI_Model{
		
		public function __construct(){
				parent::__construct();
		}
		
		public function getModule($condition_arr= array()){
				$this->db->select('COUNT(*) as total_qsn,MM.module_id,MM.module_name');
				$this->db->join(QUESTION_MASTER.' QM','MM.module_id=QM.module_id','left');	
				$this->db->from(MODULE_MASTER.' MM');
				$this->db->where($condition_arr);
				$this->db->group_by('MM.module_id');
				$query= $this->db->get();
                                //echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getModuleWiseQuestion($condition,$stilltoscore = ''){
				if($stilltoscore == '') {
                                $this->db->select('*');
				$this->db->from(MODULE_MASTER.' MM');
				$this->db->join(QUESTION_MASTER.' QM','MM.module_id=QM.module_id','inner');
                                $this->db->where($condition);
				//$this->db->order_by('QM.question_id', 'RANDOM');
				$query= $this->db->get();
                                }
				else {
				
                               foreach($condition as $key=>$val) {
                                        $t[] = $key .'='. $val;
                                    }  
                               $getCondition=implode(' AND ', $t);  
                               $getCondition_sub=str_replace('MM.','',$getCondition);
                               $sql="(SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM LEFT JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id INNER JOIN ".QUESTION_ANSWER_SET." QAS ON QAS.question_id=QM.question_id AND QAS.is_correct='No' AND QAS.student_id='".$this->session->userdata('STUDENT_ID')."' WHERE ".$getCondition.")
                                            UNION
                                            (SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM LEFT JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id WHERE ".$getCondition." AND QM.question_id NOT IN (SELECT question_id FROM ".QUESTION_ANSWER_SET." WHERE ".$getCondition_sub." AND student_id='".$this->session->userdata('STUDENT_ID')."'))";
                                $query = $this->db->query($sql);
                                //$query = $this->db->get();
                                
				}
				
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		
		public function getModuleQuestionsDetails($condition,$stilltoscore = '',$questionNoo=50){
				if($stilltoscore == '') {
                                $this->db->select('*');
				$this->db->from(MODULE_MASTER.' MM');
				$this->db->join(QUESTION_MASTER.' QM','MM.module_id=QM.module_id','inner');
                                $this->db->where($condition);
				$this->db->order_by('QM.question_id', 'RANDOM');
				$this->db->limit($questionNoo);
				$query= $this->db->get();
                                }
                                else{
				/*$this->db->join('dt_question_answer_set QAS', 'QAS.question_id=QM.question_id','left');
				$condition['QAS.is_correct']="No";
				$condition['QAS.user_id']=$this->session->userdata('user_id');
                                 * 
                                 */
                                foreach($condition as $key=>$val) {
                                       $t[] = $key .'='. $val;
                                   }  
                                $getCondition=implode(' AND ', $t);  
                                $getCondition_sub=str_replace('MM.','',$getCondition);   
                                $sql="(SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM LEFT JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id INNER JOIN  ".QUESTION_ANSWER_SET." QAS ON QAS.question_id=QM.question_id AND QAS.is_correct='No' AND QAS.student_id='".$this->session->userdata('STUDENT_ID')."' WHERE ".$getCondition.")
                                            UNION
                                            (SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM LEFT JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id WHERE ".$getCondition." AND QM.question_id NOT IN (SELECT question_id FROM ".QUESTION_ANSWER_SET." WHERE ".$getCondition_sub." AND student_id='".$this->session->userdata('STUDENT_ID')."'))";
                                    $query = $this->db->query($sql);       
				}
				
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getModuleQuestionsDetailsAll($condition){
				$this->db->select('*');
				//$this->db->join('dt_question_master QM','','inner');	
				$this->db->from(MODULE_MASTER.' MM');
				$this->db->where($condition);
				//$this->db->order_by('QM.question_id', 'RANDOM');
				//$this->db->limit(1,0);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getLesson($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(LESSION_MASTER);
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getLessonDetails($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(LESSION_DETAILS);
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getAnswerOptions($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(ANSWER_MASTER);
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getModuleQuestionsNext($condition_arr=array(),$offset,$stilltoscore=''){
				if($stilltoscore == '') {
                                $this->db->select('*');
				$this->db->from(QUESTION_MASTER.' QM');
                                $this->db->where($condition_arr);
                                $this->db->limit(1,$offset);
                                } else {
                                $this->db->select('*');
				$this->db->from(QUESTION_MASTER.' QM');
                                $incorrect_questionArr= $this->session->userdata('incorrect_question');
				$qsnId=$incorrect_questionArr[$offset]; 
                                $this->db->where('QM.question_id',$qsnId);
                                }
                                
				/*if($stilltoscore != ''){
				$incorrect_questionArr= $this->session->userdata('incorrect_question');
				$qsnId=$incorrect_questionArr[$offset];
				$this->db->join('dt_question_answer_set QAS', 'QAS.question_id=QM.question_id','left');
				//$condition_arr['QAS.is_correct']="No";
				$condition_arr['QAS.user_id']=$this->session->userdata('user_id');
				$this->db->where('QAS.question_id',$qsnId);
				} else {
						$this->db->limit(1,$offset);
				}
				$this->db->where($condition_arr);*/
				
				$query= $this->db->get();
				//echo $this->db->last_query();
				//exit;
				return $query->result_array();
		}
		
		public function getTopic($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(QUESTION_MASTER);
				$this->db->where($condition_arr);
				$this->db->limit(1,$offset);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function insertQuestionAnswerSet($insertarr=array()){
				$this->db->insert(QUESTION_ANSWER_SET, $insertarr);
				return $this->db->insert_id(); 
		}
		
		public function getViewSummary($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(QUESTION_ANSWER_SET);
				$this->db->where($condition_arr);
				$this->db->order_by("date_added","DESC");
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function delQuestionAnswerSet($condition_arr=array()){
				$this->db->where($condition_arr);
				$this->db->delete(QUESTION_ANSWER_SET);
				//echo $this->db->last_query();
				//die();
				if($this->db->affected_rows() > 0) {
						return TRUE;
				}
				else {
						return FALSE;
				}
		}
		
		public function getAnswers($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(QUESTION_ANSWER_SET);
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function checkExistQuestionAnswer($conditionarr=array()){
				$this->db->select('*');
				$this->db->from(QUESTION_ANSWER_SET);
				$this->db->where($conditionarr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function updateQuestionAnswerSet($update_arr=array(),$condition_arr=array()){
				$this->db->where($condition_arr);
				$update= $this->db->update(QUESTION_ANSWER_SET, $update_arr);
				//echo $this->db->last_query(); die();
				if($update) {
						return TRUE;
				}
				else {
						return FALSE;
				}
		}
		
		public function getModuleWiseQuestionAll($condition_arr=array(),$offset,$stilltoscore=''){
				
                                $this->db->select('QM.*,MM.module_id, MM.module_name');
				$this->db->join(QUESTION_MASTER.' QM','MM.module_id=QM.module_id','left');	
				$this->db->from(MODULE_MASTER.' MM');
				if($stilltoscore == '') {
                                    $this->db->limit(1,$offset);
                                } else {
                                    $incorrect_questionArr= $this->session->userdata('incorrect_question');
                                    $qsnId=$incorrect_questionArr[$offset]; 
                                    $condition_arr['QM.question_id']=$qsnId;
                                }
				//$this->db->order_by('QM.question_id', 'RANDOM');
                                $this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				//die();
				return $query->result_array();
		}
		
		public function getTotalNoOfQuestion($condition_arr=array(),$stilltoscore ='',$questionNoo= '50'){
				
                                if($stilltoscore == '') {
                                    $this->db->select('*');
                                    $this->db->join(QUESTION_MASTER.' QM','MM.module_id=QM.module_id','left');	
                                    $this->db->from(MODULE_MASTER.' MM');
                                    $this->db->where($condition_arr);
                                    $this->db->order_by('rand()');
                                    $this->db->limit($questionNoo);
                                    $query= $this->db->get();
                                } else {
                                    foreach($condition_arr as $key=>$val) {
                                        $t[] = $key .'='. $val;
                                    }
                                    $getCondition=implode(' AND ', $t);
                                    $getCondition_sub=str_replace('MM.','',$getCondition);
                                    
                                    $sql="(SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM INNER JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id INNER JOIN  ".QUESTION_ANSWER_SET." QAS ON QAS.question_id=QM.question_id AND QAS.is_correct='No' AND QAS.student_id='".$this->session->userdata('STUDENT_ID')."' WHERE ".$getCondition.")
                                            UNION
                                            (SELECT QM.question_id,QM.module_id,MM.topic_id,QM.question_text,QM.question_image FROM ".MODULE_MASTER." MM INNER JOIN ".QUESTION_MASTER." QM ON MM.module_id=QM.module_id WHERE ".$getCondition." AND QM.question_id NOT IN (SELECT question_id FROM ".QUESTION_ANSWER_SET." WHERE ".$getCondition_sub."  AND student_id='".$this->session->userdata('STUDENT_ID')."')) LIMIT 0,1";
                                    $query = $this->db->query($sql);
                                }
                                //echo $this->db->last_query();exit;
                                //echo $sql;
                                //echo $query->num_rows();
                                //exit;
                                //pr($query->result_array());
                                return $query->result_array();
                                
		}
		
		public function getWrongQuestionAnswerDetails($condition_arr=array()){
				$this->db->select('*');
				$this->db->join(ANSWER_MASTER.' AM','AM.question_id=QM.question_id','left');
				//$this->db->join('dt_question_answer_set QAS','QM.question_id=QAS.question_id','left');
				
				$this->db->from(QUESTION_MASTER.' QM');
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();
		}
		
		public function getAnswerSheetDetails($question_id){
				$SQL= "SELECT * FROM ".QUESTION_ANSWER_SET." WHERE question_id = ".$question_id;
				$query = $this->db->query($SQL);
				$result = $query->row_array();		
				return $result;
		}
		
		//public function getWrongQuestionAnswerDetails($question_id){
		//
		//		$SQL= "SELECT QM.*,AM.answer_id,AM.answer_type,answer_text,is_answer FROM dt_question_master QM,dt_answer_master AM WHERE AM.question_id = QM.question_id AND QM.question_id = ".$question_id;
		//		$query = $this->db->query($SQL);
		//		$result = $query->row_array();
		//		
		//		
		//		
		//		
		//		return $result;
		//}
		
		public function getModuleWisePercentage($student_id,$module_id){
				$sql="SELECT a.module_id,ROUND((SUM(IF(a.is_correct='Yes',1,0))/COUNT(*))*100) as answer_percentage FROM ".QUESTION_ANSWER_SET." AS a WHERE a.student_id='".$student_id."' AND a.module_id='".$module_id."' GROUP BY a.module_id";
				$query = $this->db->query($sql);
				$result = $query->row_array();
				return $result;
		}
		
		public function getModuleCorrectAnswer($condition){
				$this->db->select('COUNT(*) as TOTAL');
				$this->db->from(QUESTION_ANSWER_SET.' MA');
				$this->db->where($condition);
				$query= $this->db->get();
				//echo $this->db->last_query();
				$total_modules = $query->row_array();
				$data['total_correct_answer'] = $total_modules['TOTAL'];
				return $data;
		}
		
		public function getCorrectAnswer($condition){
				$result = '';
				$this->db->select('*');
				$this->db->from(QUESTION_ANSWER_SET.' MA');
				$this->db->where($condition);
				$query		= $this->db->get();
				if($query->num_rows()>0){
				$result 	= $query->result_array();
				}
				return $result;
		}
		public function getTopicDetails($condition_arr=array()){
				$this->db->select('*');
				$this->db->from(TOPIC_MASTER);
				$this->db->where($condition_arr);
				$query= $this->db->get();
				//echo $this->db->last_query(); die();
				return $query->result_array();
		}
}