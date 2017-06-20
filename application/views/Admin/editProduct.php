<?php require("includes/header.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                    <?php echo anchor('index.php/Admin/index', '<i class="fa fa-fw fa-file-image-o""></i> Main Slider') ?>
                    </li>
                    <li class="active">
                    <?php echo anchor('index.php/Admin/product', '<i class="fa fa-fw fa-cubes""></i> Products') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/client', '<i class="fa fa-fw fa-users""></i> Clients') ?>
                    </li>
                    <li>
                    <?php echo anchor('index.php/Admin/project', '<i class="fa fa-fw fa-th""></i> Projects') ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                
               <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
    }
    else {
    ?> 
    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             <small>Edit Product&nbsp;&nbsp;/ <?php echo anchor('index.php/Admin/product', '<span class="glyphicon glyphicon-plus"></span> view all products','class="btn btn-primary"') ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

     <form method="post" enctype="multipart/form-data" class="form-horizontal">
     <table class="table table-bordered table-hover">
      <tr>
        <td><label class="control-label">Product Name</label></td>
        <td><input class="form-control" type="text" name="product_name" placeholder="Enter Image name" value="<?php echo $product_name[0]["product_name"];  ?>" required/></td>
    </tr>
    <tr>
        <td colspan="12"><button type="submit" name="btnsave" class="btn btn-success">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
<?php
    }
    ?>


                    
                  
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>admin_assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>admin_assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>admin_assets/js/plugins/morris/raphael.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/js/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/js/plugins/morris/morris-data.js"></script>

</body>

</html>
