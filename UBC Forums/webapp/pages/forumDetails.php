<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $userId = $_SESSION['user_id'];
    $communityName = $_GET['$communityName']

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums</title>
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/forumDetails.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
</head>
<body>
    <!--Header import-->
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>/
        <li><a href="forums.php">Forums</a></li>/
        <li id=current><?php echo $communityName?></li>
        </ul>
    </header>
    <div id="mainWrapper">
        <div id="left">
        <?php
            
        ?>
        </div>
        <div id="right">

        </div>
    </div>
</body>
<script src = "../scripts/getPosts.js"></script>
</html>
