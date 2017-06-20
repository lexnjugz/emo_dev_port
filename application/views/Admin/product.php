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
                             <small>Products
                              </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">

        <button class="btn btn-success" data-toggle="modal" data-target="#AddProduct"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
        <br />
        <br />

        <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Product</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
       if(!empty($product_name))
            {
                 foreach ($product_name as $product): 
                   ?> 
                <tr> 
                    <td><?php echo $product['product_name']?></td>
                    <td>
                        <span>
                        <?php echo anchor('index.php/Admin/productEdit/'.$product['product_Id'], '<span class="glyphicon glyphicon-pencil"></span>','class="btn btn-primary btn-xs"') ?>
                        </span>
                        <span>
                            <a class="btn btn-danger btn-xs" href="<?php echo base_url()."index.php/Admin/productDelete/".$product['product_Id']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </span>
                    </td>
                </tr>
        <?php  endforeach; 
              }
            else {  ?>
         <div class="col-xs-12">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
             } 
        ?>
            </tbody>
        </table>
 

<!-- Bootstrap modal -->
<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Product</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open('index.php/Admin/productSave', 'role="form"'); ?>
                      <div class="form-group">
                        <label for="product_name">Product</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                      </div>
                      <div class="modal-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                      <button type="button" onclick="location.href='<?php echo site_url('index.php/Admin/product') ?>'" class="btn btn-success">Back</button>
                      </div>
                    </form>
                <?php echo form_close(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<div class="modal fade" id="EditProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Product</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open('index.php/Admin/productEdit/'.$product['product_Id'], 'role="form"'); ?>
                      <div class="form-group">
                        <label for="product_name">Product</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product_data['product_name']  ?>" required>
                      </div>
                      <div class="modal-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                      <button type="button" onclick="location.href='<?php echo site_url('index.php/Admin/product') ?>'" class="btn btn-success">Back</button>
                      </div>
                    </form>
                <?php echo form_close(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


                    
                  
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
    <!-- Datatables JavaScript -->
    <script src="<?php echo base_url('admin_assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('admin_assets/datatables/js/dataTables.bootstrap.js')?>"></script>

</body>

</html>
