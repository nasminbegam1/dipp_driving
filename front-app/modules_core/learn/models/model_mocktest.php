<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_mocktest extends CI_Model{
		
		public function __construct(){
				parent::__construct();
		}
		
		public function getQuestion($condition_arr= array()){
				$this->db->select('topic_id,COUNT( * ) AS TOTAL');
				$this->db->from(MOCK_QUESTION_MASTER);
				$this->db->where($condition_arr);
				$this->db->order_by('TOTAL','DESC');
				$this->db->group_by('topic_id');
                                $query= $this->db->get();
				$result = $query->row_array();
				
				$this->db->select('topic_id,mock_question_id,mock_question_text,mock_question_image,mock_question_explanation');
				$this->db->from(MOCK_QUESTION_MASTER);
				$this->db->where($condition_arr);
				$this->db->where(array('topic_id'=>$result['topic_id']));
				$this->db->order_by('mock_question_id','RANDOM');
                                $query= $this->db->get();
				$result = $query->row_array();
				//pr($result);
				
				if(is_array($result)){
					$this->db->select('*');
					$this->db->from(MOCK_ANSWER_MASTER);
					$this->db->where(array('mock_question_id'=>$result['mock_question_id']));
					$qr = $this->db->get();
					$result['answer'] = $qr->result_array();
					
					$this->db->select('*');
					$this->db->from(MOCK_ANSWER_MASTER);
					$this->db->where(array('mock_question_id'=>$result['mock_question_id'],'mock_is_answer'=>'Y'));
					$qr = $this->db->get();
					$result['correct_answer'] = $qr->num_rows();
				}
				return $result;
		}
		public function getExistQuestionId($addQuestionTime){
				$rec = '';
				$this->db->select('question_id');
				$this->db->from(MOCK_TEST_RESULT);
				$this->db->where('added_time',$addQuestionTime);
				$query = $this->db->get();
				$result = $query->result_array();
				if(is_array($result) && count($result)){
				    foreach($result as $res){
					$rec[] = $res['question_id'];
				    }
				    $rec = implode(',',$rec);
				}
				return $rec;
		}
		
		public function mockTestResult($student_id,$course_id){
                                $passMarkes = $this->model_basic->get_option_value(19);
				
				$sql = "SELECT * FROM ".MOCK_TEST_RESULT." MT INNER JOIN ".MOCK_QUESTION_MASTER." MQ ON MQ.mock_question_id=MT.question_id WHERE MT.student_id=".$student_id." AND MT.is_publish='Yes' AND MQ.mock_course_id=".$course_id." GROUP BY added_time" ;
				$query = $this->db->query($sql);
				//$this->db->select('*');
				//$this->db->from('dt_mock_test_result');
				//$this->db->where(array('user_id'=>$user_id,'is_publish'=>'Yes'));
				//$this->db->group_by("added_time");
				//$query 		= $this->db->get();
				$pass 		= 0;
				$fail		= 0;
				$testRes['testRes'] = '';
				if($query->num_rows() > 0)
				{
				$result 	= $query->result_array();
				foreach($result as $k=>$mockTestDetail){
				        $testRes['testRes'][$k]['testDate'] = date('d F Y h:s:i',$mockTestDetail['added_time']);
					if($mockTestDetail['answer_no'] == '0' && $mockTestDetail['question_id'] == '0' && $mockTestDetail['answer_id'] == ''){
						$fail = $fail+1;
						$testRes['testRes'][$k]['result'] = 0;
					}else{
						$exam_result = $this->mockTestForOneExam($mockTestDetail['added_time'],$course_id);
                                                if($exam_result['userNumber']>=$passMarkes){
							$pass = $pass+1;
						        $testRes['testRes'][$k]['result'] = 1;	
						}else{
						        $fail = $fail+1;
						        $testRes['testRes'][$k]['result'] = 0;
						}
						
					}
				}
				}
				$testRes['totalFail'] = $fail;
				$testRes['totalPass'] = $pass;
				$testRes['totalTest'] = $fail+$pass;
				//echo $this->db->last_query();
				//pr($testRes);
				return $testRes;
		}
		
		public function mockTestReport($student_id,$course_id){
                                $passMarkes = $this->model_basic->get_option_value(19);
				
				$sql = "SELECT * FROM ".MOCK_TEST_RESULT." MT INNER JOIN ".MOCK_QUESTION_MASTER." MQ ON MQ.mock_question_id=MT.question_id WHERE MT.student_id=".$student_id." AND MT.is_publish='Yes' AND MQ.mock_course_id=".$course_id." GROUP BY added_time ORDER  BY MT.added_time DESC" ;
				$query = $this->db->query($sql);
				$pass 		= 0;
				$fail		= 0;
				$testRes['testRes'] = '';
				if($query->num_rows() > 0)
				{
				$result 	= $query->result_array();
				foreach($result as $k=>$mockTestDetail){
					$this->db->select('count(*) total');
				        $this->db->from(MOCK_TEST_RESULT);
				        $this->db->where(array('added_time'=>$mockTestDetail['added_time'],'answer_id !='=>''));
					$query = $this->db->get();
					$res   = $query->row();
					$testRes['testRes'][$k]['attemp_question'] = $res->total;
				        $testRes['testRes'][$k]['testDate'] = date('d F Y h:s:i',$mockTestDetail['added_time']);
					if($mockTestDetail['answer_no'] == '0' && $mockTestDetail['question_id'] == '0' && $mockTestDetail['answer_id'] == ''){
						$fail = $fail+1;
						$testRes['testRes'][$k]['result'] = 0;
					}else{
						$exam_result = $this->mockTestForOneExam($mockTestDetail['added_time'],$course_id);
                                                if($exam_result['userNumber']>=$passMarkes){
							$pass = $pass+1;
						        $testRes['testRes'][$k]['result'] = 1;	
						}else{
						        $fail = $fail+1;
						        $testRes['testRes'][$k]['result'] = 0;
						}
						
					}
				}
				}
				$testRes['totalFail'] = $fail;
				$testRes['totalPass'] = $pass;
				$testRes['totalTest'] = $fail+$pass;
				//echo $this->db->last_query();
				//pr($testRes);
				return $testRes;
		}
		
		public function mockTestForOneExam($addQuestionTime,$course_id){
				$passMarkes = $this->model_basic->get_option_value(19);
				$sql = "SELECT * FROM ".MOCK_TEST_RESULT." TR INNER JOIN ".MOCK_ANSWER_MASTER." AM ON TR.question_id = AM.mock_question_id AND AM.mock_is_answer = 'Y' WHERE TR.added_time = '".$addQuestionTime."' AND TR.answer_id = (
SELECT GROUP_CONCAT( MA.mock_answer_id ) FROM ".MOCK_ANSWER_MASTER." MA WHERE MA.`mock_is_answer` = 'Y' AND TR.question_id = MA.mock_question_id ) GROUP BY TR.question_id";
				$rs = $this->db->query($sql);
				$data['passQuestionNo'] =  $rs->num_rows();
				$this->db->select('*');
				$this->db->from(MOCK_QUESTION_MASTER);
				$this->db->where(array('mock_question_status'=>'Active','mock_course_id'=>$course_id));
				$query 			= $this->db->get();
				//$totalQuestion  	= $query->num_rows();
                                $totalQuestion  	= $this->model_basic->get_option_value(18);
                                $data['userNumber']     = ($data['passQuestionNo']/$totalQuestion)*100;
				return $data;
		}
		
		public function wrongAnswer($addQuestionTime,$course_id){
				$result = '';
				$sql = "SELECT QM.mock_question_text,QM.mock_question_id,QM.mock_question_image,QM.mock_question_explanation,TR.answer_id FROM ".MOCK_TEST_RESULT." TR
				LEFT JOIN ".MOCK_ANSWER_MASTER." AM ON TR.question_id = AM.mock_question_id AND AM.mock_is_answer = 'Y'
				INNER JOIN ".MOCK_QUESTION_MASTER." QM ON TR.question_id = QM.mock_question_id
				WHERE TR.added_time = '".$addQuestionTime."' AND QM.mock_course_id=".$course_id." AND ( TR.answer_id NOT IN ( SELECT GROUP_CONCAT( MA.mock_answer_id ) FROM ".MOCK_ANSWER_MASTER." MA WHERE MA.`mock_is_answer` = 'Y' AND TR.question_id = MA.mock_question_id ) || ( TR.answer_id = '' )) GROUP BY TR.question_id";
				$rs = $this->db->query($sql);
				if($rs->num_rows()>0){
				$result = $rs->result_array();
				foreach($result as $k=>$res){
				        $result[$k]['given_answer'] = '';
				        $this->db->select('mock_answer_text,mock_is_answer,mock_answer_type,mock_answer_id');
					$this->db->from(MOCK_ANSWER_MASTER);
					$this->db->where(array('mock_question_id'=>$res['mock_question_id']));
					$qr = $this->db->get();
					$result[$k]['answer'] = $qr->result_array();
					if($res['answer_id'] != ''){
					$this->db->select('mock_answer_text,mock_answer_type');
					$this->db->from(MOCK_ANSWER_MASTER);
					$this->db->where_in('mock_answer_id',explode(',',$res['answer_id']));
					$gqr = $this->db->get();
					$result[$k]['given_answer'] = $gqr->result_array();
					}	
				}
				}
				return $result;
		}
		
		public function mockTestmastery($student_id,$course_id){
				$testRes['attemp_question'] = 0;
				$testRes['mocktestmastery'] = 0;
				$sql = "SELECT * FROM ".MOCK_TEST_RESULT." MT INNER JOIN ".MOCK_QUESTION_MASTER." MQ ON MQ.mock_question_id=MT.question_id WHERE MT.student_id=".$student_id." AND MT.is_publish='Yes' AND MQ.mock_course_id=".$course_id."   GROUP BY added_time ORDER BY added_time DESC limit 0,5" ;
				$query = $this->db->query($sql);
				if($query->num_rows() > 0)
				{
				$result 	= $query->result_array();
				$testRes['result'] = 0;
				
 				foreach($result as $k=>$mockTestDetail){
					$this->db->select('count(*) total');
				        $this->db->from(MOCK_TEST_RESULT);
				        $this->db->where(array('added_time'=>$mockTestDetail['added_time']));
					$query = $this->db->get();
					$res   = $query->row();
					$testRes['attemp_question'] += $res->total;
					if($mockTestDetail['answer_no'] == '0' && $mockTestDetail['question_id'] == '0' && $mockTestDetail['answer_id'] == ''){
						$testRes['result'] += $testRes['result'];
					}else{
						$exam_result = $this->mockTestForOneExam($mockTestDetail['added_time'],$course_id);
						$testRes['result'] += $exam_result['passQuestionNo'];
					}
					
				}
				}
				if($testRes['attemp_question'] > 0){
				$testRes['mocktestmastery'] = ((($testRes['result']/$testRes['attemp_question'])*100)/500)*100;
				}
				return $testRes;
		}
		
}
?>