use function unlink;
<?php
    session_start();
    include('connection.php');
    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['old_password']) && isset($_POST['new_password1']) && isset($_POST['new_password2']))
        {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password1'];

            $sql = "SELECT password FROM users WHERE userId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                if(password_verify($old_password, $row['password']))
                {
                    // If the old password is correct, update the password
                    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password = ? WHERE userId = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $hashed_new_password, $user_id);
                    
                    if($stmt->execute())
                    {
                        // If password updates successfully, redirect to account page with success message and close connection
                        header("Location: ../pages/account.php?passMsg=Password updated successfully!");
                        $conn->close();
                    }
                    else
                    {
                        // Redirect to account page with error message and close connection
                        header("Location: ../pages/account.php?passError=Error updating password. Please try again.");
                        $conn->close();
                    }
                }
                else
                {
                    // Redirect to account page with error message and close connection
                    header("Location: ../pages/account.php?passError=Your old password is incorrect. Please try again.");
                    $conn->close();
                }
            }
            else
            {
                // Redirect to account page with error message and close connection
                header("Location: ../pages/account.php?passError=Error retrieving account details. Please try again.");
                $conn->close();
            }
        }
        else
        {
            // Redirect to account page with error message and close connection
            header("Location: ../pages/account.php?passError=One or more fields were not set correctly. Please try again.");
            $conn->close();
        }
    }
    else
    {
        echo "Wrong request method silly!";
        $conn->close();
    }