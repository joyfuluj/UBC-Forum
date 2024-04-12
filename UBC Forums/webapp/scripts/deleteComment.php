<?php
  session_start();
  $userId = $_SESSION['userId'];

  include_once('../scripts/connection.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $commentId = $_POST['commentId'];  
    $postId = $_POST['postId'];  
    $communityId = $_POST['communityId'];
    
    if(isset($commentId) && isset($postId) && isset($communityId))
    {
      $sql = "DELETE FROM comments WHERE commentId = ? AND postId = ? AND communityId = ? LIMIT 1";
      $prep = $conn->prepare($sql);
      $prep -> bind_param("iii", $commentId, $postId, $communityId);

      if ($prep->execute() === false) 
      {
        die("Failed: " . $prep->error);
      }
    }
    else
    {
      echo "No comment selected";
    }
    $conn->close();
    exit();

  } 
  else 
  {
    echo "Wrong request method silly!";
  }
