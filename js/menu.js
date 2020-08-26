function myFunction() {
    var x = document.getElementById("mainmenu");
    if (x.className === "menu") {
        x.className += " responsive";
    } else {
        x.className = "menu";
    }
}