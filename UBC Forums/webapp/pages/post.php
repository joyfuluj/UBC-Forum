<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/post.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <!--Header import-->
    <header id="header">
        <script src="../scripts/header.js"></script>
    </header>

    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div id="post">
            <!-- <input type="text" id="title" name="title"> -->
            <?php if (isset($_GET['nocomm'])) echo "<p style=\"position: absolute; top: 60px;left: 60px;font-size: 15px;color: red;\">Please set the community.</p>"; ?>
            <input type="text" id="textPost" name="postDesc" style="<?php if(isset($_GET['nopost'])) echo 'border: 1px solid red;'; ?>"value="<?php if($_GET['postDesc']) echo $_GET['postDesc']; ?>">
            <?php if (isset($_GET['nopost'])) echo "<p style=\"position: absolute; top: 100px;left: 60px;font-size: 15px;color: red;\">Please enter something here or post the image file.</p>"; ?>
            <?php if (isset($_GET['posted'])) echo "<p style=\"position: absolute; top: 60px;left: 60px;font-size: 15px;color: red;\">Successfully posted!</p>"; ?>
            <select id="community" name="communities" style="top: 25px; left: 10px">
            <option value="" disabled selected>Choose a Community</option>
            <option value="Travel">Travel</option>
            <option value="Game">Game</option>
            <option value="Nature">Nature</option>
            <option value="School">School</option>
            <option value="Sports">Sports</option>
            </select>
            
        </div>
        <input type="file" name="image" id="uploadImg" style="top: 600px; left: 450px; width:250px" >
        <?php if (isset($_GET['invalid'])) echo "<p style=\"position: absolute; top: 600px;left: 740px;font-size: 15px;color: red;\">Only images are valid.</p>"; ?>
        <input type="submit" value="post" id="postbutton" style="top: 590px;right: 450px;padding:20px;">
    </form>
</body>
</html>
