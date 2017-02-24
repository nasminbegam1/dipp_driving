<h3>Select <?php if($answerCorrArr==1){echo 'One';}elseif($answerCorrArr==2){echo 'Two';}elseif($answerCorrArr==3){echo 'Three';}elseif($answerCorrArr==4){echo 'Four';}else{echo 'Five';}?> answer</h3>
<div class="questionLeft clearfix">
<?php
$moduleID= $questionsArr[0]['module_id'];
$questionID= $questionsArr[0]['question_id'];
//$topicID= $questionsArr[0]['topic_id'];
$questionName= $questionsArr[0]['question_text'];
$questionImage= $questionsArr[0]['question_image'];
?>
<div class="questionSec<?php echo ($questionsArr[0]['question_image'] == '')?' questionWithoutImage':'';?>">    
<p><strong><?php echo stripslashes($questionName); ?></strong></p>
<?php if($questionsArr[0]['question_image'] != ''){ ?>
        <div class="quesImage"><img src="<?php echo base_url().'uploads/question/'.$questionsArr[0]['question_image']; ?>"></div>
<?php } ?>
</div>        
<div class="example">
    <ul class="Questionzone">
	<?php
	if(is_array($answerArr)){
	    foreach($answerArr as $aArr){
		$_AnswerType= $aArr['answer_type'];
		$_Answer= $aArr['answer_text'];
		$_AnswerID= $aArr['answer_id'];
		//pr($given_answer);
	?>
		<li>    
		    <div class="answerzone">
			<input id="chkAnswer_<?php echo $_AnswerID; ?>" type="checkbox" class="Checkbox" name="chkAnswer[]" value="<?php echo $_AnswerID; ?>" <?php if(is_array($given_answer)){for($i=0;$i<count($given_answer);$i++){ if($given_answer[$i] == $_AnswerID){ echo "Checked"; }}} ?>>
			<label for="checkbox_<?php echo $_AnswerID; ?>"><span></span></label>
		    </div>
		    <strong>
			<?php if($_AnswerType == 'text') { echo stripslashes($_Answer); } ?>
			<?php if($_AnswerType == 'image') { ?>
			<img src="<?php echo base_url().'uploads/question_answer/'.$_Answer; ?>">
			<?php } ?>
		    </strong>     
		</li>    
	<?php
	    }
	}
	?>
    </ul>
</div>

</div>