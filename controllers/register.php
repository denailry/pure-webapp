<?php
	require_once "configs/db.php"; 
    require_once "models/user.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    $RETURN_HTML = true;

    if (isset($_POST["submit"])) {
        if (areSet($_POST, array('name', 'username', 'email', 'password-1', 'address', 'phone'))) {
            if ($_POST['password-1'] == $_POST['password-2']) {
                $_POST['password'] = $_POST['password-1'];
                $user = User::new($_POST);
                try {
                    switch ($user->commit()) {
                        case ERR_USERNAME_EXIST:
                            setvar('failure', 'username is exist');
                            break;
                        case ERR_EMAIL_EXIST:
                            setvar('failure', 'email is exist');
                            break; 
                        default:
                            header('Location: '.'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/login');
                            die();
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            } else {
                setvar('failure', 'passwords do not match');
            }
        } else {
            setvar('failure', 'lack of some fields');
        }
    }

    if (!isset($_POST["submit"]) && isset($_POST['username'])) {
        try {
            $result = User::isValidUsername($_POST['username']);
            $response = array(
                "status" => 0,
                "data" => array("valid" => $result),
            );
        } catch (Exception $e) {
            $response = array(
                "status" => -1,
                "data" => null,
                "details" => $e
            );
        }
        echo (json_encode($response));
        $RETURN_HTML = false;
    }

    if (!isset($_POST["submit"]) && isset($_POST['email'])) {
        try {
            $result = User::isValidEmail($_POST['email']);
            $response = array(
                "status" => 0,
                "data" => array("valid" => $result),
            );
        } catch (Exception $e) {
            $response = array(
                "status" => -1,
                "data" => null,
                "details" => $e
            );
        }
        echo (json_encode($response));
        $RETURN_HTML = false;
    }

    if ($RETURN_HTML) {
        include "views/register.php";
    }
?>