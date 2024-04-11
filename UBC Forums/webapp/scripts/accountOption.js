let optionOpen = false;
function toggleOptions() {
    if (optionOpen) {
        document.getElementById("user_info").style.display = "none";
        optionOpen = false;
    } else {
        document.getElementById("user_info").style.display = "flex";
        optionOpen = true;
    }
}