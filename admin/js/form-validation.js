$(function () {
    $(".form-validate").validate({
        
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
            
        }
    });
     $(".form-validate-signup").validate({
	rules: {  
	confirm_buyer_pass: {
	equalTo: "#confirm_pass"
	}
	},
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
            
        }
    });
    

});
