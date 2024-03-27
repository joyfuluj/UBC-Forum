<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBC Forums - Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/login-register.css">
</head>
<!--Body-->
<body>
    <!--Header-->
    <header id="header">
    </header>
    <!--Login Container-->
    <div class="login-container">
        <main>
            <h1>Login to UBC Forums</h1>
            <div class="fields">
                <div id="msg" style="color: green; font-size: 12pt; text-align: center; margin-bottom: 1em;">
                    <?php 
                        if(isset($_GET['msg'])) 
                        {
                            echo $_GET['msg'];
                            unset($_GET['msg']);
                        }
                    ?>
                    </div>
                <div id="error" style="color: red; font-size: 12pt; text-align: center; margin-bottom: 1em;">
                    <?php 
                        if(isset($_GET['error'])) 
                        {
                            echo $_GET['error'];
                            unset($_GET['error']);
                        }
                    ?>
                    </div>
                <form id="login-form" action="../scripts/login_authenticate.php" method="POST" novalidate>
                    <div id="username-error"></div>
                    <input type="email" id="email" name="email" placeholder="Your email or username" required>
                    <div id="password-error"></div>
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <button type="submit" class="login">Login</button>
                </form>
                <nav>
                    <a class="nav-link" href="register.php">Register Here</a>
                    <a class="nav-link" href="index.php">Homepage</a>
                </nav>
            </div>
        </main>
    </div>
    <script src="../scripts/login-validation.js"></script>
</body>
<!--Footer-->
<footer>
    <nav>
    </nav>
</footer>
</html>


