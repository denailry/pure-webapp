<?php
    function createResultComponent($book) {
        return '
            <table class="results">
                <td class="cover"><img src="'.$book['cover'].'"></td>
                <td class="about">
                    <p class="title">'.$book['title'].'</p>
                    <p class="author">'.$book['author'].' - '.$book['rating'].'/5.0 ('.$book['numberofvotes'].' votes)</p>
                    <p class="detail">'.$book['detail'].'</p>
                </td>
            </table>
            <button id="btn-detail" class="btn-primary" onclick="window.location.href=\'book_detail.php?book_id='.$book['id'].'\'">Detail</button>
        ';
    }

    $results = '';
    if($numberofresults != 0) { 
        foreach ($books as $item) {
            $results = $results.createResultComponent($item);
        }
    }
    setvar('result', $results);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Result</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>
    <body class="nunitofont">
        <?php setvar('page', 'browse'); embed("main-bar"); ?>
        <div id="main">
            <div id="box-search" style="width: 60%; min-height: 700px;">
                <span class="searchresult">Search Result</span>
                <span class="numberofresult">
                    Found <p><?php getvar('resultCount') ?></p> result(s)
                </span>
                <div>
                    <?php getvar('result') ?>  
                </div>
            </div>
        </div>
    </body>
</html>