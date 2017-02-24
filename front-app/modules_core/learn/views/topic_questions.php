<h3><?php echo $step_name;?></h3>
<form name="FrmQuestions" id="FrmQuestions" action="" method="post">
	 <input type="hidden" name="topic_id" id="topic_id" value="<?php echo $topic_id; ?>">
	 <table border="0" width="100%">
			<tr>
				 <td>
						<h4>1. Select the type of test you would like to take</h4>
						<table border="0" width="100%" class="moduletable">
							 <tr>
									<td>
									   <span id="topic_error" class="errormsgbox"></span>
										<div class="topiccomp">
										 <input type="radio" name="radio" item="all" class="rclass" value="<?php echo  $total_question." "; ?>" data-attr="<?php echo $total_incorrect_answer; ?>">&nbsp;&nbsp;
										 <b>Take a test on this complete lesson (<?php echo $total_module." "; ?> modules, <?php echo  $total_question." "; ?>questions)</b>
										</div>
										 <?php
										 if(is_array($modulesArr)){
												foreach($modulesArr as $mArr){
													 $_ModuleID= $mArr['module_id'];
													 $_ModuleName= $mArr['module_name'];
													 $_QuestionInModule= $mArr['total_qsn'];
                                                                                                         $_AnswerPercentage = $mArr['answer_percentage'];
													 ?>
                                                                                                        <div class="moduleoption"><input type="radio" name="radio" class="rclass" item="<?php echo $_ModuleID; ?>" value="<?php echo $_QuestionInModule." "; ?>" data-attr="<?php echo $mArr['total_incorrect_answer'];?>">&nbsp;&nbsp;<?php echo $_ModuleName; ?>(<?php echo $_QuestionInModule; ?>  questions)</div>
                                                                                                        <div class="percentagenumber"><div class="percentagetext"><?php echo $_AnswerPercentage.'%';?></div><div style="width:<?php echo $_AnswerPercentage.'%';?>;background:#ff0000;" class="percentagebar"></div></div>
													 <?php
												}
										 }
										 ?>
									</td>
							 </tr>
						</table>
				 </td>
			</tr>
			<tr>
				 <td>
						<h4>2. Now select the type of questions to answer from your selected module(s)</h4>
                                                <table border="0" width="100%" class="buttontable">
							 <tr>
									<td>
                                                                            <a id="allquestion" style="cursor: pointer;" class="modulebutton clearfix">All of the questions in the module(s)   <span class="modulesubmit"><em class='totquestion'><?php echo  $total_question." "; ?></em>questions</span></a>
										 <a id="allquestionstilltoscore" style="cursor: pointer;" class="modulebutton">Questions still to score <span class="modulesubmit"><em class='stillToScore'><?php echo  $total_incorrect_answer." "; ?></em>questions</span></a>
                                                                        </td>
							 </tr>
						</table>
				 </td>
			</tr>
	 </table>
</form>
<script type="text/javascript">
	 $(document).ready(function(){
			$('.rclass').click(function(){
				 var no_queston= $('input[name=radio]:checked').val();
				 var incorrect= $('input[name=radio]:checked').attr('data-attr');
				 $('.totquestion').html(no_queston);
				 $('.stillToScore').html(incorrect);
			});
			$('#allquestion').click(function(){
				 var selectedmodule= $('input[name=radio]:checked').attr('item');
				 if ( !($("input[name=radio]").is(':checked')) ){
					     $('#topic_error').html('Please select the type of test you would like to take');
					     return false;
				 }else{
				 var topic_id= $('#topic_id').val();
				 var base_url_suffix	= 'dipp_driving';
				 var base_url = location.protocol + '//' + location.host + '/'; 
				 //window.location.href= base_url+'learn/practice/questionList/'+topic_id+'/'+selectedmodule;
				 alert(selectedmodule);
				 window.location.href= base_url+'learn/practice/start_test/'+topic_id+'/'+selectedmodule;
				 }
			});
			$('#allquestionstilltoscore').click(function(){
			      var selectedmodule= $('input[name=radio]:checked').attr('item');
			      var incorrect= $('input[name=radio]:checked').attr('data-attr');
			      if ( !($("input[name=radio]").is(':checked')) ){
					  $('#topic_error').html('Please select the type of test you would like to take');
					  return false;
			      }else{
					     if (incorrect == 0) {
							    alert('There is no question to score');
							    return false;
					     }else{
					     var topic_id= $('#topic_id').val();
					     var base_url_suffix	= 'dipp_driving';
					     var base_url = location.protocol + '//' + location.host + '/'; 
					     //window.location.href= base_url+'learn/practice/questionList/'+topic_id+'/'+selectedmodule+'/stilltoscore';
					     window.location.href= base_url+'learn/practice/start_test/'+topic_id+'/'+selectedmodule+'/stilltoscore';
					     }
			      }
	                });
	 });
</script>