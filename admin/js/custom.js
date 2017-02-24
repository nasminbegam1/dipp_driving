// JavaScript Document

(function($) {
	$(document).ready(function() {

		            
		//-------------------- Delete -----------------

		$(".deleteitem")
		.unbind()
		.bind('click',function() {
			if(confirm("Are you sure to delete this record?")) {
				var url = $(this).attr('href');
				window.location.href = url;
			} else {
				return false;
			}
		});

//-------------------- Change status ------------------

		$(".changestatus")
			.unbind()
			.bind('click',function() {
			if(confirm("Are you sure to change status of this record?")) {
				var url = $(this).attr('href');
				window.location.href = url;
			} else {
				return false;
			}
		});

//-------------------- Logout ----------------------

		$(".logout")
		.unbind()
		.bind("click", function(event) {
			var curObj = $(this);
			var anchorLink = curObj.attr('href');
			event.preventDefault();
			if(confirm("Are you sure to logout from Admin Panel?")){
				window.location.href = anchorLink;
			} else {
				return false;
			}
		});


/*-------------  FOR ALERT OR MESSAGE DISPLAY -------------*/
$('.confirmDelete').click(function (e) {
        e.preventDefault();
        _targetUrl=$(this).attr("href");
        $("<div></div>").html("Are you sure to delete this record?").dialog({
            title: "Alert",
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                Ok: function () {
                    window.location.href =_targetUrl;
                 },
                Cancel: function () {
                    $(this).dialog("close");
                 }
            }
        });

});


$('.statusChange').click(function (e) {
        e.preventDefault();
        _targetUrl=$(this).attr("href");
        $("<div></div>").html("Are you sure to change status?").dialog({
            title: "Alert",
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                Ok: function () {
                    window.location.href =_targetUrl;
                 },
                Cancel: function () {
                    $(this).dialog("close");
                 }
            }
        });

});



$('#course_id').change(function() {
	var courseId=$(this).val();
	var postData= "action=getstep&step_type=learn&course_id="+courseId;
	$(this).after('<div class="loader" style="padding-top:50px;padding-left:75px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
	$.ajax({
	url: _baseUrl+"course/getStep",  
	type: 'POST',
	data: postData,
	success: function(sc) {
	      $('.loader').slideUp(200, function() {
		      $(this).remove();
	      });
	  $('#step_id')
	  .find('option')
	  .remove()
	  .end()
	  .append(sc);
	 //alert($('select#product_cat_id option:selected').val());
	}
       });
});

$('#step_id').change(function() {
	var stepId=$(this).val();
	var postData= "action=getstep&step_id="+stepId;
	$(this).after('<div class="loader" style="padding-top:50px;padding-left:75px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
	$.ajax({
	url: _baseUrl+"topic/getAllTopic",  
	type: 'POST',
	data: postData,
	success: function(opt) {
	      $('.loader').slideUp(200, function() {
		      $(this).remove();
	      });
	  $('#topic_id').find('option').remove().end().append(opt);
	}
       });
});

// For question section //

$('#question_course_id').change(function() {
	var courseId=$(this).val();
	var postData= "action=getstep&step_type=practice&course_id="+courseId;
	$(this).after('<div class="loader" style="padding-top:50px;padding-left:75px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
	$.ajax({
	url: _baseUrl+"course/getStep",  
	type: 'POST',
	data: postData,
	success: function(sc) {
	      $('.loader').slideUp(200, function() {
		      $(this).remove();
	      });
	  $('#question_step_id')
	  .find('option')
	  .remove()
	  .end()
	  .append(sc).trigger('change');
	 //alert($('select#product_cat_id option:selected').val());
	}
       });
});

$('#question_step_id').change(function() {
	var stepId=$(this).val();
	var postData= "action=getstep&step_id="+stepId;
	$(this).after('<div class="loader" style="padding-top:50px;padding-left:75px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
	$.ajax({
	url: _baseUrl+"topic/getAllTopic",  
	type: 'POST',
	data: postData,
	success: function(opt) {
	      $('.loader').slideUp(200, function() {
		      $(this).remove();
	      });
	  $('#question_topic_id').find('option').remove().end().append(opt).trigger('change');
	}
       });
});

$('#question_topic_id').change(function() {
	var topicId=$(this).val();
	var postData= "action=getmodule&topic_id="+topicId;
	$(this).after('<div class="loader" style="padding-top:50px;padding-left:75px;"><img src="'+_baseUrl+'images/ajax-loader002.gif" alt="loading subcategory" /></div>');
	$.ajax({
	url: _baseUrl+"question/getAllModule",  
	type: 'POST',
	data: postData,
	success: function(opt) {
	      $('.loader').slideUp(200, function() {
		      $(this).remove();
	      });
	  $('#question_module_id').find('option').remove().end().append(opt).trigger('change');
	}
       });
});


//$(".doc_type").click(function(){
//	if ($(this).val() == 'image')
//	{
//		$('#image_div').show();
//		$('#description_div').hide();
//	}
//	
//	if ($(this).val() == 'text')
//	{
//		$('#image_div').hide();
//		$('#description_div').show();
//	}
//})


/*--------------------------------------- END -----------------------------------------*/

//------------------------- End $(document).ready() -------------------
	});

})(jQuery);


function getQuestionByCourse(course_id){
    window.location.href=_baseUrl+"question/all/0/"+course_id;
}

function getMockTestQuestionByCourse(course_id){		
		window.location.href=_baseUrl+"mock-test/question/all/0/"+course_id;
}

function getModuleByCourse(course_id){		
		window.location.href=_baseUrl+"module/all/0/"+course_id;
}


function searchValidation(message)
  {
    if ( $("#search_keyword").val() == '')
    {
       custom_alert(message);
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
function show_all(url){ 
document.frmSearch.search_keyword.value = "";
document.frmSearch.action = url;
document.frmSearch.submit();
}
/*-------------  FOR ALERT OR MESSAGE DISPLAY -------------*/
function custom_alert(output_msg, title_msg)
{
    if (!title_msg)
        title_msg = 'Alert';

    if (!output_msg)
        output_msg = 'No Message to Display.';

    $("<div></div>").html(output_msg).dialog({
        title: title_msg,
        resizable: false,
        modal: true,
        buttons: {
            "Ok": function()
            {
                $( this ).dialog( "close" );
            }
        }
    });
}
$(function(){
	var i = $('#total_value').val();
	$('#addMoreDocumentType').click(function(){
		i = parseInt(i) + 1;
		$('#documentTypeContent').append("<div id='addRemoveDiv"+i+"'><div class='form_sep'><label for='reg_input_name' class='req'>Lesson Document Type</label><input type='radio' value='image' name='desc_type_"+i+"' class='doc_type' id='descTypeImage_"+i+"'>Image<input type='radio' value='text' name='desc_type_"+i+"' class='doc_type' id='descTypeText_"+i+"'>Text</div><a href='javascript:void(0)' id='removeDiv_"+i+"' class='removeDiv'>Remove</a><div class='form_sep' style='display:none;' id='image_div_"+i+"'><label for='reg_input_name' class='req'>Image</label><input type='file' class='form-control required' name='lesson_image_"+i+"' data-required='true'></div><div class='form_sep' style='display:none;' id='description_div_"+i+"'><label for='reg_input_name' class='req'>Description</label><textarea name='desc_content_"+i+"' class='form-control required'></textarea></div></div>");
		$('#total_value').val(i);
	});
	
	$(document).on('change','.doc_type',function(){
		var type_id = this.id;
		var type_count = type_id.split('_');
		if (type_count[0] == 'descTypeImage') {
			$('#image_div_'+type_count[1]).show();
			$('#description_div_'+type_count[1]).hide();
		}else{
			$('#image_div_'+type_count[1]).hide();
			$('#description_div_'+type_count[1]).show();
		}
	});
	$(document).on('click','.removeDiv',function(){
		var con = confirm('Are you sure?');
		if (con == true) {
		var removedId = this.id.split('_');
		$("#addRemoveDiv"+removedId[1]).remove();
		}
	});
	$(".doc_type:checked").each(function(){
		$(this).trigger('change');	
	});
	
});





