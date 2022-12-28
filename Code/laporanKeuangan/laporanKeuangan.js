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
    document.forms[0].submit()
})

// Arrow kiri dan kanan
arrowKiri = document.getElementById('arrowKiri')
arrowKanan = document.getElementById('arrowKanan')

arrowKanan.addEventListener('click', function(){
    indexAktif = checkManaYangAktif()

    if(indexAktif == 0){
        // Mingguan
        weekInput = document.getElementById('session-week').value
        tahunInput = parseInt(weekInput.substring(0, 4))
        weekInput = parseInt(weekInput.substring(6, 8))
        weekMax = parseInt(document.getElementsByClassName('banyakMingguTahunIni')[0].innerHTML)

        if(weekInput < weekMax){
            weekInput++;
        } else {
            weekInput = 1;
            tahunInput++;
        }

        stringJadi = tahunInput.toString() + '-W' + addLeadingZeros(weekInput, 2)
        divInput[0].value = stringJadi
        
    } else if(indexAktif == 1){
        // Bulanan
        const month = new Date(divInput[1].value)
        if(month.getMonth()+1 == 12){
            // Jika Desember, nambah tahun
            month.setMonth((month.getMonth() + 1) % 12)
            month.setFullYear(month.getFullYear() + 1)
        } else{
            month.setMonth(month.getMonth() + 1)
        }

        divInput[1].value = month.getFullYear() + '-' + addLeadingZeros(month.getMonth() + 1, 2)
    } else {
        // Tahunan
        tahunInput = document.getElementById('session-year')
        if(tahunInput.value < 2023){
            tahunInput.value = parseInt(tahunInput.value) + 1
        }
    }
})

arrowKiri.addEventListener('click', function(){
    indexAktif = checkManaYangAktif()

    if(indexAktif == 0){
        // Mingguan
        weekInput = document.getElementById('session-week').value
        tahunInput = parseInt(weekInput.substring(0, 4))
        weekInput = parseInt(weekInput.substring(6, 8))
        weekMax = parseInt(document.getElementsByClassName('banyakMingguTahunSebelum')[0].innerHTML)

        if(weekInput > 1){
            weekInput--;
        } else {
            weekInput = weekMax;
            tahunInput--;
        }

        stringJadi = tahunInput.toString() + '-W' + addLeadingZeros(weekInput, 2)
        divInput[0].value = stringJadi
    } else if(indexAktif == 1){
        // Bulanan
        const month = new Date(divInput[1].value)
        if(month.getMonth()+1 == 1){
            // Jika Januari, kurang tahun tahun
            month.setMonth(11)
            month.setFullYear(month.getFullYear() - 1)
        } else{
            month.setMonth(month.getMonth() - 1)
        }

        divInput[1].value = month.getFullYear() + '-' + addLeadingZeros(month.getMonth() + 1, 2)
    } else {
        // Tahunan
        tahunInput = document.getElementById('session-year')
        if(tahunInput.value > 2018){
            tahunInput.value = parseInt(tahunInput.value) - 1
        }
    }
})

// Function
function checkManaYangAktif(){
    for(let i = 0; i < cardJudul.length; i++){
        if(cardJudul[i].classList.contains('active')){
            return i
        }
    }
    return -1
}

function addLeadingZeros(num, totalLength) {
    return String(num).padStart(totalLength, '0');
}