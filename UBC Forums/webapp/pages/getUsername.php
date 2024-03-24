<?php
//TODO: Change when uploading to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_81265373";

$conn = new mysqli($servername, $username, $password, $dbname);
$userId = "";
if(isset($_GET['userId'])){
    $userId = $_GET['userId'];
};
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT username FROM Users WHERE userId = ? LIMIT 2";
$prep = $conn->prepare($sql);
$prep->bind_param("s", $userId);
if ($prep->execute() === false) {
    die("Failed: " . $prep->error);
}
$result = $prep->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo ('{"username":"deleted"}');
}
$conn->close();