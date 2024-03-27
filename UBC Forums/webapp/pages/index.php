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
    
    
</head>
    
<body>
    <!--Header import-->
    <header id ="header">
        <?php include_once('../scripts/header.php'); ?>
        <!--<script src="../scripts/header.js"></script>-->
    </header>
    <!--Body-->
    <div class = 'bodyDiv'>
        <section id = "sideMenu">
            <button id = 'loadDefault' onClick = 'loadDefaults()'>X</button>
            <div id = "sideMenuContent">
                <h3>To be filled Dashboard Options</h3>
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
<script src = "../scripts/getPosts.js"></script>
<script src = "../scripts/dashOptions.js"></script>
</html>

