<?php
    include('connection.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if username or email already exists
        $sql1 = "SELECT userId FROM users WHERE username = ? OR email = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ss", $username, $email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if($result1->num_rows > 0)
        {
            header("Location: ../pages/register.php?error=Username or email already exists. Please try again.");
        }
        else
        {
            $sql2 = "INSERT INTO users (userId, privilege, username, password, email, firstName, lastName, signUpDate) VALUES (NULL, '1', '{$username}', '{$hashed_password}', '{$email}', '{$fname}', '{$lname}', NOW());";
            $stmt2 = $conn->prepare($sql2);
            if($stmt2->execute())
            {
                header("Location: ../pages/login.php?msg=Your account has been successfully registered. Please login.");
            }
            else
            {
                header("Location: ../pages/register.php?error=Your account was unable to be registered. Please try again.");
            }
        }
        $conn->close();
    }
    else
    {
        echo "Wrong request method silly!";
    }