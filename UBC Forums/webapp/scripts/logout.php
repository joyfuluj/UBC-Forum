<?php 
    session_start();
    session_unset();
    session_destroy();
    echo "<script>let userId = undefined;</script>";

    header("Location: ../pages/index.php");