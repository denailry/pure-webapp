<?php
    require_once "models/session.php";
    /*
	 * validation.php
	 * is intended to collect any functions and variables
     * related with validating user's identity
     * 
	 */	

    /*
     * instance of Session class from /models/session.php
     * please refer to source file for any possible retrievable data
     */
    $SESSION = null;

    if (isset($_COOKIE['access_token'])) {
        $SESSION = Session::verify($_COOKIE['access_token']);
    }

    /*
     * calling this function means the page requires user to login
     */
    function force_login() {
        global $SESSION;
        if ($SESSION == null) {
            header('Location: '.'http://'.$_SERVER['SERVER_NAME'].'/tugasbesar1_2018/login.php');
            die();
        }   
    }
?>