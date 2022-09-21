<?php include 'header.php';
$warehouse_id	=	$_SESSION['logged']['warehouse_id'];
 ?>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
table tbody tr{
	background-color:#E9ECEF;
	color:#000;
}
.table th, .table td {
	padding:2px;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="container-fluid">
<!-- Breadcrumbs-->
		<div class="row">
			<div class="col-xl-3 col-sm-3 mb-3">
				<div class="card text-white bg-success o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-truck"></i>
						</div>
					<?php
						$sqlpmrr	=	"SELECT * FROM `inv_material`";	
					
					
					$resultpmrr = mysqli_query($conn, $sqlpmrr);
					$totalPendingMrr = mysqli_num_rows($resultpmrr);
					?>
						<div class="mr-5"><?php echo $totalPendingMrr; ?> Total Material</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="material.php">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-3 mb-3">
				<div class="card text-white bg-info o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-truck"></i>
						</div>
					<?php
						$sqlpmrr	=	"SELECT * FROM `inv_warehosueinfo` ";	
					
					
					$resultpmrr = mysqli_query($conn, $sqlpmrr);
					$totalPendingMrr = mysqli_num_rows($resultpmrr);
					?>
						<div class="mr-5"><?php echo $totalPendingMrr; ?> Total Site</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-3 mb-3">
				<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-truck"></i>
						</div>
					<?php
					if($_SESSION['logged']['user_type'] == 'superAdmin') {
						$sqlpmrr	=	"SELECT * FROM `inv_receive`";
					}else{
						$sqlpmrr	=	"SELECT * FROM `inv_receive` WHERE `warehouse_id`='$warehouse_id'";
					}
					
					$resultpmrr = mysqli_query($conn, $sqlpmrr);
					$totalPendingMrr = mysqli_num_rows($resultpmrr);
					?>
						<div class="mr-5"><?php echo $totalPendingMrr; ?> Received Count</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="receive-list.php">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-3 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-truck"></i>
						</div>
					<?php
					if($_SESSION['logged']['user_type'] == 'superAdmin') {
						$sqlpmrr	=	"SELECT * FROM `inv_issue`";	
					}else{
						$sqlpmrr	=	"SELECT * FROM `inv_issue` WHERE `warehouse_id`='$warehouse_id'";
					}
					
					$resultpmrr = mysqli_query($conn, $sqlpmrr);
					$totalPendingMrr = mysqli_num_rows($resultpmrr);
					?>
						<div class="mr-5"><?php echo $totalPendingMrr; ?> Issue Count</div>
					</div> 
					<a class="card-footer text-white clearfix small z-1" href="issue-list.php">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
					</a>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-8 col-sm-8 mb-3">
				<!--here your code will go-->
				<?php //include('received-chart.php'); ?>
				<?php //include('chart/received.php'); ?>
				<?php include('chart/receive-highchart.php'); ?>
				<!--here your code will go-->
			</div>
			<div class="col-xl-4 col-sm-4 mb-3">
				<?php //include('chart/pie.php'); ?>
				<div class="row">
					<div class="col-xl-12 col-sm-12 mb-4">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-truck"></i>
								</div>
							<?php
								$sqlpmrr	=	"SELECT * FROM `inv_projectstransfer`";
							
							
							$resultpmrr = mysqli_query($conn, $sqlpmrr);
							$totalPendingMrr = mysqli_num_rows($resultpmrr);
							?>
								<div class="mr-5"><?php echo $totalPendingMrr; ?> - Project to Project Transfer Count</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="receive-list.php">
							<span class="float-left">View Details</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
							</a>
						</div>
					</div>
					<div class="col-xl-12 col-sm-12 mb-4">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-truck"></i>
								</div>
							<?php
								$sqlpmrr	=	"SELECT * FROM `inv_transfermaster`";
							
							
							$resultpmrr = mysqli_query($conn, $sqlpmrr);
							$totalPendingMrr = mysqli_num_rows($resultpmrr);
							?>
								<div class="mr-5"><?php echo $totalPendingMrr; ?> Site to Site Transfer Count</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="receive-list.php">
							<span class="float-left">View Details</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
							</a>
						</div>
					</div>
					<div class="col-xl-12 col-sm-12 mb-4">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-truck"></i>
								</div>
							<?php
							if($_SESSION['logged']['user_type'] == 'admin') {
								$sqlpmrr	=	"SELECT * FROM `inv_consumption` ";	
							}else{
								$sqlpmrr	=	"SELECT * FROM `inv_consumption` WHERE `warehouse_id`='$warehouse_id'";
							}
							
							$resultpmrr = mysqli_query($conn, $sqlpmrr);
							$totalPendingMrr = mysqli_num_rows($resultpmrr);
							?>
								<div class="mr-5"><?php echo $totalPendingMrr; ?> Consumption Count</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="issue-list.php">
							<span class="float-left">View Details</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
							</a>
						</div>
					</div>
					<div class="col-xl-12 col-sm-12 mb-4">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-truck"></i>
								</div>
							<?php
							if($_SESSION['logged']['user_type'] == 'admin') {
								$sqlpmrr	=	"SELECT * FROM `inv_return` ";	
							}else{
								$sqlpmrr	=	"SELECT * FROM `inv_return` WHERE `warehouse_id`='$warehouse_id'";
							}
							
							$resultpmrr = mysqli_query($conn, $sqlpmrr);
							$totalPendingMrr = mysqli_num_rows($resultpmrr);
							?>
								<div class="mr-5"><?php echo $totalPendingMrr; ?> Return Count</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="issue-list.php">
							<span class="float-left">View Details</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
							</a>
						</div>
					</div>
					<!--
					<div class="col-xl-4 col-sm-6 mb-4">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-truck"></i>
								</div>
							<?php
							if($_SESSION['logged']['user_type'] == 'superAdmin') {
								$sqlpmrr	=	"SELECT * FROM `inv_return` WHERE `approval_status` = '0'";
							}else{
								$sqlpmrr	=	"SELECT * FROM `inv_return` WHERE `warehouse_id`='$warehouse_id' AND `approval_status` = '0'";
							}
							
							$resultpmrr = mysqli_query($conn, $sqlpmrr);
							$totalPendingMrr = mysqli_num_rows($resultpmrr);
							?>
								<div class="mr-5"><?php echo $totalPendingMrr; ?> Pending Return</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="return-list.php">
							<span class="float-left">View Details</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
							</a>
						</div>
					</div> -->
				</div>
			</div>
			<div class="col-xl-12 col-sm-12 mb-4">
				<!----------------------------------Ajax Search------------------------------------------>
				<!----------------------------------Ajax Search------------------------------------------>
				<script type="text/javascript" src="js/getData.js"></script>
				
						<h3>Materialwise Current Stock</h3>
				<div class="card">
					<select class="form-control js-example-basic-single material_select_2" id="material">
						<?php
						$projectsData = get_product_with_category();
						if (isset($projectsData) && !empty($projectsData)) {
							foreach ($projectsData as $data) {
								?>
								<option value="<?php echo $data['item_code']; ?>"><?php echo $data['material_name']; ?></option>
								<?php
							}
						}
						?>
					</select>
					<div id="display">
						<table class="table table-bordered" id="heading" style="display:none;">
							<tbody id="records">
								<tr>
									<td id="in_stock"></td>
								</tr>
							</tbody>
						</table>
						<div class="row" id="no_records"><div class="col-sm-12" style="text-align:center;">Plese select Material to view current stock</div></div>
					</div>	
				</div>
				<!----------------------------------Ajax Search------------------------------------------>
				<!----------------------------------Ajax Search------------------------------------------>
					<!-- end receive search -->
			</div>
		</div>
      </div>
      <!-- /.container-fluid -->
<?php include 'footer.php' ?>