<?php
error_reporting(E_ALL);
include_once('../scripts/connection.php');
        
//GET Request for promoting a post

if(isset($_GET['postId']) && isset($_GET['communityId'])){
    if(!isset($_SESSION)){
        session_start();
    }   
    if(isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
        $postId = $_GET['postId'];
        $communityId = $_GET['communityId'];
        $sql = "SELECT * FROM postLike WHERE postId = ? AND communityId = ? AND userId = ? LIMIT 1";
        $prep = $conn -> prepare($sql);
        $prep -> bind_param("sss", $postId, $communityId, $userId);
        if($prep -> execute() === false){
            die("Failed: " . $prep -> error);
        }
        $result = $prep -> get_result();
        if($result -> num_rows <= 0){
            $row = $result -> fetch_assoc();
            $sql = "UPDATE posts SET promos = promos+1 WHERE postId = ? AND communityId = ? LIMIT 1";
            $prep = $conn -> prepare($sql);
            $prep -> bind_param("ss", $postId, $communityId);
            if($prep -> execute() === false){
                die("Failed: " . $prep -> error);
            }
            $sql = "INSERT INTO postLike (postId, communityId, userId) VALUES (?, ?, ?)";
            $prep = $conn -> prepare($sql);
            $prep -> bind_param("sss", $postId, $communityId, $userId);
            if($prep -> execute() === false){
                die("Failed: " . $prep -> error);
            }
            echo 1;
        } else {
            $row = $result -> fetch_assoc();
            $sql = "UPDATE posts SET promos = promos-1 WHERE postId = ? AND communityId = ? LIMIT 1";
            $prep = $conn -> prepare($sql);
            $prep -> bind_param("ss", $postId, $communityId);
            if($prep -> execute() === false){
                die("Failed: " . $prep -> error);
            }
            $sql = "DELETE FROM postLike WHERE postId = ? AND communityId = ? AND userId = ?";
            $prep = $conn -> prepare($sql);
            $prep -> bind_param("sss", $postId, $communityId, $userId);
            if($prep -> execute() === false){
                die("Failed: " . $prep -> error);
            }
            echo 2;
        }
    }
    else{
        echo 3;
    }
}
