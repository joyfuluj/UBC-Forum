<?php
//TODO: Change when uploading to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_81265373";

$conn = new mysqli($servername, $username, $password, $dbname);
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

if ($result->num_rows > 0) {
  $rows = array();
  while($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }
  echo json_encode($rows);
} else {
echo "-1";
}
$conn->close();