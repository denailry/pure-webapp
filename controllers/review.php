<?php
	require_once "configs/db.php"; 
    require_once "utils/validation.php";
    require_once "models/user.php";
    require_once "models/session.php";
    require_once "models/order.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";

    if (isset($_COOKIE['access_token'])) {
        $SESSION = Session::verify($_COOKIE['access_token']);
    }

    if ($SESSION == null) {
        force_login();
    } else {
        $user = $SESSION->get_user();
        $order = new Order($_GET['orderid']);

        setvar('name',$user->name);
        setvar('username',$user->username);
        setvar('email',$user->email);
        setvar('address',$user->address);
        setvar('phone',$user->phone);
        setvar('orderid', $_GET['orderid']);
        setvar('title',$order->get_book()->title);
        setvar('cover',$order->get_book()->cover);
        setvar('author',$order->get_book()->author);
        setvar('rating',$order->rating);
    }
    if(isset($_POST["ratinginput"])){
        global $conn;
        $orderid = 
        $rating = $_POST['ratinginput'];
        $reviewcomment = $_POST['inputcomment'];
        $orderid = $_POST['orderid'];
        $query = $conn->prepare('UPDATE orderbook
        SET rating=?, reviewcomment=?
        WHERE id=?');
        
        $query->bind_param('isi', $rating,$reviewcomment,$orderid);
        $query->execute();
        $result = mysqli_stmt_get_result($query);
        header('Location: '.'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/history');
        die();  
    }
    include 'views/review.php';
?>