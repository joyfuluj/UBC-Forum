<?php
    session_start();
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $user_privilege = $_SESSION['user_privilege'];
    $user_email = $_SESSION['user_email'];
    $user_fname = $_SESSION['user_fname']; 
    $user_lname = $_SESSION['user_lname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Account Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/account.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <!--Header-->
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
    </header>

    <!--Body-->
    <div>
        <div id="post">
            <h2>hmm... <?php echo $_SESSION['user_name']; ?> hasn't posted anything</h2>
        </div>

        <div id="info">

            <div id="sub">
                <h3 id="name"><?php echo $_SESSION['user_name']; ?></h3>
            </div>

            <div id="pic">
                <img src="images/notYet.jpg">
            </div>

            <h2>Create Avatar</h2>
            <h3 id="newPost">New post</h3>
        </div>  

    </div>

    <!--Footer-->
    <footer>
        <nav>
        </nav>
    </footer>
</body>

</html>

