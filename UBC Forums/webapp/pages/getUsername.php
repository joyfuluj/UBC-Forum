<?php
//TODO: Change when uploading to server
include_once('../scripts/connection.php');


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