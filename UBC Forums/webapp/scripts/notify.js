
$(document).ready(function() {
    var lastCheckTime = Math.floor(Date.now() / 1000);
    // var alertShown = false;
    // Function to check for new posts
    function checkForNewPosts() {
        $.ajax({
            url: 'notification.php',
            type: 'GET',
            data: {
                last_check_time: lastCheckTime
            },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                // Check if new posts are available
                if (jsonResponse && jsonResponse.new_posts !== undefined && jsonResponse.new_posts !== 0){
                    var element = document.getElementById("name");
                    if (element) {
                        element.style.color = "#ffffff";
                        element.style.background = "transparent";
                        element.style.border = "3pt solid red";
                        var visible = true;
                        var intervalId = setInterval(function() {
                            element.style.visibility = visible ? "hidden" : "visible";
                            visible = !visible;
                        }, 500); // Toggle visibility every 500 milliseconds (0.5 seconds)

                        
                        setTimeout(function() {
                            clearInterval(intervalId);
                            element.style.visibility = "visible";
                        }, 3000);// Stop blinking after 3 seconds (3000 milliseconds)
                    }
                }
                console.log("response");
                // alertShown = true;
            },
            error: function() {
                console.log('Error checking for new posts.');
            }
        });
    }
    setInterval(checkForNewPosts, 10000);
});