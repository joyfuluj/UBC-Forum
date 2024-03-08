<html>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new mysqli("localhost", "root", "", "ubcforums");
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
        }else{
            echo "Invalid email or password!";
        }
        $conn->close();
    }else{
        echo "Wrong request method silly!";
    }
?>
</html>
