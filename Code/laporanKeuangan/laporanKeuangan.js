// Pilih opsi week, bulan, tahun
buttonOpsi = document.getElementsByClassName('cardJudul')
divInput = document.getElementsByClassName('input')
cardJudul = document.getElementsByClassName('cardJudul')
mode = document.getElementById('mode')

modeList = ['week', 'month', 'year']

for(let i = 0; i < buttonOpsi.length; i++){
    buttonOpsi[i].addEventListener('click', function(){
        //  Untuk ukuran cardJudul
        cardJudul[i].classList.add('active')

        // Untuk select date, month, year
        divInput[i].classList.remove('displayNone')
        mode.value = modeList[i]

        for(let j = 0; j < buttonOpsi.length; j++){
            if(j != i){
                divInput[j].classList.add('displayNone')
                cardJudul[j].classList.remove('active')
            }
        }
    })
}

tombolSubmitForm = document.getElementById('tombolSubmitForm')
tombolSubmitForm.addEventListener('click', function(){
    document.forms[1].submit()
})

// Arrow kiri dan kanan
arrowKiri = document.getElementById('arrowKiri')
arrowKanan = document.getElementById('arrowKanan')

arrowKiri.addEventListener('click', function(){
    indexAktif = checkManaYangAktif()

    
})

function checkManaYangAktif(){
    for(let i = 0; i < cardJudul.length; i++){
        if(cardJudul[i].classList.contains('active')){
            return i
        }
    }
    return -1
}
document.getElementById('session-year').value = 2020
console.log(document.getElementById('session-year').value);