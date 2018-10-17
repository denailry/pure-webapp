<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    if ($SESSION != null) {
        header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018');
        die();  
    }

    function setup_session($userId) {
        $session = Session::new($userId);
        if ($session != null) {
            setcookie('access_token', $session->get_token(), time() + 86400, "/");    
        }
        return ($session != null);
    }

    if (isset($_POST["submit"])) {
        if (areSet($_POST, array('username', 'password'))) {
            $userId = User::verify($_POST['username'], $_POST['password']);
            if ($userId != -1) {
                if (setup_session($userId)) {
                    header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018');
                    die();   
                } else {
                    setvar('failure', 'please try again');
                }   
            } else {
                setvar('failure', 'wrong username or password');
            }
        } else {
            setvar('failure', 'lack of some fields');
        }
    }

    include "views/login.php";
?>