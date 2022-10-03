<style>
.dtext{
	text-decoration:underline;
}
.linktext{
	font-size:12px;
}
.table th, .table td{
	padding:5px;
}
</style>
<div class="card mb-3">
    <div class="card-header">
        <button class="btn btn-info linktext" onclick="window.location.href='movement_report.php'">Movement Report Search</button>
        <button class="btn btn-success linktext">Material Movement Report Search</button>
		<button class="btn btn-info linktext" onclick="window.location.href='sitewise_movement_report.php'"> Sitewise Movement Report </button>
		<button class="btn btn-info linktext" onclick="window.location.href='categorywise_movement_report.php'"> Categorywise Movement Report </button>
	</div>
    <div class="card-body">
        <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
            <div class="table-responsive">          
                <table class="table table-borderless search-table">
                    <tbody>
                        <tr>  
							<td>
								<div class="form-group">
									<label for="id">Material</label>
									<select class="form-control material_select_2" id="material_name" name="material_name" required  onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id');">
										<option value="">Select</option>
										<?php
										$projectsData = get_product_with_category();
										if (isset($projectsData) && !empty($projectsData)) {
											foreach ($projectsData as $data) {
												if($_GET['material_name'] == $data['id']){
													$selected	= 'selected';
													}else{
													$selected	= '';
													}
												?>
												<option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>><?php echo $data['material_name']; ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="id">Material ID</label>
									<input type="text" name="material_id" id="material_id" class="form-control" value="<?php if(isset($_GET['material_id'])){ echo $_GET['material_id']; } ?>" required readonly>
								</div>
							</td>
							<td>
                                <div class="form-group">
                                    <label for="todate">From Date</label>
                                    <input type="text" class="form-control" id="from_date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" autocomplete="off" required >
                                </div>
                            </td>
							<td>
                                <div class="form-group">
                                    <label for="todate">To Date</label>
                                    <input type="text" class="form-control" id="to_date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" autocomplete="off" required >
                                </div>
                            </td>
							
							<td>
                                <div class="form-group">
                                    <label for="todate">.</label>
									<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<?php
if(isset($_GET['submit'])){
	$material_name	=	$_GET['material_name'];
	$material_id	=	$_GET['material_id'];
	$from_date		=	$_GET['from_date'];
	$to_date		=	$_GET['to_date'];
	$warehouse_id	=	$_SESSION['logged']['warehouse_id'];
	
	
?>
<center>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="printableArea">
			<div class="row">
				<div class="col-sm-12">	
					<center>
						<p>
							<img src="images/Saif_Engineering_Logo_165X72.png" height="100px;"/><br>
							<span>Material Movement Report</span><br>
							<span>Material : <?php echo getDataRowByTableAndId('inv_material', $material_name)->material_description; ?></span><br>
							From <span class="dtext"><?php echo date("jS F Y", strtotime($from_date));?></span> To  <span class="dtext"><?php echo date("jS F Y", strtotime($to_date));?> </span><br>
						</p>
					</center>
				</div>
			</div>
				<table id="" class="table table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th>Type</th>
							<th>Ref No</th>
							<th>In Qty</th>
							<th>Out Qty</th>
							<th>Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							/* $sqlpreinqty = "SELECT SUM(`mbin_qty`)- SUM(`mbout_qty`) AS due FROM `inv_materialbalance` WHERE `mb_materialid` = '$material_id' AND `warehouse_id`='$warehouse_id' AND `mb_date` < '$from_date'"; */
							
							$sqlpreinqty = "SELECT SUM(`mbin_qty`)- SUM(`mbout_qty`) AS due FROM `inv_materialbalance` WHERE `mb_materialid` = '$material_id' AND `warehouse_id`='$warehouse_id' AND `mb_date` < '$from_date'";
							$resultpreinqty = mysqli_query($conn, $sqlpreinqty);
							$rowpreinqty = mysqli_fetch_object($resultpreinqty);
							
							if($rowpreinqty->due > 0){
								$opening_stock = $rowpreinqty->due;
							}
							else {
									$opening_stock = 0;
								}
							//echo $opening_stock;
						?>
						<tr style="background-color:#E9ECEF;">
							<td><?php echo date("jS F Y", strtotime($from_date));?></td>
							<td>Opening Balance</td>
							<td></td>
							<td colspan="2"><?php echo $opening_stock; ?></td>
							<td><?php echo $opening_stock; ?></td>
						</tr>
						<?php
							$sql	=	"SELECT * FROM `inv_materialbalance` WHERE `mb_materialid`='$material_id' AND `warehouse_id`='$warehouse_id' AND `mb_date` BETWEEN '$from_date' AND '$to_date';";
							$result = mysqli_query($conn, $sql);
							$totaldebit = 0;
							$totalcredit = 0;
							while($row=mysqli_fetch_array($result))
							{
								$debit = $row['mbout_qty'];
								$totaldebit += $row['mbout_qty'];
								
								$credit = $row['mbin_qty'];
								$totalcredit += $row['mbin_qty'];
									
								$balance = $opening_stock + $totalcredit - $totaldebit;
						?>
						<tr style="background-color:#E9ECEF;">
							<td><?php echo date("jS F Y", strtotime($row['mb_date']));?></td>
							<td><?php echo $row['mbtype']; ?></td>
							<td><?php echo $row['mb_ref_id']; ?></td>
							<td><?php echo $row['mbin_qty']; ?></td>
							<td><?php echo $row['mbout_qty']; ?></td>
							
							<?php 
							$adate			=	$row['mb_date'];
							$sqlcredit 		=	"SELECT SUM(`mbin_qty`) AS tcredit FROM `inv_materialbalance` WHERE `mb_materialid` = '$material_id' AND `warehouse_id`='$warehouse_id' AND `mb_date` < '$adate'";
							$resultcredit 	= 	mysqli_query($conn, $sqlcredit);
							$rowcredit 		=	mysqli_fetch_object($resultcredit);
							$creditamount	=	$rowcredit->tcredit;
							?>
							<td><?php echo $balance; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<center><div class="row">
					<div class="col-sm-6"></br></br>--------------------</br>Receiver Signature</div>
					<div class="col-sm-6"></br></br>--------------------</br>Authorised Signature</div>
				</div></center></br>
				<div class="row">
					<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
						<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
						
					</div>
				</div>
			</div>			
		</div>
		<center><button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button></center>
		<div class="col-md-1"></div>
</center>
<?php }?>
<script>
function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;

	 document.body.innerHTML = printContents;

	 window.print();

	 document.body.innerHTML = originalContents;
}
</script>
<script>
    $(function () {
        $("#from_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<script>
    $(function () {
        $("#to_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>


