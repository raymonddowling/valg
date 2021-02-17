// siden utviklet av Raymond Dowling. sist endret 14 oktober 2020

var windowIncrease = window.matchMedia("(min-width: 768px)");
windowIncrease.addListener(adjustUp);
adjustUp(windowIncrease);

var windowdecrease = window.matchMedia("(max-width: 768px)");
windowdecrease.addListener(adjustDown);
adjustDown(windowdecrease);


function adjustUp(windowIncrease) {
    if (windowIncrease.matches) {
        showMenuitems();
        menuDark();
    }
}

function adjustDown(windowdecrease) {
    if (windowdecrease.matches) {
        hideMenuitems();
        menuDark();
    }
}

function toggleMenu() {
    if (document.getElementById("menuitems").style.display === "block") {
        hideMenuitems();
        menuDark();
    } else {
        showMenuitems();
        menuLight();
    }
}

function hideMenuitems() {
    document.getElementById("menuitems").style.display = "none";
}

function showMenuitems() {
    document.getElementById("menuitems").style.display = "block";
}

function menuLight() {
    document.getElementById("menu").style.backgroundColor = "rgba(89, 158, 175, 0.75)";
    // document.getElementById("menuitems").style.height = "100vh";

    document.getElementById("menuitems").style.width = "auto";
}

function menuDark() {
    document.getElementById("menu").style.backgroundColor = "rgba(89, 158, 175, 1)";
}