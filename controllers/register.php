<?php
    require "models/user.php";
    require "utils/common.php";
    require "utils/page_var.php";

    if (isset($_POST["submit"])) {
        if (are_set($_POST, array('name', 'username', 'email', 'password-1', 'address', 'phone'))) {
            $_POST['password'] = $_POST['password-1'];
            $user = User::new($_POST);
            try {
                $user->commit();
                header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018/login');
                die();
            } catch (Exception $e) {
                echo $e;
            }
        } else {
            setvar('register_fail', 'lack of some fields');
        }
    }

    include "views/register.html";
?>