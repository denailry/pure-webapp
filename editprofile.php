<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    define("IMAGE_DIR", "statics/img/profile/");

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
        if ($user->profilepic != NULL) {
            setvar('profilepicture',$user->profilepic);
        } else {
            setvar('profilepicture','statics/img/default-profile-picture.png');
        }   
    }

    if(isset($_POST['name'])){
        if(!$_POST['fileinput']==''){
            $user->profilepic = IMAGE_DIR.basename($_POST['fileinput']);
            $tmp_name = $_FILES["profilepic"]["tmp_name"];
            move_uploaded_file($tmp_name, IMAGE_DIR.basename($_POST['fileinput']));
        }
        $user->name = $_POST['name'];
        $user->phone = $_POST['phone-number'];
        $user->address = $_POST['address'];
        $user->commit();
        header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018'.'/profile.php');
        die();  
    }

    include 'views/editprofile.php';
?>