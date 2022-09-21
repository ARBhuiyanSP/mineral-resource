<?php
include '../connection/connect.php';
include '../helper/utilities.php';
$mrr_no = check_input_data($_GET['mrr_no']);

/*
 * *get data from inv_receive table:
 * *will return one row as object:
 */
$inv_rcv_sql = "inv_receive WHERE mrr_no='$mrr_no'";
$invoice_receives = getDataRowIdAndTable($inv_rcv_sql);



/*
 * *get data from inv_receivedetail table:
 * *will return multiple row as object:
 */
$inv_rcvD_sql = "inv_receivedetail WHERE mrr_no='$mrr_no'";
$invoice_receivesD = getTableDataByTableName($inv_rcvD_sql, $order = 'asc', $column = 'id', $dataType = 'obj');
//    print '<pre>';
//    print_r($invoice_receivesD);
//    print '</pre>';
//    exit;

/*
 * *get data from inv_materialbalance table:
 * *will return multiple row as object:
 */
$inv_rcvD_sql = "inv_materialbalance WHERE mb_ref_id='$mrr_no'";
$inv_materialbalanceD = getTableDataByTableName($inv_rcvD_sql, $order = 'asc', $column = 'id', $dataType = 'obj');
?>
<h3>Invoice Receive &nbsp;<button type="button" class="btn btn-sm btn-info" onclick="cross_update_invoice_receive('invoice_receive_form', 'invoice_receive', 'invoice_receive');">Update</button></h3>
<div class="update_operation_message_section" id="invoice_receive"></div>
<?php
if (isset($invoice_receives) && !empty($invoice_receives)) {
    $invoice_receives_array = (array) ($invoice_receives);
    $invoice_receives_keys = array_keys($invoice_receives_array);
    ?>
    <form id='invoice_receive_form'>
        <div class="table-responsive">          
            <table class="table table-bordered cross_check_table_style">
                <thead>
        <?php
        $invoice_receives_array = (array) ($invoice_receives);
        $invoice_receives_keys = array_keys($invoice_receives_array);
        ?>
                    <tr>
                    <?php
                    foreach ($invoice_receives_keys as $rkey) {
                        ?>
                            <th><?php echo $rkey; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
        <?php
        foreach ($invoice_receives_keys as $rkey) {
            ?>
                            <td>
                                <input type="text" name="<?php echo $rkey; ?>" value="<?php echo (isset($invoice_receives_array[$rkey]) && !empty($invoice_receives_array[$rkey]) ? $invoice_receives_array[$rkey] : ''); ?>">
                            </td>
        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <h3>Invoive Receive Details &nbsp;<button type="button" class="btn btn-sm btn-info" onclick="cross_update_invoice_receive('invoice_receive_details_form', 'invoice_receive_details', 'invoice_receive_details');">Update</button></h3>
    <div class="update_operation_message_section" id="invoice_receive_details"></div>
    <?php
    if (isset($invoice_receivesD) && !empty($invoice_receivesD)) {
        $invoice_receivesD_frow = (array) ($invoice_receivesD[0]);
        $invoice_receivesD_keys = array_keys($invoice_receivesD_frow);
        ?>
    <form id="invoice_receive_details_form">
        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
        <?php
        foreach ($invoice_receivesD_keys as $rkey) {
            ?>
                            <th><?php echo $rkey; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
        <?php
        $sl = 1;
        foreach ($invoice_receivesD as $ird) {
            $ird = (array) ($ird);
            ?>
                        <tr>
                        <?php
                        foreach ($invoice_receivesD_keys as $rkey) {
                            ?>
                                <td>
                                    <input type="text" name="<?php echo $rkey; ?>[]" value="<?php echo (isset($ird[$rkey]) && !empty($ird[$rkey]) ? $ird[$rkey] : ''); ?>">
                                </td>
            <?php } ?>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
</form>
    <?php } else { ?>
        <div class="alert alert-info">
            Sorry! No Data found
        </div>
    <?php } ?>
    <h3>Material Balance &nbsp;<button type="button" class="btn btn-sm btn-info" onclick="cross_update_invoice_receive('material_balance_form', 'material_balance', 'material_balance');">Update</button></h3>
    <div class="update_operation_message_section" id="material_balance"></div>
    <?php
    if (isset($inv_materialbalanceD) && !empty($inv_materialbalanceD)) {
        $inv_materialbalance_frow = (array) ($inv_materialbalanceD[0]);
        $inv_materialbalance_keys = array_keys($inv_materialbalance_frow);
        ?>
    <form id='material_balance_form'>
        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
        <?php
        foreach ($inv_materialbalance_keys as $rkey) {
            ?>
                            <th><?php echo $rkey; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
        <?php
        $sl = 1;
        foreach ($inv_materialbalanceD as $ird) {
            $ird = (array) ($ird);
            ?>
                        <tr>
                        <?php
                        foreach ($inv_materialbalance_keys as $rkey) {
                            ?>
                                <td>
                                    <input type="text" name="<?php echo $rkey; ?>[]" value="<?php echo (isset($ird[$rkey]) && !empty($ird[$rkey]) ? $ird[$rkey] : ''); ?>">
                                </td>
                            <?php } ?>
                        </tr>
        <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
                <?php } else { ?>
        <div class="alert alert-info">
            Sorry! No Data found
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="alert alert-info">
        Sorry! No Data found
    </div>
<?php } ?>