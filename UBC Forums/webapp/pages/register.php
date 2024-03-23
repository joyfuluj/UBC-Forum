<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBC Forums - Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/login-register.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<!--Body-->
<body>
    <!--Header-->
    <header>
        <script src="../scripts/header.js"></script>
    </header>
    <!--Login Container-->
    <div class="register-container">
        <main>
            <h1>Register for UBC Forums</h1>
            <div class="fields">
                <div id="error"></div>
                <form id="register-form" action="#" method="POST">
                    <input type="text" id="username" placeholder="Choose a username" required>
                    <input type="email" id="email" placeholder="Your email address" required>
                    <input type="password" id="password1" placeholder="Choose a password" required>
                    <input type="password" id="password2" placeholder="Reenter password" required>
                    <button type="submit" class="create-account">Create Account</button>
                </form>
                <nav>
                    <a class="sign-up-link" href="login.html">Go Back to Login</a>
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
