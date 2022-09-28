<?php 
include 'header.php';
include 'includes/ignite_invoice_process.php';
?>

<!-- Left Sidebar End -->
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<link href="css/form-entry.css" rel="stylesheet">-->
<!-- Left Sidebar End -->
<div class="container-fluid">
    <!-- DataTables Example -->
	
	<script type="text/javascript">
        $(document).ready(function(){

            $(document).on('keydown', '.vehicleno', function() {
                
                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];

                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "getDetails.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,request:1
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    select: function (event, ui) {
                        $(this).val(ui.item.label); // display the selected text
                        var userid = ui.item.value; // selected id to input

                        // AJAX
                        $.ajax({
                            url: 'getDetails.php',
                            type: 'post',
                            data: {userid:userid,request:2},
                            dataType: 'json',
                            success:function(response){
                                
                                var len = response.length;

                                if(len > 0){
                                    var id = response[0]['id'];
                                    var name = response[0]['name'];
                                    var modelno = response[0]['modelno'];
                                    var myear = response[0]['myear'];
                                    var division = response[0]['division'];
                                    var chasisno = response[0]['chasisno'];
                                    var office = response[0]['office'];
                                    var engineno = response[0]['engineno'];

                                    document.getElementById('name_'+index).value = name;
                                    document.getElementById('modelno_'+index).value = modelno;
                                    document.getElementById('myear_'+index).value = myear;
                                    document.getElementById('division_'+index).value = division;
                                    document.getElementById('office_'+index).value = office;
                                    document.getElementById('chasisno_'+index).value = chasisno;
                                    document.getElementById('engineno_'+index).value = engineno;
                                }  
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
	
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Invoice Form
			<span style="float:right;"><button class="btn btn-info" onclick="window.location.href='ignite-invoice-list.php';"><i class="fas fa-list"></i> Invoice List</button></span>
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="add_name">
                    <div class="row" id="div1" style="">
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label class="field_title"> Invoice ID</label>
                                <input type="text" name="invoice_id" id="invoice_id" class="form-control" readonly="readonly" value="<?php echo getDefaultCategoryCode('ignite_invoice', 'invoice_no', '03d', '001', 'INV-') ?>">
                            </div>
                        </div>
						<div class="col-xs-2">
                            <div class="form-group">
                                <label class="field_title">Date<span class="reqr"> is required***</span></label>
                                <input type="text" autocomplete="off" name="invoice_date" id="invoice_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" required >
                            </div>
                        </div>
						<div class="col-xs-2">
                            <div class="form-group">
                                <label class="field_title">Vehicle Reg No<span class="reqr"> is required***</span></label>
								<input type='text' name="vehicle_reg_no" class='form-control vehicleno' id='vehicleno_1' placeholder='Enter Vehicle No' required>
                            </div>
                        </div>
						<div class="col-xs-2">
                            <div class="form-group">
                                <label class="field_title">Chasis No<span class="reqr"> is required***</span></label>
                                <input type='text' name="chasis_no" class='form-control chasisno' id='chasisno_1' required >
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Brand</label>
                                <input type="text" name="brand" id="name_1" class="form-control name">
                            </div>
                        </div>
						
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Model</label>
                                <input type="text" name="modelno" id="modelno_1" class="form-control name">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Year</label>
                                <input type="text" name="myear" id="myear_1" class="form-control name">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="id">Engine No.<span class="reqr"> is required***</span></label>
                                <input type='text' name="engine_no" class='form-control engineno' id='engineno_1' required >
                            </div>
                        </div>
						<div class="col-xs-2">
                            <div class="form-group">
                                <label class="field_title">Client Name<span class="reqr"> is required***</span></label>
                                <input type='text' name="client_name" class='form-control division' id='division_1' required >
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Address<span class="reqr"> is required***</span></label>
                                <input type='text' name="address" class='form-control office' id='office_1' required >
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="id">Client Phone<span class="reqr"> is required***</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" required >
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="id">Client Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="id">Driver Name<span class="reqr"> is required***</span></label>
                                <input type="text" name="driver_name" id="driver_name" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="id">Driver Phone<span class="reqr"> is required***</span></label>
                                <input type="text" name="driver_phone" id="driver_phone" class="form-control"  >
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div1"  style="">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-bordered" id="service_table">
								<thead>
								<th>Services Perform</th>
								<th width="15%">Total Amount</th>
								<th width="10%"></th>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" name="service_name[]" id="service_name" class="form-control" required></td>
										<td><input type="text" name="totalamount[]" id="servicesum0" onchange="servicesum(0)" class="form-control" required></td>
										<td><button type="button" name="add" id="add" class="btn btn-info" style="">+</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row" style="">
							<div class="col-xs-6 col-md-9">
								<div class="form-group">
									<label style="float:right;">Service Total :</label>
								</div>
							</div>
							<div class="col-xs-6 col-md-3">
								<div class="form-group">
									<input type="text" class="form-control" maxlength="30" name="service_total" id="servicetotalsum" readonly />
								</div>
							</div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="id">Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
							</div>
						</div>
					</div>
				</div>
                    <div class="row" style="">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="submit" name="ignite_invoice_submit" id="submit" class="btn btn-block btn-info" style="" value="Save" />   
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
	$(document).ready(function () {
       $(".txtMult input").keyup(multInputs);

       function multInputs() {
           var mult = 0;
           // for each row:
           $("tr.txtMult").each(function () {
               // get the values from this row:
               var $val1 = $('.val1', this).val();
               var $val2 = $('.val2', this).val();
               var $total = ($val1 * 1) * ($val2 * 1)
               $('.multTotal',this).val($total);
               mult += $total;
           });
           $("#grandTotal").val(mult);
       }
  });
	</script>
	<script>
    var i = 0;
    $(document).ready(function () {
        $('#add').click(function () {
            i++;
            $('#service_table').append('<tr id="row' + i + '"><td><input type="text" name="service_name[]" id="service_name' + i + '" class="form-control" required></td><td><input type="text" name="totalamount[]" id="servicesum' + i + '" class="form-control" required></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td></tr>');
            $('#servicesum' + i + ', #servicesum' + i).change(function () {
                servicesum(i)
            });
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            servicesum();
        });

    });

  
    function servicesum() {
        var newTot = 0;
        for (var a = 0; a <= i; a++) {
            aVal = $('#servicesum' + a);
            if (aVal && aVal.length) {
                newTot += aVal[0].value ? parseFloat(aVal[0].value) : 0;
            }
        }
        document.getElementById('servicetotalsum').value = newTot.toFixed(2);
    }
</script>
<script>
    $(function () {
        $("#invoice_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<?php include 'footer.php' ?>