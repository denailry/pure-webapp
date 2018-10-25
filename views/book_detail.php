<!DOCTYPE html>
<html>
    <head>
        <title>Book Detail</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <?php setvar('page', 'browse'); embed("main-bar"); ?>
        <div id="main">
            <figure class="bookcover">
                <img id="cover" src=<?php getvar('cover'); ?>>
                <?php 
                    switch (true) {
                        case ($rating == 5):
                            echo "<img id='starrating' src='statics/img/5-stars.png'>";
                            break;
                        case ($rating >= 4 && $rating < 5): 
                            echo "<img id='starrating' src='statics/img/4-stars.png'>";
                            break;
                        case ($rating >= 3 && $rating < 4): 
                            echo "<img id='starrating' src='statics/img/3-stars.png'>";
                            break;
                        case ($rating >= 2 && $rating < 3): 
                            echo "<img id='starrating' src='statics/img/2-stars.png'>";
                            break;
                        case ($rating >= 1 && $rating < 2): 
                            echo "<img id='starrating' src='statics/img/1-star.png'>";
                            break;
                        default:
                            echo "<img id='starrating' src='statics/img/0-star.png'>";
                            break;
                    }  
                ?>
                <figcaption class="caption" style="font-weight: bold;"><?php getvar('rating'); ?>/5.0</figcaption>
            </figure>
            <div>
                <h3><?php getvar('title'); ?></h3>
                <span class="author"><?php getvar('author'); ?></span>
                <span class="detail"><?php getvar('detail'); ?></span>
            </div>
            <div class="order">
                <span class="subheading">Order</span>
                <form method="POST">
                    <span class="jumlah">Jumlah :</span>
                    <select id='orderamount' name="orderamount">
                        <?php
                            for ($i=1;$i<=100;$i++) {
                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <button id="btn-order" class="btn-primary" type="button" required onclick="startOrder(<?php getvar('id'); ?>)">Order</button>
                </form>
            </div>
            <div class="review">
                <span class="subheading">Reviews</span>
                <?php
                    if ($reviews[0]['profilepic'] != 'foo'){
                        foreach ($reviews as $item) {
                            ?>
                            <table class="reviews">
                                <td class="profile_picture"><img src=<?php echo $item['profilepic']; ?>></td>
                                <td class="comments">
                                    <span class="username">@<?php echo $item['username']; ?></span>
                                    <span class="comment"><?php echo $item['reviewcomment']; ?></span>
                                </td>
                                <td class="ratings">
                                    <figure class="reviewrating">
                                        <img src="statics/img/single-star.png">
                                        <figcaption><?php echo $item['rating']; ?>/5.0</figcaption>
                                    </figure>
                                </td>
                            </table>
                            <?php
                        }
                    } 
                ?>                
            </div>
        </div>

        <div id="modaltransaksi" class="modal">
          <div class="modalcontent">
            <span class="close" onclick="spanClose()">X</span>
            <table class="contentbox">
                <td class="checkmark"><img src="statics/img/checkmark.png"></td>
                <td class="insidecontent">
                    <p id="pesan">Pemesanan Berhasil!</p>
                    <p id="transaksi">Nomor Transaksi: </p>
                    <p id="nomortransaksi"></p>
                </td>
            </table>
          </div>
        </div>

    </body>
    <script>

        var modal = document.getElementById('modaltransaksi');

        function showModal(id){
            document.getElementById('nomortransaksi').innerHTML = id;
            modal.style.display = "block";
        }

        function spanClose(){
            modal.style.display = "none";
        }

    </script>
    <script src="statics/js/ajax.js"></script>
    <script type="text/javascript">

        function startOrder(id){
            var sel = document.getElementById('orderamount');
            var value = sel.options[sel.selectedIndex].value;
            
            var data = {};
            data['orderandid'] = value.toString()+"."+id;

            let ajax = {};
            ajax = requestPost(
                'book_detail.php',
                data,
                function(result) {
                    console.log(typeof result);
                    console.log(result);
                    showNotification(result.data.orderid);
                }
            );
        }

        function showNotification(id){
            showModal(id);
        }

    </script>
</html>