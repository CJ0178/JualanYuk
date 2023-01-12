buttonCheckout = document.getElementsByClassName('tombolCekot')[0]

buttonCheckout.addEventListener('click', function(){
    // Validasi Form (Charlene)
    if(validasiBerhasil()){
        popUp.classList.add("open-popUp");
        bg.classList.add("open-bg");
        
    }
})

// Untuk pop up bayar berhasil
let popUp = document.getElementById("popUp");
let bg = document.getElementById("bg");

// function openPopUp(){
//     popUp.classList.add("open-popUp");
//     bg.classList.add("open-bg");
// }

function closePopUp(){
    popUp.classList.remove("open-popUp");
    bg.classList.remove("open-bg");
    parameter = document.getElementsByClassName('hidden')[0].innerHTML
    document.location.href = '../checkoutProcess.php?list='+parameter
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

function validasiBerhasil(){
    const name = document.getElementById('namaId');
    const address = document.getElementById('alamatLengkapId');
    const phone = document.getElementById('telpId');

    // kalo empty semua
    if(isEmpty(name.value) && isEmpty(address.value) && isEmpty(phone.value)){
        alert('Silahkan isi data dengan lengkap!');
        return false;
    }

    // nama
    if(isEmpty(name.value) || (name.value.length < 3 || name.value.length > 40)){
        alert('Nama harus diisi dan memiliki panjang karakter antara 3 sampai dengan 40 karakter!');
        return false;
    }

    // alamat
    if(isEmpty(address.value) || (address.value.length < 5 || address.value.length > 50)){
        alert('Alamat harus diisi dan memiliki panjang karakter antara 5 sampai dengan 50 karakter!');
        return false;
    }

    // no telp
    if(isEmpty(phone.value)){
        alert('No. Telp harus diisi!');
        return false;
    }

    for(i = 0; i < phone.value.length; i++){
        if(!(phone.value[i] >= '0' && phone.value[i] <= '9')){
            alert('No. Telp harus berupa angka!');
            return false;
        }
    }

    if(phone.value.length < 10 || phone.value.length > 13){
        alert('No. Telp harus memiliki panjang antara 10 sampai dengan 13!');
        return false;
    }

    // button pilih
    if(buttonPilih.innerHTML == 'PILIH'){
        alert('Silahkan pilih metode pembayaran!');
        return false;
    }

    return true;
}

function isEmpty(str) {
    return (!str || str.length === 0 );
}