<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
</head>

<body class="nunitofont">
    <?php embed("main-bar"); setvar('page', 'review'); ?>

    <?php
    global $conn;
    $orderid = $_GET['orderid'];
    $userid = $_GET['userid'];
    
    $query = $conn->prepare('SELECT `title`, `author`, `cover`
    FROM orderbook INNER JOIN book ON orderbook.bookid = book.id
    WHERE orderbook.id = ?;');
    
    $query->bind_param('i', $orderid);
    $query->execute();
    $result = mysqli_stmt_get_result($query);

    $row = $result->fetch_assoc();
    
    echo '<div style="display:flex;">';
    echo '<div style="display:flex flex-direction:column;">';
    echo '<div id="main">';
    echo '<h2>'.$row["title"].'</h2>';
    echo '</div>';
    echo '<div id="author">';
    echo $row["author"];
    echo '</div>';
    echo '</div>';
    echo '<div class="bookimage">';
    echo '<img class="bookreview" src=';
    echo $row["cover"];
    echo ' alt="cover buku">';
    echo '</div>';
    echo '</div>';
    echo '<div class="ml-20">';
    echo '<div class="subjudul">';
    echo 'Add Rating';
    echo '</div>';
    echo '<form method="POST" id="input-form" autocomplete="off">';

    echo '<div>';
    echo '<input class="input-value inputbox inputreview" name="ratinginput" id="ratinginput" type="number>';
    echo '</div>';

    echo '<div class="subjudul">';
    echo 'Add Comment';
    echo '</div>';

    echo '<div>';
    echo '<textarea class="input-value inputbox inputreview" name="inputcomment" type="text"  id="inputcomment" rows="4">';
    echo '</textarea>';
    echo '</div>';

    echo '<div id="inputfileprofpic">';
    echo '<input name="orderid" type="number"  id="orderid" value=';
    echo $orderid;
    echo '>';
    echo '</div>';
    
    echo '<button onclick=changePage() type="button" id="back-button">Back</button>';
    echo '<button  class="mlreview blue-button" type="submit" name="submitreview" id="save-button">Save</button>';
    echo '</form>';

    $row = $result->fetch_assoc();
    

    ?>

</body>
<script type="text/javascript">
    function changePage(){
        console.log("HTE")
        window.location.href="profile.php";
    }
</script>
</html>