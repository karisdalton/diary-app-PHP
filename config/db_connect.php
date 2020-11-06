<?php 

    // connect to database
    $conn = mysqli_connect('localhost', 'dalton', 'czksnm1470', 'diary');

    // check connection
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>