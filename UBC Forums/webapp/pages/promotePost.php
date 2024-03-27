<?php
include 'connection.php';
//GET Request for promoting a post
start_session();
if(isset($_GET['postId']) && isset($_GET['communityId'])){
    if(isset($_SESSION)){
        $userId = $_SESSION['userId'];
        $postId = $_GET['postId'];
        $communityId = $_GET['communityId'];
        $sql = "SELECT * FROM postLikes WHERE postId = ? AND communityId = ? AND userId = ? LIMIT 1";
        $prep = $conn -> prepare($sql);
        $prep -> bind_param("sss", $postId, $communityId, $userId);
        if($prep -> execute() === false){
            die("Failed: " . $prep -> error);
        }
        $result = $prep -> get_result();
        if($result -> num_rows <= 0){
            $row = $result -> fetch_assoc();
            $sql = "UPDATE Posts SET promoted = 1 WHERE postId = ? AND communityId = ? LIMIT 1";
            $prep = $conn -> prepare($sql);
            $prep -> bind_param("ss", $postId, $communityId);
            if($prep -> execute() === false){
                die("Failed: " . $prep -> error);
            }
            echo json_encode(array("status" => "success"));
        } else {
            echo 1;
        }
    }
}
