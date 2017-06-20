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
                    <li class="active">
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
                             <small>Clients
                              </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">

        <button class="btn btn-success" data-toggle="modal" data-target="#AddClient"><i class="glyphicon glyphicon-plus"></i> Add Client</button>
        <br />
        <br />

        <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Client</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
       if(!empty($client))
            {
                 foreach ($client as $client): 
                 
                   ?> 
                <tr>
                    <td><img src="<?php echo base_url();?>assets/img/client_logo/<?php echo $client['client_logo'] ?>" alt="<?php echo $client['client_name'] ?>" width="50" height="50"/></td> 
                    <td><?php echo $client['client_name']?></td>
                    <td>
                        <span>
                        <?php echo anchor('index.php/Admin/clientEdit/'.$client['client_Id'], '<span class="glyphicon glyphicon-pencil"></span>','class="btn btn-primary btn-xs"') ?>
                        </span>
                        <span>
                            <a class="btn btn-danger btn-xs" href="<?php echo base_url()."index.php/Admin/clientDelete/".$client['client_Id']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-trash"></span></a>
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
                    <div class="modal fade" id="AddClient" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Add Client</h3>
                                </div>
                                <div class="modal-body form">
                                    <?php echo form_open_multipart('index.php/Admin/clientSave', 'role="form"'); ?>
                                          <div class="form-group">
                                            <label for="client_name">Client</label>
                                            <input type="text" class="form-control" id="client_name" name="client_name" required>
                                          </div>
                                          <div class="form-group">
                                              <label for="client_logo">Logo</label>
                                              <input class="input-group" type="file" name="client_logo" accept="image/*" required />
                                          </div>
                                          <div class="modal-footer">
                                          <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                          <button type="button" onclick="location.href='<?php echo site_url('index.php/Admin/client') ?>'" class="btn btn-success">Back</button>
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
