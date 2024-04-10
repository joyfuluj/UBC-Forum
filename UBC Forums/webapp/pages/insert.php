<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../scripts/connection.php');
    

    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr";
      }
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    if($_SESSION['user_id']){
        $userId = $_SESSION['user_id'];
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
            $communityId = $_POST["communities"];
            $postDesc = $_POST["postDesc"];
            if($_POST["title"]){
                $title = $_POST["title"];
            }else{
                $title = "Untitled";
            }
            if ($postDesc xor $targetFile) {
                // $sql = "SELECT communityId FROM community WHERE communityName = ?";
                // if ($statement = mysqli_prepare($conn, $sql)) {
                //     mysqli_stmt_bind_param($statement, 's', $communityName);
                //     echo $communityName."kore";
                //     mysqli_stmt_execute($statement);
                //     $communityId=0;
                //     if($result = mysqli_stmt_get_result($statement)){
                //         while ($row = mysqli_fetch_assoc($result)) {
                //             $communityId = $row['communityId'];
                //         }
                //     }
                    $sql = "INSERT INTO posts (communityId, userId, postTime, promos, postTitle) VALUES (?, ?, NOW(), 0, ?)";
                    if ($statement = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($statement, 'iss', $communityId, $userId, $title);
                        mysqli_stmt_execute($statement);
                        $postType="";
                        $fileName="";
                        $postID = mysqli_insert_id($conn);
                        if($postDesc){
                            $fileName = "$postID" . "-" . "$communityId.txt";
                            $postType="txt";
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
                            $parts = explode(".", $targetFile);
                            $extension = end($parts);
                            $postType= $extension;
                            $targetFile = $_FILES["image"]["name"];
                            //upload image file
                            $fileName = $postID . "-" . $communityId . "." .$extension;
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
                // }else{
                //     echo "Couldn't find the community.";
                // }
            }else if($postDesc&&$targetFile){
                $postDesc = $_POST["postDesc"];
                header("Location: post.php?both&postDesc=$postDesc");
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
    }else{
        echo "You are not logged in!";
    }
    
    
    ?>
    <a href="index.php">Go back to main page</a>