<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body class="nunitofont">
        <?php embed("main-bar"); setvar('page', 'review'); ?>
        <div id="main">
            <div id="box-search">
                <div style="display: flex; margin-bottom: 50px;">
                    <div style="width: 80%;">
                        <h2 style="text-align: left; margin-left: 0px;"><?php getvar('title'); ?></h2>
                        <div style="text-align: left; margin-left: 0px;" id="author">
                            <span style="font-size: 15px; font-weight: normal;">
                                <?php getvar('author'); ?>
                            </span>
                        </div>
                    </div>
                    <div style="width: 20%; display: flex; align-items: center; justify-content: center;">
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
                        <input id="rating" type="hidden" value="<?php getvar('rating') ?>">
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img id="star-1" style="width: 40px;" src="statics/img/void-star.png">
                            <img id="star-2" style="width: 40px;" src="statics/img/void-star.png">
                            <img id="star-3" style="width: 40px;" src="statics/img/void-star.png">
                            <img id="star-4" style="width: 40px;" src="statics/img/void-star.png">
                            <img id="star-5" style="width: 40px;" src="statics/img/void-star.png">
                        </div>
                        <div class="subjudul">
                            Add Comment
                        </div>
                        <div>
                            <textarea style="width: 100%; box-sizing: border-box;" class="input-value inputbox inputreview" name="inputcomment" type="text"  id="inputcomment" rows="4">
                            </textarea>
                        </div>
                        <div id="inputfileprofpic">
                            <input name="orderid" type="number"  id="orderid" value="<?php getvar('orderid'); ?>">
                        </div>
                        <button onclick=changePage() type="button" id="back-button">Back</button>
                        <button class="blue-button" style="float: right;" type="submit" name="submitreview" id="save-button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        function changePage(){
            console.log("HTE")
            window.location.href="profile.php";
        }
        
        function validateReview(){
            var ratinginput = document.getElementById("ratinginput").value;
            var inputcomment = document.getElementById("inputcomment").value;
            if(ratinginput.trim() === ""){
                window.alert("Rating masih kosong");
            }
            else if(inputcomment === ""){
                window.alert("Comment masih kosong");
            }
            else{
                document.getElementById('input-form').submit();
                //window.location.href="history.php";
            }

        }
    </script>
</html>