<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";
    force_login();
    $SESSION = null;

    if (isset($_COOKIE['access_token'])) {
        $SESSION = Session::verify($_COOKIE['access_token']);
    }

    if ($SESSION == null) {
        force_login();
    } else {
        $user = $SESSION->get_user();
        setvar('name',$user->name);
        setvar('username',$user->username);
        setvar('email',$user->email);
        setvar('address',$user->address);
        setvar('phone',$user->phone);
    }

    if(isset($_POST["submit"])){
        //$user = Session::get_id();
        setvar('profilepic',$_POST['fileinput']);
        setvar('name',$_POST['name']);
        setvar('phone',$_POST['phone']);
        setvar('address',$_POST['address']);
        
    }

    include 'views/editprofile.php';
?>