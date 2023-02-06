function changeSize(sizeChoice) {
    if (sizeChoice == "small") {
        document.getElementById("textarea").style.size = "small";
    }
    else {
        if (sizeChoice == "medium") {
            document.getElementById("textarea").style.fontSize = "medium";
        }
        else {
            document.getElementById("textarea").style.fontSize = "large";
        }
    }
}

function changeFont(fontChoice, fontName) {
    if (fontChoice == "") {
        document.getElementById("textarea").style.font = "Ariel";
    }
    else {
        document.getElementById("textarea").style.font = fontName;
    }
}