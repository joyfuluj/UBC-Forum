let menuOpen = false;
function toggleMenu() {
    if (menuOpen) {
        document.getElementById("menuBar").style.display = "none";
        menuOpen = false;
    } else {
        document.getElementById("menuBar").style.display = "flex";
        menuOpen = true;
    }
}
document.getElementById("menuBar").style.display = "none";
