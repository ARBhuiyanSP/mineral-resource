<?php include 'header.php' ?>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Material Receive List
			<a href="receive_entry.php" style="float:right"><i class="fas fa-plus"></i> Receive Entry<a>
		</div>
        <div class="card-body">
			<div class="table-responsive data-table-wrapper">
				<table id="receive_data_list" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>MRR No</th>
							<th>MRR Date</th>
							<th>
								<select name="suppliers" id="suppliers" class="form-control">
									<option value="">Supplier Search</option>
										<?php 
										$query = "SELECT * FROM suppliers ORDER BY name ASC";
										$result = mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($result))
										{
										echo '<option value="'.$row["code"].'">'.$row["name"].'</option>';
										}
										?>
								</select>
							</th>
							<th>Total Qty</th>
							<th>Total Amount</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_receive_data();

 function load_receive_data(is_suppliers)
 {
  var dataTable = $('#receive_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch_receive_table.php",
    type:"POST",
    data:{is_suppliers:is_suppliers}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#suppliers', function(){
  var suppliers = $(this).val();
  $('#receive_data_list').DataTable().destroy();
  if(suppliers != '')
  {
   load_receive_data(suppliers);
  }
  else
  {
   load_receive_data();
  }
 });
});
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>