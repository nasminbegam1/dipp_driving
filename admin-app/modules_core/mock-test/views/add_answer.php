<script>
$(document).ready(function(){
/***** For Add More section ******/ 
var wrapper         = $("#content-2"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID

$(document).on("click",".add_field_button",function(e){ //on add input button click
var x = $('.attr_val').length;//initlal text box count    
e.preventDefault();
x++; //text box increment
$(wrapper).append('<div id="content_inner"><div class="col-sm-6"><label for="reg_input_answer"><b>Answer</b></label><input type="text" class="form-control required attr_val" name="answer['+x+']" id="answer" value="" data-required="true"></div><div class="col-sm-1"><label for="reg_answer_correct"><b>Correct</b></label><input type="checkbox" class="form-control" name="is_answer['+x+']" id="is_answer" value="Y"></div><div class="col-sm-2"><label for="reg_input_answer">&nbsp;</label><a href="" class="remove_field">Remove</a></div></div><br class="spacer">');
});
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text 
e.preventDefault(); 
//$(this).closest('div.form_sep').remove();
$(this).parent().parent().remove(); // x--;
})


/***** For Add More section ******/ 
var wrapper = $("#content-2"); //Fields wrapper


$(document).on("click",".add_field_button_image",function(e){ //on add input button click
var x = $('.attr_val_image').length;//initlal text box count    
e.preventDefault();
x++; //text box increment
$(wrapper).append('<div id="content_inner"><div class="col-sm-6"><label for="reg_input_answer"><b>Answer</b></label><input type="file" class="required attr_val_image" name="answer['+x+']" id="answer" data-required="true"></div><div class="col-sm-1"><label for="reg_answer_correct"><b>Correct</b></label><input type="checkbox" class="form-control" name="is_answer['+x+']" id="is_answer" value="Y"></div><div class="col-sm-2"><label for="reg_input_answer">&nbsp;</label><a href="" class="remove_field_image">Remove</a></div></div><br class="spacer">');
});
$(wrapper).on("click",".remove_field_image", function(e){ //user click on remove text 
e.preventDefault(); 
//$(this).closest('div.form_sep').remove();
$(this).parent().parent().remove(); // x--;
})

$(".answersubmit").on("click",function(){
    var count_checked = $('#frmAnswer input[type="checkbox"]:checked').length;
    if (count_checked == 0){
        custom_alert("Please check at least one correct answer");
        return false;
    }
    
});




$('.answertype').on("click",function() {
var questionId='<?php echo $question_id;?>';
var answerType=$(this).val();
var postData= "action=getanswer&type="+answerType+"&question_id="+questionId;
//$(this).after('<div class="loader" style="padding-top:50px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
$('#content-2').html('<img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" />');
$.ajax({
url: _baseUrl+"mock-test/answer/getAllAnswer",  
type: 'POST',
data: postData,
success: function(opt) {
  setTimeout(function () {   
  $('#content-2').html(opt);
  }, 1000);
}
});
});

})

$(function(){
  $('input[name="answer_type"]:checked').click();
});
</script> 


<script>
$(document).ready(function(){
/***** For Add More section ******/ 
var wrapper         = $("#content-2"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID

var x = $('.attr_val').length;//initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
x++; //text box increment
$(wrapper).append('<div id="content_inner"><div class="col-sm-6"><label for="reg_input_answer">&nbsp;</label><input type="text" class="form-control required attr_val" name="answer['+x+']" id="answer" value="" data-required="true"></div><div class="col-sm-1"><label for="reg_answer_correct">&nbsp;</label><input type="checkbox" class="form-control" name="is_answer['+x+']" id="is_answer" value="Y"></div><div class="col-sm-2"><label for="reg_input_answer">&nbsp;</label><a href="" class="remove_field">Remove</a></div></div><br class="spacer">');
});
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text 
e.preventDefault(); 
//$(this).closest('div.form_sep').remove();
$(this).parent().parent().remove(); // x--;
})

$("#frmAnswer").submit(function(){
    var count_checked = $("#frmAnswer input:checked").length;
    if (count_checked == 0){
        custom_alert("Please check at least one correct answer");
        return false;
    }
    
});

})
</script> 
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Answer</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>mock-test/answer/add/<?php echo $question_id;?>" class="form-validate main parsley_reg" id="frmAnswer" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name"><b>Question</b></label>
                                    <?php echo $question;?>
                                <?php if($question_image <> '') { ?>
                                &nbsp;<img src="<?php echo FILE_UPLOAD_URL?>question/mock_test/thumbs/<?php echo $question_image;?>" border="0">
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <label>Answer Type</label>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="text" name="answer_type" class="answertype" <?php if($get_answer_type == 'text') echo "checked";?>>
                                        Text
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="image" name="answer_type" class="answertype" <?php if($get_answer_type == 'image') echo "checked";?>>
                                        Image
                                    </label>
                                </div>
                            </div>
                            <br class="spacer">
                            <div id="content-2" style="padding-top:10px;">&nbsp;</div>
                            <!--<div id="content-2" style="padding-top:10px;">
                                    <?php
                                    if(count($answer_all) > 0) {
                                    $i=1;
                                    foreach($answer_all as $answer_data) {
                                    $is_checked=($answer_data['mock_is_answer'] == 'Y')?"checked":"";    
                                    ?>
                                    <div id="content_inner"> 
                                    <div class="col-sm-6">
                                        <label for="reg_input_answer" class="req"><b>Answer</b></label>
                                        <input type="text" class="form-control attr_val required" name="answer[<?php echo $i;?>]" id="answer" value="<?php echo $answer_data['mock_answer_text'];?>" data-required="true">
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="reg_input_answer" class="req"><b>Correct</b></label>
                                        <input type="checkbox" class="form-control" name="is_answer[<?php echo $i;?>]" id="is_answer" value="Y" <?php echo $is_checked;?>>
                                    </div>
                                    <?php if($i==1) {?>
                                    <div class="col-sm-2">
                                        <label for="reg_input_answer">&nbsp;</label>
                                        <a class="add_field_button" href="">Add Answer</a>
                                    </div>    
                                    <?php } else {?>
                                    <div class="col-sm-2">
                                        <label for="reg_input_answer">&nbsp;</label>
                                        <a href="" class="remove_field">Remove</a>
                                    </div>
                                    <?php } ?>    
                                    </div>
                                    <br class="spacer">
                                    <?php $i++;} } else {?>
                                   <div id="content_inner">  
                                   <div class="col-sm-6">
                                        <label for="reg_input_answer" class="req"><b>Answer</b></label>
                                        <input type="text" class="form-control required" name="answer[0]" id="answer" value="" data-required="true">
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="reg_input_answer" class="req"><b>Correct</b></label>
                                        <input type="checkbox" class="form-control" name="is_answer[0]" id="is_answer" value="Y">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="reg_input_answer">&nbsp;</label>
                                        <a class="add_field_button" href="">Add More Fields</a>
                                    </div>
                                   </div>
                                    <br class="spacer">
                                    <?php } ?>
                            </div>-->
                            <div class="col-sm-4" style="padding-top:4px;">
                                <button class="btn btn-default" type="submit">Submit</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>