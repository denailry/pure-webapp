<?php
    if ($rating >= 1 && $rating <= 5) {
        setvar('stars', 'statics/img/'.((int) $rating).'-stars.png');
    } else {
        setvar('stars', 'statics/img/0-stars.png');
    }
?>
<?php
    function createOrderOptionComponent($value) {
        return '
            <option value="'.$value.'">'.$value.'</option>
        ';
    }
    function createOptionListComponent($limit) {
        $optionList = '';
        for ($i = 1 ; $i <= $limit; $i++) {
            $optionList = $optionList.createOrderOptionComponent($i);
        }
        return $optionList;
    }
?>
<?php
    function createReviewComponent($profilepic, $username, $reviewcomment, $rating) {
        return '
            <table class="reviews">
                <td class="profile_picture"><img src="'.$profilepic.'"></td>
                <td class="comments">
                    <span class="username">@'.$username.'</span>
                    <span class="comment">'.$reviewcomment.'</span>
                </td>
                <td class="ratings">
                    <figure class="reviewrating">
                        <img src="statics/img/single-star.png">
                        <figcaption>'.$rating.'/5.0</figcaption>
                    </figure>
                </td>
            </table>
        ';
    }

    $reviewList = '';
    if ($reviews[0]['profilepic'] != 'foo'){
        foreach ($reviews as $item) {
            $reviewList = $reviewList.createReviewComponent($item['profilepic'], $item['username'], 
                $item['reviewcomment'], $item['rating']);
        }
    }
    setvar('reviews', $reviewList);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book Detail</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>
    <body class="nunitofont">
        <?php setvar('page', 'browse'); embed("main-bar"); ?>
        <div id="main">
            <figure class="bookcover">
                <img id="cover" src=<?php getvar('cover'); ?>>
                <img id='starrating' src="<?php getvar('stars') ?>">
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
                        <?php echo createOptionListComponent(100) ?>
                    </select>
                    <button id="btn-order" class="btn-primary" type="button" onclick="startOrder(<?php getvar('id'); ?>)">Order</button>
                </form>
            </div>
            <div class="review">
                <span class="subheading">Reviews</span>
                <?php getvar('reviews') ?>                
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
                    showNotification(result.data.orderid);
                }
            );
        }

        function showNotification(id){
            showModal(id);
        }

    </script>
</html>