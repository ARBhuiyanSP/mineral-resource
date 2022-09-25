<?php include 'header.php' ?>
<!-- Left Sidebar End -->
<style>
.table-bordered thead th, .table-bordered thead tr th{
	font-size:12px !important;
}
</style>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="consumption_report.php">Sales Report</a>
        </li>
        <li class="breadcrumb-item active">Delivery Order</li>
		
		
		        <li class="breadcrumb-item" style="text-align:right;">
								
								<?php  
									$warehouse_id = $_SESSION['logged']['warehouse_id'];								
									$dataresult =   getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);
								
								echo 'Location: <b>'.(isset($dataresult) && !empty($dataresult) ? $dataresult->name : '').'</b>'; ?>
		</li>
		
		
		
		
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Delivery Order Entry Form</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_issue" id="issue_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('issue_entry_form');">
                    <div class="row" id="div1" style="">
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="text" autocomplete="off" name="issue_date" id="issue_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
						
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>Delivery No</label>
                                <?php
                                if ($_SESSION['logged']['user_type'] == 'whm') {
                                    $warehouse_id = $_SESSION['logged']['warehouse_id'];
                                    $sql = "SELECT * FROM inv_warehosueinfo WHERE `id`='$warehouse_id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $short_name = $row['short_name'];
                                    $issueCode = 'DO-' . $short_name;
                                } else {
                                    $issueCode = 'DO-CW';
                                }
                                ?>
                                <input type="text" name="issue_id" id="issue_id" class="form-control" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_issue', 'issue_id', '03d', '001', $issueCode) ?>" readonly>
                                <input type="hidden" name="issue_no" id="issue_no" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_issue', 'issue_id', '03d', '001', $issueCode) ?>">
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						
						
					<div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">P/O No</label>
                                <input type="text" name="pono" id="pono" class="form-control">
                            </div>
                        </div>
						
						
						
                       	<td style="width:30%">
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
							</td>
							
						
                        <div class="col-xs-1">
                            <div class="form-group">
                                <label for="id">party ID</label>
                                <input type="text" name="party_id" id="party_id" class="form-control" readonly required>
                            </div>
                        </div>
						
						
						<div class="col-xs-2">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select name="partystatus" id="partystatus" value="<?php if (isset($rowedit['partystatus']) && $rowedit['partystatus'] != '') { echo $rowedit['partystatus']; }?>" class="form-control">
									<option value="Cash">Cash</option>
									<option value="Credit">Credit</option>
									
								</select>
                            </div>
                        </div>
						
						
						
						
						
						<td style="width:30%">
								<div class="form-group">
								<label for="id">S.E Name</label><span class="reqfield"> ***required</span>
								<select class="form-control" id="main_sub_item_id" name="salesexuctivename" onchange="getItemCodeByParam(this.value, 'tb_salesexcutive', 'se_id', 'se_id');">
									<option value="">Select</option>
									<?php
									$parentCats = getTableDataByTableName('tb_salesexcutive','','salesexuctivename');
									if (isset($parentCats) && !empty($parentCats)) {
										foreach ($parentCats as $pcat) {
											?>
											<option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['salesexuctivename'] ?></option>
										<?php }
									} ?>
								</select>
							</div>
							</td>
							
						
                        <div class="col-xs-1">
                            <div class="form-group">
                                <label for="id">S.E ID</label>
                                <input type="text" name="se_id" id="se_id" class="form-control" readonly required>
                            </div>
                        </div>
						
						<div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Due/Credit Amount</label>
                                <input type="text" name="credit" id="credit" class="form-control">
                            </div>
                        </div>
						
						<div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Prepared By</label>
                                <input type="text" name="preparedby" id="preparedby" class="form-control">
                            </div>
                        </div>


						<div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Authorized by</label>
                                <input type="text" name="authorizedby" id="authorizedby" class="form-control">
                            </div>
                        </div>
						
						
                       <input type="hidden" value="2" name="project_id" />
					   
                        <div class="col-xs-2">
                             <?php
                                $warehouse_id = $_SESSION['logged']['warehouse_id'];
                                $dataresult = getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);
                                ?>
                                <input type="hidden" class="form-control" readonly="readonly" value="<?php echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); ?>">

                                <input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['warehouse_id']; ?>">
              
                        </div>


                    </div>
                    <div class="row" id="div1"  style="">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamic_field">
                                <thead>
                                <th width="40%">Material Name </th>
                                <th width="10%">Unit</th>
                                <th width="10%">In Stock</th>
								
								
							    <th width="10%">Qty <span class="reqfield"> ***req</span></th>
								<th width="10%">Sale Price</th>
                                <th width="15%">Sale Amount</th>
								
								
                                <th width="5%"></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control material_select_2" id="material_name" name="material_name[]" required onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id0', 'qty_unit', 'cur_price');">
                                                <option value="">Select</option>
                                                <?php
                                                $projectsData = get_product_with_category();
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?>
                                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <input type="hidden" name="material_id[]" id="material_id0" class="form-control" required readonly>
                                        <td>
                                            <select class="form-control" id="unit0" name="unit[]" required readonly>
                                                <option value="">Select</option>
                                                <?php
                                                $projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?>
                                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
										<td><input type="text" name="material_total_stock[]" id="material_total_stock0" class="form-control" readonly ></td>
										
										
										<!-- Start: text QTY and Unit Price and Total amount -->
										
										<td><input type="text" name="quantity[]" id="quantity0" onchange="check_stock_quantity_validation(0)" class="form-control common_issue_quantity" required></td>
					  
                               
                                       
										<td><input type="text" name="unit_price[]" id="unit_price0" onkeyup="sum(0)" class="form-control" required></td>
										<td><input type="text" name="amount[]" id="sum0" class="form-control sub_sell_amount" readonly ></td>
										
										<!-- End: text QTY and Unit Price and Total amount -->
										
										<td><button type="button" name="add" id="add" class="btn" style="background-color:#007BFF;color:#ffffff;">+</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					
					
							<div class="col-sm-4">
							<table class="table table-bordered">
							
								<tr>
									<td>Total Sale Amount</td>
									<td><input type="text" class="form-control" maxlength="10" name="total_amount" id="allsum" readonly /></td>
								</tr>
								
								
								
								<tr>
									<td>Discount Amount (%/amt) <span class="reqfield"> req</span></td>
									<td><input type="text" class="form-control" name="discount_amount" id="discount" class="form-control" required></td>
								</tr>
								
								
								<tr>
									<td>Net Sale Amount</td>
									<td><input type="text" class="form-control" name="netsale_amount" id="netsale" class="form-control" readonly ></td>
								</tr>
								
								
								
								
								<tr>
									<td>Paid Amount <span class="reqfield"> req</span></td>
									<td><input type="text" class="form-control" name="paid_amount" id="paid" class="form-control" required></td>
								</tr>
								<tr>
									<td>Due Amount</td>
									<td><input type="text" class="form-control" name="due_amount" id="due" class="form-control" readonly ></td>
								</tr>
								
							
								
								
								
							</table>
						</div>
					
                    
						
						
						
						
						                    <div class="row" id="div1"  style="">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamic_field">
                                <thead>
                                <th width="40%">last Mr No </th>
                                <th width="10%">Last Mr Date</th>
                                <th width="10%">Last MR No</th>
								
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                    
										
		<td><input type="text" class="form-control" maxlength="10" name="lastmrno" id="lastmrno"  /></td>	
										
		<td><input type="text" class="form-control" maxlength="10" name="lastmrdate" id="lastmrdate"  /></td>
		
		<td><input type="text" class="form-control" maxlength="10" name="lastmramount" id="lastmramount"  /></td>
                               
                            
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					
					
					
					
					<div class="row" style="">
						<div class="col-sm-8">
							<div class="form-group">
                                <label>Remarks</label>
                                <textarea id="remarks" name="remarks" class="form-control" rows="6"></textarea>
                            </div>
						</div>
					
				
                    </div>
					
					
				
					
					
					
					
                    <div class="row" style="">
                        <div class="col-xs-12">
                            
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="modal-footer">
                                    <input type="submit" name="issue_submit" id="issue_submit" class="btn btn-block" style="background-color:#007BFF;color:#ffffff;" value="Save" />
                                </div>    
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <!--here your code will go-->
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- Comments: + addd korar code  -->


