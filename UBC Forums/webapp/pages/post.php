<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/post.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/notify.js"></script>
</head>
<body>
    <!--Header import-->
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>/
        <li id=current>Post</li>
        </ul>
    </header>
    <div id = postWrapper>
        <form id = 'post' method="POST" action="insert.php" enctype="multipart/form-data">
            <!-- <input type="text" id="title" name="title"> -->
            <?php if (isset($_GET['nocomm'])) echo "<p class = 'error'>Please set the community.</p>"; ?>
            <?php if (isset($_GET['nopost'])) echo "<p class = 'error'>Please enter something here or post the image file.</p>"; ?>
            <?php if (isset($_GET['posted'])) echo "<p class = 'error'>Successfully posted!</p>"; ?>
            <?php if (isset($_GET['both'])) echo "<p class = 'error'>Please post either text or image!</p>"; ?>
            <input type="text" id="title" name="title" placeholder="Put your title here">
                <select id="communitySelect" name="communities">
                    <option value="" disabled selected>Choose a Community</option>
                    <?php
                    include_once('../scripts/connection.php');
                    $sql = "SELECT communityId, communityName FROM community";
                    if ($statement = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_execute($statement);
                        mysqli_stmt_bind_result($statement, $communityId, $communityName);
                        while (mysqli_stmt_fetch($statement)) {
                            echo "<option value=\"$communityId\">$communityName</option>";
                        }
                        mysqli_stmt_close($statement);
                    } else {
                        echo 'Error preparing statement: ' . mysqli_error($conn);
                    }
                    ?>
                </select>
            <input type="text" id="textPost" name="postDesc" style="<?php if(isset($_GET['nopost'])) echo 'border: 1px solid red;'; ?>"value="<?php if($_GET['postDesc']) echo $_GET['postDesc']; ?>">
            <input type="file" name="image" id="uploadImg">
            <?php if (isset($_GET['invalid'])) echo "<p class ='error'>Only images are valid.</p>"; ?>
            <input type="submit" value="Post" id="postbutton">
        
        </form>
    </div>
</body>
</html>
