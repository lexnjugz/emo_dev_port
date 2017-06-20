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
                    <li class="active">
                    <?php echo anchor('index.php/Project', '<i class="fa fa-fw fa-th""></i> Projects') ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container">
                    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             <small>Projects
                              </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                    <br />
                    <button class="btn btn-success" onclick="add_project()"><i class="glyphicon glyphicon-plus"></i> Add Project</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <br />
                    <br />
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="95%">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Client Name</th>
                                <th>Product Name</th>
                                <th>Project Details</th>
                                <th style="width:50px;">Slider Images</th>
                                <th style="width:150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Project Title</th>
                            <th>Client Name</th>
                            <th>Product Name</th>
                            <th>Project Details</th>
                            <th>Slider Images</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            <script src="<?php echo base_url('admin_assets/bootstrap/js/bootstrap.min.js')?>"></script>
            <script src="<?php echo base_url('admin_assets/datatables/js/jquery.dataTables.min.js')?>"></script>
            <script src="<?php echo base_url('admin_assets/datatables/js/dataTables.bootstrap.js')?>"></script>
            <script type="text/javascript" src="<?php echo base_url();?>admin_assets/tinymce/jquery.tinymce.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url();?>admin_assets/tinymce/tinymce.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url();?>admin_assets/tinymce/tinymce_properties.js"></script>

            <script type="text/javascript">

            var save_method; //for save method string
            var table;

            $(document).ready(function() {

                //datatables
                table = $('#table').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('index.php/project/ajax_list')?>",
                        "type": "POST"
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [
                    { 
                        "targets": [ 4,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    ],

                });


            });



            function add_project()
            {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Add Project'); // Set Title to Bootstrap modal title
            }

            function add_projSlider(id)
            {
               $.ajax({
                    url : "<?php echo site_url('index.php/project_images/index/')?>/" + id,
                    type: "POST",
                    success: function()
                    {
                      window.open("<?php echo site_url('index.php/project_images/index/')?>/"+ id);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error getting dropzone page');
                    }
               });
            }

            function edit_project(id)
            {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string

                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('index.php/project/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {

                        $('[name="id"]').val(data.project_Id);
                        $('[name="project_title"]').val(data.project_title);
                        $('[name="client_Id"]').val(data.client_Id);
                        $('[name="product_Id"]').val(data.product_Id);
                        tinyMCE.activeEditor.setContent(data.project_details);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Project'); // Set title to Bootstrap modal title


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function reload_table()
            {
                table.ajax.reload(null,false); //reload datatable ajax 
            }

            function save()
            {
                tinymce.triggerSave();
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;

                if(save_method == 'add') {
                    url = "<?php echo site_url('index.php/project/ajax_add')?>";
                } else {
                    url = "<?php echo site_url('index.php/project/ajax_update')?>";
                }

                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {

                        if(data.status) //if success close modal and reload ajax table
                        {
                            $('#modal_form').modal('hide');
                            reload_table();
                        }

                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 

                    }
                });
            }

            function delete_project(id)
            {
                if(confirm('Are you sure delete this data?'))
                {
                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('index.php/project/ajax_delete')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });

                }
            }
            </script>

            <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Project Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="id"/> 
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Project Title</label>
                                        <div class="col-md-9">
                                            <input name="project_title" placeholder="Project Title" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Client</label>
                                        <div class="col-md-9">
                                            <select id="client_Id" name="client_Id" class="form-control">
                                                  <option value="" disabled selected hidden>Please Choose</option>
                                                     <?php
                                                       for ($i=0; $i <= max(array_keys($client)); $i++) { 
                                                        ?> 
                                                      
                                                          <option value="<?php echo $client[$i]["client_Id"];?>"><?php echo $client[$i]["client_name"];?></option>
                                                      
                                                      <?php  } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Product</label>
                                        <div class="col-md-9">
                                            <select id="product_Id" name="product_Id" class="form-control">
                                                  <option value="" disabled selected hidden>Please Choose</option>
                                                  <?php
                                                        for ($i=0; $i <= max(array_keys($product)); $i++) { 
                                                    ?> 
                                                      
                                                           <option value="<?php echo $product[$i]["product_Id"];?>"><?php echo $product[$i]["product_name"];?></option>
                                                      
                                                      <?php  } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Project Details</label>
                                        <div class="col-md-9">
                                            <textarea name="project_details" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
