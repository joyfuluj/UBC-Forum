<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBC Forums - Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
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
                <form id="register-form" action="#" method="POST" novalidate>
                    <div id="username-error"></div>
                    <input type="text" id="username" placeholder="Choose a username" required>
                    <div id="email-error"></div>
                    <input type="email" id="email" placeholder="Your email address" required>
                    <div id="password-error"></div>
                    <input type="password" id="password1" placeholder="Choose a password" required>
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
