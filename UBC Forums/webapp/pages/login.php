
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
    <header id="header">
    </header>
    <!--Login Container-->
    <div class="login-container">
        <main>
            <h1>Login to UBC Forums</h1>
            <div class="fields">
                <div id="error"></div>
                <form id="login-form" action="authenticate.php" method="POST">
                    <input type="email" id="email" name="email" placeholder="Your email or username" required>
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <button type="submit" class="login">Login</button>
                </form>
                <nav>
                    <a class="sign-up-link" href="register.html">Or Register Here</a>
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
