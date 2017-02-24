<?php
if(count($answer_all) > 0) {
$i=0;
foreach($answer_all as $answer_data) { 
$is_checked=($answer_data['is_answer'] == 'Y')?"checked":"";    
?>
<div id="content_inner"> 
<div class="col-sm-6">
    <label for="reg_input_answer" class="req"><b>Answer</b></label>
    <img src="<?php echo FILE_UPLOAD_URL?>question_answer/thumbs/<?php echo $answer_data['answer_text'];?>">
</div>
<div class="col-sm-1">
    <label for="reg_input_answer" class="req"><b>Correct</b></label>
    <input type="checkbox" class="form-control" name="is_answer[<?php echo $i;?>]" id="is_answer" value="Y" <?php echo $is_checked;?>>
</div>
 <?php if($i==0) {?>
<div class="col-sm-2">
    <label for="reg_input_answer">&nbsp;</label>
    <a class="add_field_button_image" href="">Add Answer</a>
</div>    
<?php } else {?>
<div class="col-sm-2">
    <label for="reg_input_answer">&nbsp;</label>
    <a href="" class="remove_field_image">Remove</a>
</div>
<?php } ?>    
</div>
<input type="hidden" name="answerid[<?php echo $i;?>]" value="<?php echo $answer_data['answer_id'];?>">
<input type="hidden" class="attr_val_image" name="hidden_answer_img[<?php echo $i;?>]" value="<?php echo $answer_data['answer_text'];?>">
<br class="spacer">
<?php $i++;} } else {?>
<div id="content_inner">  
<div class="col-sm-6">
    <label for="reg_input_answer" class="req"><b>Answer</b></label>
    <input type="file" class="attr_val_image required" name="answer[0]" id="answer" value="" data-required="true">
</div>
<div class="col-sm-1">
    <label for="reg_input_answer" class="req"><b>Correct</b></label>
    <input type="checkbox" class="form-control" name="is_answer[0]" id="is_answer" value="Y">
</div>
<div class="col-sm-2">
    <label for="reg_input_answer">&nbsp;</label>
    <a class="add_field_button_image" href="">Add More Fields</a>
</div>
</div>
<input type="hidden" name="answer_type" value="image">
<br class="spacer">
<?php } ?>
