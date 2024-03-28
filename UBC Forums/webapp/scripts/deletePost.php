<?php
include_once('../scripts/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $deletedPost = $_POST['postId'];  
    $deletedCommunity = $_POST['communityId'];
  
  if(isset($deletedPost) && isset($deletedCommunity)){
    $sql = "DELETE FROM posts WHERE postId = ? AND communityId = ? LIMIT 1";
    $prep = $conn->prepare($sql);
    $prep -> bind_param("ss", $deletedPost, $deletedCommunity);
    if ($prep->execute() === false) {
      die("Failed: " . $prep->error);
    }
  }else{
    echo "No user selected";
  }
  $conn->close();
  exit();

} else {
  echo "Wrong request method silly!";
}
