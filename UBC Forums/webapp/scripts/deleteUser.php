<?php
include_once('../scripts/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $deletedUser = $_POST['userId'];  
  
  if(isset($deletedUser)){
    $sql = "DELETE FROM users WHERE userId = ? LIMIT 1";
    $prep = $conn->prepare($sql);
    $prep -> bind_param("s", $deletedUser);
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
