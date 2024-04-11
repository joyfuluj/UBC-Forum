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
    $user_fname = $_SESSION['user_fname']; 
    $user_lname = $_SESSION['user_lname'];

    // Echo the $user_id into a JavaScript variable
    echo "<script>let userId = $user_id;</script>";
    echo "<script>let userPrivilege = $user_privilege;</script>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Account Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/postFrag.css">
    <link rel="stylesheet" type="text/css" href="../styles/account.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/notify.js"></script>

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
        <div class="column" id="recent_posts">
            <h1 style="text-decoration: underline; padding-bottom: 0.5em;"><?php echo $user_name . "'s Posts"; ?></h1>
            <section id="posts" style="padding: 0;">

            </section>
        </div>

        <!-- Account Information -->
        <div class="column" id="user_info">
            <div id="info">
                <h1 style="text-decoration: underline;"><?php echo $user_name; ?></h1>
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
                            echo "<img src='../images/default_account.jpg'>";
                        }
                    ?>
                </div>
                <h2 style="margin-top: 0.5em; margin-bottom: 0.5em;"><?php echo $user_fname . " " . $user_lname; ?></h2>
            </div>

            <!-- Account Options -->
            <div id="options">
                <h3 style="text-decoration: underline; margin-top: 0.25em; margin-bottom: 0.5em;">Account Settings</h3><br>

                <!-- Change Profile Picture -->
                <div id="change_pic">
                    <h4>Change Profile Picture</h4>
                    <div id="picError" style="color: red; font-size: 12pt; text-align: center;">
                        <?php 
                            if(isset($_GET['picError'])) 
                            {
                                echo $_GET['picError'];
                                unset($_GET['picError']);
                            }
                        ?>
                    </div>
                    <div id="picMsg" style="color: green; font-size: 12pt; text-align: center;">
                        <?php
                            if(isset($_GET['picMsg'])) 
                            {
                                echo $_GET['picMsg'];
                                unset($_GET['picMsg']);
                            }
                                
                        ?>
                    </div>
                    
                        <form action="../scripts/updateProfilePic.php" method="post" enctype="multipart/form-data">
                            <input type="file" id="choose_file" name="new_pic">
                            <input type="submit" id="upload_pic" name="submit" value="Upload">
                        </form><br><br>
                </div>
                
                <!-- Change Password -->
                <div id="change_password">
                    <h4 style="margin-bottom: 0.5em;">Change Password</h4>
                    <div id="passError" style="color: red; font-size: 12pt; text-align: center;">
                        <?php 
                            if(isset($_GET['passError'])) 
                            {
                                echo $_GET['passError'];
                                unset($_GET['passError']);
                            }
                        ?>
                    </div>
                    <div id="passMsg" style="color: green; font-size: 12pt; text-align: center;">
                        <?php
                            if(isset($_GET['passMsg'])) 
                            {
                                echo $_GET['passMsg'];
                                unset($_GET['passMsg']);
                            }
                        ?>
                    </div>
                    <form id="change-password-form" action="../scripts/updatePassword_authenticate.php" method="post" style="margin-bottom: 0.5em;">
                        <input type="password" id="old_password" name="old_password" placeholder="Current password" style="margin-bottom: 0.5em;"><br>
                        <input type="password" id="new_password1" name="new_password1" placeholder="New password" style="margin-bottom: 0.5em;"><br>
                        <input type="password" id="new_password2" name="new_password2" placeholder="Re-enter new password" style="margin-bottom: 0.5em;"><br>
                        <input type="submit" value="Change Password">
                    </form><br><br>
                </div>

                    <!-- Delete Account -->
                <div id="delete_account">
                    <h4 style="margin-bottom: 0.5em;">Delete Account</h4>
                    <div id="delError" style="color: red; font-size: 12pt; text-align: center;">
                        <?php 
                            if(isset($_GET['delError'])) 
                            {
                                echo $_GET['delError'];
                                unset($_GET['delError']);
                            }
                        ?>
                    </div>
                    <div id="delMsg" style="color: green; font-size: 12pt; text-align: center;">
                        <?php
                            if(isset($_GET['delMsg'])) 
                            {
                                echo $_GET['delMsg'];
                                unset($_GET['delMsg']);
                            }
                        ?>
                    </div>
                </div>
                
                <form id="delete-account-form" action="../scripts/deleteAccount_authenticate.php" method="post" style="margin-bottom: 0.5em;">
                    <input type="password" id="password1" name="password1" placeholder="Current password" style="margin-bottom: 0.5em;"><br>
                    <input type="password" id="password2" name="password2" placeholder="Re-enter current password" style="margin-bottom: 0.5em;"><br>
                    <input type="submit" value="Delete Account">
                </form>
            </div>

            
                <?php
                    if($user_privilege == 2)
                    {
                        echo 
                        '<div id="admin-options">
                            <h3 style="text-decoration: underline; margin: 0;">Admin Panel</h3><br>
                            <div id="admin-search" style="margin-top: 1em">
                                <form id="admin-form" method="GET" action ="">
                                    <select id="type" name="searchType" style="width: auto;">
                                    <option value="1">Users</option>
                                    <option value="2">Posts</option>
                                    </select>
                                    <input id="admin-search-input" type="text" name="search" placeholder="Search..." style="margin-top: 1em; margin-bottom: 1em; padding: 0.5em; border-radius: 0.75em; width: 75%;">
                                    <button id="admin-search-button" type="submit" style="width: auto;">Search</button>
                                </form>
                            </div>';

                        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) 
                        {
                            // Store the output of the adminDashboard.php file in a variable and print it to account.php
                            ob_start();
                            include('../pages/adminDashboard.php');
                            $admin_dashboard_output = ob_get_clean();

                            echo $admin_dashboard_output;
                        }

                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="../scripts/getOwnComments.js"></script>
    <script src="../scripts/getOwnPosts.js"></script>
    <script src="../scripts/updatePassword-validation.js"></script>
    <script src="../scripts/deleteAccount-validation.js"></script>
</body>
</html>