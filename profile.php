<?php
    require_once "configs/db.php"; 
    require_once "models/user.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    embed("main-bar");

    /*$user = $SESSION->get_user();*/
    $user = new User(1);
    setvar('username',$user->username);
    setvar('email',$user->email);
    setvar('address',$user->address);
    setvar('phone',$user->phone);
    
    include "views/profile.php";
?>