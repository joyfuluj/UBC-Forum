<?php 
    if(isset($_SESSION['user_privilege']))
    {
        $user_privilege = $_SESSION['user_privilege'];
    }
    if(isset($_SESSION['user_fname']))
    {
        $user_fname = $_SESSION['user_fname']; 
    }
    if(isset($_SESSION['user_lname']))
    {
        $user_lname = $_SESSION['user_lname'];
    }
?>

<!DOCTYPE html>
<html>
    <div>
        <a href="../pages/index.php" id="name">Home</a>
        <form id = 'searchBarForm'action="../pages/index.php" method="GET" >
            <select id="community" name="community" style="width: 60px">
            <!-- Fetch all communities from database-->
            <option value="">All</option>
            <?php
                include_once('connection.php');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                  
                $sql = "SELECT * FROM community";
                $prep = $conn->prepare($sql);
                if ($prep->execute() === false) {
                    die("Failed: " . $prep->error);
                }
                $result = $prep->get_result();
                foreach($result as $row)
                {
                    echo '<option value="'.$row['communityId'].'">'.$row['communityName'].'</option>';
                }

            ?>
            </select><br>
            
            <input type='text' id="search_input" name="search" placeholder='Search' />

            <select id="filter" name="filter" style="width: 90px">
            <!-- Fetch all communities from database-->
            <option value="">Newest</option>
            <option value="1">Oldest</option>
            <option value="2">Promoted</option>
            <option value="3">Unpopular</option>

            </select><br>
            <input type="submit" id="search_button" value=">" style="border: 2pt solid var(--Coral); width:15%;"/>
        </form>
        <button id="menu" class="mobile" onclick="toggleMenu()">🔻</button>
        <a href="../pages/forums.php" class="noMob">Forums</a>
        <?php
            if (!isset($user_privilege) || $user_privilege == 0) 
            {
                echo '<a href="../pages/login.php" class="noMob">Login</a>';
                echo '<a href="../pages/register.php" class="noMob">Register</a>';
            } 
            else if ($user_privilege == 1) 
            {
                echo '<a href="../pages/post.php" class="noMob">Post</a>';
                echo '<a href="../pages/account.php" class="noMob">' . $user_fname . ' ' . $user_lname . '</a>';
                echo '<a href="../scripts/logout.php" class="noMob">Logout</a>';
            } 
            else if ($user_privilege == 2) 
            {
                echo '<a href="../pages/post.php" class="noMob">Post</a>';

                echo '<a href="../pages/account.php" class="noMob">' . $user_fname . ' ' . $user_lname . ' (Admin)</a>';
                echo '<a href="../scripts/logout.php" class="noMob">Logout</a>';
            }
        ?>
    </div>
    <div id = 'menuBar'>
        <a href="../pages/forums.php">Forums</a>
        <?php
            if (!isset($user_privilege) || $user_privilege == 0) 
            {
                echo '<a href="../pages/login.php">Login</a>';
                echo '<a href="../pages/register.php">Register</a>';
            } 
            else if ($user_privilege == 1) 
            {
                echo '<a href="../pages/post.php">Post</a>';
                echo '<a href="../pages/account.php">' . $user_fname . ' ' . $user_lname . '</a>';
                echo '<a href="../scripts/logout.php">Logout</a>';
            } 
            else if ($user_privilege == 2) 
            {
                echo '<a href="../pages/post.php">Post</a>';
                echo '<a href="../pages/account.php">' . $user_fname . ' ' . $user_lname . ' (Admin)</a>';
                echo '<a href="../scripts/logout.php">Logout</a>';
            }
        ?>
    </div>
    <script src="../scripts/header.js"></script>
</html>