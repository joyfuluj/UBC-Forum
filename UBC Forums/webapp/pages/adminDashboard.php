<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/adminDashboard.css">
    <script src = '../scripts/admin.js'></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <form class="search-form" method="GET" action = '../pages/adminDashboard.php'>
                <select id="type" name="searchType" style="width: 15%">
                <option value="1">Users</option>
                <option value="2">Posts</option>
                </select>
                <input class="search-input" type="text" name="search" placeholder="Search...">
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>
        <div class="main-content">
            <?php
                include_once('../scripts/connection.php');

                if (isset($_GET['search']) && isset($_GET['searchType'])) {
                    $searchType = $_GET['Search Type'];
                    $searchTerm = $_GET['search'];
                    if ($searchType == 1) {
                        $sql = "SELECT * FROM users WHERE username LIKE ? OR firstName LIKE ? OR lastName LIKE ? OR email LIKE ?";
                        $prep = $conn->prepare($sql);
                        $searchTerm = "%".$searchTerm."%";
                        $prep -> bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
                        if ($prep->execute() === false) {
                            die("Failed: " . $prep->error);
                        }
                        $result = $prep->get_result();
                        $rows = array();
                        while($row = $result->fetch_assoc()) {
                            $rows[] = $row;
                        }
                        foreach($rows as $row){
                            echo 
                                "<div class='user'>
                                    <h3>{$row['username']}</h3>
                                    <p>{$row['firstName']} {$row['lastName']}</p>;
                                    <p>{$row['email']}</p>;
                                    <div class='user-actions'>
                                        <button class='delete-user' onclick='deleteUser({$row['userId']})'>Delete</button>
                                    </div>
                                </div>";
                        }
                    } 
                    else if ($searchType == 2) {
                        $sql = "SELECT * FROM posts WHERE postTitle LIKE ? OR postContent LIKE ?";
                        $prep = $conn->prepare($sql);
                        $searchTerm = "%".$searchTerm."%";
                        $prep -> bind_param("ss", $searchTerm, $searchTerm);
                        if ($prep->execute() === false) {
                            die("Failed: " . $prep->error);
                        }
                    }
                    else{
                        $sql = "SELECT * FROM users";
                        $prep = $conn->prepare($sql);
                        if ($prep->execute() === false) {
                            die("Failed: " . $prep->error);
                        }
                        $result = $prep->get_result();
                        $rows = array();
                        while($row = $result->fetch_assoc()) {
                            $rows[] = $row;
                        }
                        foreach($rows as $row){
                            echo 
                            "<div class='user'>
                                <h3>{$row['username']}</h3>
                                <p>{$row['firstName']} {$row['lastName']}</p>;
                                <p>{$row['email']}</p>;
                                <div class='user-actions'>
                                    <button class='delete-user' onclick='deleteUser({$row['userId']})'>Delete</button>
                                </div>
                            </div>";
                        }

                    }
                    
                }
            
            ?>
        </div>
    </div>
</body>
</html>