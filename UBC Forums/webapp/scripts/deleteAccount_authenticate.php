use function unlink;
<?php
    session_start();
    include('connection.php');
    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['password1']) && isset($_POST['password2']))
        {
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if($password1 === $password2)
            {
                $sql = "SELECT password FROM users WHERE userId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                    if(password_verify($password1, $row['password']))
                    {
                        // If the passwords are correct, delete the account.
                        $sql = "DELETE FROM users WHERE userId = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $user_id);
                        
                        if($stmt->execute())
                        {
                            // If account is deleted successfully, redirect to account page with success message and close connection
                            header("Location: logout.php");
                            $conn->close();
                        }
                        else
                        {
                            // Redirect to account page with error message and close connection
                            header("Location: ../pages/account.php?delError=Error deleting account. Please try again.");
                            $conn->close();
                        }
                    }
                    else
                    {
                        // Redirect to account page with error message and close connection
                        header("Location: ../pages/account.php?delError=Your password is incorrect. Please try again.");
                        $conn->close();
                    }
                }
                else
                {
                    // Redirect to account page with error message and close connection
                    header("Location: ../pages/account.php?delError=Error retrieving account details. Please try again.");
                    $conn->close();
                }                
            }
            else
            {
                // Redirect to account page with error message and close connection
                header("Location: ../pages/account.php?delError=Your passwords dont match. Please try again.");
                $conn->close();
            }

        }
        else
        {
            // Redirect to account page with error message and close connection
            header("Location: ../pages/account.php?delError=One or more fields were not set correctly. Please try again.");
            $conn->close();
        }
    }
    else
    {
        echo "Wrong request method silly!";
        $conn->close();
    }