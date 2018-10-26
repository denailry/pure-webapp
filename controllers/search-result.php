<?php
    require_once "configs/db.php"; 
    require_once "models/user.php";
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
        if(isset($_GET['input-search'])) {
            $input = '%'.$_GET['input-search'].'%';
            /*find titles*/
            $querytitle = $conn->prepare("SELECT * FROM book WHERE title LIKE ?");
            $querytitle->bind_param('s', $input);
            $querytitle->execute();

            $bookresult = mysqli_stmt_get_result($querytitle);
            $numberofresults = mysqli_num_rows($bookresult);

            if (mysqli_num_rows($bookresult) != 0) {
                $j = 0;
                while ($objbook = mysqli_fetch_row($bookresult)) {
                    $books[$j]['id'] = $objbook[0];
                    $books[$j]['title'] = $objbook[1];
                    $books[$j]['author'] = $objbook[2];
                    $books[$j]['cover'] = $objbook[3];
                    $books[$j]['detail'] = $objbook[4];

                    /*find rating*/
                    $queryrating = $conn->prepare("SELECT AVG(rating), count(rating) AS ratings FROM orderbook WHERE bookid=? GROUP BY bookid");
                    $queryrating->bind_param('i', $objbook[0]);
                    $queryrating->execute();

                    $ratingresult = mysqli_stmt_get_result($queryrating);
                    if (mysqli_num_rows($ratingresult) == 0) {
                        $books[$j]['rating'] = number_format((float)0, 1, '.', '');
                        $books[$j]['numberofvotes'] = 0;
                    } else {
                        $objrating = mysqli_fetch_row($ratingresult);
                        $books[$j]['rating'] = number_format((float)$objrating[0], 1, '.', '');
                        $books[$j]['numberofvotes'] = $objrating[1];
                    }
                    $j=$j+1;
                }
            }

            setvar('resultCount', $numberofresults);
        }
    }
    
    include "views/search-result.php";	
?>