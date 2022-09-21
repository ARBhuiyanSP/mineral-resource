$(document).ready(function(){  
	// code to get all records from table via select box
	$("#material").change(function() {    
		var id = $(this).find(":selected").val();
		var dataString = 'materialid='+ id;    
		$.ajax({
			url: 'getMaterial.php',
			dataType: "json",
			data: dataString,  
			cache: false,
			success: function(materialData) {
			   if(materialData) {
					$("#heading").show();		  
					$("#no_records").hide();				
					$("#in_stock").text(parseFloat(materialData.total).toFixed(2));
					$("#records").show();		 
				} else {
					$("#heading").hide();
					$("#records").hide();
					$("#no_records").show();
				}   	
			} 
		});
 	}) 
});