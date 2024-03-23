<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UBC Forums - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/post.css">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <!--Header import-->
    <header id="header">
        <script src="../scripts/header.js"></script>
    </header>

    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div id="post">
            <!-- <input type="text" id="title" name="title"> -->
            <input type="text" id="textPost" name="postDesc">
            <select id="community" name="communities" style="top: 25px; left: 10px">
                <option value="all">Choose a Community</option>
                <option value="travel">travel</option>
                <option value="sports">sports</option>
                <option value="game">game</option>
                <option value="school">school</option>
            </select>
            
        </div>
        <input type="file" name="image" id="uploadImg" style="top: 600px; left: 450px; width:250px" >
        <?php if (isset($_GET['invalid'])) echo "<p style=\"position: absolute; top: 600px;left: 740px;font-size: 15px;color: red;\">Only images are valid.</p>"; ?>
        <input type="submit" value="post" id="postbutton" style="top: 590px;right: 450px;padding:20px;">
    </form>
</body>
</html>
