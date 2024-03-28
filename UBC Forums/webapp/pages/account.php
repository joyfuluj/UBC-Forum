<?php
    session_start();
    include_once('../scripts/connection.php');

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
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">

</head>
<body>
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>/
        <li id=current>Account</li>
        </ul>
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
                <?php 
                    $sql = "SELECT profilePic FROM users WHERE userId = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    if($row['profilePic'] != NULL)
                    {
                        echo "<img src='../images/" . $row['profilePic'] . "'>";
                    }
                    else
                    {
                        echo "<img src='../images/img-6603a76f01ab77.05776938.jpg'>";
                    }
                ?>
            </div>

            <h3>Upload Profile Picture</h3>
            <div id="error" style="color: red; font-size: 12pt; text-align: center;">
                <?php 
                    if(isset($_GET['picError'])) 
                    {
                        echo $_GET['picError'];
                        unset($_GET['picError']);
                    }
                ?>
            </div>
            <div id="msg" style="color: green; font-size: 12pt; text-align: center;">
                <?php
                    if(isset($_GET['msg'])) 
                    {
                        echo $_GET['msg'];
                        unset($_GET['msg']);
                    }
                        
                ?>
            </div>
            <div id="upload_pic">
                <form action="../scripts/updateProfilePic.php" method="post" enctype="multipart/form-data">
                    <input type="file" id="choose_file" name="new_pic">
                    <input type="submit" id="upload_pic" name="submit" value="Upload">
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