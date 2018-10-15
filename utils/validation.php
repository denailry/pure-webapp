<?php
    require_once "models/session.php";

    $SESSION = null;

    if (isset($_COOKIE['access_token'])) {
        $SESSION = Session::verify($_COOKIE['access_token']);
    } else {
        echo "no access token found";
    }

    function force_login() {
        global $SESSION;
        if ($SESSION == null) {
            header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018/login.php');
            die();
        }   
    }
?>