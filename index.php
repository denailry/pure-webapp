<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";

    force_login();

    include "views/search.php";
?>