<?php
include_once('../scripts/connection.php');

if (isset($_POST['userIdNum'], $_POST['communityId'])) {
    $userId = $_POST['userIdNum'];
    $commId = $_POST['communityId'];

    $sql = "SELECT type FROM memberOf WHERE userId = ? AND communityId = ?";
    if ($statement = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($statement, 'ii', $userId, $commId);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $type = $row['type'];
            if ($type == 'admin') {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    } else {
        echo "Error: SQL preparation error";
    }
} else {
    echo "Error: userIdNum or communityId parameter is not set";
}
?>
