<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn){
        die("Connect Fail" . mysqli_connect_error());
    }
?>