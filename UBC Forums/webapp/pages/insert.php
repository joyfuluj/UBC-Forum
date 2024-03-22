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
        echo $communityName ."<br>". $postDesc ."";
        if ($communityName != "all" && $postDesc) {
            $sql = "SELECT communityID FROM community WHERE communityName=?";
            if ($statement = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($statement, 's', $communityName);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                if ($row = mysqli_fetch_assoc($result)) {
                    $communityID = $row['communityID'];
                    echo ''. $communityID .'<br>';
                    $postDesc = $_POST["postDesc"];
                    
                    $sql = "INSERT INTO posts (communityID, userId, postTime) VALUES ('$communityID', 1, NOW())";
                    if (mysqli_query($conn, $sql)) {
                        // set_error_handler("customError");
                        $postID = mysqli_insert_id($conn);
                        $fileName = "$communityID"."_"."$postID.txt";
                        $sql = "UPDATE posts SET postDesc='$fileName' WHERE postId = $postID";
                        if (mysqli_query($conn, $sql)) {
                            $filePath = "../posts/$fileName";
                            $newFile = fopen("$filePath", "w") or die("Unable to open file!");
                            fwrite($newFile, $postDesc);
                            fclose($newFile);
                            echo "CREATED!!!!";
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
    }
    ?>
    <a href="index.php">Go back to main page</a>