<?php 

    // connect to database
    $conn = mysqli_connect('localhost', 'your database username default is root', 'database password if you have one otherwise leave blank', 'database name');

    // check connection
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>
