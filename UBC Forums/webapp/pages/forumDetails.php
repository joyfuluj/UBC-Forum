<?php
    include_once('../scripts/connection.php');
    session_start();
    $communityName = $_GET['communityName'];
    $commName = urlencode($communityName);
    $commId ="";
    $sql = "SELECT communityId FROM community WHERE communityName = ?";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 's', $commName);
        mysqli_stmt_execute($statement);
        if($result = mysqli_stmt_get_result($statement)){
            while ($row = mysqli_fetch_assoc($result)) {
                $commId = $row['communityId'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/postFrag.css">
    <link rel="stylesheet" type="text/css" href="../styles/commentFrag.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../styles/forumDetails.css">
</head>

<body>
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>/
        <li><a href="forums.php">Forums</a></li>/
        <li id=current><?php echo $commName?></li>
        </ul>
    </header>
    <div id="sort">
        <select id="sortSelection" name="sort" onchange="redirectToSamePage();">
                    <option value="" disabled selected>Sort by</option>
                    <option value="alphabet">A-Z</option>
                    <option value="newest">newest</option>
                    <option value="oldest">oldest</option>
        </select>
    </div>
    <script>
        function redirectToSamePage() {
            var selectedValue = document.getElementById("sortSelection").value;
            var communityName = "<?php echo $commName; ?>";
            window.location.href = "forumDetails.php?communityName=" + communityName + "&sort=" + selectedValue;
        }
    </script>
    <div id="mainWrapper">
        <div id="posts">
            <?php echo "<h1>Posts about ".$commName."</h1>"?>
    
        </div>
        <div id="right">
        <?php
            if($_SESSION['user_privilege'] == 2){
                echo "<h1>Members:</h1>";
                ini_set('display_errors', 1);
                include_once('../scripts/connection.php');
                $sql = "SELECT users.userId,username FROM users JOIN memberOf ON users.userId = memberOf.userId WHERE memberOf.communityId = ?";            
                if(isset($_GET['sort'])){
                    $sort = $_GET['sort'];
                    if($sort == 'alphabet'){
                        $sql = "SELECT users.userId,username FROM users JOIN memberOf ON users.userId = memberOf.userId WHERE memberOf.communityId = ? ORDER BY username ASC";            
                    }
                    elseif($sort == 'newest'){
                        $sql = "SELECT users.userId, username FROM users JOIN memberOf ON users.userId = memberOf.userId WHERE memberOf.communityId = ? ORDER BY users.userId DESC";
                    }
                    elseif($sort == 'oldest'){
                        $sql = "SELECT users.userId, username FROM users JOIN memberOf ON users.userId = memberOf.userId WHERE memberOf.communityId = ? ORDER BY users.userId ASC";
                    }
                }
                if ($statement = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($statement, 's', $commId);
                    mysqli_stmt_execute($statement);
                    if($result = mysqli_stmt_get_result($statement)){
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userName = $row['username'];
                            $userId = $row['userId'];
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);
                            echo "<div class=\"names\">";
                            echo "<table id=><tr>";
                            echo "<td rowspan=\"2\"id=\"nameColumn\"><p>User name: <strong>$userName</strong></p></td>";
                            echo "<td id=\"\"><a href=\"forumDetails.php?userId=$userId\" id=\"assign\">Assign</a></td></tr>";
                            echo "<tr col span\"2\"><td id=\"\"><a href=\"forumDetails.php?userId=$userId\" id=\"delete\">Delete</a></td>";
                            echo "</tr></table>";
                            echo "</div>"; 
                        }
                    }
                }
            }else{
                echo "<h1>Can't see</h1>";
            }
            
            ?>
        </div>
    </div>
            <script>
                let community = '<?php echo $commId; ?>';
            </script>
            <script src = "../scripts/promotePost.js"></script>
            <script src = "../scripts/getForumposts.js"></script>
            <script src="../scripts/notify.js"></script>
            </html>
            
            