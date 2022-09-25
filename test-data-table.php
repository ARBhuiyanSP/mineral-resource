<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>User Info</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Info</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="user_create.php"><i class="fa fa-user-plus"></i> Create</a></li>
                                <li><a href="live_user_import.php"><i class="fa fa-upload"></i> Import</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
   <!------------ Table Content-------------->
						<div class="table-responsive">
							<table id="users_data" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Office ID</th>
										<th>
											<select name="branch" id="branch" class="form-control">
												<option value="">Branch Search</option>
													<?php 
													$query = "SELECT * FROM branch ORDER BY name ASC";
													$result = mysqli_query($conn, $query);
													while($row = mysqli_fetch_array($result))
													{
													echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
													}
													?>
											</select>
										</th>
										<th>Name</th>
									</tr>
								</thead>
							</table>
						</div>


   <!------------ Table Content-------------->
					</div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_users_data();

 function load_users_data(is_branch)
 {
  var dataTable = $('#users_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch_test_table.php",
    type:"POST",
    data:{is_branch:is_branch}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#branch', function(){
  var branch = $(this).val();
  $('#users_data').DataTable().destroy();
  if(branch != '')
  {
   load_users_data(branch);
  }
  else
  {
   load_users_data();
  }
 });
});
</script>

<?php include 'footer.php'; ?>