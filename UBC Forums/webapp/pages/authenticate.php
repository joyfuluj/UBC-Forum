<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $username = $_POST['email'];
        $password = $_POST['password'];

        $conn = new mysqli("localhost", "root", "", "ubcforums");

        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE (username = ? OR email = ?) AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['user'] = $row['username'];
            header("Location: account.php");
        }
        else
        {
            echo 
                "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>UBC Forums - Invalid Login</title>
                    <link rel='stylesheet' type='text/css' href='../styles/reset.css'>
                    <link rel='stylesheet' type='text/css' href='../styles/login-register.css'>
                </head>
                <body>
                    <header id='header'>
                    </header>
                    <div class='login-container'>
                        <main>
                            <h1>Invalid Login</h1>
                            <div class='fields'>
                                <div id='error'>Your login details are incorrect. Please try again.</div>
                                <form id='login-form' action='authenticate.php' method='POST' novalidate>
                                    <div id='username-error'></div>
                                    <input type='email' id='email' name='email' placeholder='Your email or username' required>
                                    <div id='password-error'></div>
                                    <input type='password' id='password' name='password' placeholder='Your password' required>
                                    <button type='submit' class='login'>Login</button>
                                </form>
                                <nav>
                                    <a class='nav-link' href='register.php'>Register Here</a>
                                    <a class='nav-link' href='index.php'>Homepage</a>
                                </nav>
                            </div>
                        </main>
                    </div>
                    <script src='../scripts/login-validation.js'></script>
                </body>
                <footer>
                    <nav>
                    </nav>
                </footer>
                </html>";
        }

        $conn->close();
    }
    else
    {
        echo "Wrong request method silly!";
    }
