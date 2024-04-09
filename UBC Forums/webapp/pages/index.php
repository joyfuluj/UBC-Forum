<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/postFrag.css">
    <link rel="stylesheet" type="text/css" href="../styles/commentFrag.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
    
    
</head>

<body>
    <!--Header import-->
    <header id ="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
            <li id=current>Home</li>
        </ul>
        <!--<script src="../scripts/header.js"></script>-->
    </header>
    <!--Body-->
    <div class = 'bodyDiv'>
        <section id = "sideMenu">
            <button id = 'loadDefault' onClick = 'loadDefaults()'>X</button>
            <div id = "sideMenuContent">
                <h3>Dashboard Options</h3>
            </div>
            <div id = "sideOptions">
                
                </div>
            </section>
            <section id = "posts">
                
                
                </section>
                
            </div>
            
            <!--Footer-->
            <footer>
                <nav>
                    </nav>
                </footer>
            </body>
            <!--<script src="../scripts/header.js"></script>-->
            <script src = "../scripts/promotePost.js"></script>
            <script src = "../scripts/getComments.js"></script>
            <script src = "../scripts/getPosts.js"></script>
            <script src = "../scripts/dashOptions.js"></script>
            <script src="../scripts/notify.js"></script>
            </html>
            
            