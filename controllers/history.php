<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "models/order.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    force_login();

    include 'views/history.php';
?>