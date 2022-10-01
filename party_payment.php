<?php 
include 'header.php';

if (isset($_GET['id']) && $_GET['id'] != '') { 
	//echo $row['education'];
	$id=	$_GET['id'];
	
	
	$table 	= 'party_payment';
	$sqledit = "SELECT * FROM $table WHERE `id`='$id'";
	$resultedit = $conn->query($sqledit);
	$rowedit = mysqli_fetch_array($resultedit);
	$button_name = 'Update';
	$button_post_name = 'party_payment_update_submit';
}
else{
	$button_name = 'Save';
	$button_post_name = 'party_payment_submit';
}

?>
<style>
.bs-member-type 
	{
		display: none;
	}
show-fields 
	{
		display:block;   
	}
hidden-fields 
	{
		display:none;
	}
</style>
<!-- Left Sidebar End -->
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="party_ledger.php">Party Ledger Report</a>
			
        </li>
		<li class="breadcrumb-item">
            <a href="allpartyaccountstatus_report.php">All Party Balance REport</a>
			
        </li>
		
		<li class="breadcrumb-item">
            <a href="allpartyaccountstatuspartnerandpartywise_report.php">Partner and  Party wise Balance Report</a>
			
        </li>
		
        <li class="breadcrumb-item active"> Party Payment Receive Form</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Party Payment Receive Form
		</div>
        <div class="card-body">
		
		
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="form" enctype="multipart/form-data">
                    <div class="row" id="div1" style="">
					<!--search and view data || auto increment-->
						<div class="col-xs-2">
							<div class="form-group">
								<label>MR ID</label>
								<?php
								
									if(isset($rowedit['voucherid']) && !empty($rowedit['voucherid'])){
										$voucherid 	=$rowedit['voucherid'];
									}else{
										$voucherid 	=	getDefaultCategoryCode('party_payment', 'voucherid', '03d', '001', 'MR-');
									}
								   ?>
								<input type="text" name="voucherid" id="voucherid" value="<?php echo $voucherid; ?>" class="form-control" readonly="readonly">
							</div>
						</div>
						
						<div class="col-xs-2">
							<div class="form-group">
								<label for="id">MR Date</label>
								<input type="text" autocomplete="off" name="voucherdate" id="voucherdate" value="<?php if (isset($rowedit['voucherdate']) && $rowedit['voucherdate'] != '') { echo $rowedit['voucherdate']; }?>" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
						<div class="col-xs-2">
							<div class="form-group">
								<label for="id">Party Name</label><span class="reqfield"> ***required</span>
								<select class="form-control" id="main_sub_item_id" name="partyname" onchange="getItemCodeByParam(this.value, 'tb_party', 'party_id', 'party_id');">
									<option value="">Select</option>
									<?php
									$parentCats = getTableDataByTableName('tb_party','','partyname');
									if (isset($parentCats) && !empty($parentCats)) {
										foreach ($parentCats as $pcat) {
											?>
											<option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['partyname'] ?></option>
										<?php }
									} ?>
								</select>
							</div>
						</div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">party ID</label>
                                <input type="text" name="party_id" id="party_id" class="form-control" value="<?php if (isset($rowedit['partyid']) && $rowedit['partyid'] != '') { echo $rowedit['partyid']; }?>" readonly required>
                            </div>
                        </div>
                       
						
						
						<div class="col-xs-2">
                            <div class="form-group">
                                <label>Payment Type</label>
								<select class="form-control" id="main_sub_item_id" name="mem_type">
									<option value="">Select</option>
									<option value="CASH">CASH</option>
									<option value="BANK">BANK</option>
								</select>
                            </div>
                        </div>
	
						<div class="col-xs-2">
							<div class="form-group">
								<label>Amount</label>
								<input type="text" name="amount" value="<?php if (isset($rowedit['amount']) && $rowedit['amount'] != '') { echo $rowedit['amount']; }?>" id="amount" class="form-control">
							</div>
						</div>
						
						<!---------->
						<!---------->
						<div class="col-xs-2 bs-member-type"> 
							<h2>Bank info</h2>
						</div>
						<div class="col-xs-2 bs-member-type">
							<label for="reg_first_name">Bank Name</label>
							<input type="text" class="form-control" name="first_name" id="reg_first_name" size="10" value="" />
						</div>

						<div class="col-xs-3 bs-member-type">
							<label for="reg_last_name">Branch Name</label>
							<input type="text" class="form-control" name="last_name" id="reg_last_name" size="10" value="" />
						</div>
						<div class="col-xs-3 bs-member-type">
							<label for="reg_last_name">Cheque No</label>
							<input type="text" class="form-control" name="last_name" id="reg_last_name" size="10" value="" />
						</div>
						<div class="col-xs-2 bs-member-type">
							<label for="reg_last_name">Cheque date</label>
							<input type="text" class="form-control" name="last_name" id="cheque_date" size="10" value="" />
						</div>
						<!---------->
						<!---------->
						<div class="col-xs-2">
							<div class="form-group">
								<label>Receiver Mode</label>
								<input type="text" name="receivermode" id="receivermode" value="<?php if (isset($rowedit['receivermode']) && $rowedit['receivermode'] != '') { echo $rowedit['receivermode']; }?>" class="form-control">
							</div>
						</div>
						
						<div class="form-group">
							<label>Warehouse</label>

							<?php
							$warehouse_id = $_SESSION['logged']['warehouse_id'];
							$dataresult = getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);
							?>
							<input type="text" class="form-control" readonly="readonly" value="<?php echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); ?>">

							<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['warehouse_id']; ?>">

						</div>	
						<div class="col-xs-8">
							<div class="form-group">
								<label>Remarks</label>
								<input type="text" name="remarks" id="remarks" class="form-control" value="<?php if (isset($rowedit['remarks']) && $rowedit['remarks'] != '') { echo $rowedit['remarks']; }?>">
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<!-- name="edit_id"   call korchi party_payment_process.php -->		
								<input type="hidden" name="edit_id" value="<?php echo (isset($rowedit['id']) && !empty($rowedit['id']) ? $rowedit['id']: ""); ?>">
								<!-- party_payment_submit        party_payment_process.php -->	
								<input type="submit" name="party_payment_submit" id="submit" class="btn btn-block" style="background-color:#007BFF;color:#ffffff;" value="<?php echo $button_name; ?>" />   
							</div>
						</div>
                    </div>
					<div class="row">
						<div class="col-xs-12">
							<table id="dataTable" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Voucher ID</th>
										<th>Voucher Date</th>
										<th>Party ID</th>
										<th>Payment Type</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									$item_details = getTableDataByTableName('party_payment', '', 'id');
									
									if (isset($item_details) && !empty($item_details)) {
										foreach ($item_details as $item) {
											?>
											<tr>
												<td><?php echo $item['voucherid']; ?></td>
												<td><?php echo $item['voucherdate']; ?></td>
												
												<td>
									<?php 
									$dataresult =   getDataRowByTableAndId1('tb_party', $item['partyid']);
									echo (isset($dataresult) && !empty($dataresult) ? $dataresult->partyname : '');
									?>
								               </td>
											   
											   
												<td><?php echo $item['paymenttype']; ?></td>
												<td><?php echo $item['amount']; ?></td>
												<td>
													<span><a class="action-icons c-approve" href="issue-view.php?no=<?php echo $item['issue_id']; ?>" title="View"><i class="fas fa-eye text-success"></i></a></span>
													
													<span><a class="action-icons c-approve" href="party_payment.php?id=<?php echo $item['id']; ?>" title="View"><i class="fas fa-edit text-info"></i></a></span>
													
											<span><a class="action-icons c-delete" href="#" title="delete"><i class="fa fa-trash text-danger"></i></a></span>
												</td>
											</tr>
											<?php
										}
									}else{ ?>
										  <tr>
											  <td colspan="7">
													<div class="alert alert-info" role="alert">
														Sorry, no data found!
													</div>
												</td>
											</tr>  
									<?php } ?>
								</tbody>

							</table>
						</div>
</div>
                </form>
            </div>
            <!--here your code will go-->
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
	$(function() {
	$("#voucherdate").datepicker({
			inline: true,
			dateFormat:"yy-mm-dd",
			yearRange:"-50:+10",
			changeYear: true,
			changeMonth: true
	});
});
</script>

<script>
	$(function() {
	$("#cheque_date").datepicker({
			inline: true,
			dateFormat:"yy-mm-dd",
			yearRange:"-50:+10",
			changeYear: true,
			changeMonth: true
	});
});
</script>
<script>
jQuery(document).ready(function($){
  $('select[name=mem_type]').change(function () {
        
        
    // hide all optional elements
    $('.bs-member-type').css('display','none');   
        
    var $name = $(this).val();
    
    console.log($name);    
    if($name == "BANK") {
      $('.bs-member-type').css('display','block');
    }

  }); 
});
</script>

<?php include 'footer.php' ?>