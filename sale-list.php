<?php include 'header.php' ?>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Material Sale List
			<a href="issue_entry.php" style="float:right"><i class="fas fa-plus"></i> Sale Entry<a>
		</div>
        <div class="card-body">
			<div class="table-responsive data-table-wrapper">
				<table id="sale_data_list" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Sale No</th>
							<th>Sale Date</th>
							<th>
								<select name="partyname" id="partyname" class="form-control">
									<option value="">Search By All Party</option>
									<?php 
									$query = "SELECT * FROM tb_party ORDER BY partyname ASC";
									$result = mysqli_query($conn, $query);
									while($row = mysqli_fetch_array($result))
									{
										echo '<option value="'.$row["party_id"].'">'.$row["partyname"].'</option>';
									}
									?>
								</select>
							</th>
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
 
 load_sale_data();

 function load_sale_data(is_partyname)
 {
  var dataTable = $('#sale_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch/fetch_sale_table.php",
    type:"POST",
    data:{is_partyname:is_partyname}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#partyname', function(){
  var partyname = $(this).val();
  $('#sale_data_list').DataTable().destroy();
  if(partyname != '')
  {
   load_sale_data(partyname);
  }
  else
  {
   load_sale_data();
  }
 });
});
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>