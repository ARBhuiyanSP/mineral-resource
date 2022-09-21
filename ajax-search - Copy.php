<?php include 'header.php' ?>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Receive Report Filters</a>
        </li>
        <li class="breadcrumb-item active">Receive Report Search</li>
    </ol>
	
	
	
	
    <!-- receive search start here -->

<script type="text/javascript" src="js/getData.js"></script>

<div class="card">
		
	
	
	
			<select class="form-control js-example-basic-single" id="employee">
				<option value="" selected="selected">Select Employee Name</option>
				<?php
				$sql = "SELECT id, employee_name, employee_salary, employee_age FROM employee LIMIT 10";
				$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
				while( $rows = mysqli_fetch_assoc($resultset) ) { 
				?>
				<option value="<?php echo $rows["id"]; ?>"><?php echo $rows["employee_name"]; ?></option>
				<?php }	?>
			</select>
       
	   
		<div id="display">
			<table class="table table-bordered" id="heading" style="display:none;">
				<thead>
					<tr>
						<th>Employee Name</th>
						<th>Age</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody id="records">
					<tr>
						<td id="emp_name"></td>
						<td id="emp_age"></td>
						<td id="emp_salary"></td>
					</tr>
				</tbody>
			</table>
			<div class="row" id="no_records"><div class="col-sm-12" style="text-align:center;">Plese select employee name to view details</div></div>
        </div>		
		
</div>
    <!-- end receive search -->





</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>