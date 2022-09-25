<?php
/*******************************************************************************
 * The following code will
    
 * 2. inv_receivedetail (Store Multiple row)
 * 3. inv_materialbalance (Store Multiple row)
 * 4. inv_supplierbalance (Store single row)
 * *****************************************************************************
 */  
if (isset($_POST['issue_submit']) && !empty($_POST['issue_submit'])) 

{
	
                                if ($_SESSION['logged']['user_type'] == 'whm') {
                                    $warehouse_id = $_SESSION['logged']['warehouse_id'];
                                    $sql = "SELECT * FROM inv_warehosueinfo WHERE `id`='$warehouse_id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $short_name = $row['short_name'];
                                    $issueCode = 'IS-' . $short_name;
                                } else {
                                    $issueCode = 'IS-CW';
                                }
                                
	// check duplicate:
	$issue_id	= getDefaultCategoryCodeByWarehouse('inv_issue', 'issue_id', '03d', '001', $issueCode);
    $table		= 'inv_issue';
    $where		= "issue_id='$issue_id'";
    if(isset($_POST['issue_update_submit']) && !empty($_POST['issue_update_submit'])){
        $notWhere   =   "id!=".$_POST['issue_update_submit'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
	if ($duplicatedata) {
		$status     =   'error';
		$_SESSION['warning']    =   "Operation faild. Duplicate data found..!";
    }else{
		    
			
			for ($count = 0; $count < count($_POST['quantity']); $count++) {
				
				/*
				 *  Insert Data Into inv_issuedetail Table:
				*/       
				
				$issue_date         = $_POST['issue_date'];
				
				$issue_id           = $issue_id;
		
				$party_id         = $_POST['party_id'];
                $memono         = $_POST['memono'];
				$project_id         = $_POST['project_id'];
				$warehouse_id   	= $_POST['warehouse_id'];
				$material_name      = $_POST['material_name'][$count];
				$material_id        = $_POST['material_id'][$count];
				$unit               = $_POST['unit'][$count];
			    $brand            	= 'S';
				
				$quantity           = $_POST['quantity'][$count];
				$unit_price       	= $_POST['unit_price'][$count];
				$amount         	= $_POST['amount'][$count];
				$cur_price			= $_POST['cur_price'][$count];
			

				
				$partner_id 		= $_POST['partner_id'];
                $party_id   		= $_POST['party_id'];
				
				
				
				
				
				
				$received_by		= $_SESSION['logged']['user_name'];








				
				$receiver_phone		= 0;     
				$remarks            = $_POST['remarks'];  

				
				$cur_price_amount	    = $_POST['cur_amount'][$count];
				
				// replace netsaleamount 600-80(dis)=520 will be 520 not 600 change 28/4/2022
				$total_amount       	= $_POST['total_amount'];
				$discount_amount        = $_POST['discount_amount'];
				$netsale_amount         = $_POST['netsale_amount'];
				$paid_amount            = $_POST['paid_amount'];	
				$due_amount             = $_POST['due_amount'];
				$profitamount           = $_POST['profitamount'];
				
			
				
				$parent_item_id         = '0';
				
				
				
				
				$approval_status		= ''; 
				
			
        
		
		
		/*
				 *  Insert Data Into inv_issuedetail Table:
				*/
				
				
				
				$query = "INSERT INTO `inv_issuedetail` (`issue_id`,`issue_date`,`memono`,`material_id`,`material_name`,`unit`,`cur_price`,`cur_price_amount`,`issue_qty`,`issue_price`,`amount`,`part_no`,`project_id`,`warehouse_id`,`partner_id`,`party_id`,`approval_status`) VALUES ('$issue_id','$issue_date','$memono','$material_id','$material_name','$unit','$cur_price','$cur_price_amount','$quantity','$unit_price','$amount','$brand','$project_id','$warehouse_id','$partner_id','$party_id','0')";
				$conn->query($query);
				
				/*
				 *  Insert Data Into inv_materialbalance Table:
				*/
				$mb_ref_id      = $issue_id;
				$mb_materialid  = $material_id;
				$mb_date        = (isset($issue_date) && !empty($issue_date) ? date('Y-m-d h:i:s', strtotime($issue_date)) : date('Y-m-d h:i:s'));
				$mbin_qty       = 0;
				$mbin_val       = 0;
				$mbout_qty      = $quantity;
				$mbout_val      = 0;
				$mbprice        = 0;
				$mbtype         = 'Issue';
				$mbserial       = '1.1';
				$mbunit_id      = $project_id;
				$mbserial_id    = 0;
				$jvno           = $issue_id;
				$part_no        = $brand;  

                                 
								   
				
				$query_inmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`,`part_no`,`project_id`,`warehouse_id`,`partner_id`,`party_id`,`created_at`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbin_qty','$mbin_val','$mbout_qty','$mbout_val','$mbprice','$mbtype','$mbserial','$mbunit_id','$mbserial_id','$jvno','$part_no','$project_id','$warehouse_id','$partner_id','$party_id','$issue_date')";
				$conn->query($query_inmb);
				
				
				
				
			}
			/*
			*  Insert Data Into inv_issue Table: Table: change 28/4/2022
			*/
			$total_cur = $_POST['total_cur'];
			$total_amount = $_POST['total_amount'];
			$profitamount = $_POST['profitamount'];
			
			$var_profit	= $profitamount  / 2;
			
			
			
			
			$query2 = "INSERT INTO `inv_issue` (`issue_id`,`issue_date`,`memono`,`party_id`,`partner_id`,`received_by`,`totalcur`,`totalamount`,`discount_amount`,`netsale_amount`,`paidamount`,`Dueamount`,`profitamount`,`receiver_phone`,`remarks`,`project_id`,`warehouse_id`,`created_at`) VALUES ('$issue_id','$issue_date','$memono','$party_id','$partner_id','$received_by','$total_cur','$total_amount','$discount_amount','$netsale_amount','$paid_amount','$due_amount','$profitamount','$receiver_phone','$remarks','$project_id','$warehouse_id','$issue_date')";
			$result2 = $conn->query($query2);
			
		
				
			
			/*
			*  Insert Data Into inv_partybalance Table: Table: change 28/4/2022
			*/
			
			 $query3 = "INSERT INTO `inv_partybalance` (`pb_ref_id`,`warehouse_id`,`pb_date`,`memono`,`partner_id`,`pb_party_id`,`pb_dr_amount`,`pb_cr_amount`,`pb_remark`,`pb_partac_id`,`receivermode`,`approval_status`) VALUES ('$issue_id','$warehouse_id','$issue_date','$memono','$partner_id','$party_id','$netsale_amount','$paid_amount','$remarks','$issue_id','NAP','$approval_status')";
    $result2 = $conn->query($query3);
	
	
	

	
	
	
	
	
	
			
			$_SESSION['success']    =   "Issue process have been successfully completed.";
			header("location: issue_entry.php");
			exit();
			}
	
}

function getissueDataDetailsById($id){
    global $conn;
    $receieves      =   "";
    $receiveDetails =   "";
    
    // get receive data
    $sql1           = "SELECT * FROM inv_issue where id=".$id;
    $result1        = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        $receieves = $result1->fetch_object();
        // get receive details data
        $table                  =   'inv_issuedetail where issue_id='."'$receieves->issue_id'";
        $order                  =   'DESC';
        $column                 =   'issue_qty';
        $dataType               =   'obj';
        $receiveDetailsData     = getTableDataByTableName($table, $order, $column, $dataType);
        if(isset($receiveDetailsData) && !empty($receiveDetailsData)){
            $receiveDetails     =   $receiveDetailsData;
        }
    }
    $feedbackData   =   [
        'receiveData'           =>  $receieves,
        'receiveDetailsData'    =>  $receiveDetails
    ];
    
    return $feedbackData;
}




if(isset($_GET['process_type']) && $_GET['process_type'] == 'get_building_by_package'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $package_id      =    $_POST['package_id'];
    $tableName      =    'buildings where package_id='.$package_id;
    $tableData      = getTableDataByTableName($tableName, '', 'building_id');
    if (isset($tableData) && !empty($tableData)) {
        echo "<option value=''>Please Select</option>";
        foreach ($tableData as $data) { ?>
            <option value="<?php echo $data['id']; ?>"><?php echo $data['building_id'].'('.$data['id'].')'; ?></option>
            <?php
        }
    }
}
/*******************************************************************************
 * The following code will
 * Update Receive entry data.
 * There are 4 table to keet track on receive data. The are following:
 * 1. inv_receive (Update single row)      
 * 2. inv_receivedetail (First Delete all rows then Store Multiple row)
 * 3. inv_materialbalance (First Delete all rows then Store Multiple row)
 * 4. inv_supplierbalance (Update single row)
 * *****************************************************************************
 */
 
 
 
 
 

if(isset($_POST['issue_update_submit']) && !empty($_POST['issue_update_submit'])){


    $edit_id            =   $_POST['edit_id'];
    $mrr_no             =   $_POST['issue_no'];
    
    // first delete all from inv_receivedetail; 
    $delsql    = "DELETE FROM `inv_issuedetail` WHERE `issue_id`='$mrr_no'";
    $conn->query($delsql);
    // first delete all from inv_materialbalance; 
    $delsq2    = "DELETE FROM `inv_materialbalance` WHERE `mb_ref_id`='$mrr_no'";
    $conn->query($delsq2);
	
	
	
	 // first delete all from inv_partybalance; 
    $delsq4    = "DELETE FROM `inv_partybalance` WHERE `pb_ref_id`='$mrr_no'";
    $conn->query($delsq4);
	

	
    
    for ($count = 0; $count < count($_POST['quantity']); $count++) {
        
       /*    Insert Data Into inv_issuedetail Table: */
               
        
				$issue_date         = $_POST['issue_date'];
				$issue_id           = $_POST['issue_id'];
		
				$party_id           = $_POST['party_id'];
                $memono             = $_POST['memono'];
				$project_id         = 1;
				$warehouse_id   	= $_POST['warehouse_id'];
				$material_name      = $_POST['material_name'][$count];
				$material_id        = $_POST['material_id'][$count];
				$unit               = $_POST['unit'][$count];
			    $brand            	= 'U';
				
				$quantity           = $_POST['quantity'][$count];
				$unit_price       	= $_POST['unit_price'][$count];
				$amount         	= $_POST['amount'][$count];
				$cur_price			= $_POST['cur_price'][$count];
			

				
				$partner_id 		= $_POST['partner_id'];
                $party_id   		= $_POST['party_id'];
				$received_by		= $_SESSION['logged']['user_name'];     
				$receiver_phone		= 1;     
				$remarks            = $_POST['remarks'];  

				
				$cur_price_amount	    = $_POST['cur_amount'][$count];
				
				// replace netsaleamount 600-80(dis)=520 will be 520 not 600 change 28/4/2022
				$total_amount       	= $_POST['total_amount'];
				$discount_amount        = $_POST['discount_amount'];
				$netsale_amount         = $_POST['netsale_amount'];
				$paid_amount            = $_POST['paid_amount'];	
				$due_amount             = $_POST['due_amount'];
				$profitamount           = $_POST['profitamount'];
				
			
				
				$parent_item_id         = '1';
				
				
				
				
				$approval_status		= '';     
				
				
				
        
				$query = "INSERT INTO `inv_issuedetail` (`issue_id`,`issue_date`,`memono`,`material_id`,`material_name`,`unit`,`cur_price`,`cur_price_amount`,`issue_qty`,`issue_price`,`amount`,`part_no`,`project_id`,`warehouse_id`,`partner_id`,`party_id`,`approval_status`) VALUES ('$issue_id','$issue_date','$memono','$material_id','$material_name','$unit','$cur_price','$cur_price_amount','$quantity','$unit_price','$amount','$brand','$project_id','$warehouse_id','$partner_id','$party_id','0')";
				$conn->query($query);
				
				
				/*   Insert Data Into inv_materialbalance Table: */
				
				$mb_ref_id      = $issue_id;
				$mb_materialid  = $material_id;
				$mb_date        = (isset($issue_date) && !empty($issue_date) ? date('Y-m-d h:i:s', strtotime($issue_date)) : date('Y-m-d h:i:s'));
				$mbin_qty       = 0;
				$mbin_val       = 0;
				$mbout_qty      = $quantity;
				$mbout_val      = 0;
				$mbprice        = 0;
				$mbtype         = 'Issue';
				$mbserial       = '1.1';
				$mbunit_id      = $project_id;
				$mbserial_id    = 0;
				$jvno           = $issue_id;
				$part_no        = $brand;  

                                 
								   
				
				$query_inmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`,`part_no`,`project_id`,`warehouse_id`,`partner_id`,`party_id`,`created_at`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbin_qty','$mbin_val','$mbout_qty','$mbout_val','$mbprice','$mbtype','$mbserial','$mbunit_id','$mbserial_id','$jvno','$part_no','$project_id','$warehouse_id','$partner_id','$party_id','$issue_date')";
				$conn->query($query_inmb);
    }
    
	
	
      /*  *  Update Data Into inv_issue Table: */
   
				
				
			$total_cur = $_POST['total_cur'];
			$total_amount = $_POST['total_amount'];
			$profitamount = $_POST['profitamount'];
			
			$var_profit	= $profitamount  / 2;	
				

     $query2    = "UPDATE inv_issue SET issue_id='$issue_id',issue_date='$issue_date',memono='$memono',party_id='$party_id',partner_id='$partner_id',received_by='$received_by',totalcur='$total_cur',totalamount='$total_amount',discount_amount='$discount_amount',netsale_amount='$netsale_amount',paidamount='$paid_amount',Dueamount='$due_amount',profitamount='$profitamount',receiver_phone='$receiver_phone',remarks='$remarks',project_id='$project_id',warehouse_id='$warehouse_id',created_at='$issue_date' WHERE id=$edit_id";
    $result2 = $conn->query($query2);
	
	
	
	/*
			*  Insert Data Into inv_partybalance Table: Table: change 28/4/2022
			*/
			
			 $query3 = "INSERT INTO `inv_partybalance` (`pb_ref_id`,`warehouse_id`,`pb_date`,`memono`,`partner_id`,`pb_party_id`,`pb_dr_amount`,`pb_cr_amount`,`pb_remark`,`pb_partac_id`,`approval_status`) VALUES ('$issue_id','$warehouse_id','$issue_date','$memono','$partner_id','$party_id','$netsale_amount','$paid_amount','$remarks','$issue_id','$approval_status')";
    $result2 = $conn->query($query3);
	
	

	
    
    $_SESSION['success']    =   "Issue process have been successfully updated.";
    header("location: issue_edit.php?edit_id=".$edit_id);
    exit();
}


if (isset($_POST['issue_approve_submit']) && !empty($_POST['issue_approve_submit'])) {
 
        /*
         *  Update Data Into inv_receive Table:
        */ 
       
        $issue_id				= $_POST['issue_id']; 
        $approval_status		= $_POST['approval_status'];       
        $approved_by            = $_SESSION['logged']['user_id'];       
        $approved_at            = $_POST['approved_at'];        
        $approval_remarks		= $_POST['approval_remarks'];       
               
        $query = "UPDATE `inv_issue` SET `approval_status`='$approval_status',`approved_by`='$approved_by',`approved_at`='$approved_at',`approval_remarks`='$approval_remarks' WHERE `issue_id`='$issue_id'";
        $conn->query($query);
		
		
		/*
         *  Update Data Into inv_receivedetail Table:
        */      
        $query2 = "UPDATE `inv_issuedetail` SET `approval_status`='$approval_status' WHERE `issue_id`='$issue_id'";
        $conn->query($query2);
		
		/*
         *  Update Data Into inv_materialbalance Table:
        */      
        $query3 = "UPDATE `inv_materialbalance` SET `approval_status`='$approval_status' WHERE `mb_ref_id`='$issue_id'";
        $conn->query($query3);
		
		/*
         *  Update Data Into inv_supplierbalance Table:
        */      
        $query3 = "UPDATE `inv_supplierbalance` SET `approval_status`='$approval_status' WHERE `sb_ref_id`='$issue_id'";
        $conn->query($query3);
		
		

    $_SESSION['success']    =   "ISSUE Approval process successfully completed.";
    header("location: issue-list.php");
    exit();
}

?>