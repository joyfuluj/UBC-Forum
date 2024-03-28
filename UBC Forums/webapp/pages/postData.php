<?php
include_once('../scripts/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  $pageNum = "";
  if(isset($_GET['pageNum']))
  {
      $pageNum = 5*$_GET['pageNum'];
  };
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_GET['community'])){
    $community = $_GET['community'];
  }
  if(isset($_GET['search'])){
    $search = $_GET['search'];
  }
  if(isset($_GET['userId']))
  {
      $user_id = $_GET['userId'];
  };
  
  if(isset($search) && isset($community) && $community != "" && $search != ""){
    $sql = "SELECT * FROM posts WHERE communityId = ? AND postTitle LIKE ? ORDER BY postTime ASC LIMIT 5 OFFSET ?";
    $prep = $conn->prepare($sql);
    $search = "%".$search."%";
    $prep -> bind_param("ssi", $community, $search, $pageNum);
    if ($prep->execute() === false) {
      die("Failed: " . $prep->error);
    }
  }
  else if(isset($search) && $search != ""){
    $sql = "SELECT * FROM posts WHERE postTitle LIKE ? ORDER BY postTime ASC LIMIT 5 OFFSET ?";
    $prep = $conn->prepare($sql);
    $search = "%".$search."%";
    $prep -> bind_param("si", $search, $pageNum);
    if ($prep->execute() === false) {
      die("Failed: " . $prep->error);
    }
  }
  else if(isset($community) && $community != ""){
    $sql = "SELECT * FROM posts WHERE communityId = ? ORDER BY postTime ASC LIMIT 5 OFFSET ?";
    $prep = $conn->prepare($sql);
    $prep -> bind_param("si", $community, $pageNum);
    if ($prep->execute() === false) 
    {
      die("Failed: " . $prep->error);
    }
  }
  else if(isset($user_id) && $user_id != "")
  {
    $sql = "SELECT * FROM posts WHERE userId = ? ORDER BY postTime ASC LIMIT 5 OFFSET ?";
    $prep = $conn->prepare($sql);
    $prep -> bind_param("ii", $user_id, $pageNum);
    if ($prep->execute() === false) 
    {
      die("Failed: " . $prep->error);
    }
  }
  else
  {
    $sql = "SELECT * FROM posts ORDER BY postTime ASC LIMIT 5 OFFSET ?";
    $prep = $conn->prepare($sql);
    $prep -> bind_param("i", $pageNum);
    if ($prep->execute() === false) {
      die("Failed: " . $prep->error);
    }
  }
  $result = $prep->get_result();
  $rows = array();
  while($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }
  echo json_encode($rows);
  $prep->close();
  $conn->close();
  exit();
  $rows = array();
  while($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }
  echo json_encode($rows);


  $prep->close();
  $conn->close();
} else {
  echo "Wrong request method silly!";
}
