<?php

    if($_SERVER['SERVER_NAME'] == 'localhost'){
        $db_hostname = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "db_81265373";
    }else{
        $db_hostname = "localhost";
        $db_username = "81265373";
        $db_password = "81265373";
        $db_name = "db_81265373";
    }
    

    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }