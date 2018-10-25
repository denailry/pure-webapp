<?php
    // global $conn;
    // $orderid = $_GET['orderid'];
    // $userid = $_GET['userid'];
    
    // $query = $conn->prepare('SELECT `title`, `author`, `cover`
    // FROM orderbook INNER JOIN book ON orderbook.bookid = book.id
    // WHERE orderbook.id = ?;');
    
    // $query->bind_param('i', $orderid);
    // $query->execute();
    // $result = mysqli_stmt_get_result($query);

    // $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body class="nunitofont">
        <?php embed("main-bar"); setvar('page', 'review'); ?>
        <div style="display:flex;">
            <div style="display:flex flex-direction:column;">
                <div id="main">
                    <h2><?php getvar('title'); ?></h2>
                </div>
                <div id="author"><?php getvar('author'); ?></div>
            </div>
            <div class="bookimage">
                <img class="bookreview" src="<?php getvar('cover'); ?>" alt="cover buku">
            </div>
        </div>
        <div class="ml-20">
            <div class="subjudul">
                Add Rating
            </div>
            <form method="POST" id="input-form" autocomplete="off">
                <div>
                    <input class="input-value inputbox inputreview" name="ratinginput" id="ratinginput" type="number">
                </div>
                <div class="subjudul">
                    Add Comment
                </div>
                <div>
                    <textarea class="input-value inputbox inputreview" name="inputcomment" type="text"  id="inputcomment" rows="4">
                    </textarea>
                </div>
                <div id="inputfileprofpic">
                    <input name="orderid" type="number"  id="orderid" value="<?php getvar('orderid'); ?>">
                </div>
        
                <button onclick=changePage() type="button" id="back-button">Back</button>
                <button  class="mlreview blue-button" type="submit" name="submitreview" id="save-button">Save</button>
            </form>
        </div>
    </body>
    <script type="text/javascript">
        function changePage(){
            console.log("HTE")
            window.location.href="profile.php";
        }
    </script>
</html>