<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../styles/post.css">

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
            <select id="community" name="communities">
                <option value="" disabled selected>Choose a Community</option>
                <option value="Travel">Travel</option>
                <option value="Game">Game</option>
                <option value="Nature">Nature</option>
                <option value="School">School</option>
                <option value="Sports">Sports</option>
            </select>
            <input type="text" id="textPost" name="postDesc" style="<?php if(isset($_GET['nopost'])) echo 'border: 1px solid red;'; ?>"value="<?php if($_GET['postDesc']) echo $_GET['postDesc']; ?>">
            <input type="file" name="image" id="uploadImg">
            <?php if (isset($_GET['invalid'])) echo "<p class ='error'>Only images are valid.</p>"; ?>
            <input type="submit" value="Post" id="postbutton">
        
        </form>
    </div>
</body>
</html>
