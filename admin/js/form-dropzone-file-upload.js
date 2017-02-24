$(function () {
    Dropzone.options.myDropzone = {
            
            autoProcessQueue: false,
            url: _baseUrl+'product/gallery/upload',
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            clickable: true,
            dictDefaultMessage: 'Add files to upload by clicking or droppng them here.',
            /*addRemoveLinks: true,*/
            acceptedFiles: '.jpg,.pdf,.png,.bmp',
            dictInvalidFileType: 'This file type is not supported.',
        
        
        init: function() {
            
             var myDropzone = this;
             
                $("button[type=submit]").bind("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // If the user has selected at least one file, AJAX them over.
                    if (myDropzone.files.length !== 0) {
                        myDropzone.processQueue();
                    // Else just submit the form and move on.
                    } else {
                        //$('#my-dropzone').submit();
                    }
                });

                this.on("successmultiple", function (files, response) { alert('ooo');
                    // After successfully sending the files, submit the form and move on.
                    //$('#my-dropzone').submit();
                });
            
            
            this.on("addedfile", function(file) {
                //Active submit button//
                $('button[type="submit"]').removeAttr('disabled');
                $('#clear-dropzone').css('display','inline');
                // Create the remove button
                var removeButton = Dropzone.createElement("<button class='btn'>Remove file</button>");


                // Capture the Dropzone instance as closure.
                var _this = this;

                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();
                    /*var name = file.name;        
                    $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: "image_name="+name,
                    dataType: 'html'
                    });*/
                    
                    // Remove the file preview.
                    _this.removeFile(file);
                    if (myDropzone.files.length == 0) {
                        $('button[type="submit"]').attr('disabled','disabled');
                        $('#clear-dropzone').css('display','none');
                    }
                    
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
                   $("button#clear-dropzone").bind("click", function (e) {
                      
                       _this.removeAllFiles();
                       if (myDropzone.files.length == 0) { alert('ffff');
                            $('button[type="submit"]').attr('disabled','disabled');
                            $('#clear-dropzone').css('display','none');
                       } 
                   
                   })
                
     
            });
            
            
        }
        
    
    };
    
    
});