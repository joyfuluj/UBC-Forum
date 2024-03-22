<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr";
      }
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $communityName = $_POST["communities"];
        $postDesc = $_POST["postDesc"];

        if (isset($_FILES["image"]["error"]) && $_FILES["image"]["error"] == 0) {
            // Print the name of the uploaded file
            echo "<br>file name is: ".$_FILES["image"]["name"];
        } else {
            echo "Error uploading file. Please try again.";
        }


        // echo $communityName ."<br>". $postDesc ."";
        if ($postDesc || $targetFile) {
            $sql = "SELECT communityID FROM community WHERE communityName=?";
            if ($statement = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($statement, 's', $communityName);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                if ($row = mysqli_fetch_assoc($result)) {
                    $communityID = $row['communityID'];
                    $postDesc = $_POST["postDesc"];        
                    $sql = "INSERT INTO posts (communityID, userId, postTime) VALUES ('$communityID', 1, NOW())";
                    if (mysqli_query($conn, $sql)) {
                        $postID = mysqli_insert_id($conn);
                        $fileName = "$communityID" . "_" . "$postID.txt";
                        $sql = "UPDATE posts SET postDesc='$fileName' WHERE postId = $postID";
                        if (mysqli_query($conn, $sql)) {
                            $filePath = "../posts/$fileName";
                            $newFile = fopen("$filePath", "w");
                            if ($newFile) {
                                fwrite($newFile, $postDesc);
                                fclose($newFile);
                                echo "Posted";
                            } else {
                                echo "Error creating file!";
                            }
                            //upload image file
                            $targetFile = $_FILES["image"]["name"]; // Get the file name
                            $parts = explode(".", $targetFile);
                            $extension = end($parts);
                            $newFileName = $communityID . "_" . $postID . "." .$extension;
                            
                            echo "<br>Uploaded file name: ".$newFileName;
                            $destination = "../images/" . $newFileName;
                            
                            // if(move_uploaded_file($_FILES["image"]["tmp_name"], $destination)){
                            //     echo "The file was uploaded and moved successfully!";
                            // } else {
                            //     echo "There was a problem moving the file";
                            // }
                        } else {
                            echo "Error updating post description: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Error inserting post: " . mysqli_error($conn);
                    }
                }
            }
        }
        else{
            echo "Query not done.";
        }
    }
    ?>
    <a href="index.php">Go back to main page</a>