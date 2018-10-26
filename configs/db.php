<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tugasbesar1_2018";
    $current_version = 8;
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        echo "Have you created database 'tugasbesar1_2018'? <br>";
        die("Connection failed: " . $conn->connect_error);
    } else {
        $result = $conn->query("SELECT number FROM version");
        $row = mysqli_fetch_row($result);
        $db_version = $row[0];
        if ($current_version != $db_version) {
            die("Database is outdated. Please update database with migration file.");
        }
    }
?>