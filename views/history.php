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
        echo "<table>";
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
        $query = $conn->prepare("SELECT `cover`,`title`,`total`,`reviewcomment`,`orderdate`,`ordernumber` 
        FROM orderbook INNER JOIN book ON orderbook.bookid = book.id
        WHERE orderbook.userid = ?");
        $userid = $SESSION->get_id();
        $query->bind_param('i', $userid);
        $query->execute();
        $result = mysqli_stmt_get_result($query);

        $row = $result->fetch_assoc();
        while($row != null){
            echo "<tr>";
            echo "<td>";
            echo "<div class='bookimage' style='border:1px'>";
            echo "<img src=".$row['bookpicture'].">";
            echo "</div>
            </td>
            <td>
                <div id='bookinfo'>
                    <div class='title' id='booktitle'>";
            echo $row['title'];
            echo "</div>
            <div id='jumlahpesanan'>";
            echo "Jumlah :".$row['total'];
            echo "</div>";
            echo "<div id='sudahreview'>";
            if(is_null($row['review'])){
                echo "Belum direview";
            }
            else{
                echo "Anda sudah memberikan review";
            }
            echo "</div>";
            echo "</td>
            <td>
                <div class='orderinfo'>
                    <div id='tanggalpesan'>";
            echo "<div id='ordernumber'>";
            echo $row['orderdate'];//belum format DD - bulan - YYYY
            echo "</div>
            <div>";
            if(is_null($row['review'])){
                echo "<button onclick='window.location.href=";
                echo '"review.php"';
                echo "type='button' class='blue-button' id='review-button'>Review</button>";
            }
            echo "</td>";
        


            //echo $row['title'];
            //Lakukan prosees print
            $row = $result->fetch_assoc();
        }




    ?>

    <table style="border:1px solid black">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>
                <div class="bookimage" style="border:1px">
                    GAMBAR BUKU
                </div>
            </td>
            <td>
                <div id="bookinfo">
                    <div class="title" id="booktitle">
                        JUDUL BUKU
                    </div>
                    <div id="jumlahpesanan">
                        JUMLAHPESAN
                    </div>

                    <div id="sudahreview">
                        SUDAHREVIEW
                    </div>
            </td>
            <td>
                <div class="orderinfo">
                    <div id="tanggalpesan">
                        TANGGAL PESEN
                    </div>
                    <div id="ordernumber">
                        NOMOR ORDER
                    </div>
                </div>
                <button onclick="window.location.href='review.php'" type="button" class="blue-button" id="review-button">Review</button>
            </td>
</tr>
    </table>


    <script type="text/javascript">
        document.getElementById("menu-history").setAttribute("data-menu-selected", "");
    </script>
</body>