document.getElementById("header").innerHTML = `
    <div>
        <a href="index.html">
            <img src="../images/logo.png" alt="UBC Forums" id="logo">
        </a>
        <form action="index.php" metho="GET" >
            <select id="communities" name="communities" style="width: 15%">
            <option value="all">All</option>
            <option value="travel">travel</option>
            <option value="sport">sport</option>
            <option value="game">game</option>
            <option value="school">school</option>
            </select><br>
            <input type='text' name="search" placeholder='Search'/>
            <input type="submit" value="Search" style="border: 1pt solid var(--Coral); width:30%;"/>
        </form>
        <a href="post.php">Post</a>
        <a href="">Dashboard</a>
        <a href="">Forums</a>
        <a id = 'user' href=""><img alt = 'Profile'src = ''></a>
        <a class = "hidden" href="login.html">Login</a>
    </div>
`;