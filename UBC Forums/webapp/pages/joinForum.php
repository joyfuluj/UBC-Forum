<?php
if (isset($_POST['communityId'])&&isset($_POST['userId'])&&isset($_POST['userId'])) {
    $communityId = $_POST['communityId'];
    $userId = $_POST['userId'];
    $action = $_POST['action'];
} else {
    echo "error";
}


include_once('../scripts/connection.php');
if($action == 'Join'){
    $sql = "INSERT INTO memberOf (userId, communityId, type, joinDate) VALUES (?, ?, 'member', NOW())";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 'ii', $userId, $communityId);
        ini_set('display_errors', 1);
        mysqli_stmt_execute($statement);
        // Check for affected rows
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: forums.php?joined&communityId=$communityId");
            exit();
        } else {
            echo 'Error storing membership: ' . mysqli_stmt_error($statement);
        }
        mysqli_stmt_close($statement);
    } else {
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }
}
else{
    $sql = "DELETE FROM memberOf WHERE userId = ? and communityId = ?";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 'ii', $userId, $communityId);
        ini_set('display_errors', 1);
        mysqli_stmt_execute($statement);
        // Check for affected rows
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: forums.php?withdrawed&communityId=$communityId");
            exit();
        } else {
            echo 'Error storing membership: ' . mysqli_stmt_error($statement);
        }
        echo "YAY";
        mysqli_stmt_close($statement);
    } else {
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }
}



mysqli_close($conn);

