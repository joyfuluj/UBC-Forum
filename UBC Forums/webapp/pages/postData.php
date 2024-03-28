<?php
//TODO: Change when uploading to server
include_once('../scripts/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $pageNum = "";
  if(isset($_GET['pageNum'])){
      $pageNum = 5*$_GET['pageNum'];
  };
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM posts ORDER BY postTime ASC LIMIT 5 OFFSET ?";
  $prep = $conn->prepare($sql);
  $prep -> bind_param("i", $pageNum);
  if ($prep->execute() === false) {
    die("Failed: " . $prep->error);
  }
  $result = $prep->get_result();

  $rows = array();
  while($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }
  echo json_encode($rows);


  $prep->close();
  $conn->close();
}else{
  echo "Wrong request method silly!";
}
