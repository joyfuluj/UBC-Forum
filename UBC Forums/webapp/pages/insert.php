<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // $servername = $host;
    // $username = $user;
    // $password = $pass;
    // $dbname = $db;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_81265373";

    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr";
      }
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $targetFile = $_FILES["image"]["name"];
    if (isset($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {
        echo "<br>file name is: ".$_FILES["image"]["name"];
        // limity the type of the file
        $validExt = array("jpg", "png");
        $validMime = array("image/jpeg", "image/png") ;
        foreach($_FILES as $fileKey => $fileArray ){
            $parts = explode(".", $fileArray["name"]);
            $extension = end($parts);
            if (in_array($fileArray["type"],$validMime) &&
                in_array($extension, $validExt)) {
                echo "all is well. Extension and mime types valid";
            }
            else {
                echo $fileKey." Has an invalid mime type or extension";
                header("Location: post.php?invalid");
                exit();
            }
        }
    } 
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['communities'])) {
        $communityName = $_POST["communities"];
        $postDesc = $_POST["postDesc"];
        if ($postDesc || $targetFile) {
            $sql = "SELECT communityId FROM community WHERE communityName = ?";
            if ($statement = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($statement, 's', $communityName);
                mysqli_stmt_execute($statement);
                $communityId=0;
                if($result = mysqli_stmt_get_result($statement)){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $communityId = $row['communityId'];
                    }
                }
                $sql = "INSERT INTO posts (communityId, userId, postTime) VALUES (?, 1, NOW())";
                if ($statement = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($statement, 'i', $communityId);
                    mysqli_stmt_execute($statement);
                    $postType="";
                    $fileName="";
                    $postID = mysqli_insert_id($conn);
                    if($postDesc){
                        $fileName = "$communityId" . "-" . "$postID.txt";
                        $postType="text";
                        $filePath = "../posts/$fileName";
                        //Upload Text post
                        $newFile = fopen("$filePath", "w");
                        if ($newFile) {
                            fwrite($newFile, $postDesc);
                            fclose($newFile);
                            // echo "Post created!";
                        } else {
                            echo "Error creating file!";
                        }
                        $fileName = "$communityId" . "-" . "$postID.txt";
                    } 
                    else{
                        $postType= "image";
                        $targetFile = $_FILES["image"]["name"];
                        //upload image file
                        $parts = explode(".", $targetFile);
                        $extension = end($parts);
                        $fileName = $communityId . "-" . $postID . "." .$extension;
                        $tempFile = $_FILES["image"]["tmp_name"];
                        $destination = "../posts/" . $fileName;
                        if(copy($_FILES["image"]["tmp_name"], $destination)){
                            // echo "The image was uploaded and moved successfully!";
                        } else {
                            echo "There was a problem uploading the file";
                        }
                    }
                    $sql = "UPDATE posts SET postType=? WHERE postId=?";
                    if ($statement = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($statement, "si", $postType, $postID);
                        mysqli_stmt_execute($statement);
                        // echo "Successfully Posted!";
                    }else {
                        echo "Error inserting post: " . mysqli_error($conn);
                    }
                    header("Location: post.php?posted");
                    exit();
                }else{
                    echo "Error with storing first info.";
                }
            }else{
                echo "Couldn't find the community.";
            }
        }else if($postDesc&&$targetFile){
            header("Location: post.php?both");
            exit();
        }
        else{
            header("Location: post.php?nopost");
            exit();
        }
    }else{
        $postDesc = $_POST["postDesc"];
        header("Location: post.php?nocomm&postDesc=$postDesc");
        exit();
    }
    ?>
    <a href="index.php">Go back to main page</a>