// JavaScript Document

(function($) {
$(document).ready(function() {
    
    $('#search_submit').click(function(){
    var search_text = $('#search_text').val();
    if (search_text == '') {
	$('#search_text_error').html('Please enter zipcode');
    }else{
	$('#search_text_error').html('');
	$.ajax({
	  type: "POST",
	  dataType : 'json',
	  url: _baseUrl+'home/getDetails', // preview.php
	  data: 'search_text='+search_text, // all form fields
	  success: function (data) {
	    if (data.type == 'error') {
		$('#search_text_error').html(data.message);
	    }else{
		$('#search_text_error').html('');
		window.location.href = _baseUrl+'home/get_instractor/'+data.zipCode;
		//var response = data.res;
		//var str = '<ul class="showDetails">';
		//$.each(response,function(index,value){
		//    str += '<li data-title="<b>Phone No : </b>'+value.instructor_phone_number+'<br><b>Email : </b>'+value.instructor_email+'"><span>'+value.instructor_fname+' '+value.instructor_lname+'</span><span class="business_name">'+value.instructor_business_name+'</span><span>'+value.zip_code+'</span></li>';
		//});
		//str += '</ul>';
		//$('#search_result').html(str);
		//
		// $(".showDetails span.business_name").bind({
		//    mousemove : changeTooltipPosition,
		//    mouseenter : showTooltip,
		//    mouseleave: hideTooltip
		// });
	    }
	  } // success
	}); // ajax
	
    }
    
     
     
});
//    $('.business_name').mousemove(function(){
//	alert('hi');
//    })
    
    
    $('#clear_result').click(function(){
	$('#search_result').html('');
	$('#search_text_error').html('');
	$('#search_text').val('');
    });
    
/*------------------------------Student Car Login----------------------------------*/

    $("#studentCarLogin").validate({
        // Specify the validation rules
        rules: {
            student_email			: {required:true, email : true},
            student_password			: "required",
	    student_username			: "required"
        },
        
        // Specify the validation error messages
        messages: {
            student_email		: {required : "Please enter student email address",
					    email : 'Please enter valid email address'},
            student_password		: "Please enter student password",
	    student_username		: "Please enter Business Code"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

    
/*------------------------------Student Bike Login----------------------------------*/

    $("#studentBikeLogin").validate({
        // Specify the validation rules
        rules: {
            student_email			: {required:true, email : true},
            student_password			: "required",
	    student_username			: "required"
        },
        
        // Specify the validation error messages
        messages: {
            student_email		: {required : "Please enter student email address",
					    email : 'Please enter valid email address'},
            student_password		: "Please enter student password",
	    student_username		: "Please enter Business Code"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

/*------------------------------Instructor Car Login----------------------------------*/

    $("#instructorCarLogin").validate({
        // Specify the validation rules
        rules: {
            instructor_email			: {required:true, email : true},
            instructor_password			: "required"
        },
        
        // Specify the validation error messages
        messages: {
            instructor_email		: {required : "Please enter instructor email address",
					    email : 'Please enter valid email address'},
            instructor_password		: "Please enter instructor password"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*------------------------------Instructor Bike Login----------------------------------*/

    $("#instructorBikeLogin").validate({
        // Specify the validation rules
        rules: {
            instructor_email			: {required:true, email : true},
            instructor_password			: "required"
        },
        
        // Specify the validation error messages
        messages: {
            instructor_email		: {required : "Please enter instructor email address",
					    email : 'Please enter valid email address'},
            instructor_password		: "Please enter instructor password"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*--------------------------------------Student Edit Profile validation--------*/

    $("#editProfile").validate({
        // Specify the validation rules
        rules: {
            student_fname			: "required",
            student_lname			: "required"
        },
        
        // Specify the validation error messages
        messages: {
            student_fname		: "Please enter student first name",
            student_lname		: "Please enter student last name",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/***********************Instractor edit profile*********************/

    $("#editInstractorProfile").validate({
        // Specify the validation rules
        rules: {
            instructor_business_name		: "required",
            instructor_fname			: "required",
	    instructor_lname			: "required"
        },
        
        // Specify the validation error messages
        messages: {
	    instructor_business_name	: "Please enter business name",
            instructor_fname		: "Please enter first name",
            instructor_lname		: "Please enter last name",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

/*************Student Change Password *****************/

    $("#changePassword").validate({
        // Specify the validation rules
        rules: {
            current_password			: "required",
            new_password			: "required",
	    confirm_password               	:   {
						     required: true,
						     equalTo: "#new_password"
						    }
        },
        
        // Specify the validation error messages
        messages: {
            current_password		: "Please enter current password",
            new_password		: "Please enter new password",
	    confirm_password       	:   {
					    required: "Please enter confirm password",
					    equalTo: "Please enter the same password as above"
					}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*************Instractor Change Password *****************/

    $("#changeInsPassword").validate({
        // Specify the validation rules
        rules: {
            current_password			: "required",
            new_password			: "required",
	    confirm_password               	:   {
						     required: true,
						     equalTo: "#new_password"
						    }
        },
        
        // Specify the validation error messages
        messages: {
            current_password		: "Please enter current password",
            new_password		: "Please enter new password",
	    confirm_password       	:   {
					    required: "Please enter confirm password",
					    equalTo: "Please enter the same password as above"
					}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*************Student Reset Password *****************/  
    $("#sendResetLink").validate({
        // Specify the validation rules
        rules: {
	    student_email :   {required: true,email: true }
        },
        
        // Specify the validation error messages
        messages: {
            student_email : {
				required : "Please enter student email address",
				email    : "Please enter valid email address"
			    }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

    /*************Instructor Reset Password *****************/  
    $("#sendResetLinkIns").validate({
        // Specify the validation rules
        rules: {
	    instructor_email :   {required: true,email: true }
        },
        
        // Specify the validation error messages
        messages: {
            instructor_email : {
				required : "Please enter instructor email address",
				email    : "Please enter valid email address"
			    }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
/*************Student Reset Password *****************/  
    $("#resetPassword").validate({
        // Specify the validation rules
        rules: {
            new_password			: "required",
	    confirm_password               	:   {
						     required: true,
						     equalTo: "#new_password"
						    }
        },
        
        // Specify the validation error messages
        messages: {
            new_password		: "Please enter new password",
	    confirm_password       	:   {
					    required: "Please enter confirm password",
					    equalTo: "Please enter the same password as above"
					}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*****************Student Add**********************************/
    $("#addStudent").validate({
        // Specify the validation rules
        rules: {
            student_fname			: "required",
	    student_lname			: "required",
	    student_email               	:   {
						     required: true,
						     email: true
						    }
        },
        
        // Specify the validation error messages
        messages: {
            student_fname		: "Please enter student first name",
	    student_lname		: "Please enter student last name",
	    student_email       	:   {
					    required: "Please enter student email",
					    email: "Please enter valid email address"
					    }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
/*************************************News letter******************/

$("#newsletter").validate({
    // Specify the validation rules
    rules: {
	newsletter_email:   {required: true,email: true}
    },
    messages: {
	newsletter_email:   {
			    required: "Please enter email",
			    email: "Please enter valid email address"
			    }
    },
    
    submitHandler: function(form) {
	var newsletter_email = $('input[name=newsletter_email]').val();
            $.ajax({
                type: 'post',
                data: 'newsletter_email='+newsletter_email,
		 beforeSend: function( ) {
		   $('#loader').show(); 
		 },
                url: _baseUrl + 'home/newslettersubmit',
                success: function(data){
		    $('#loader').hide(); 
                    if (data==1) {
                        $('#error_newsletter_email').html('You are a register user');
			$('#newsletter_success').html('');
                        return false;
                    }else{
			$('#error_newsletter_email').html('');
			$('input[name=newsletter_email]').val('')
                        $('#newsletter_success').html('Email address saved successfully!');
			return false;
                    }
                }
            });
    }
});


/************************Instractor Signup*********************/

$("#instractorSignup").validate({
    // Specify the validation rules
    rules: {
	instructor_business_name	: "required",
	instructor_fname		: "required",
	instructor_lname		: "required",
	instructor_email               	:   {
						 required: true,
						 email: true
					    },
	instructor_password		: "required",
	card_holder_name		: "required",
	card_number			: "required",
	security_code			: "required",
	payment_type			: "required",
	instructor_address		: "required",
	zip_code			: "required",
    },
    
    // Specify the validation error messages
    messages: {
	instructor_business_name	: "Please enter instractor business name",
	instructor_fname		: "Please enter instractor first name",
	instructor_lname		: "Please enter instractor last name",
	instructor_email       		:   {
					    required: "Please enter instractor email",
					    email: "Please enter valid email address"
					    },
	instructor_password		: "Please enter instractor password",
	card_holder_name		: "Please enter card holder name",
	card_number			: "Please enter card number",
	security_code			: "Please enter security code",
	payment_type                    : "Please select one payment method",
	instructor_address		: "Please enter address",
	zip_code			: "Please enter post code",
	
    },
    
    submitHandler: function(form) {
	form.submit();
    }
});

    $("#pass_quarantee_first").validate({
	
	
        rules: {
            testCategory		: {required:true},
	    instructor_code		: {required:true}
        },
        messages: {
            testCategory		: {required : "Please select test category"},
	    instructor_code		: {required : "Please enter instructor code"}
        },
        
        submitHandler: function(form) {
	    
	    var instructor_code = $('input[name=instructor_code]').val();
            $.ajax({
                type: 'post',
                data: 'instructor_code='+instructor_code,
		beforeSend: function( ) {},
                url: _baseUrl + 'pass_guarantee/instructor_code',
                success: function(data){
                    if (data=='error') {
			$('#errorMsg').show();
			$('#errorMsg').html("Please enter valid instructor code");
			$('input[name=instructor_id]').val('');
                        return false;
                    }else{
			$('#errorMsg').hide();
			$('#errorMsg').html("");
			$('input[name=instructor_id]').val(data);
			form.submit();
                    }
                }
            });
            
        }
    });
    $("#test_centre").validate({
        rules: {
            test_centre			: {required:true}
	    //instructor_code		: {required:true}
        },
        messages: {
            test_centre			: {required : "Please select test centre"}
	    //instructor_code		: {required : "Please enter instructor code"}
        },
        
        submitHandler: function(form) {
	    
	    
	    form.submit();
	    
//	    var instructor_code = $('input[name=instructor_code]').val();
//            $.ajax({
//                type: 'post',
//                data: 'instructor_code='+instructor_code,
//		beforeSend: function( ) {},
//                url: _baseUrl + 'pass_guarantee/instructor_code',
//                success: function(data){
//                    if (data=='error') {
//			$('#errorMsg').show();
//			$('#errorMsg').html("Please enter valid instructor code");
//			$('input[name=instructor_id]').val('');
//                        return false;
//                    }else{
//			$('#errorMsg').hide();
//			$('#errorMsg').html("");
//			$('input[name=instructor_id]').val(data);
//			form.submit();
//                    }
//                }
//            });
        }
    });
    $('#user_info').validate({
	rules: {
            licence_number			: {required:true,minlength: 16},
	    title				: "required",
	    first_name				: "required",
	    last_name				: "required",
	    address1				: "required",
	    town				: "required",
	    post_code				: "required",
	    telephone_no			: "required",
	    email				: {required:true,email:true}
        },
        messages: {
            licence_number			: {required:"Enter a Great Britain licence number",
						    minlength: "Your Great Britain licence number must be 16 characters long"},
	    title				: "Select a title",
	    first_name				: "Forename is required",
	    last_name				: "Surname is required",
	    address1				: "Address line 1 is required",
	    town				: "Town is required",
	    post_code				: "Postcode is required",
	    telephone_no			: "Telephone number is required",
	    email				: {required:"Email is required",email:"Enter a valid email address"}
	    
	    
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    })
    
    $("#terms_condition").validate({
        rules: {
            terms			: {required:true}
        },
        messages: {
            terms			: {required : "You must indicate you have read and understood the terms on this page to continue. Note that you MUST use our online training material as described on this page towards qualifying for unlimited re-tests."}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $("#gua_summary").validate({
	rules: {
            payment_type			: {required:true}
        },
        messages: {
            payment_type			: {required : "Select payment type"}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#lookup').click(function(){
	var post_code 		= $('#post_code').val();
	var dataString    	= 'post_code=' + post_code;
	if (post_code == '') {
	    $('#post_code').parent().append('<label class="error">Please enter post code</label>');
	}else{
	    $('#post_code').parent().find('label.error').remove();
	    $('#post_code').parent().find('div').remove();
	    $.ajax({
		type: 'post',
		data: dataString,
		beforeSend: function(msg){
		    $('#post_code').parent().append('<img src="'+_baseUrl+'images/bx_loader.gif">');
		},
		url: _baseUrl + 'pass_guarantee/getLocation',
		success: function(data){
		    $('#result_details').html('');
		    $('#post_code').parent().find('img').remove();
		    
		    data        = $.parseJSON(data);
		    var str     = '';
		    if(data.type == 'error'){
			$('#post_code').parent().append('<label class="error">'+data.message+'</label>');
		    }else if(data.type == 'not_found'){
			$('#post_code').parent().append('<div><p>We could not find any test centres near to the postcode you entered.</p><p>Please ensure you entered your postcode correctly or try a different one.</p><p>Alternatively select a test centre from the test centre list.</p></div>');
		    }else{
			var str = '';
			str += '<p>We have found the following test centres near to you:</p>';
			
			if (data.res.length > 0) {
			    str += '<ul>';
			    $.each(data.res, function(index, item) {
				
				str += '<li>';
				str += '<div class="postcodeView">';
				str += '<span><strong>'+item.name+'</strong>';
				if (item.distance == null) {
				    str += '(0 miles)'+'</span>';
				}else{
				    str += '('+parseFloat(item.distance).toFixed(2)+' miles)'+'</span>';
				}
				str += '<span>'+item.address+'</span>';
				str += '<span>'+item.zip_code+'</span>';
				str += '</div>';
				str += '<input type="button" class="selectTestCentre" id="'+item.id+'" value="Click to select this test centre">'
				str += '</li>';
			    });
			    str += '</ul>';
			}
			
			$('#result_details').html(str);
			
		    }
		    
		    $('.selectTestCentre').click(function(){
			$("#test_centre").find('option:selected').removeAttr("selected");
			$('#test_centre option[value='+this.id+']').prop('selected','selected');
			
		    });
		}
	    });
	}
    });
/*******************Lesson Details Change***********************/
    $('#lessonChange').change(function(){
	var lesson = $('#lessonChange option:selected').val();
	var dataString    = 'lesson_id=' + lesson;
	$.ajax({
		type: 'post',
		data: dataString,
		url: _baseUrl + 'learn/lessionDetails',
		success: function(data){
		    $('#lessonChange').removeClass("colorselect");
		    data        = $.parseJSON(data);
		    var str     = '';
		    if(data.type != 'error'){
		    str += '<h2 class="title">'+data.lesson_name+'</h2>';
		    str += '<div class="topicDetailSec clear">';
		    str += '<div class="topicLeft">';
		    str += '<div class="explanation">';
		    str += '<h3 class="topicTitle detailTitle">1. Read my explanation</h3>';
		    str += '<div class="leasonPart">';
		    str += '<p>'+data.lesson_description+'</p>';
		    //if (data.add_lesson == 'Yes') {
		    //str += '<a href="javascript:void(0);" class="myLeason">Remove from My Lessons</a>';
		    //}else{
		    //str += '<a href="javascript:void(0);" class="myLeason">Add to my lessons</a>';
		    //}
		    str += '</div></div>';
		    str += '<div class="bigArrow"><img src="'+_baseUrl+'images/bigArrow.png" alt=""></div>';
		    
		    str += '</div>';
		    str += '<div class="topicRight">';
		    str += '<div class="animationSec">';
		    str += '<h3 class="topicTitle detailTitle">2. Look at my animetions</h3>';
		    str += '<div id="animationSlide" class="owl-carousel owl-theme">';
		    if (data.lesson_details.length > 0) {
			$.each(data.lesson_details, function(index, item) {
			str += '<div class="item">';
			str += '<div class="motorway">';
			str += '<h3>'+data.lesson_name+'</h3>';
			if (item.desc_type == 'text') {
			str += '<p>'+item.desc_content+'</p>';
			}else{
			str += '<img src="'+_baseUrl+'uploads/lesson/'+item.desc_content+'">'; 
			}
			str += '</div></div>';
			});
		    }
		    str += '</div></div>';
		    str += '</div>';
		    str += '<h4 class="lessons">When you\'ve learnt these lessons try some Step 2 tests:</h4>';
		    str += '<div class="checkArea questionZoneBox">';
		    str += '<p class="tickBox">Tick the box when you have read and understood this lesson</p>';
		    var valueChecked = '';
		    if (data.lesson_read == 'Yes') {
			$('#lessonChange').addClass("colorselect");
			valueChecked = "checked='checked'";
		    }
		    str += '<input id="chkAnswer_1" name="" class="lesson_read" '+valueChecked+' type="checkbox" value=""><label for="chkAnswer_1"><span></span></label>';
		    str += '</div></div>';
		    }
		    $('#lessonDetailsView').html(str);
		    $("#animationSlide").owlCarousel({
    
		    navigation : true, // Show next and prev buttons
		    slideSpeed : 300,
		    paginationSpeed : 400,
		    singleItem:true,
		    pagination: false
		    });
		}
	});
    });
    
    $('#lessonChange').trigger("change");
    
    
/********************Read lesson***********************/
    $(document).on('click','.lesson_read',function(){
        if ($(this).is(':checked')) {
            var checking_val = 1;
            $('#lessonChange').addClass("colorselect");
            $('#lessonChange option:selected').addClass("greenclass");
        } else {
            var checking_val = 0;
            $('#lessonChange').removeClass("colorselect");
            $('#lessonChange option:selected').removeClass("greenclass");
        }
        var lesson        = $('#lessonChange option:selected').val();
        var dataString    = 'lesson_id=' + lesson + '&checking_val=' + checking_val;
        $.ajax({
            type: 'post',
            data: dataString,
            url: _baseUrl + 'learn/addRemoveRead',
            success: function(data){}
        });
    });
///***********************Add to my lesson*********************/
   // $(document).ajaxStop($.unblockUI); 
    $(document).on('click','.myLeason',function(){
        var lesson        = $('#lessonChange option:selected').val();
        var dataString    = 'lesson_id=' + lesson;
        $.ajax({
            type: 'post',
            data: dataString,
            url: _baseUrl + 'learn/addToMyLesson',
            beforeSend: function(){
              $.blockUI({ message: '<h1><img src="'+_baseUrl+'images/ajax-loader.gif" />  Please Wait...</h1>',
                        css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        }   
                });   
            },
            success: function(data){
                setTimeout($.unblockUI, 500); 
                var path = location.pathname;
                if(path.indexOf('mylesson')>0){
                       
                        $("#lessonChange option[value="+lesson+"]").remove();
                        //$("#lessonChange option:eq(1)").attr('selected','selected');
                        //$('#lessonChange').find('option').eq(1).val()
                        var optionFirstVal=$('#lessonChange').find('option').eq(1).val();
                        $('#lessonChange').val(optionFirstVal).trigger("change");
                    }
                $('.myLeason').text(data);
                
            }
        });
    });
    //Next question for mock test
    $(document).on('click','#nxtmockquestion',function(){
        var questionid = $('#questionid').val();
        
        var answerId = [];
        $.each($(".Checkboxmock:checked"), function(){
            answerId.push($(this).val());
        }); 
        answerId = answerId.join(",");
        
        var currentNo = $('#currQuestionNo').val();
        $.ajax({
                    type: 'post',
                    data: 'questionid='+questionid+'&answerId='+answerId+'&currentNo='+currentNo,
                    url: _baseUrl + 'learn/mocktest/saveGetQuestion',
                    success: function(data){
                        if (data == 'complate') {
                            window.location.href = _baseUrl + 'learn/mocktest/result/';
                        }else{
                        $('#question_no').html(parseInt(currentNo)+1);
                        $('#mocktestQuestion').html(data);
                        }
			/*$(".understand-question").bind({
			    mousemove : changeTooltipPosition,
			    mouseenter : showTooltip2,
			    mouseleave: hideTooltip
			 });*/
                    }
                });
    });
    $(document).on('click','#prevMockQuestion',function(){
        var questionid = $('#questionid').val();
        var answerId = [];
        $.each($(".Checkboxmock:checked"), function(){
            answerId.push($(this).val());
        }); 
        answerId = answerId.join(",");
        var currQuestionNo = $('#currQuestionNo').val();
        $.ajax({
            type: 'post',
            data: 'questionid='+questionid+'&answerId='+answerId+'&currQuestionNo='+currQuestionNo,
            url: _baseUrl + 'learn/mocktest/prevQuestion',
            success: function(data){
                $('#question_no').html(parseInt(currQuestionNo)-1);
                $('#mocktestQuestion').html(data);
            }
        });
    });
    $('.fancyboxReviewQuestion').fancybox({/*'width':1000,'height':1000,'autoSize' : false,'scrolling' : 'yes'*/});
    

    //***********Tooltip***********************//
    var changeTooltipPosition = function(event) {
        var tooltipX = event.pageX - 8;
        var tooltipY = event.pageY + 8;
        $('div.tooltip').css({top: tooltipY, left: tooltipX});
    };
      
    var showTooltip = function(event) {
        var data_title = $(event.target).parents('li').attr('data-title');
        $('div.tooltip').remove();
        $('<div class="tooltip">'+data_title+'</div>')
          .appendTo('body');
        changeTooltipPosition(event);
      };
    var showTooltip1 = function(event) {
        var data_title = $(event.target).attr('data-title');
        $('div.tooltip').remove();
        $('<div class="tooltip">'+data_title+'</div>')
          .appendTo('body');
        changeTooltipPosition(event);
    };
    
    // For understand text display   
    $(document).on('click','#open',function(){
        $("div.explanation").hide().fadeIn(200);
    });
    
    $(document).on('click','.close_arrow',function(){
        $(this).parent().fadeOut(600, function(){ 
            
            $(this).hide();
        })
     });
    // For how it works height set  
    var n=0
    $("#first_box").children().each(function(){
     $('#second_box').children().eq(n).css({'height':($(this).height()+'px')});
     n++;
    });
    
       
    
    var showTooltip2 = function(event) {
        //var data_title = $(event.target).attr('data-title');
	
	var data_title = $(".explanation").text();
        $('div.tooltip').remove();
        $('<div class="tooltip">'+data_title+'</div>')
          .appendTo('.questionZoneBox');
        changeTooltipPosition(event);
    };
    
    var hideTooltip = function() {
         $('div.tooltip').remove();
    };

    $(".topicArea li a").bind({
         mousemove : changeTooltipPosition,
         mouseenter : showTooltip,
         mouseleave: hideTooltip
    });
      
     
     $(".showDetails td.business_name").bind({
        mousemove : changeTooltipPosition,
        mouseenter : showTooltip1,
        mouseleave: hideTooltip
     });
     
    /*$(".understand-question").bind({
        mousemove : changeTooltipPosition,
        click : showTooltip2,
        mouseleave: hideTooltip
     });*/ 
     $('.advertisement').on("click", function (e) {
	var id= this.id;
	e.preventDefault(); // avoids calling preview.php
	$.ajax({
	  type: "POST",
	  cache: false,
	  url: _baseUrl+'instructor/advertisement_copy', // preview.php
	  data: 'id='+id, // all form fields
	  success: function (data) {
	    // on success, post (preview) returned data in fancybox
	    $.fancybox(data, {
	      // fancybox API options
	      fitToView: true,
	      width: 600,
	      height: 200,
	      autoSize: false
	    }); // fancybox
	  } // success
	}); // ajax
      }); // on
 
    $('#next_passguarantee').on("click", function (e) {
        if($('#pasguarantee_terms').is(':checked')) {
             $('#errorMsg').hide();
             $('#errorMsg').html("");
            return true;
        } 
        else {
            $('#errorMsg').show();
            $('#errorMsg').html("You must agree to the terms and conditions before continue");
            return false;
        }

    })  
    

});




})(jQuery);
$(function(){
    $(document).ready(function(){
    resizeContent();

    $(window).resize(function() {
        resizeContent();
    });
});
    function resizeContent() {
    var winHt=$(window).height();
    var headerHt=$('header').outerHeight();
    var navHt=$('#nav2').outerHeight();
    var allCount1=(headerHt+navHt);
    var allCount2=(winHt-allCount1);
    $('#fixedbanner').css('height',allCount2);
}
})
$(document).on('click','#copy_btn',function(){
    var urlField = document.querySelector('#textar');
    urlField.select();
    document.execCommand('copy');
});

