<!DOCTYPE html>
<html>
    <script src="../scripts/admin.js"></script>
    <?php
        include_once('../scripts/connection.php');

        if (isset($_GET['search']) && isset($_GET['searchType']))
        {
            $searchType = $_GET['searchType'];
            $searchTerm = $_GET['search'];

            if ($searchType == 1) 
            {
                $sql = "SELECT * FROM users WHERE username LIKE ? OR firstName LIKE ? OR lastName LIKE ? OR email LIKE ?";
                $prep = $conn->prepare($sql);
                $searchTerm = "%" . $searchTerm . "%";
                $prep->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);

                if ($prep->execute() === false) 
                {
                    die("Failed: " . $prep->error);
                }

                $result = $prep->get_result();
                $rows = array();
                echo "<h3 style='margin-top: 0; margin-bottom: 1em; color: var(--Cream);'>{$result->num_rows} USERS FOUND</h3><br>";

                while ($row = $result->fetch_assoc()) 
                {
                    $rows[] = $row;
                }
                foreach ($rows as $row) 
                {
                    //TODO: Add delete user functionality
                    echo
                    "<div class='admin-user'>
                        <h4 style='margin: 0; text-decoration: underline;'>User: {$row['username']}</h4><br>
                        <h4 style='margin: 0;'>Name: {$row['firstName']} {$row['lastName']}</h4><br>
                        <h4 style='margin: 0;'>Email: {$row['email']}</h4><br>
                        <button class='delete-user' onclick='deleteUser({$row['userId']})'>Delete</button>
                    </div>";
                }
            } 
            else if ($searchType == 2) 
            {
                if ($searchTerm == "") 
                {
                    $sql = "SELECT * FROM posts";
                    $prep = $conn->prepare($sql);
                } 
                else 
                {
                    $sql = "SELECT * FROM posts WHERE postTitle LIKE ?";
                    $prep = $conn->prepare($sql);
                    $searchTerm = "%" . $searchTerm . "%";
                    $prep->bind_param("s", $searchTerm);
                }

                if ($prep->execute() === false) 
                {
                    die("Failed: " . $prep->error);
                }
                $result = $prep->get_result();
                $rows = array();
                echo "<h3 style='margin-top: 0; margin-bottom: 1em; color: var(--Cream);'>{$result->num_rows} POSTS FOUND</h3><br>";

                while ($row = $result->fetch_assoc()) 
                {
                    $rows[] = $row;
                }
                foreach ($rows as $row) 
                {
                    //TODO: Add delete post functionality
                    echo
                    "<div class='admin-post'>
                        <br><h4 style='margin: 0; text-decoration: underline;'>{$row['postTitle']}</h4><br>
                        <h4 style='margin: 0;'>{$row['postTime']}</h4><br>
                        <button class='delete-post' onclick='deletePost({$row['postId']}, {$row['communityId']})'>Delete</button>
                    </div>";
                }
            } 
            else 
            {
                $sql = "SELECT * FROM users";
                $prep = $conn->prepare($sql);
                if ($prep->execute() === false) 
                {
                    die("Failed: " . $prep->error);
                }
                $result = $prep->get_result();
                $rows = array();
                while ($row = $result->fetch_assoc()) 
                {
                    $rows[] = $row;
                }
                foreach ($rows as $row) 
                {
                    echo
                    "<div class='admin-user'>
                        <br><h4 style='margin: 0; text-decoration: underline;'>User: {$row['username']}</h4><br>
                        <h4 style='margin: 0;'>Name: {$row['firstName']} {$row['lastName']}</h4><br>
                        <h4 style='margin: 0;'>Email: {$row['email']}</h4><br>
                        <button class='delete-user' onclick='deleteUser({$row['userId']})'>Delete</button>
                    </div>";
                }
            }
        }
    ?>
</html>

