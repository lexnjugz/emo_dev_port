<?php require("includes/header.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                    <?php echo anchor('index.php/Admin/index', '<i class="fa fa-fw fa-file-image-o""></i> Main Slider') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/product', '<i class="fa fa-fw fa-cubes""></i> Products') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/client', '<i class="fa fa-fw fa-users""></i> Clients') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Project', '<i class="fa fa-fw fa-th""></i> Projects') ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             <small>Images on Main Slider&nbsp;&nbsp;/ 
                              <?php echo anchor('index.php/Admin/addslider', '<span class="glyphicon glyphicon-plus"></span> add new','class="btn btn-default"') ?>
                              </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
               
                    

                    <div class="modal fade bs-modal-lg" id="addnew" tabindex="-1" role="dialog" aria-labelledby="AddNew">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Slider Image</h4>
      </div>
      <div class="modal-body">
         ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="btnsave">Save changes</button>
      </div>
                        </div>
                      </div>
                    </div>
                
                <div class="row">
<?php
if(!empty($slider_imgs))
 {

                 foreach ($slider_imgs as $slider): 
                   ?>
        <div class="col-lg-3 thumbnail-slider">
        <p class="page-header"><?php echo $slider['img_name']?></p>
        <img src="<?php echo base_url();?>assets/img/slider/<?php echo $slider['img_name'] ?>" alt="<? echo $slider['img_name'] ?>" width="250" height="250"/>
                <p class="page-header">
                <span>
                <a class="btn btn-danger" href="<?php echo base_url()."index.php/Admin/deleteimg/".$slider['img_Id']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
                </span>
                </p>
            </div>       


<?php endforeach; 
    }
   else { ?>

    <div class="col-xs-12">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
    }
    
?>


                    
                  
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

</body>

</html>
