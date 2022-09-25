<?php
/*******************************************************************************
 * The following code will
 * Insert Project Info at projects table
 */
if (isset($_POST['party_submit']) && !empty($_POST['party_submit'])) {

        $party_id	= $_POST['party_id'];
        $partyname	= $_POST['partyname'];    
        $address		= $_POST['address']; 
        $reg_date		= $_POST['reg_date'];	


$mobile		= $_POST['mobile'];
$district		= $_POST['district'];
$partystatus		= $_POST['partystatus'];


	                    if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])){
		
		                         $edit_id            =   $_POST['edit_id']; 

		
		
		    $query2    = "UPDATE tb_party SET party_id='$party_id',partyname='$partyname',address='$address' WHERE id=$edit_id";
            $result2 = $conn->query($query2);
			
	
		$_SESSION['success']    =   "party update process have been successfully completed.";
		header("location: party_entry.php");
		exit();
		
		                                           }else{
	
	

        $query = "INSERT INTO `tb_party` (`party_id`,`partyname`,`address`,`RegistrationDate`,`mobile`,`district`,`partystatus`) VALUES ('$party_id','$partyname','$address','$reg_date','$mobile','$district','$partystatus')";
        $conn->query($query);
	
	
        
		$_SESSION['success']    =   "Party Entry process have been successfully completed.";
		header("location: party_entry.php");
		exit();
		
		
}



}

?>