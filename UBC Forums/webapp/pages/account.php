<?php
    session_start();

    if (!isset($_SESSION['user_id'])) 
    {
        header("Location: login.php");
        exit();
    }

    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $user_privilege = $_SESSION['user_privilege'];
    $user_email = $_SESSION['user_email'];
    $user_fname = $_SESSION['user_fname']; 
    $user_lname = $_SESSION['user_lname'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Account Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/account.css">
</head>
<body>
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
    </header>
    <div class="container">

        <div class="column" id="sidebar">
            Sidebar
        </div>

        <div class="column" id="recent_posts">
            Recent Posts
        </div>

        <div class="column" id="user_info">
            <h1><?php echo $user_name; ?></h1>

            <div id="pic">
                <img src="../posts/2-1.jpg">
            </div>

            <h3>Upload Profile Picture</h3>
            <div id="upload_pic">
                <form action="upload_pic.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_pic" id="profile_pic">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </div>
            
            <p>First Name: <?php echo $user_fname; ?></p>
            <p>Last Name: <?php echo $user_lname; ?></p>
            <p>Email: <?php echo $user_email; ?></p>
            <h3>Change Password</h3>
            <form action="change_password.php" method="post">
                <label for="old_password">Old Password:</label><br>
                <input type="password" id="old_password" name="old_password"><br>
                <label for="new_password">New Password:</label><br>
                <input type="password" id="new_password" name="new_password"><br>
                <input type="submit" value="Change Password">
            </form>
            
        </div>
    </div>
</body>
</html>