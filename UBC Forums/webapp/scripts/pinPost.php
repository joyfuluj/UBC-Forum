<?php
include_once('../scripts/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $postId = $_POST['postId'];  
    $pin = $_POST['pin'];
    if($pin == 0){
        $sql = "UPDATE posts SET pin=1 WHERE postId = ?";
        $prep = $conn->prepare($sql);
        $prep -> bind_param("s", $postId);
        if ($prep->execute() === false) {
            die("Exception: " . $prep->error);
        }
    }
    else{
        $sql = "UPDATE posts SET pin=0 WHERE postId = ?";
        $prep = $conn->prepare($sql);
        $prep -> bind_param("s", $postId);
        if ($prep->execute() === false) {
            die("Exception: " . $prep->error);
        }
    }
    
    $conn->close();
    exit();
} else {
  echo "Method doesn't work";
}
