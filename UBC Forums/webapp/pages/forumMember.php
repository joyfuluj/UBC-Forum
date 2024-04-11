<?php
    include_once('../scripts/connection.php');
    session_start();
    $admin_action = $_GET['action'];
    $adminAction = urlencode($admin_action);
    $user_id = $_GET['userId'];
    $userId = urlencode($user_id);
    $communityId = $_GET['communityId'];
    $commId = urlencode($communityId);
    $commName ="";
    $sql = "SELECT communityName FROM community WHERE communityId = ?";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 's', $commId);
        mysqli_stmt_execute($statement);
        if($result = mysqli_stmt_get_result($statement)){
            while ($row = mysqli_fetch_assoc($result)) {
                $commName = $row['communityName'];
            }
        }
    }

    if ($adminAction == "assign") {
        $sql = "UPDATE memberOf SET type = 'moderator' WHERE userId = ? and communityId = ?";
        if ($statement = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($statement, 'ss', $userId, $commId);
            mysqli_stmt_execute($statement);
            header("Location: forumDetails.php?assigned&communityName=$commName&userId=$userId");
            exit();
        }
    } elseif ($adminAction == "unassign"){
        $sql = "UPDATE memberOf SET type = 'member' WHERE userId = ? and communityId = ?";
        if ($statement = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($statement, 'ss', $userId, $commId);
            mysqli_stmt_execute($statement);
            header("Location: forumDetails.php?unassigned&communityName=$commName&userId=$userId");
            exit();
        }
    }
    else{
        $sql = "DELETE FROM memberOf WHERE userId = ? and communityId=?";
        if ($statement = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($statement, 'ss', $userId, $commId);
            mysqli_stmt_execute($statement);
            header("Location: forumDetails.php?deleted&communityName=$commName&userId=$userId");
            exit();
        }
    }
    
