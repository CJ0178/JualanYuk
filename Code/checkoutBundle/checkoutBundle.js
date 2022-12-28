buttonCheckout = document.getElementsByClassName('tombolCekot')[0]

buttonCheckout.addEventListener('click', function(){
    parameter = document.getElementsByClassName('hidden')[0].innerHTML
    document.location.href = '../checkoutProcess.php?list='+parameter
})

// Untuk pop up bayar berhasil
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

// Untuk pop up: Jeff
buttonPilih = document.getElementById('buttonPilih')
divPopUp = document.getElementsByClassName('popUpBayar')[0]
svgPanah = document.getElementsByClassName('svgPanah')

buttonPilih.addEventListener('click', function(){
    divPopUp.classList.remove('displayNone')
})

listNama = ['DANA', 'OVO', 'GOPAY', 'SHOPEE PAY', 'LINK AJA', 'JENIUS', 'SAKUKU', 'VIRTUAL ACCOUNT']

for(let i = 0; i < svgPanah.length; i++){
    svgPanah[i].addEventListener('click', function(){
        buttonPilih.innerHTML = listNama[i]
        divPopUp.classList.add('displayNone')
    })
}

