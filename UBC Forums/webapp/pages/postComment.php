<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_81265373";

$conn = new mysqli($servername, $username, $password, $dbname);

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $commentContent = "";
    $userId = "";
    $postId = "";
    $communityId = "";
    if(!isset($_SESSION)){
        session_start();
        
    }

    if(isset($_GET['commentContent'])&& isset($_GET['postId'])&& isset($_GET['communityId'])){
        $commentContent = $_GET['commentContent'];
        $postId = $_GET['postId'];
        $communityId = $_GET['communityId'];
    }else{
        echo -1;
    }

    if(isset($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
    }else{
        echo -1;
    }
    
    /*
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    postId INT,
    communityId INT,
    commentContent VARCHAR(900),
    */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO comments (postId, communityId, commentContent, commentTime, promos, userId) 
                                VALUES (?, ?, ?, NOW(), 0, ?)";    
    $prep = $conn->prepare($sql);
    $prep -> bind_param("iisi", $postId, $communityId, $commentContent, $userId);
    if ($prep->execute() == false) {
        die("Failed: " . $prep->error);
    }
    $prep->close();
    $conn->close();
}else{
    echo "Wrong request method silly!";
}