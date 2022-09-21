<?php
include '../connection/connect.php';
include '../helper/utilities.php';
if(isset($_GET['cross_update']) && !empty($_GET['cross_update'])){
    $update_type    =   $_GET['cross_update'];
    
    switch($update_type){
        case 'invoice_receive' :
            $update_response    =   update_invoice_receive_data();
            break;
        case 'invoice_receive_details' :
            $update_response    =   update_invoice_receive_details_data();
            break;
        case 'material_balance' :
            $update_response    =   update_material_balance_data();
            break;
        default:
            $update_response    =   'default status';
    }
    
    get_update_operation_reponse_html($update_response);
}

function update_invoice_receive_data(){
    $update_response    =   [];
    $id                 =   $_POST['id'];
    unset($_POST['id']);
    $response           =   update_data('inv_receive', $_POST, $id);   
    array_push($update_response, $response);
    return $update_response;
}

function update_invoice_receive_details_data(){
    $update_response    =   [];
    $row_count      =   count($_POST['id']);
    $table_column   =   array_keys($_POST);
    for($i = 0; $i < $row_count; $i++){
        $update_data    =   [];
        foreach($table_column as $col){
            $update_data[$col]  =   $_POST[$col][$i];
        } 
        $id     =   $update_data['id'];
        unset($update_data['id']);
        $response   =   update_data('inv_receivedetail', $update_data, $id);   
        array_push($update_response, $response);
    }
    
    return $update_response;
}

function update_material_balance_data(){
    $update_response    =   [];
    $row_count      =   count($_POST['id']);
    $table_column   =   array_keys($_POST);
    for($i = 0; $i < $row_count; $i++){
        $update_data    =   [];
        foreach($table_column as $col){
            $update_data[$col]  =   $_POST[$col][$i];
        } 
        $id     =   $update_data['id'];
        unset($update_data['id']);
        $response   =   update_data('inv_materialbalance', $update_data, $id);   
        array_push($update_response, $response);
    }
    
    return $update_response;
}

function get_update_operation_reponse_html($message_data){
    foreach($message_data as $msg){
        if($msg['status'] == 'success'){ ?>
            <div class="alert alert-success">
                <?php echo $msg['id']." ".$msg['message']; ?>
            </div>
        <?php }else{ ?>
            <div class="alert alert-danger">
                <?php echo $msg['id']." ".$msg['message']; ?>
            </div>
    <?php }
    }
}
    
