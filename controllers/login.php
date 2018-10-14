<?php
    require "models/user.php";
    require "utils/common.php";
    require "utils/page_var.php";

    if (isset($_POST["submit"])) {
        if (are_set($_POST, array('username', 'password'))) {
            if (User::verify($_POST['username'], $_POST['password'])) {
                header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018/');
                die();
            }
        } else {
            setvar('register_fail', 'lack of some fields');
        }
    }

    include "views/login.html";
?>