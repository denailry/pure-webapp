<?php
    require_once "configs/db.php"; 
    require_once "models/user.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";
    require_once "utils/validation.php";

    setvar('page', 'profile');

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
    
    include "views/profile.php";
?>