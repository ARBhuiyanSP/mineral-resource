<?php include 'header.php'; ?>
<!-- Left Sidebar End -->
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<link href="css/form-entry.css" rel="stylesheet">-->
<!-- Left Sidebar End -->



<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Receive Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Receive Entry
            <a href="receive-list.php" style="float:right"><i class="fas fa-list"></i> Receive List<a>
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
                    <div class="row" id="div1" style="">
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>MRR Date</label>
                                <input type="text" autocomplete="off" name="mrr_date" id="mrr_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>MRR No</label>
								<?php if($_SESSION['logged']['user_type'] == 'whm')
									{
										$warehouse_id	=	$_SESSION['logged']['warehouse_id'];
										$sql	=	"SELECT * FROM inv_warehosueinfo WHERE `id`='$warehouse_id'";
										$result = mysqli_query($conn, $sql);
										$row=mysqli_fetch_array($result);
										$short_name = $row['short_name'];
										$mrrcode= 'MRR-'.$short_name;
									} else{
										$mrrcode= 'MRR-WL';
									}
									
									if($_SESSION['logged']['user_type'] == 'admin')
									{
										$vars	=	'getDefaultCategoryCode';
									}else{
										$vars	=	'getDefaultCategoryCodeByWarehouse';
									}
								?>
                                <input type="text" name="mrr_no" id="mrr_no" class="form-control" value="<?php echo $vars('inv_receive', 'mrr_no', '03d', '001', $mrrcode) ?>" readonly>
                                <input type="hidden" name="receive_no" id="receive_no" value="<?php echo $vars('inv_receive', 'mrr_no', '03d', '001', $mrrcode) ?>">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>LC No</label>
                                <input type="text" name="lc_no" id="purchase_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>LC Date</label>
                                <input type="text" autocomplete="off" name="lc_date" id="requisition_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">	
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">PKG No</label>
                                <input type="text" name="pkg_no" id="pkg_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">PKG Date</label>
                                <input type="text" autocomplete="off" name="pkg_date" id="challan_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">BL No.</label>
                                <input type="text" name="bl_no" id="requisition_no" class="form-control">
								<!-- <input type="text" id="requisition_no" name="requisition_no" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{5}" required></input> -->
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">BL Date</label>
                                <input type="text" autocomplete="off" name="bl_date" id="bl_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="id">Supplier</label><span class="reqfield"> ***required</span>
                                <select class="form-control material_select_2" id="supplier_name" name="supplier_name" required onchange="getItemCodeByParam(this.value, 'suppliers', 'code', 'supplier_id');">
                                    <option value="">Select</option>
                                    <?php
                                    $projectsData = getTableDataByTableName('suppliers');

                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Supplier ID</label>
                                <input type="text" name="supplier_id" id="supplier_id" class="form-control" required>
                            </div>
                        </div>
						<div class="col-xs-2">
                            <div class="form-group">
                                <label>Warehouse</label>
								
								<?php  
									$warehouse_id = $_SESSION['logged']['warehouse_id'];								
									if($_SESSION['logged']['user_type'] != 'admin'){$dataresult =   getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);}
								?>
								<input type="text" class="form-control" readonly="readonly" value="<?php if($_SESSION['logged']['user_type'] == 'admin'){echo '';}else{echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');} ?>">
								
								<input type="hidden" name="port_id" id="port_id" class="form-control" readonly="readonly" value="<?php if($_SESSION['logged']['user_type'] == 'admin'){echo '';}else{echo $_SESSION['logged']['port_id'];} ?>">
								
								<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php if($_SESSION['logged']['user_type'] == 'admin'){echo '';}else{echo $_SESSION['logged']['warehouse_id'];} ?>">
								
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div1"  style="">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamic_field">
                                <thead>
									<th width="30%">Material Name<span class="reqfield"> ***</span></th>
									<th>Material ID</th>
									<th width="10%">Unit</th>
									<th width="10%">Country</th>
									<th>Qty<span class="reqfield"> ***</span></th>
									<th>Unit Price<span class="reqfield"> ***</span></th>
									<th>Total Amount</th>
									<th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control material_select_2" id="material_name" name="material_name[]" required onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id0', 'qty_unit');">
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
                                        <td><input type="text" name="material_id[]" id="material_id0" class="form-control" required readonly></td>
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
                                        <td>
                                            <select class="form-control material_select_2" id="country0" name="country[]">
                                                <option value="">Select</option>
                                                <option value="Indonesia">Indonesia</option>
                                            </select>
                                        </td>
                                        <td><input type="number" step=".01" name="quantity[]" id="quantity0" onkeyup="sum(0)" class="form-control" required></td>
                                        <td><input type="number" step=".01" name="unit_price[]" id="unit_price0" onkeyup="sum(0)" class="form-control" required></td>
                                        <td><input type="text" step=".01" name="totalamount[]" id="sum0" class="form-control" readonly ></td>
                                        <td><button type="button" name="add" id="add" class="btn" style="background-color:#2e3192;color:#ffffff;">+</button></td>
                                    </tr>
                                </tbody>
                            </table>
							<table class="table table-bordered">
								<tr>
									<td width="" style="">VAT Challan No<span class="reqfield"> ***required</span></td>
									<td><input type="text" class="form-control" maxlength="30" name="vat_challan_no" required /></td>
									<td width="" style="text-align:right;">Total Amount</td>
									<td><input type="text" class="form-control" maxlength="30" name="sub_total_amount" id="allsum" readonly /></td>
								</tr>
							</table>
                        </div>
                    </div>
					<div class="row" style="">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input type="file" accept="image/*"  name="file" id="picture">
								<p id="error1" style="display:none; color:#FF0000;">
								Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
								</p>
								<p id="error2" style="display:none; color:#FF0000;">
								Maximum File Size Limit is 500KB.
								</p>
								<script>
								  var loadFile = function(event) {
									var output = document.getElementById('output');
									output.src = URL.createObjectURL(event.target.files[0]);
									output.onload = function() {
									  URL.revokeObjectURL(output.src) // free memory
									}
								  };
								  
								</script>
								
                            </div>
                        </div>
						<div class="col-xs-6"></div>
                    </div>
                    <div class="row" style="">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea id="remarks" name="remarks" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                 <input type="submit" name="receive_submit" id="submit" class="btn btn-block" style="background-color:#007BFF;color:#ffffff;" value="Save" />   
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
<script>
    var i = 0;
    $(document).ready(function () {
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><select class="form-control material_select_2" id="material_name' + i + '" name="material_name[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'," + "'material_id_code'," + "'material_id'," + "'qty_unit'" + ')"><option value="">Select</option><?php
                                                $projectsData = get_product_with_category();
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option><?php }
                                                }
                                                ?></select></td><td><input type="text" name="material_id[]" id="material_id' + i + '" class="form-control" required readonly></td><td><select class="form-control select2" id="unit' + i + '" name="unit[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id''" + ",'qty_unit'" + ')" readonly><option value="">Select</option><?php
                                                $projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option><?php }
                                                }
                                                ?></select></td><td><select class="form-control material_select_2" id="country' + i + '" name="country[]' + i + '" ><option value="">Select</option><option value="Indonesia">Indonesia</option></select></td><td><input type="number" step=".01" name="quantity[]" id="quantity' + i + '" onkeyup="sum(' + i + ')" class="form-control" required></td><td><input type="number" step=".01" name="unit_price[]" id="unit_price' + i + '" onkeyup="sum(' + i + ')" class="form-control" required></td><td><input type="text" step=".01" name="totalamount[]" id="sum' + i + '" class="form-control" readonly ></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td></tr>');
												$(".material_select_2").select2();
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
            document.getElementById('sum' + i).value = result.toFixed(2);
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
</script>
<script>
    $(function () {
        $("#mrr_date").datepicker({
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
        $("#challan_date").datepicker({
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
        $("#requisition_date").datepicker({
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
        $("#bl_date").datepicker({
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
var a=0;
//binds to onchange event of your input field
$('#picture').bind('change', function() {
if ($('input:submit').attr('disabled',false)){
 $('input:submit').attr('disabled',true);
 }
var ext = $('#picture').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
 $('#error1').slideDown("slow");
 $('#error2').slideUp("slow");
 a=0;
 }else{
 var picsize = (this.files[0].size);
 if (picsize > 500000){
 $('#error2').slideDown("slow");
 a=0;
 }else{
 a=1;
 $('#error2').slideUp("slow");
 }
 $('#error1').slideUp("slow");
 if (a==1){
 $('input:submit').attr('disabled',false);
 }
}
});
</script>
<?php include 'footer.php' ?>