use function unlink;
<?php
    session_start();
    include('connection.php');
    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_FILES['new_pic']) && isset($_POST['submit']))
        {
            // Stores the new profile picture's information (from its array) in variables.
            $pic_name = $_FILES['new_pic']['name'];
            $tmp_name = $_FILES['new_pic']['tmp_name'];
            $pic_size = $_FILES['new_pic']['size'];
            $error = $_FILES['new_pic']['error'];

            if($error === 0)
            {
                // Checks if the file is too large to be uploaded.
                if($pic_size > 125000)
                {
                    header("Location: ../pages/account.php?picError=Your file is too large. Please try again.");
                    $conn->close();
                }
                // File is an appropriate size
                else
                {
                    // Checks if the file is a valid image type by extracting its file extension.
                    $pic_ext = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ext_lc = strtolower($pic_ext);
                    $valid_exts = array("jpg", "jpeg", "png");
                    
                    if(in_array($pic_ext_lc, $valid_exts))
                    {
                        // Generates a unique name for the new profile picture and stores it on the server.
                        $new_pic_name = uniqid("img-", true) . "." . $pic_ext_lc;
                        $pic_path = "../images/" . $new_pic_name;
                        move_uploaded_file($tmp_name, $pic_path);
                            
                        // Stores the old profile picture's path in a variable to be deleted from the server later.
                        $sql1 = "SELECT profilePic FROM users WHERE userId = ?";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bind_param("s", $user_id); // assuming $user_id contains the ID of the current user
                        $stmt1->execute();
                        $result = $stmt1->get_result();
                        $row = $result->fetch_assoc();
                        $oldPicPath = "../images/" . $row['profilePic'];

                        // Insert new profile pic into database
                        $sql2 = "UPDATE users SET profilePic = ? WHERE userId = ?";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param("si", $new_pic_name, $user_id);
                        if($stmt2->execute())
                        {
                            // Deletes the old profile pic from the server as long as it is not the default picture.
                            if (file_exists($oldPicPath) && $oldPicPath != '../images/default_account.jpg') 
                            {
                                unlink($oldPicPath);
                            }

                            header("Location: ../pages/account.php?msg=Your profile picture has been successfully updated." . $oldPicPath . "");
                            $conn->close();
                        }
                        else
                        {
                            header("Location: ../pages/account.php?picError=Your profile picture was unable to be updated. Please try again.");
                            $conn->close();
                        }
                    }
                    else
                    {
                        header("Location: ../pages/account.php?picError=You cannot upload files of this type. Please try again.");
                        $conn->close();
                    }
                }
            }
            else
            {
                header("Location: ../pages/account.php?picError=There was an error uploading your file. Please try again.");
                $conn->close();
            }
        }
        else
        {
            header("Location: ../pages/account.php?picError=You must select a file to upload. Please try again.");
            $conn->close();
        }
    }
    else
    {
        echo "Wrong request method silly!";
        $conn->close();
    }