<script>
     var i = 0;
    $(document).ready(function () {
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><select class="form-control material_select_2" id="material_name' + i + '" name="material_name[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'," + "'material_id_code'," + "'material_id'," + "'qty_unit'" + ')"><option value="">Select</option><?php
                                    $projectsData = get_product_with_category();
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?><option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option><?php
                                        }
                                    }
                                    ?></select></td><input type="hidden" name="material_id[]" id="material_id' + i + '" class="form-control" required readonly><td><select class="form-control select2" id="unit' + i + '" name="unit[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id''" + ",'qty_unit'" + ')"><option value="">Select</option><?php
                                    $projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?><option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option><?php
                                        }
                                    }
                                    ?></select></td><td><input type="text" name="material_total_stock[]" id="material_total_stock' + i + '" class="form-control" readonly></td><td><input type="text" name="quantity[]" id="quantity' + i + '" onchange="check_stock_quantity_validation(' + i + ')" class="form-control common_issue_quantity" required></td><td><input type="text" name="unit_price[]" id="unit_price' + i + '" onchange="sum(0)" class="form-control" required></td><td><input type="text" name="amount[]" id="sum' + i + '" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td></tr>');
									$(".material_select_2").select2();
									
									<!-- COMMENTS: QTY AND UNIT PRICE AND TOTAL AMOUNT -->
									
            $('#quantity' + i + ', #unit_price' + i).change(function () {
                 sum(i)
            });
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            sum_total();
        });
    });

    $(document).ready(function () {
        //this calculates values automatically 
        sum(0);
    });

    function sum(i) {
        var quantity1 = document.getElementById('quantity' + i).value;
        var unit_price1 = document.getElementById('unit_price' + i).value;
        var result = parseFloat(quantity1) * parseFloat(unit_price1);
        if (!isNaN(result)) {
            document.getElementById('sum' + i).value = result;
        }
        sum_total();
    }
    function sum_total() {
        var newTot = 0;
        for (var a = 0; a <= i; a++) {
            aVal = $('#sum' + a);
            if (aVal && aVal.length) {
                newTot += aVal[0].value ? parseFloat(aVal[0].value) : 0;
            }
        }
        document.getElementById('allsum').value = newTot.toFixed(2);
    }
	
	$(function () {
	  $("#allsum, #discount").keyup(function () {
		$("#netsale").val(+$("#allsum").val() - +$("#discount").val());
		calculate_profit_amount();
	  });
	});
	
	
	$(function () {
	  $("#allsum, #paid").keyup(function () {
		$("#due").val(+$("#allsum").val() - +$("#paid").val());
	  });
	});
</script>

<script>
    $(function () {
        $("#issue_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<script>
    $('input[type="submit"]').prop("disabled", false);
    var a = 0;
//binds to onchange event of your input field
    $('#picture').bind('change', function () {
        if ($('input:submit').attr('disabled', false)) {
            $('input:submit').attr('disabled', true);
        }
        var ext = $('#picture').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $('#error1').slideDown("slow");
            $('#error2').slideUp("slow");
            a = 0;
        } else {
            var picsize = (this.files[0].size);
            if (picsize > 500000) {
                $('#error2').slideDown("slow");
                a = 0;
            } else {
                a = 1;
                $('#error2').slideUp("slow");
            }
            $('#error1').slideUp("slow");
            if (a == 1) {
                $('input:submit').attr('disabled', false);
            }
        }
    });

</script>
<?php include 'footer.php' ?>