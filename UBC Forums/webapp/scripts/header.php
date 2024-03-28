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
        <a href="../pages/index.php">UBC Forums</a>
        <form id = 'searchBarForm'action="../pages/index.php" method="GET" >
            <select id="community" name="community" style="width: 15%">
            <option value="">All</option>
            <option value="1">Travel</option>
            <option value="2">Sports</option>
            <option value="3">Games</option>
            <option value="4">School</option>
            </select><br>
            <input type='text' id="search_input" name="search" placeholder='Search' />
            <input type="submit" id="search_button" value="Search" style="border: 2pt solid var(--Coral); width:15%;"/>
        </form>
            
        <a href="../pages/index.php">Forums</a>
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
</html>