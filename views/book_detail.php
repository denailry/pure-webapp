<!DOCTYPE html>
<html>
    <head>
        <title>Book Detail</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <?php embed("main-bar"); ?>
        <div id="main">
            <figure>
                <img id="cover" src=<?php getvar('cover'); ?>>
                <figcaption class="caption"><?php getvar('rating'); ?>/5.0</figcaption>
            </figure>
            <div>
                <h3><?php getvar('title'); ?></h3>
                <span class="author"><?php getvar('author'); ?></span>
                <span class="detail"><?php getvar('detail'); ?></span>
            </div>
            <div class="order">
                <span class="subheading">Order</span>
                <button id="btn-order" class="btn-primary">Order</button>
                <div>
                    <span class="jumlah">Jumlah :</span>
                    <select>
                        <?php
                            for ($i=1;$i<=100;$i++) {
                                ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="review">
                <span class="subheading">Reviews</span>
                <?php 
                    foreach ($reviews as $item) {
                        ?>
                        <table class="reviews">
                            <td class="profile_picture"><img src=<?php $item['profilepic']; ?>></td>
                            <td class="comments">
                                <span class="username">@<?php echo $item['username']; ?></span>
                                <span class="comment"><?php echo $item['reviewcomment']; ?></span>
                            </td>
                            <td class="ratings"><p><?php echo $item['rating']; ?>/5.0</p></td>
                        </table>
                        <?php
                    }
                ?>                
            </div>
        </div>
    </body>
</html>