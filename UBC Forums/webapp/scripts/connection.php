<?php
    $db_hostname = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "db_81265373";

    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }