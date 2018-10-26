<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>
    <body class="nunitofont">
        <?php  setvar('page', 'history'); embed("main-bar"); ?>
        <div id="main">
            <div class="center">
                <div style="display: flex; margin-bottom: 50px;">
                    <div style="width: 80%;">
                        <h2 style="margin-bottom: 0px; text-align: left; margin-left: 0px;"><?php getvar('title'); ?></h2>
                        <div style="text-align: left; margin-left: 0px;" id="author">
                            <span style="font-size: 12px; font-weight: normal; font-weight:bold;">
                                <?php getvar('author'); ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 20%; display: flex; align-items: center; justify-content: center; margin-top:30px;">
                        <div class="bookimage" >
                            <img class="bookreview" src="<?php getvar('cover'); ?>" alt="cover buku">
                        </div>
                    </div>
                </div>
                <div>
                    <form style="width: 100%;" method="POST" id="input-form" autocomplete="off">
                        <div class="subjudul" style="margin-bottom: 20px;">
                            Add Rating
                        </div>
                        <input id="ratinginput" name="ratinginput" type="hidden" value="<?php getvar('rating') ?>">
                        <div style="text-align: center; margin-bottom: 30px;">
                            <div id="star-1-wrapper" style="display: inline">
                                <img id="star-1" style="width: 40px;" src="statics/img/void-star.png">
                            </div>
                            <div id="star-2-wrapper" style="display: inline">
                                <img id="star-2" style="width: 40px;" src="statics/img/void-star.png">
                            </div>
                            <div id="star-3-wrapper" style="display: inline">
                                <img id="star-3" style="width: 40px;" src="statics/img/void-star.png">
                            </div>
                            <div id="star-4-wrapper" style="display: inline">
                                <img id="star-4" style="width: 40px;" src="statics/img/void-star.png">
                            </div>
                            <div id="star-5-wrapper" style="display: inline">
                                <img id="star-5" style="width: 40px;" src="statics/img/void-star.png">
                            </div>
                        </div>
                        <div class="subjudul">
                            Add Comment
                        </div>
                        <div>
                            <textarea style="width: 100%; box-sizing: border-box;" class="input-value inputbox inputreview" name="inputcomment" type="text"  id="inputcomment" rows="4"></textarea>
                        </div>
                        <div id="inputfileprofpic">
                            <input name="orderid" type="number"  id="orderid" value="<?php getvar('orderid'); ?>">
                        </div>
                        <button onclick=changePage() type="button" id="back-button">Back</button>
                        <button class="blue-button" style="float: right;" type="button" name="submitreview" id="save-button" onclick="validateReview()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        const VOID_STAR = 0;
        const FILLED_STAR = 1;

        let star = ['statics/img/void-star.png', 'statics/img/filled-star.png'];
        let current_src = [VOID_STAR, VOID_STAR, VOID_STAR, VOID_STAR, VOID_STAR];

        for (let i = 1; i <= 5; i++) {
            document.getElementById('star-' + i + '-wrapper').onmouseover = function() {
                for (let j = 1; j <= 5; j++) {
                    if (j <= i) {
                        document.getElementById('star-' + j).setAttribute('src', star[FILLED_STAR]);
                    } else {
                        document.getElementById('star-' + j).setAttribute('src', star[VOID_STAR]);
                    }
                }
            }

            document.getElementById('star-' + i + '-wrapper').onmouseout = function() {
                for (let j = 1; j <= 5; j++) {
                    document.getElementById('star-' + j).setAttribute('src', star[current_src[j-1]]);
                }
            }

            document.getElementById('star-' + i + '-wrapper').onclick = function() {
                for (let j = 1; j <= 5; j++) {
                    if (j <= i) {
                        current_src[j-1] = FILLED_STAR;
                    } else {
                        current_src[j-1] = VOID_STAR;
                    }
                }
                document.getElementById('ratinginput').value = i;
            }
        }
        
    </script>
    <script type="text/javascript">
        function changePage(){
            window.location.href="history.php";
        }
        
        function validateReview() {
            var ratinginput = document.getElementById("ratinginput").value;
            var inputcomment = document.getElementById("inputcomment").value;
            if(inputcomment.trim() === ""){
                window.alert("Comment masih kosong");
            } else{
                document.getElementById('input-form').submit();
            }
        }
    </script>
</html>