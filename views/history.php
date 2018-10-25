<!DOCTYPE html>
<html>

<head>
    <title>History</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
</head>

<body>
    <?php embed("main-bar"); ?>

    <div id="main">
        <h2>History</h2>
    </div>


    <?php 
        echo '<table class="ahistorybook">';
        echo '<col>';
        echo '<col width="300">';
        echo '<col width="150">';
        echo "<tr>
        <th></th>
        <th></th>
        <th></th>
        </tr>";


        if ($SESSION == null) {
            force_login();
        } else {
            $user = $SESSION->get_user();
            setvar('name',$user->name);
            setvar('username',$user->username);
            setvar('email',$user->email);
            setvar('address',$user->address);
            setvar('phone',$user->phone);
        }

        global $conn;
        $query = $conn->prepare("SELECT `cover`,`title`,`total`,`reviewcomment`,`orderdate`,`ordernumber`,`userid`,orderbook.id AS orderid
        FROM orderbook INNER JOIN book ON orderbook.bookid = book.id
        WHERE orderbook.userid = ?
        ORDER BY orderdate DESC");
        $userid = $SESSION->get_id();
        $query->bind_param('i', $userid);
        $query->execute();
        $result = mysqli_stmt_get_result($query);

        $row = $result->fetch_assoc();
        while($row != null){
            echo "<tr>";
            echo "<td>";
            echo '<div class="bookimage">';  
            if(is_null($row['cover'])){
                echo '<img class="historybook" src=';
                echo '"statics/img/mocks/detail.png">';
            }
            else{
                echo '<img class="historybook" max-height="50" id="historybook" src=';
                echo $row['cover'];
                echo '>';
            }
            echo '</div>
            </td>
            <td>
                <div class="ml" id="bookinfo">
                    <div  id="booktitle">';
            echo $row['title'];
            echo '</div>
            <div id="jumlahpesanan">';
            echo "Jumlah :".$row['total'];
            echo "</div>";
            echo "<div id='sudahreview'>";
            if(is_null($row['reviewcomment'])){
                echo "Belum direview";
            }
            else{
                echo "Anda sudah memberikan review";
            }
            echo "</div>";
            echo '</td>
            <td>
                <div class="orderinfo ml right-pos"">
                    <div id="tanggalpesan">';
            
            echo $row['orderdate'];//belum format DD - bulan - YYYY
            echo "</div>";
            echo "<div id='ordernumber' class='right-pos'>";
            echo "Nomor Order : #";
            echo $row['ordernumber'];
            echo "</div></div>";
            if(is_null($row['reviewcomment'])){
                //<button  class="right-button blue-button" type="submit" name="submit" id="save-button">Save</button>
                echo '<form action="review.php" method="get" id="input-form" autocomplete="off">';
                echo '<div id="inputfileprofpic">';
                echo '<input name="orderid" type="number"  id="orderid" value=';
                echo $row['orderid'];
                echo '>';
                echo '<input type="number" name="userid" id="userid" value=';
                echo $row['userid'];
                echo '>';
                echo '</div>';
                echo '<button  onclick=changePage() class="blue-button right-button" id="review-button">';
                echo 'Review';
                echo '</button>';
                echo '</form>';
            }
            echo "</div>";
            echo "</td>";


            //echo $row['title'];
            //Lakukan prosees print
            $row = $result->fetch_assoc();
        }



    ?>

    </table>


    <script type="text/javascript">
        orderid.value = $user['orderid'];
        userid.value = $user['userid'];

        function changePage() {
            console.log("HTE")
            window.location.href = "review.php";
        }

        function changePage() {
            //document.getElementById('tanggalpesan').innerHTML = "Masuk";
            window.location.href = "review.php";
            //window.location.href="review.php?param1="+$row['orderid']+"&param2="+$row['userid'];
        }
    </script>
</body>