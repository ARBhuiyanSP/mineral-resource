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
				<thead>
					<tr>
						<th>In Stock - Qty</th>
					</tr>
				</thead>
				<tbody id="records">
					<tr>
						<td id="in_stock"></td>
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