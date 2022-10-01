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
		<button class="btn btn-info linktext" onclick="window.location.href='issue_report.php'">Sales Order Report Search</button>
		<button class="btn btn-success linktext"> Materialwise Sales Order Report </button>
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
									<input type="text" name="material_id" id="material_id" class="form-control" required readonly>
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
							<span>Material Sales Order Report</span><br>
							<span><?php echo getDataRowByTableAndId('inv_material', $material_name)->material_description; ?></span><br>
							From <span class="dtext"><?php echo date("jS F Y", strtotime($from_date));?></span> To  <span class="dtext"><?php echo date("jS F Y", strtotime($to_date));?> </span><br>
						</p>
					</center>
				</div>
			</div>
				<table id="" class="table table-bordered">
					<thead>
						<tr>
							<th>Material ID</th>
							<th>Material Name</th>
							<th>Unit</th>
							<th>QTY</th>
							<th>Party</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($_SESSION['logged']['user_type'] !== 'whm'){
								$sql	=	"SELECT * FROM `qry_inv_issue` where `material_id`='$material_id' AND `issue_date` BETWEEN '$from_date' AND '$to_date';";
							}else{
								$sql	=	"SELECT * FROM `qry_inv_issue` where `material_id`='$material_id' AND `warehouse_id` = '$warehouse_id' AND `issue_date` BETWEEN '$from_date' AND '$to_date';";
							}
							
							$result = mysqli_query($conn, $sql);
							while($row=mysqli_fetch_array($result))
							{
						?>
						<tr style="background-color:#E9ECEF;">
							<td>DO No : <?php echo $row['issue_id']; ?></td>
							<td>Date : <?php echo date("jS F Y", strtotime($row['issue_date']));?></td>
							<td colspan="4">From : <?php 
								$warehouse_id = $row['warehouse_id'];
								$sqlunit	=	"SELECT * FROM `inv_warehosueinfo` WHERE `id` = '$warehouse_id' ";
								$resultunit = mysqli_query($conn, $sqlunit);
								$rowunit=mysqli_fetch_array($resultunit);
								echo $rowunit['name'];
								?>
							</td>
						</tr>
						<?php
							$totalQty = 0;
							
							$issue_id = $row['issue_id'];
							$sqlall	=	"SELECT * FROM `qry_inv_issue` where `material_id`='$material_id' AND `issue_id` = '$issue_id';";
							$resultall = mysqli_query($conn, $sqlall);
							while($rowall=mysqli_fetch_array($resultall))
							{
								$totalQty += $rowall['issue_qty'];
								
						?>
						<tr style="text-align:right;">
							<td><?php echo $rowall['material_id']; ?></td>
							<td><?php 
								$mb_materialid = $rowall['material_id'];
								$sqlname	=	"SELECT * FROM `inv_material` WHERE `material_id_code` = '$mb_materialid' ";
								$resultname = mysqli_query($conn, $sqlname);
								$rowname=mysqli_fetch_array($resultname);
								echo $rowname['material_description'];
							?>
							</td>
							<td><?php echo getDataRowByTableAndId('inv_item_unit', $rowall['unit'])->unit_name; ?></td>
							<td><?php echo $rowall['issue_qty']; ?></td>
							<td><?php 
											$dataresult =   getDataRowByTableAndId1('tb_party', $row['party_id']);
											echo (isset($dataresult) && !empty($dataresult) ? $dataresult->partyname : '');
										?></td>
							
							
						</tr>
						<?php } ?>
						<tr style="text-align:right;">
							<td colspan="3" class="grand_total">Total:</td>
							<td><?php echo $totalQty; ?></td>
							<td></td>
							
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


