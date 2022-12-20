let popUp = document.getElementById("popUp");
let bg = document.getElementById("bg");

function openPopUp(){
    popUp.classList.add("open-popUp");
    bg.classList.add("open-bg");
}

function closePopUp(){
    popUp.classList.remove("open-popUp");
    bg.classList.remove("open-bg");
}

