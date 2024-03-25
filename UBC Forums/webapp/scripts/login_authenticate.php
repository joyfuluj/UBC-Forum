<?php
    include('connection.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $username = $_POST['email'];
        $password = $_POST['password'];

        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT userId, privilege, username, password, email, firstName, lastName FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            echo "Submitted password: " . $password . "<br>";

            if(password_verify($password, $row['password']))
            {
                session_start();
                $_SESSION['user_id'] = $row['userId'];
                $_SESSION['user_privilege'] = $row['privilege'];
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_fname'] = $row['firstName'];
                $_SESSION['user_lname'] = $row['lastName'];
                header("Location: ../pages/index.php");
            }
            else
            {
                header("Location: ../pages/login.php?error=Your login details are incorrect. Please try again.");
            }
            
        }
        else
        {
            header("Location: ../pages/login.php?error=Your login details are incorrect. Please try again.");
        }

        $conn->close();
    }
    else
    {
        echo "Wrong request method silly!";
    }
