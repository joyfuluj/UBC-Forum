<?php
include_once('../scripts/connection.php');

$lastCheckTime = isset($_GET['last_check_time']) ? $_GET['last_check_time'] : 0;

// check for new posts
$query = "SELECT COUNT(*) as new_posts FROM posts WHERE postTime > FROM_UNIXTIME(?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $lastCheckTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error in query: " . $conn->error);
}

$row = $result->fetch_assoc();
$newPostsCount = $row['new_posts'];

echo json_encode(['new_posts' => $newPostsCount]);

$stmt->close();
$conn->close();

