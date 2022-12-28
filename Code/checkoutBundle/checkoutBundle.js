buttonCheckout = document.getElementsByClassName('tombolCekot')[0]
bundle = document.getElementsByClassName('bundle')[0].innerHTML
qtyBeli = document.getElementsByClassName('qtyBeli')[0].innerHTML

buttonCheckout.addEventListener('click', function(){
    window.location.href = '../checkoutBundleProcess.php?bundle='+bundle+'&qtyBeli='+qtyBeli;
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

