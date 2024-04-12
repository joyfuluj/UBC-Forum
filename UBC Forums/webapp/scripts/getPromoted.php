<?php
    include_once('../scripts/connection.php');

    if(isset($_GET['postId']) && isset($_GET['communityId']) && isset($_GET['userId']))
    {
        $postId = $_GET['postId'];
        $communityId = $_GET['communityId'];
        $userId = $_GET['userId'];

        $sql = "SELECT * FROM postLike WHERE postId = ? AND communityId = ? AND userId = ? LIMIT 1";
        $prep = $conn -> prepare($sql);
        $prep -> bind_param("iii", $postId, $communityId, $userId);
        if($prep -> execute() === false)
        {
            die("Failed: " . $prep -> error);
        }

        $result = $prep -> get_result();
        if($result -> num_rows > 0)
        {
            echo 1;
        } 
        else 
        {
            echo 0;
        }
    }