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
        echo "tes";
        
        echo $_POST['fileinput'];
        echo $_POST['name'];
        echo $_POST['phone-number'];
        echo $_POST['address'];
        $user->profilepic = $_POST['fileinput'];
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone-number'];
        $user->address = $_POST['address'];
        $user->commit();
    }

    include 'views/editprofile.php';
?>