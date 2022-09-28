<?php
include "config.php";

$request = $_POST['request'];   // request

// Get vehicleno list
if($request == 1){
    $search 	= $_POST['search'];

    $query 		= "SELECT * FROM tb_party WHERE partyname like'%".$search."%'";
    $result 	= mysqli_query($con,$query);
    
    while($row 	= mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['partyname'].'|'.$row['party_id']);
    }

    // encoding array to json format
    echo json_encode($response);
    exit;
}

// Get details
if($request == 2){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM inv_partybalance WHERE pb_party_id=".$userid;

    $result = mysqli_query($con,$sql);

    $users_arr = array();
	//$pb_dr_amount = 0;
	//$pb_cr_amount = 0;
    while( $row = mysqli_fetch_array($result) ){
        $userid 		= $row['id'];
        $memono 		= $row['memono'];
        $pb_date 		= $row['pb_date'];
        $pb_party_id 	= $row['pb_party_id'];
        $pb_dr_amount 	= $row['pb_dr_amount'];
        $pb_cr_amount 	= $row['pb_cr_amount'];
        $pb_remark 	= $row['pb_remark'];

        $users_arr[] 	= array("id" => $userid,"memono" => $memono,"pb_date" => $pb_date,"pb_party_id" => $pb_party_id, "pb_dr_amount" => $pb_dr_amount,"pb_cr_amount" => $pb_cr_amount,"pb_remark" => $pb_remark);
    }
	
    // encoding array to json format
    echo json_encode($users_arr);
    exit;
}
