<?php
    require_once "configs/db.php"; 
    require_once "models/user.php";
    require_once "models/book.php";
    require_once "utils/common.php";
    require_once "utils/page_var.php";
    require_once "utils/validation.php";

    $SESSION = null;

    if (isset($_COOKIE['access_token'])) {
        $SESSION = Session::verify($_COOKIE['access_token']);
    }

    if ($SESSION == null) {
        force_login();
    } else {
        if (isset($_GET['book_id'])) {
            $id = $_GET['book_id'];
            $book = new Book($id);

            setvar('title',$book->title);
            setvar('author',$book->author);
            setvar('cover',$book->cover);
            setvar('detail',$book->detail);

            /*find rating*/
            $queryrating = $conn->prepare("SELECT AVG(rating) AS ratings FROM orderbook WHERE bookid=? GROUP BY bookid");
            $queryrating->bind_param('i', $id);
            $queryrating->execute();

            $ratingresult = mysqli_stmt_get_result($queryrating);
            if (mysqli_num_rows($ratingresult) == 0) {
                setvar('rating',number_format((float)0, 1, '.', ''));
            } else {
                $objrating = mysqli_fetch_row($ratingresult);
                setvar('rating',number_format((float)$objrating[0], 1, '.', ''));
            }

            /*find reviews*/ 
            $queryreview = $conn->prepare("SELECT profilepic, username, rating, reviewcomment FROM orderbook INNER JOIN user ON orderbook.userid=user.id WHERE orderbook.bookid=?");
            $queryreview->bind_param('i', $id);
            $queryreview->execute();

            $reviewresult = mysqli_stmt_get_result($queryreview);
            if (mysqli_num_rows($reviewresult) == 0) {
                $reviews[0]['profilepic'] = 'foo';
            } else {
                $j = 0;
                while ($objreview = mysqli_fetch_row($reviewresult)) {
                    $reviews[$j]['profilepic'] = $objreview[0];
                    $reviews[$j]['username'] = $objreview[1];
                    $reviews[$j]['rating'] = number_format((float)$objreview[2], 1, '.', '');
                    $reviews[$j]['reviewcomment'] = $objreview[3];
                    $j=$j+1;
                }
            }
        }
    }
    
    include "views/book_detail.php";
?>