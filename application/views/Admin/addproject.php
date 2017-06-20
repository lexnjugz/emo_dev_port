<?php require("includes/header.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                    <?php echo anchor('index.php/Admin/index', '<i class="fa fa-fw fa-file-image-o""></i> Main Slider') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/product', '<i class="fa fa-fw fa-cubes""></i> Products') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/client', '<i class="fa fa-fw fa-users""></i> Clients') ?>
                    </li>
                    <li  class="active">
                    <?php echo anchor('index.php/Project', '<i class="fa fa-fw fa-th""></i> Projects') ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
<style type="text/css">

body{
  background-color: #E8E9EC;
}

.dropzone {
  margin-top: 50px;
  border:2px dashed #0087F7;
}

</style>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             <small>Upload Project Images for <?php echo $name[0]["project_title"]; ?> Project
                              </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                 
                <div class="row">
                  <input id="id" name="id" value="<?php echo $id; ?>" hidden>

                   <div class="dropzone col-md-8 col-md-offset-2">

                        <div class="dz-message">
                            <h3> Drag and Drop Images Here</h3>
                        </div>

                    </div>
                    <div class="row clear-fix">
                          <div class="col-md-12">
                              <div style="margin-top: 1%;">
                                  <blockquote>
                                  <ul class="list-inline"  id="gallery">
                                       
                                  </ul>
                                  </blockquote>
                              </div>  
                          </div>
                   </div>

                    
                  
                </div>
                 <!-- /. row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>admin_assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (){
          loadgallery();
        });
        Dropzone.autoDiscover = false;

        var image_upload= new Dropzone(".dropzone",{
        url: "<?php echo base_url('index.php/project_images/project_image_upload') ?>",
        maxFilesize: 2,
        method:"post",
        acceptedFiles:"image/*",
        paramName:"userfile",
        dictInvalidFileType:"This file type is not supported.",
        addRemoveLinks:true,
        });


        //Event when Starting upload
        image_upload.on("sending",function(a,b,c){
          a.token=Math.random();
          var value = $('#id').val();
          c.append("id", value); //add project Id to image
          c.append("token_image",a.token); //Preparing token for each photo
          
        });


        //Event when photos are deleted
        image_upload.on("removedfile",function(a){
          var token=a.token;
          $.ajax({
            type:"post",
            data:{token:token},
            url:"<?php echo base_url('index.php/project_images/project_image_delete') ?>",
            cache:false,
            dataType: 'json',
            success: function(){
              console.log("Image deleted");
            },
            error: function(){
              console.log("Error in deleting image");

            }
          });
        });

        function  loadgallery(){
                   $.ajax({
                      url:'<?php echo base_url('index.php/project_images/project_slider_images') ?>',
                      type:'GET'
                    }).done(function (data){
                        $("#gallery").html(data);
                        var btnDelete  = $("#gallery").find($(".btn-delete"));
                        (btnDelete).on('click', function (e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            $(id).hide();
                            $.ajax({
                                type:"post",
                    data:{id:id},
                    url:"<?php echo base_url('index.php/project_images/project_deleteimg') ?>",
                    cache:false,
                    success: function(){
                      console.log("Image deleted");
                      $('#gallery').load().fadeIn("slow");
                      location.reload();

                    },
                    error: function(){
                      console.log("Error in deleting image");
                    }
                            }).done(function (data){
                                 
                            });
                        });
                         
                    });
                   }


      </script>

</body>

</html>
