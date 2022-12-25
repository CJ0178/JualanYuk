buttonCheckout = document.getElementsByClassName('tombolCekot')[0]

buttonCheckout.addEventListener('click', function(){
    parameter = document.getElementsByClassName('hidden')[0].innerHTML
    document.location.href = '../checkoutProcess.php?list='+parameter
})

// Untuk pop up
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
