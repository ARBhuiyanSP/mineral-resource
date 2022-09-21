<?php
include_once("connection/connect.php");
if($_REQUEST['materialid']) {
	//$sql = "SELECT `id`, `employee_name`, `employee_salary`, `employee_age` FROM `employee` 
//WHERE `id`='".$_REQUEST['empid']."'";

$to_date = date('Y-m-d');
$mb_materialid = $_REQUEST['materialid'];
$sql="SELECT SUM(`mbin_qty`)-SUM(`mbout_qty`) AS total FROM `inv_materialbalance` WHERE `mb_materialid` = '$mb_materialid' AND mb_date <= '$to_date'";


	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
	$data = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}