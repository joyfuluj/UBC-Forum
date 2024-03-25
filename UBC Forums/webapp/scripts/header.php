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
        <a href="index.php">
            <img src="../images/logo.png" alt="UBC Forums" id="logo">
        </a>
        <form action="../pages/index.php" method="GET" >
            <select id="communities" name="communities" style="width: 15%">
            <option value="all">All</option>
            <option value="travel">Travel</option>
            <option value="sport">Sport</option>
            <option value="game">Game</option>
            <option value="school">School</option>
            </select><br>
            <input type='text' name="search" placeholder='Search'/>
            <input type="submit" value="Search" style="border: 1pt solid var(--Coral); width:30%;"/>
        </form>
            <a href="../pages/post.php">Post</a>
            <a href="../pages/index.php">Dashboard</a>
            <a href="../pages/index.php">Forums</a>
        <?php
            if (!isset($user_privilege) || $user_privilege == 0) 
            {
                echo '<a href="../pages/login.php">Login</a>';
                echo '<a href="../pages/register.php">Register</a>';
            } 
            else if ($user_privilege == 1) 
            {
                echo '<a href="../pages/account.php">' . $user_fname . ' ' . $user_lname . '</a>';
                echo '<a href="../scripts/logout.php">Logout</a>';
            } 
            else if ($user_privilege == 2) 
            {
                echo '<a href="../pages/account.php">' . $user_fname . ' ' . $user_lname . ' (Admin)</a>';
                echo '<a href="../scripts/logout.php">Logout</a>';
            }
        ?>
    </div>
</html>