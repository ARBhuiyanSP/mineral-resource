
<ul class="sidebar navbar-nav">
	<li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #ffffff;"></i>
            <span>Dashboard</span>
        </a>
    </li>
	<?php if($_SESSION['logged']['user_type'] !== 'superAdmin') {?>
	<?php if($_SESSION['logged']['user_type'] !== 'superAdmin') {?>
    <li class="nav-item" style="background-color:#ffffff;">
        <span class="nav-link" href="#">
            <i class="fa fa-bars" aria-hidden="true" style="color: #000;"></i>
            <span style="color: #000;">Settings</span></span>
    </li>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-cog" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Master Setup</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="material.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Material</span>
            </a>
            <a class="dropdown-item" href="unit_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> UOM</span>
            </a>
            <a class="dropdown-item" href="supplier_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Supplier Entry</span>
            </a>
			<a class="dropdown-item" href="party_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Party Entry</span>
			</a>
			<a class="dropdown-item" href="supplier_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Supplier Add</span>
            </a>
			<a class="dropdown-item" href="supplier_info.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Supplier Report</span>

            </a>
            <a class="dropdown-item" href="port_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Ports</span>
            </a>
            <a class="dropdown-item" href="warehouse_entry.php">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #000;"></i>
                <span class="sub_menu_text_design"> Site</span>
            </a>
        </div>
    </li>
	
	<li class="nav-item" style="background-color:#ffffff;">
        <span class="nav-link" href="#">
            <i class="fa fa-users" aria-hidden="true" style="color: #000;"></i>
            <span style="color: #000;">User Page</span></span>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-truck" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Material Receive</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="receive_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Receive Entry</span></a>
            <a class="dropdown-item" href="receive-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Receive List</span></a>
        </div>
    </li>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-server" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Material Sale</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="issue_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Material Sale</span></a>
            <a class="dropdown-item" href="sale-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Sales List</span></a>
        </div>
    </li>
	    
	<?php } ?>
	<?php } ?>
	<?php if($_SESSION['logged']['user_type'] !== 'superAdmin') {?>
	
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-ship " aria-hidden="true" style="color: #ffffff;"></i>
            <span>Port Transfer</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="port_transfer.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Transfer To Port</span></a>
			
			<a class="dropdown-item" href="port_to_site_transfer.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Transfer To Site</span></a>
            <!-- <a class="dropdown-item" href="warehousetransfer_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #ffffff;"></i><span class="sub_menu_text_design">Warehouse Transfer</span></a> -->
            <a class="dropdown-item" href="port-transfer-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Transfer List</span></a>
        </div>
    </li>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-undo " aria-hidden="true" style="color: #ffffff;"></i>
            <span>Port Return</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="port_return_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Return Entry</span></a>
            <!-- <a class="dropdown-item" href="warehousetransfer_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #ffffff;"></i><span class="sub_menu_text_design">Warehouse Transfer</span></a> -->
            <a class="dropdown-item" href="port-return-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Return List</span></a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-store " aria-hidden="true" style="color: #ffffff;"></i>
            <span>Site Transfer</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="site_to_site_transfer.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Site Transfer</span></a>
            <a class="dropdown-item" href="transfer-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Transfer List</span></a>
        </div>
    </li>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-undo" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Site Return</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="s2s_return_entry.php"><i class="fa fa-plus" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Material return</span></a>
            <a class="dropdown-item" href="port-return-list.php"><i class="fa fa-list" aria-hidden="true" style="color: #000;"></i><span class="sub_menu_text_design">Return List</span></a>
        </div>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="party_payment.php">
            <i class="fa fa-money-bill" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Party Payment</span></a>
    </li>
	 <li class="nav-item">
        <a class="nav-link" href="payment_entry.php">
            <i class="fa fa-money-bill" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Supplier Payment</span></a>
    </li>

	<?php } ?>
	<li class="nav-item" style="background-color:#ffffff;">
        <span class="nav-link" href="#">
            <i class="fa fa-bars" aria-hidden="true" style="color: #000;"></i>
            <span style="color: #000;">Reports</span></span>
    </li>

	
	<li class="nav-item">
        <a class="nav-link" href="materialinfo_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Material List</span></a>
    </li>
	
	<li class="nav-item">
        <a class="nav-link" href="stock_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Stock Reports</span></a>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="movement_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Movement Reports</span></a>
    </li>
	<!--<li class="nav-item">
        <a class="nav-link" href="consumption_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Consumption Reports</span></a>
    </li>-->
	<li class="nav-item">
        <a class="nav-link" href="supplier_ledger.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Supplier Ledger</span></a>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="receive_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Receive Details</span></a>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="issue_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Sales Details</span></a>
    </li>
	<!--<li class="nav-item">
        <a class="nav-link" href="s2stransfer_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>S2S Transfer details</span></a>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="p2ptransfer_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>P2P Transfer details</span></a>
    </li>
	<li class="nav-item">
        <a class="nav-link" href="return_report.php">
            <i class="fa fa-registered" aria-hidden="true" style="color: #ffffff;"></i>
            <span>Return details</span></a>
    </li> --->
	
</ul>