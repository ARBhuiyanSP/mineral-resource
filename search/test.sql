CREATE VIEW qry_inv_receive AS select `eel_wlp`.`inv_receive`.`mrr_no` AS `mrr_no`,`eel_wlp`.`inv_receive`.`mrr_date` AS `mrr_date`,`eel_wlp`.`inv_receive`.`purchase_id` AS `purchase_id`,`eel_wlp`.`inv_receive`.`challanno` AS `challanno`,`eel_wlp`.`inv_receivedetail`.`material_id` AS `material_id`,`eel_wlp`.`inv_receivedetail`.`receive_qty` AS `receive_qty`,`eel_wlp`.`inv_receivedetail`.`unit_price` AS `unit_price`,`eel_wlp`.`inv_receivedetail`.`unit_id` AS `unit_id`,`eel_wlp`.`inv_receivedetail`.`total_receive` AS `total_receive`,`eel_wlp`.`inv_receive`.`warehouse_id` AS `warehouse_id` from (`eel_wlp`.`inv_receive` join `eel_wlp`.`inv_receivedetail` on(`eel_wlp`.`inv_receive`.`mrr_no` = `eel_wlp`.`inv_receivedetail`.`mrr_no`))