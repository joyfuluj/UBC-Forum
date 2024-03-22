<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    
</head>
    
<body>
    <!--Header import-->
    <header id ="header">
        <script src="../scripts/header.js"></script>
    </header>
    <!--Body-->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    $community = $_GET['communities'];
    $input = $_GET['search'];
    $nameFlag = false;

    ?>
    <div>
        <section id = "sideMenu">
    
        </section>
        <section id = "posts">
        
    <?php
   
    if(!empty($community) && $community!="all"){
        $sql = "SELECT communityId FROM community WHERE communityName='$community'";
        $result = mysqli_query($conn, $sql);
        $comId =0;
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $comId = $row['communityId'];
        }
        $sql = "SELECT postTime, postDesc, userId FROM posts WHERE communityId = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $comId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fileName = "../posts/".$row['postDesc'];
                $file = fopen($fileName, "r") or die("Unable to open file!");
                $content = 0;
                $postTime = $row["postTime"];
                $userId = $row["userId"];
                //get Username
                $sql = "SELECT username FROM users WHERE userId = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);
                $resultName = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultName) > 0) {
                    $userRow = mysqli_fetch_assoc($resultName);
                    $user = $userRow["username"];
                }
                echo "<span style=\"height: 25px;
                width: 25px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;\"></span>";
                echo "<pmargin-left: 20px;><strong>".$user;
                while (!feof($file)) {
                    echo "<br>";
                    $ln = fgets($file);
                    if ($input != null && !empty($input)) {
                        if (strpos($ln, $input) !== false) {
                            echo "<p style=\"margin-left: 20px;\"><strong>".$postTime."<br>".$ln."</strong></p>";
                            echo "<hr style=\"border: 0.5pt solid;width: 95%;margin-left: 20px\">";                        }
                    } else {
                        echo "<p><strong>".$postTime."<br>".$ln."</strong></p>";
                        echo "<hr style=\"border: 0.5pt solid;width: 95%;margin-left: 20px\">";                    }
                }
            }
        }      
    }
    else{ 
        $sql = "SELECT postTime, postDesc, userId FROM posts";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fileName = "../posts/".$row['postDesc'];
                // echo $fileName;
                $file = fopen($fileName, "r") or die("Unable to open file!");
                $content = 0;
                $postTime = $row["postTime"];

                $userId = $row["userId"];
                // get Username
                $sql = "SELECT username FROM users WHERE userId = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);
                $resultName = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultName) > 0) {
                    $userRow = mysqli_fetch_assoc($resultName);
                    $user = $userRow["username"];
                }
                echo "<span style=\"height: 50px;
                width: 50px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                margin: 10px\"></span>";
                echo "<pmargin-left: 20px;><strong>".$user;
                while (!feof($file)) {
                    echo "<br>";
                    $ln = fgets($file);
                    if ($input != null && !empty($input)) {
                        if (strpos($ln, $input) !== false) {
                            echo "<p><strong>"."<br>".$ln."</strong></p>";
                            echo "<hr style=\"border: 0.5pt solid;width: 95%;margin-left: 20px\">";                        }
                    } else {
                        echo "<p style=\"margin-left: 20px;\"><strong>".$postTime."<br>".$ln."</strong></p>";
                        echo "<hr style=\"border: 0.5pt solid;width: 95%;margin-left: 20px\">"; 
                    }
                }
            }
        }      
    }
            
    ?></section>
        
    </div>
    
    <!--Footer-->
    <footer>
        <nav>
        </nav>
    </footer>
</body>
<script src="../scripts/header.js"></script>
</html>

