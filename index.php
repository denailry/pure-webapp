<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "utils/page_var.php";

    force_login();

    include "views/search.php";
?>