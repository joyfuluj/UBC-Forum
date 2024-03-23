<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);
$postTime = "";
if(isset($_GET['postTime'])){
    $postTime = $_GET['postTime'];
};
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts WHERE postTime < '$postTime' SORT BY postTime DESC LIMIT 25";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result);
} else {
  echo "-1";
}
$conn->close();
