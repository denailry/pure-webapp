<?php
    $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", 
        "September", "Oktober", "November", "Desember"];
    function formatDate($date) {
        global $months;
        return substr($date, 8, 2).' '.$months[((int)substr($date, 5, 2)) + 1].' '.substr($date,0,4);
    }

    function createOrderComponent($order, $cover, $sudahreview, $formComponent) {
        return '
            <tr>
                <td>
                    <div class="bookimage">
                        <img class="historybook" max-height="50" id="historybook" src="'.$cover.'">`
                    </div>
                </td>
                <td>
                    <div class="ml" id="bookinfo">
                        <div  id="booktitle">
                            '.$order->get_book()->title.'
                        </div>
                        <div id="jumlahpesanan">
                            Jumlah: '.$order->total.'
                        </div>
                        <div id="sudahreview">
                            '.$sudahreview.'
                        </div>
                    </div>
                </td>
                <td style="position: relative;">
                    <div style="position: absolute; top: 0px; bottom: 0px; width:100%;">
                        <div class="orderinfo" style="position: absolute; top: 0px; left: 0px; ">
                            <div id="tanggalpesan">
                                '.formatDate($order->orderdate).'
                            </div>
                            <div id="orderid">
                                Nomor Order : #'.$order->get_id().'
                            </div>
                        </div>
                    </div>
                    '.$formComponent.'
                </td>
            </tr>
            <tr>
                <td></td><td></td>
                <td>
                    <div class="blank-space">
                    </div>
                </td>
            </tr>
        ';
    }

    function createReviewFormComponenet($orderid) {
        return '
            <div style="position: absolute; right: 0px; bottom: 0px;">
                <form action="review" method="get" id="input-form" autocomplete="off">
                    <div id="inputfileprofpic">
                        <input name="orderid" type="number"  id="orderid" value='.$orderid.'>
                    </div>
                    <button id="review-button" class="blue-button">
                        Review
                    </button>
                </form>
            </div>
        ';
    }

    $history = Order::get_history($SESSION->get_id());
    $historyView = "";
    foreach ($history as $order) {
        if ($order->get_book()->cover == null) {
            $cover = 'statics/img/mocks/detail.png';
        } else {
            $cover = $order->get_book()->cover;
        }
        if ($order->reviewcomment == null) {
            $sudahreview = "Belum direview";
            $formComponent = createReviewFormComponenet($order->get_id());
        } else {
            $sudahreview = "Anda sudah memberikan review";
            $formComponent = "";
        }
        $historyView = $historyView.createOrderComponent($order, $cover, $sudahreview, $formComponent);
    }
    setvar('history', $historyView);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>History</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css?version=3">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>
    <body class="nunitofont">
        <?php setvar('page', 'history'); embed("main-bar"); ?>
        <div id="main">
            <table class="ahistorybook">
                <caption>History</caption>
                <col>
                <col width="300">
                <col width="150">
                <?php getvar('history') ?>
            </table>
        </div>    
    </body>
</html>