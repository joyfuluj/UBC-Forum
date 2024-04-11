<?php
include_once('../scripts/connection.php');
if(isset($_POST['forumName']) && isset($_POST['forumDescription'])) {
    $forumName = $_POST['forumName'];
    $forumDescription = $_POST['forumDescription'];
    $userId = $_POST['userId'];
    // echo $forumName;
    // echo $forumDescription;
    // echo $userId;
    $sql = "INSERT INTO community (communityName, communityDesc, ownerId, dateCreated) VALUES (?, ?, ?, NOW())";
    echo "YAY";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 'ssi', $forumName, $forumDescription, $userId);
        ini_set('display_errors', 1);
        mysqli_stmt_execute($statement);
        // Check for affected rows
        if (mysqli_affected_rows($conn) > 0) {
            ini_set('display_errors', 1);
            $communityId = mysqli_insert_id($conn);
            $sql = "INSERT INTO memberOf (userId, communityId, type, joinDate) VALUES (?, ?, 'admin', NOW())";
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
        } else {
            echo 'Error creating community: ' . mysqli_stmt_error($statement);
        }
        mysqli_stmt_close($statement);
    } else {
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }
} else {
    echo "Form fields are not set.";
}



mysqli_close($conn);

