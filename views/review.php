<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
</head>

<body>
    <?php embed("main-bar"); setvar('page', 'editprofile'); ?>

    <div id="main">
        <h2>Edit Profile<h2>
    </div>
    <?php
    global $conn;
    $orderid = $_GET['orderid'];
    $orderid = $_GET['userid'];
    $query = $conn->prepare("SELECT `title`, 
    FROM orderbook INNER JOIN book ON orderbook.bookid = book.id
    WHERE orderbook.orderid = ? 
    ");
    $userid = $SESSION->get_id();
    $query->bind_param('i', $orderid);
    $query->execute();
    $result = mysqli_stmt_get_result($query);

    $row = $result->fetch_assoc();
    while($row != null){

    }

    ?>

</body>
<script type="text/javascript">
    
</script>
</html>