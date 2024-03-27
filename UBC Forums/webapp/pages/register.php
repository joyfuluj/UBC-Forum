<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBC Forums - Register</title>
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
    <div class="register-container">
        <main>
            <h1>Register for UBC Forums</h1>
            <div class="fields">
                <div id="error" style="color: red; font-size: 12pt; text-align: center; margin-bottom: 1em;">
                    <?php 
                        if(isset($_GET['error'])) 
                        {
                            echo $_GET['error'];
                            unset($_GET['error']);
                        }
                    ?>
                </div>
                <form id="register-form" action="../scripts/register_authenticate.php" method="POST" novalidate>
                    <div id="fname-error"></div>
                    <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
                    <div id="lname-error"></div>
                    <input type="text" id="lname" name="lname" placeholder="Enter your last name" required>
                    <div id="username-error"></div>
                    <input type="text" id="username" name="username" placeholder="Choose a username" required>
                    <div id="email-error"></div>
                    <input type="email" id="email" name="email" placeholder="Your email address" required>
                    <div id="password-error"></div>
                    <input type="password" id="password1" name="password" placeholder="Choose a password" required>
                    <input type="password" id="password2" placeholder="Reenter password" required>
                    <button type="submit" class="create-account">Create Account</button>
                </form>
                <nav>
                    <a class="nav-link" href="login.php">Login Here</a>
                    <a class="nav-link" href="index.php">Homepage</a>
                </nav>
            </div>
        </main>
    </div>
    <script src="../scripts/register-validation.js"></script>
</body>
<!--Footer-->
<footer>
    <nav>
    </nav>
</footer>
</html>
