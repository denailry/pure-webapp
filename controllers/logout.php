<?php
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    if ($SESSION != null) {
        $SESSION->remove();
    }

    header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018/');
    die();  
?>