
var alertShown = false;
$(document).ready(function() {
    var lastCheckTime = Math.floor(Date.now() / 1000);
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
                if (jsonResponse && jsonResponse.new_posts !== undefined && jsonResponse.new_posts !== 0 && !alertShown){
                    var element = document.getElementById("name");
                    if (element) {
                        element.style.color = "#ffffff";
                        element.style.background = "transparent";
                        element.style.border = "3pt solid red";
                        var visible = true;
                        var intervalId = setInterval(function() {
                            element.style.visibility = visible ? "hidden" : "visible";
                            visible = !visible;
                        }, 500); // Toggle visibility every 0.5sec

                        
                        setTimeout(function() {
                            clearInterval(intervalId);
                            element.style.visibility = "visible";
                        }, 3000);// Stop blinking after 3 sec
                        alertShown = true;
                    }
                }
                console.log("response");
            },
            error: function() {
                console.log('Error checking for new posts.');
            }
        });
    }
    // do this again after 5sec again
    setInterval(checkForNewPosts, 5000); 
});