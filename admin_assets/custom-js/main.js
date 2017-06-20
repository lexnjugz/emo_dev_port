    $(document).ready(function() {
                $('#summernote').summernote({
                                height: $(this).attr('data-height') || 200,
                                lang:   $(this).attr('data-lang') || 'en-US', // default: 'en-US'
                                toolbar: [
                                /*  [groupname,     [button list]]  */
                                    ['style',       ['style']],
                                    ['fontsize',    ['fontsize']],
                                    ['style',       ['bold', 'italic', 'underline','strikethrough', 'clear']],
                                    ['color',       ['color']],
                                    ['para',        ['ul', 'ol', 'paragraph']],
                                    ['table',       ['table']],
                                 /*   ['media',       ['link', 'picture', 'video']],*/
                                    ['misc',        ['codeview', 'fullscreen', 'help']]
                                ]
                               
                            });
                
    });

    function submitform() {
            var projectdata = {
                'project_name'          : $('input[name=project_name]').val(),
                'product_Id'            : document.getElementById("product_Id").value,
                'client_Id'             : document.getElementById("client_Id").value,
                'project_details'       : $('.summernote').code()
            };
                $.ajax({
                type: "POST",
                url: "/dev/index.php/Admin/projectSave",
                dataType: 'json',
                data: projectdata,
                    success : function (data, status)
                        {
                            if(data.status != 'error')
                            {
                                alert("Project Added");
                            }
                            alert(data.msg);
                        }
                });
              // e.preventDefault();
       //  document.project.submit();
 
    }


    $(document).ready(function() {

        Dropzone.options.myDropzone = {
            init: function() {
                this.on("addedfile", function(file) {
                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");
                    
                    // Capture the Dropzone instance as closure.
                   // var _this = this;

                    // Listen to the click event
                   // removeButton.addEventListener("click", function(e) {
                      // Make sure the button click doesn't submit the form:
                   //   e.preventDefault();
                     // e.stopPropagation();

                      // Remove the file preview.
                     // _this.removeFile(file);
                      // If you want to the delete the file on the server as well,
                      // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    //file.previewElement.appendChild(removeButton);
                 }
              
            }            
        

    });

   
    $(document).ready(function() {
        $(".submit").click(function(event) {
            event.preventDefault();
            var project_name = document.getElementById("project_name").value;
            var product_Id = document.getElementById("product_Id").value;
            var client_Id = document.getElementById("client_Id").value;
            var project_details = $('.summernote').code();
                jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/Admin/projectSave",
                dataType: 'json',
                data: {project_name: project_name, product_Id: product_Id, client_Id: client_Id, project_details: project_details},
                    success: function(res) {
                        if (res)
                            {
                                // Show Entered Value
                                jQuery("div#result").show();
                                jQuery("div#value").html(res.username);
                                jQuery("div#value_pwd").html(res.pwd);
                            }
                    }
                });
            });
        });

     // function submit_form() {
    //     var project_name = document.getElementById("project_name").value;
    //         var product_Id = document.getElementById("product_Id").value;
    //         var client_Id = document.getElementById("client_Id").value;
    //         var project_details = $('.summernote').code();
    //             jQuery.ajax({
    //             type: "POST",
    //             url: "<?php echo base_url(); ?>" + "index.php/Admin/projectSave",
    //             dataType: 'json',
    //             data: {project_name: project_name, product_Id: product_Id, client_Id: client_Id, project_details: project_details},
    //                 success: function(res) {
    //                     if (res)
    //                         {
    //                             // Show Entered Value
    //                             jQuery("div#result").show();
    //                             jQuery("div#value").html(res.username);
    //                             jQuery("div#value_pwd").html(res.pwd);
    //                         }
    //                 }
    //             });
    //    //  document.project.submit();
 
    // }
