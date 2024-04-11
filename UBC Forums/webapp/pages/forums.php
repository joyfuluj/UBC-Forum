<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $userId = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums</title>
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/forums.css">
    <link rel="stylesheet" type="text/css" href="../styles/breadcrumb.css">
</head>
<body>
    <!--Header import-->
    <header id="header">
        <?php include_once('../scripts/header.php'); ?>
        <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>/
        <li id=current>Forums</li>
        </ul>
    </header>
    <div id="sort">
        <select id="sortSelection" name="sort" onchange="redirectToSamePage();">
                    <option value="" disabled selected>Sort by</option>
                    <option value="popular">popular</option>
                    <option value="newest">newest</option>
                    <option value="oldest">oldest</option>
                    <option value="alphabet">A-Z</option>
        </select>
    </div>
    <script>
        function redirectToSamePage() {
            var selectedValue = document.getElementById("sortSelection").value;
            window.location.href = "forums.php?sort=" + selectedValue;
        }
    </script>
    <form action="createForums.php" method="post">
        <button type="button" class="create">Create + </button>
        <div id="createForumWrapper">
            <input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
            Forum Name:<input type="text" id="createName" name="forumName"><br>
            Description:<input type="text" id="createForum" name="forumDescription">
            <input type="submit" id="submit" value="Submit">
        </div>
    </form>
    <script>
            var call = document.getElementsByClassName("create");
            var i;

            for (i = 0; i < call.length; i++) {
                call[i].addEventListener("click", function() {
                    var content = this.nextElementSibling;
                    if (content.style.display === "block") {
                    content.style.display = "none";
                    } else {
                    content.style.display = "block";
                    }
                });
            }
        </script>
    <div id="mainWrapper">
        <div id="main">
            <?php
            ini_set('display_errors', 1);
            include_once('../scripts/connection.php');
            $sql = "SELECT communityId,communityName, communityDesc, dateCreated FROM community";
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
            
                if($sort == 'popular'){
                    $sql = "SELECT c.communityId, c.communityName, c.communityDesc, c.dateCreated, COUNT(m.userId) AS userCount
                    FROM community c
                    LEFT JOIN memberOf m ON c.communityId = m.communityId
                    GROUP BY c.communityId, c.communityName, c.communityDesc, c.dateCreated
                    ORDER BY userCount DESC;";
                }
                elseif($sort == 'newest'){
                    $sql = "SELECT communityId,communityName, communityDesc, dateCreated FROM community ORDER BY dateCreated DESC";
                }
                elseif($sort == 'oldest'){
                    $sql = "SELECT communityId,communityName, communityDesc, dateCreated FROM community ORDER BY dateCreated ASC";
                }
                elseif($sort == 'alphabet'){
                    $sql = "SELECT communityId,communityName, communityDesc, dateCreated FROM community ORDER BY communityName ASC";
                }
            }
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $communityId = $row['communityId'];
                $sql_2 = "SELECT COUNT(userId) FROM memberOf WHERE communityId = ?";
                if ($statement = mysqli_prepare($conn, $sql_2)) {
                    mysqli_stmt_bind_param($statement, 's', $communityId);
                    mysqli_stmt_execute($statement);
                    if($result_2 = mysqli_stmt_get_result($statement)){
                        while ($row_2 = mysqli_fetch_assoc($result_2)) {
                            $count = $row_2['COUNT(userId)'];
                        }
                    }
                }
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $communityName = $row['communityName'];
                $communityDesc = $row['communityDesc'];
                $dateCreated = $row['dateCreated'];
                echo "<div class=\"community\">";
                echo "<table><tr>";
                echo "<td id=\"nameColumn\"><a href=\"forumDetails.php?communityName=$communityName\" id=\"comName\">$communityName</a></td>";
                echo "<td id=\"dateColumn\"><p id=\"comDate\">Date created:<br>$dateCreated</p></td>";
                echo "</tr></table>";
                echo "</div>";                
                if (isset($_GET['joined'])){
                    if($communityId == $_GET['communityId'])
                        echo "<p id='joined'>Successfully joined the forum!</p>";
                }
                if (isset($_GET['withdrawed'])){
                    if($communityId == $_GET['communityId'])
                        echo "<p id='withdrawed'>Successfully withdrawed from the forum.</p>";
                } 
                echo "<p id=\"member\">$count members</p>";
                echo "<form action=\"joinForum.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"communityId\" id=\"communityId\" value=\"$communityId\">";
                echo "<input type=\"hidden\" name=\"userId\" id=\"userId\" value=\"$userId\">";
                echo "<button type=\"button\" class=\"showMore\">Show more</button>";
                echo "<div class=\"buttons\">";
                echo "<p id=\"description\">$communityDesc</p>";
                $sql_3 = "SELECT * FROM memberOf WHERE userId = ? and communityId = ?";
                if ($statement = mysqli_prepare($conn, $sql_3)) {
                    mysqli_stmt_bind_param($statement, 'ii', $userId, $communityId);
                    mysqli_stmt_execute($statement);
                    if($result_3 = mysqli_stmt_get_result($statement)){
                        $num_rows = mysqli_num_rows($result_3);
                        if ($num_rows > 0){
                            echo "<input type=\"submit\" id=\"withdraw\" name=\"action\" value=\"Withdraw\">";
                        }else{
                            echo "<input type=\"submit\" id=\"join\" name=\"action\" value=\"Join\">";
                        }
                    }
                }
                echo "<a href=\"forumDetails.php\" id=\"seePosts\">View Forum</a>";
                echo "</div>";
                echo "</form>";
                echo "<hr>";
            }
            ?>
        </div>
        <script>
            var call = document.getElementsByClassName("showMore");
            var i;
            for (i = 0; i < call.length; i++) {
                call[i].addEventListener("click", function() {
                    var content = this.nextElementSibling;
                    if (content.style.display === "block") {
                    content.style.display = "none";
                    this.innerHTML = "Show more";
                    } else {
                    content.style.display = "block";
                    this.innerHTML = "Show less";
                    }
                });
            }
        </script>
    </div>
</body>
</html>