<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Practice extends MY_Controller {
    
    var $lessonMaster 	= LESSION_MASTER;
    var $lessonDetails 	= LESSION_DETAILS;
    var $lessonRead	= LESSION_READ;
    var $topicMaster	= TOPIC_MASTER;
   
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic','learn/model_learn','learn/model_practice'));
        $this->load->library('form_validation');
        $this->url = base_url().'practice/';
	$this->chk_student_login();
				//error_reporting(E_ALL);
    }

    public function openFancyBox(){
	    $data= array();
	    $student_id = $this->session->userdata('STUDENT_ID');
	    $step_id = $this->uri->segment(5,0);
	    $topic_id= $this->uri->segment(4,0);
	    $topic_details = $this->model_basic->detailsDB($this->topicMaster,'id ='.$topic_id,'id,step_id,name,short_description');
	    $data['step_name'] = $topic_details[0]['name'];
	    
	    $conditionArr = array('MM.topic_id' => $topic_id);
	    $modulesArr= $this->model_practice->getModule($conditionArr);
	    
	    $data['total_module']= count($modulesArr);
	    $total_question= 0;
	    $correct_answer   = 0;
	    $moduleIds = '';
	    for($i=0;$i<count($modulesArr);$i++){ 
		$moduleId=$modulesArr[$i]['module_id'];
		$conditionArr= array('student_id'=>$student_id,'module_id'=>$moduleId,'is_correct'=>'Yes');
		$correctAnswer=$this->model_practice->getCorrectAnswer($conditionArr);
		$answer_percentage = 0;
		$modulesArr[$i]['total_incorrect_answer'] = 0;
		if(is_array($correctAnswer) && count($correctAnswer) > 0){
		    $answer_percentage=(count($correctAnswer)/$modulesArr[$i]['total_qsn'])*100;
		    $modulesArr[$i]['total_incorrect_answer'] = $modulesArr[$i]['total_qsn']-count($correctAnswer);
		    $correct_answer += count($correctAnswer);
		}
		$answer_percentage = round($answer_percentage,2); 
		$modulesArr[$i]['answer_percentage']=$answer_percentage;
		
		$total_question= $total_question + $modulesArr[$i]['total_qsn'];		
		$moduleIds[]= $moduleId;
	    }
	    $data['total_incorrect_answer'] = $total_question - $correct_answer;
	    $data['total_question'] = $total_question;
	    $data['modulesArr']= $modulesArr;
	    if(is_array($moduleIds)){
	    $data['module_ids']= implode(",",$moduleIds);
	    }else{
	     $data['module_ids']= '';
	    }
	    $data['topic_id']= $topic_id;
	    echo $this->load->view('learn/topic_questions',$data,TRUE);
	    exit;
    }
		
		public function openFancyBoxTwo(){
				$data= array();
				$student_id = $this->session->userdata('STUDENT_ID');
				$topic_id= $this->uri->segment(4,0);
				$module_id= $this->uri->segment(5,0);
				$selected_module= $this->session->userdata('selected_module');
				$questionNoo = $this->model_basic->detailsDB('dipp_sitesettings',array('sitesettings_id'=>22),'sitesettings_value');
				if($selected_module == "all"){
				    $conditionArr = array('MM.topic_id' => $topic_id);
				    $totQuestionsArr= $this->model_practice->getTotalNoOfQuestion($conditionArr,'',$questionNoo[0]['sitesettings_value'] );
				    $conditionArr= array('topic_id'=> $topic_id, 'student_id' => $student_id);
				}
				else{
				    $conditionArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $selected_module);
				    $totQuestionsArr= $this->model_practice->getModuleWiseQuestion($conditionArr);
				    $conditionArr= array('topic_id'=> $topic_id, 'module_id'=> $module_id, 'student_id' => $student_id);
				}
				//pr($totQuestionsArr,0);
				//echo $totQuestionsArr[0]['topic_id']; 
				$conditiontopicArr = array('id' => $totQuestionsArr[0]['topic_id']);
				$data['topic_name'] = $this->model_practice->getTopicDetails($conditiontopicArr);
				$data['module_name']= $totQuestionsArr[0]['module_name']; 
				
				$noofquestion= count($totQuestionsArr);
				
				$data['view_summary']= $this->model_practice->getViewSummary($conditionArr);
				$countCom= 0;
				$countIncom= 0;
				$countCorrect= 0;
				$countInCorrect= 0;
				foreach($data['view_summary'] as $key){
						if($key['answer_id'] != 0){
								$countCom= $countCom+1;
						}
						//if($key[answer_id] == 0){
						//		$countIncom= $countIncom+1;
						//}
						if($key['is_correct'] == "Yes"){
								$countCorrect= $countCorrect+1;
						}
						if($key['is_correct'] == "No"){
								$countInCorrect= $countInCorrect+1;
						}
				}
				$incomQuestion= ($noofquestion-$countCom);
				$percentage= ($countCorrect/$noofquestion)*100;
				$data['topic_id']= $topic_id;
				$data['module_id']= $module_id;
				$data['complete_question']= $countCom; 
				$data['total_question']= $noofquestion;
				$data['incomplete_question']= $incomQuestion;
				$data['marks_percentage']= $percentage;
				$data['correct_answer']= $countCorrect;
				$data['incorrect_answer']= $countInCorrect;
				//pr($data);
				//pr($data['view_summary'],0);
			 
				echo $this->load->view('learn/review_questions',$data,TRUE);
				exit;
		}
		
		public function changeLesson(){
				$this->getTemplate();
				if($this->input->post('action')=="lesson_search"){
						$lesson_id= $this->input->post('lesson_id');
						$conditionArr= array('lesson_id' => $lesson_id);
						$lessonDetailsArr= $this->model_practice->getLessonDetails($conditionArr);
						$data['lessonDetailsArr']= $lessonDetailsArr;
						//pr($lessonDetailsArr,0);
						echo $this->load->view('learn/learning_new',$data,TRUE);
				}
				die();
		}

		
		public function questionList(){
				$student_id = $this->session->userdata('STUDENT_ID');
				$this->getTemplate();
				$data= array();
				$topic_id= $this->uri->segment(4,0);
				$this->session->set_userdata('topic_id',$topic_id);
				$selected_module= $this->uri->segment(5,0);
				$this->session->set_userdata('selected_module',$selected_module);
				$stilltoscore	= $this->uri->segment(6,0);
				if($stilltoscore != ''){
				    $this->session->set_userdata('stilltoscore',$stilltoscore);
				}else{
				    $this->session->set_userdata('stilltoscore','');
				}
				if($selected_module == "all"){
				    $conditionArr = array('MM.topic_id' => $topic_id);
				}
				else{
				    $conditionArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $selected_module);
				}
				
				$questionsArr= $this->model_practice->getModuleQuestionsDetails($conditionArr,$stilltoscore);
				//echo $this->db->last_query();
				//pr($questionsArr);
				$conditionLessonArr= array('topic_id' => $topic_id);
				$lessonArr= $this->model_practice->getLesson($conditionLessonArr);
				$data['lessonArr']= $lessonArr;
		
				$this->template->write_view('content','learn/learning_zone_one',$data);
				$this->template->render();
		}
		
		public function start_test(){
		    //start last page remove code
		    $student_id = $this->session->userdata('STUDENT_ID');
		    //$this->getTemplate();
		    $data= array();
		    $topic_id= $this->uri->segment(4,0);
		    $this->session->set_userdata('topic_id',$topic_id);
		    $selected_module= $this->uri->segment(5,0);
		    $this->session->set_userdata('selected_module',$selected_module);
		    $stilltoscore	= $this->uri->segment(6,0);
		    if($stilltoscore != ''){
			$this->session->set_userdata('stilltoscore',$stilltoscore);
		    }else{
			$this->session->set_userdata('stilltoscore','');
		    }
		    if($selected_module == "all"){
			$conditionArr = array('MM.topic_id' => $topic_id);
		    }
		    else{
			$conditionArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $selected_module);
		    }
		    
		    $questionsArr= $this->model_practice->getModuleQuestionsDetails($conditionArr,$stilltoscore);
		    //echo $this->db->last_query();
		    //pr($questionsArr);
		    $conditionLessonArr= array('topic_id' => $topic_id);
		    $lessonArr= $this->model_practice->getLesson($conditionLessonArr);
		    $data['lessonArr']= $lessonArr;
		    //end last page remove  code
		    
		    $data = array();
		    $data['details'] = $this->model_basic->detailsDB(CMS,array('cms_id'=>4),'cms_content');
		    //pr($data);
		    $this->getTemplate();
		    $this->template->write_view('content','learn/start_test',$data);
		    $this->template->render();
		}
		public function questionAnswerList(){
				$this->getTemplate();
				$data= array();
				$topic_id= $this->uri->segment(4,0); 
				$module_id= $this->uri->segment(5,0);
				$data['topic_id']= $topic_id;
				//$data['module_id']= $module_id;
				$this->session->set_userdata('topic_id',$topic_id);
				$selected_module= $this->uri->segment(5,0);
				$this->session->set_userdata('selected_module',$selected_module);
				
				$topic_name = $this->model_basic->detailsDB(TOPIC_MASTER,array('id'=>$topic_id),'name');
				$questionNoo = $this->model_basic->detailsDB('dipp_sitesettings',array('sitesettings_id'=>22),'sitesettings_value');
				$data['topic_name'] = $topic_name[0]['name'];
                                $stilltoscore	= $this->uri->segment(6,0);
				if($stilltoscore != ''){
				    $this->session->set_userdata('stilltoscore',$stilltoscore);
				}else{
				    $this->session->set_userdata('stilltoscore','');
				}
				
				if($selected_module == "all"){ 
				    $conditionArr = array('MM.topic_id' => $topic_id);
                                    $totQuestionsArr= $this->model_practice->getTotalNoOfQuestion($conditionArr,$stilltoscore,$questionNoo[0]['sitesettings_value'] );
				    $data['module_id']= $selected_module;
				}else{ 
				    $conditionArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $module_id);
                                    $totQuestionsArr= $this->model_practice->getModuleWiseQuestion($conditionArr,$stilltoscore);
				    $data['module_id']= $module_id;
				}
				//echo $this->db->last_query();
				//pr($totQuestionsArr);
				$noofquestion= count($totQuestionsArr);
				$this->session->set_userdata('numqusetion',$noofquestion);
				$data['noofquestion']= $this->session->userdata('numqusetion');
				
				$questionsArr= $this->model_practice->getModuleQuestionsDetails($conditionArr,$stilltoscore,$questionNoo[0]['sitesettings_value']);
				//echo count($questionsArr);
                                //pr($questionsArr);
				foreach($questionsArr as $val)
				{
				    $incorrect_question_arr[]=$val['question_id'];
				}
				$this->session->set_userdata('incorrect_question',$incorrect_question_arr);
				//print_r($incorrect_question_arr);
				
				$data['questionsArr']= $questionsArr;
				
				$cond= array('question_id' => $questionsArr[0]['question_id']);
				$answerArr= $this->model_practice->getAnswerOptions($cond);
				$data['answerArr']= $answerArr;
				
				$cond= array('question_id' => $questionsArr[0]['question_id'],'is_answer' => 'Y');
				$answerCorrArr= $this->model_practice->getAnswerOptions($cond);
				$data['answerCorrArr']= count($answerCorrArr);
				
				//pr($data);
				
				if($selected_module == "all"){
						$this->template->write_view('content','learn/question_zone_all',$data);
				}
				else{
						$this->template->write_view('content','learn/question_zone',$data);
				}
				$this->template->render();
		}
		
		
		public function changeQuestion(){
				$data=array();
				if($this->input->post('action')=="question_search"){
						$student_id= $this->session->userdata('STUDENT_ID');
						$module_id= $this->input->post('module_id');
						$question_id= $this->input->post('question_id'); 
						$topic_id= $this->input->post('topic_id');
						$offset_val= $this->input->post('offset');
						$answerGivenId= $this->input->post('answer_id');
						$is_del= $this->input->post('is_del');
						$stilltoscore = $this->input->post('stilltoscore');
                                                $ans = '';
						if($answerGivenId == ""){
						    $answerGivenId= 0;
						}
						else{
						    if (strpos($answerGivenId,',') !== false) {
							$ans= explode(",",$answerGivenId);
						    }
						    else{
							$ans[]= $answerGivenId;
						    }
						}
						
						$condArr= array('question_id' => $question_id);
						$answerArrOne= $this->model_practice->getAnswerOptions($condArr);
						foreach($answerArrOne as $ansArr){
						    if($ansArr['is_answer']== 'Y'){
							$rightAnsArr= array();
							$rightAnsArr[]= $ansArr['answer_id'];  
						    }
						}
						
						if(count($ans) == count($rightAnsArr) && $answerGivenId!= 0){
						    $arr1= array_values($ans);
						    $arr2= array_values($rightAnsArr);
						    $arr= array_diff($arr1,$arr2);
						    if(empty($arr)){
								    $isCorrect= 'Yes';
						    }
						    else{
								    $isCorrect= 'No';
						    }
						}
						else{
						    $isCorrect= 'No';
						}
						
						if($stilltoscore == '' && $is_del == 1 && $this->input->post('step') == "next"){
						    $conditionArr= array('topic_id' => $topic_id,'module_id' => $module_id,'student_id' => $student_id);
						    $this->model_practice->delQuestionAnswerSet($conditionArr);
						}
						
						if($this->input->post('step') == "next"){
						    $condition_arr= array('topic_id' => $topic_id,'module_id' => $module_id,'student_id' => $student_id,'question_id' => $question_id);
						    $returnresult= $this->model_practice->checkExistQuestionAnswer($condition_arr);
								
						    if(empty($returnresult)){
							    $insert_arr = array('student_id'		=> $student_id,
										'topic_id'		=> $topic_id,
										'module_id'		=> $module_id,
										'question_id'		=> $question_id,
										'answer_id'		=> $answerGivenId,
										'is_correct' 		=> $isCorrect,
										'date_added'		=> date('Y-m-d h:i:s'));
										$last_id= $this->model_practice->insertQuestionAnswerSet($insert_arr);
						    }else{
							    $update_arr = array('answer_id'	=> $answerGivenId,
										'is_correct' 	=> $isCorrect,
										'date_added'	=> date('Y-m-d h:i:s')
														);
							    $this->model_practice->updateQuestionAnswerSet($update_arr,$condition_arr);
						    }
						}
					
						$conditionArr= array('QM.module_id' => $module_id);
						$questionsArr= $this->model_practice->getModuleQuestionsNext($conditionArr,$offset_val,$stilltoscore);
						//$data['query'] = $this->db->last_query();
						$data['questionsArr']= $questionsArr;
						
						$cond= array('question_id' => $questionsArr[0]['question_id']);
						$answerArr= $this->model_practice->getAnswerOptions($cond);

						$data['answerArr']= $answerArr;
                                                                    
						$cond= array('question_id' => $questionsArr[0]['question_id'],'is_answer' => 'Y');
						$answerCorrArr= $this->model_practice->getAnswerOptions($cond);
						$data['answerCorrArr']= count($answerCorrArr);
						
						$question_id= $questionsArr[0]['question_id'];
						$conditionArr= array('question_id' => $question_id,'student_id' => $student_id);
						$given_answer= $this->model_practice->getAnswers($conditionArr);
						$ans = '';
						foreach($given_answer as $key){
						    $answer= $key['answer_id'];
						    if (strpos($answer,',') !== false) {
							$ans= explode(",",$answer);
						    }
						    else{
							$ans[]= $answer;
						    }
						}
						$data['given_answer']= $ans;
						$data['stilltoscore'] = $stilltoscore;
				}
				
				$data['question_zone']=$this->load->view('learn/change_question_zone',$data,TRUE);
				$data['question_id']= $questionsArr[0]['question_id'];
				
				echo json_encode($data);
				exit;
		}
		
		
		public function changeQuestionAll(){ 
				$data=array();
				
				if($this->input->post('action')=="question_all"){
						$student_id= $this->session->userdata('STUDENT_ID');
						$module_id= $this->input->post('module_id');
						$question_id= $this->input->post('question_id');
						$answerGivenId= $this->input->post('answer_id');
						$topic_id= $this->input->post('topic_id');
						$offset_val= $this->input->post('offset');
						$is_del= $this->input->post('is_del');
                                                $stilltoscore = $this->input->post('stilltoscore');
						$ans = '';
						if($answerGivenId == ""){
								$answerGivenId= 0;
						}
						else{
								if (strpos($answerGivenId,',') !== false) {
										$ans= explode(",",$answerGivenId);
								}
								else{
										$ans[]= $answerGivenId;
								}
						}
						
						$condArr= array('question_id' => $question_id);
						$answerArrOne= $this->model_practice->getAnswerOptions($condArr);
						foreach($answerArrOne as $ansArr){
								if($ansArr['is_answer']== 'Y'){
										$rightAnsArr= array();
										$rightAnsArr[]= $ansArr['answer_id'];  
								}
						}

						if(count($ans) == count($rightAnsArr) && $answerGivenId!= 0){
								$arr1= array_values($ans);
								$arr2= array_values($rightAnsArr);
								$arr= array_diff($arr1,$arr2);
								if(empty($arr)){
										$isCorrect= 'Yes';
								}
								else{
										$isCorrect= 'No';
								}
						}
						else{
								$isCorrect= 'No';
						}

						if($stilltoscore == '' && $is_del == 1 && $this->input->post('step') == "next"){
								$conditionArr= array('topic_id' => $topic_id,'student_id' => $student_id);
								$this->model_practice->delQuestionAnswerSet($conditionArr);
						}
						
						if($this->input->post('step') == "next"){
								$condition_arr= array('topic_id' => $topic_id,'module_id' => $module_id,'student_id' => $student_id,'question_id' => $question_id);
								$returnresult= $this->model_practice->checkExistQuestionAnswer($condition_arr);
								
						    if(empty($returnresult)){
							$insert_arr = array('student_id'		=> $student_id,
									    'topic_id'		=> $topic_id,
									    'module_id'		=> $module_id,
									    'question_id'	=> $question_id,
									    'answer_id'		=> $answerGivenId,
									    'is_correct' 	=> $isCorrect,
									    'date_added'	=> date('Y-m-d h:i:s'));
							$last_id= $this->model_practice->insertQuestionAnswerSet($insert_arr);
						    }else{
							$update_arr = array('answer_id'		=> $answerGivenId,
									    'is_correct' 	=> $isCorrect,
									    'date_added'	=> date('Y-m-d h:i:s'));
							$this->model_practice->updateQuestionAnswerSet($update_arr,$condition_arr);
						    }
						}
						
						$conditionArr = array('MM.topic_id' => $topic_id);
						$questionsArr= $this->model_practice->getModuleWiseQuestionAll($conditionArr,$offset_val,$stilltoscore);
						$data['questionsArr']= $questionsArr;
						
						$cond= array('question_id' => $questionsArr[0]['question_id']);
						$answerArr= $this->model_practice->getAnswerOptions($cond);
						$data['answerArr']= $answerArr;
						
						$cond= array('question_id' => $questionsArr[0]['question_id'],'is_answer' => 'Y');
						$answerCorrArr= $this->model_practice->getAnswerOptions($cond);
						$data['answerCorrArr']= count($answerCorrArr);

						$question_id= $questionsArr[0]['question_id'];
						$conditionArr= array('question_id' => $question_id);
						$given_answer= $this->model_practice->getAnswers($conditionArr);
						foreach($given_answer as $key){
								$answer= $key['answer_id'];
								if (strpos($answer,',') !== false) {
										$ans= explode(",",$answer);
								}
								else{
										$ans[]= $answer;
								}
						}
						$data['given_answer']= $ans;
                                                $data['stilltoscore'] = $stilltoscore;
				}

				$data['question_zone']=$this->load->view('learn/change_question_zone',$data,TRUE);
				$data['question_id']= $questionsArr[0]['question_id'];
				$data['module_id']= $questionsArr[0]['module_id'];
				echo json_encode($data);
				exit;		
		}
		
		public function viewSummary(){
				$data=array();
				if($this->input->post('action')=="question_search"){
						$student_id= $this->session->userdata('STUDENT_ID');
						$module_id= $this->input->post('module_id');
						$question_id= $this->input->post('question_id'); 
						$topic_id= $this->input->post('topic_id');
						$offset_val= $this->input->post('offset');
						$answerGivenId= $this->input->post('answer_id');
						$totalquestion= $this->input->post('total_question');
						$this->session->set_userdata('totalnoofquestion',$totalquestion+1);
						
						if($answerGivenId == ""){
						    $answerGivenId= 0;
						}
						else{
						    if (strpos($answerGivenId,',') !== false) {
							$ans= explode(",",$answerGivenId);
						    }
						    else{
							$ans[]= $answerGivenId;
						    }
						}
						
						$condArr= array('question_id' => $question_id);
						$answerArrOne= $this->model_practice->getAnswerOptions($condArr);
						foreach($answerArrOne as $ansArr){
						    if($ansArr['is_answer']== 'Y'){
							$rightAnsArr= array();
							$rightAnsArr[]= $ansArr['answer_id'];  
						    }
						}
						
						if(count($ans) == count($rightAnsArr) && $answerGivenId!= 0){
						    $arr1= array_values($ans);
						    $arr2= array_values($rightAnsArr);
						    $arr= array_diff($arr1,$arr2);
						    if(empty($arr)){
							$isCorrect= 'Yes';
						    }
						    else{
							$isCorrect= 'No';
						    }
						}
						else{
						    $isCorrect= 'No';
						}
						
						$condition_arr= array('topic_id' => $topic_id,'module_id' => $module_id,'student_id' => $student_id,'question_id' => $question_id);
						$returnresult= $this->model_practice->checkExistQuestionAnswer($condition_arr);
						
						if(empty($returnresult)){
						    $insert_arr = array('student_id'		=> $student_id,
									'topic_id'		=> $topic_id,
									'module_id'		=> $module_id,
									'question_id'		=> $question_id,
									'answer_id'		=> $answerGivenId,
									'is_correct' 		=> $isCorrect,
									'date_added'		=> date('Y-m-d h:i:s'));
									
								$last_id= $this->model_practice->insertQuestionAnswerSet($insert_arr);
						}
						else{
								$update_arr = array(
										'answer_id'	=> $answerGivenId,
										'is_correct' 	=> $isCorrect,
										'date_added'	=> date('Y-m-d h:i:s')
								);
								$this->model_practice->updateQuestionAnswerSet($update_arr,$condition_arr);
						}
						echo 'Ok';
						exit;
				}
		}
		
		
		public function answerResult(){
				$this->getTemplate();
				$data= array();
				//$totalnoofquestion= $this->session->userdata('totalnoofquestion'); 
				$topic_id= $this->uri->segment(4,0); 
				$module_id= $this->uri->segment(5,0);
				$student_id= $this->session->userdata('STUDENT_ID');
				$selected_module= $this->session->userdata('selected_module');
				$questionNoo = $this->model_basic->detailsDB('dipp_sitesettings',array('sitesettings_id'=>22),'sitesettings_value');
				if($selected_module == "all"){ 
						$conditionArr= array('topic_id'=> $topic_id, 'student_id' => $student_id);
						$data['module_id']= $selected_module;
						$condArr = array('MM.topic_id' => $topic_id);
						$totQuestionsArr= $this->model_practice->getTotalNoOfQuestion($condArr,'',$questionNoo[0]['sitesettings_value']);
				}
				else{ 
						$conditionArr= array('topic_id'=> $topic_id, 'module_id'=> $module_id, 'student_id' => $student_id);
						$data['module_id']= $module_id;
						$condArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $module_id);
						$totQuestionsArr= $this->model_practice->getModuleWiseQuestion($condArr);
				}
				$data['view_summary']= $this->model_practice->getViewSummary($conditionArr);
				$noofquestion= count($totQuestionsArr);
				//pr($totQuestionsArr,0); 
				//pr($data['view_summary'],0);
				//$this->session->set_userdata("viewsummary",$data['view_summary']);
				
				$countCom= 0;
				$countIncom= 0;
				$countCorrect= 0;
				$countInCorrect= 0;
				foreach($data['view_summary'] as $key){
				    if($key['answer_id'] != 0){
						    $countCom= $countCom+1;
				    }
				    //if($key[answer_id] == 0){
				    //		$countIncom= $countIncom+1;
				    //}
				    if($key['is_correct'] == "Yes"){
						    $countCorrect= $countCorrect+1;
				    }
				    if($key['is_correct'] == "No"){
						    $countInCorrect= $countInCorrect+1;
				    }
				}
				//$noofquestion= count($data['view_summary']);
				$percentage= ($countCorrect/$noofquestion)*100;
				$data['complete_question']= $countCom; 
				$data['total_question']= $noofquestion;
				$data['marks_percentage']= $percentage;
				$data['incomplete_question']= ($noofquestion-$countCom);
				$data['correct_answer']= $countCorrect;
				$data['incorrect_answer']= $countInCorrect;
				$data['topic_id']= $topic_id;
				$data['module_id']= $module_id;
				//pr($data);
				
				$this->template->write_view('content','learn/result_zone',$data);
				$this->template->render();
		}
		
		public function resultSummary(){
				$this->getTemplate();
				$data= array();
				$topic_id= $this->uri->segment(4,0); 
				$module_id= $this->uri->segment(5,0);				
				$student_id= $this->session->userdata('STUDENT_ID');
				//$totalnoofquestion= $this->session->userdata('totalnoofquestion'); 
				$selected_module= $this->session->userdata('selected_module');
				$questionNoo = $this->model_basic->detailsDB('dipp_sitesettings',array('sitesettings_id'=>22),'sitesettings_value');
				if($selected_module == "all"){
						$conditionArr= array('topic_id'=> $topic_id, 'student_id' => $student_id);
						$data['module_id']= $selected_module;
						$condArr = array('MM.topic_id' => $topic_id);
						$totQuestionsArr= $this->model_practice->getTotalNoOfQuestion($condArr,'',$questionNoo[0]['sitesettings_value']);
				}
				else{
						$conditionArr= array('topic_id'=> $topic_id, 'module_id'=> $module_id, 'student_id' => $student_id);
						$data['module_id']= $module_id;
						$condArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $module_id);
						$totQuestionsArr= $this->model_practice->getModuleWiseQuestion($condArr);
				}
				$noofquestion= count($totQuestionsArr);
				$data['view_summary']= $this->model_practice->getViewSummary($conditionArr);
				
				$countCom= 0;
				$countIncom= 0;
				$countCorrect= 0;
				$countInCorrect= 0;
				foreach($data['view_summary'] as $key){
						if($key['answer_id'] != 0){
								$countCom= $countCom+1;
						}
						//if($key[answer_id] == 0){
						//		$countIncom= $countIncom+1;
						//}
						if($key['is_correct'] == "Yes"){
								$countCorrect= $countCorrect+1;
						}
						if($key['is_correct'] == "No"){
								$countInCorrect= $countInCorrect+1;
						}
				}
			//	$noofquestion= count($data['view_summary']);
				$percentage= ($countCorrect/$noofquestion)*100;
				$data['complete_question']= $countCom; 
				$data['total_question']= $noofquestion;
				$data['marks_percentage']= $percentage;
				$data['incomplete_question']= ($noofquestion-$countCom);
				$data['correct_answer']= $countCorrect;
				$data['incorrect_answer']= $countInCorrect;
				$data['topic_id']= $topic_id;
				$data['module_id']= $module_id;
				
				foreach($data['view_summary'] as $key){ 
						$is_correct= $key['is_correct'];
						if($is_correct == "No"){ 
								$question_id= $key['question_id'];
								$conditionArr= array('QM.question_id' => $question_id);
								$wrongQuestionArr[]= $this->model_practice->getWrongQuestionAnswerDetails($conditionArr);
								$givenAnswerArr[]= $this->model_practice->getAnswerSheetDetails($question_id);
								//$wrongQuestionArr[]= $this->model_practice->getWrongQuestionAnswerDetails($question_id);
						}
				}
				
				$data['givenAnswerArr']= $givenAnswerArr;
				$data['wrongQuestionArr']= $wrongQuestionArr;
				//pr($data);
				//pr($wrongQuestionArr,0);
				
				$this->template->write_view('content','learn/summary_zone',$data);
				$this->template->render();
		}

}