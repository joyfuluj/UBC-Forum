<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//TODO: Change when uploading to server
$userId = "";
if(isset($_GET['userId'])){
    $userId = $_GET['userId'];
};
include_once('../scripts/connection.php');


$sql = "SELECT username FROM users WHERE userId = ? LIMIT 2";
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