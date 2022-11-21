// Button Pilih Semua Checkbox
buttonPilihSemua = document.getElementById('pilihSemua')
gambarLogoPilihSemua = document.getElementById('gambarLogoPilihSemua')
gambarlogo = document.getElementsByClassName('gambarlogo')
checkBoxInputs = document.getElementsByClassName('checkBoxInput')
containerInputs = document.getElementsByClassName('kotakPilih')
grandTotalPrice = document.getElementsByClassName('grandTotal')[0]
grandTotalQty = document.getElementsByClassName('grandTotalQty')[0]
formQty = document.getElementsByClassName('qtyBeli')

// Convert ke array
checkBoxInputs = Array.prototype.slice.call(checkBoxInputs);
gambarlogo = Array.prototype.slice.call(gambarlogo);
containerInputs = Array.prototype.slice.call(containerInputs);

containerInputsItem = containerInputs.slice(1, containerInputs.size)

// Cek apakah ada input yang hidup
function allChecked(){
    temp = true
    for(let i = 0; i < checkBoxInputs.length; i++){
        if(!checkBoxInputs[i].checked){
            temp = false;
            return temp
        }
    }
    return true
}

// Jika button Pilih semua di-klik
buttonPilihSemua.addEventListener('click', ()=>{
    
    // Jika tombol pertama lagi di check
    if(allChecked()){
        // Hidupin dulu semuanya
        for(let i = 0; i < checkBoxInputs.length; i++){
            checkBoxInputs[i].checked = true;
        }
        gambarLogoPilihSemua.classList.add('displayNone')
        containerInputs[0].classList.remove('borderNone')
    } else{
        // Matiin dulu semuanya
        for(let i = 0; i < checkBoxInputs.length; i++){
            checkBoxInputs[i].checked = false;
        }
        gambarLogoPilihSemua.classList.remove('displayNone')
        containerInputs[0].classList.add('borderNone')
    }
    
    // Centangin semua checkbox
    checkBoxInputs.forEach((element, index)=>{
        element.checked = element.checked ? false:true
        if(element.checked){
            gambarlogo[index].classList.remove('displayNone')
            containerInputsItem[index].classList.add('borderNone')
        } else{
            gambarlogo[index].classList.add('displayNone')
            containerInputsItem[index].classList.remove('borderNone')
            
        }
    });
    
    grandTotalPrice.innerHTML = calculatePrice()
    grandTotalQty.innerHTML = calculateQuantity()
})

// Loop untuk setiap checkbox barang
containerInputsItem.forEach((element, index)=>{
    element.addEventListener('click', ()=>{
        checkBoxInputs[index].checked = checkBoxInputs[index].checked ? false:true
        if(checkBoxInputs[index].checked){
            gambarlogo[index].classList.remove('displayNone')
            containerInputsItem[index].classList.add('borderNone')
        } else{
            gambarlogo[index].classList.add('displayNone')
            containerInputsItem[index].classList.remove('borderNone')
        }
        
        // gambarlogo[index].classList.toggle('displayNone')
        // containerInputsItem[index].classList.toggle('borderNone')
        if(allChecked()){
            gambarLogoPilihSemua.classList.remove('displayNone')
            containerInputs[0].classList.add('borderNone')
        } else{
            gambarLogoPilihSemua.classList.add('displayNone')
            containerInputs[0].classList.remove('borderNone')
        }
        
        grandTotalPrice.innerHTML = calculatePrice()
        grandTotalQty.innerHTML = calculateQuantity()
    })
});



// Plus min
buttonMinus = document.getElementsByClassName('kotakMin')
buttonPlus = document.getElementsByClassName('kotakTambah')
inputQty = document.getElementsByClassName('qtyBeli')

for(let i = 0; i < buttonMinus.length; i++){
    buttonPlus[i].addEventListener('click', ()=>{
        inputQty[i].value++
        // Submit form yang bersangkutan
        document.getElementsByClassName('qty'+i)[0].submit()
    })
    
    buttonMinus[i].addEventListener('click', ()=>{
        if(inputQty[i].value-1 >= 1){
            inputQty[i].value--
            document.getElementsByClassName('qty'+i)[0].submit()
        } else{
            inputQty[i].value = 1
            document.getElementsByClassName('qty'+i)[0].submit()
        }
    })
    
}

// Menghitung harga
prices = document.getElementsByClassName('subtotal')
function calculatePrice(){
    total = 0
    for(let i = 0; i < checkBoxInputs.length; i++){
        // Kalau dichecked
        if(checkBoxInputs[i].checked){
            // Hilangkan Rp
            temp = prices[i].innerHTML.substring(2,prices[i].length)
            // Menghilangkan koma
            while(temp != temp.replace(',','')){
                temp = temp.replace(',','')
            }
            total += parseInt(temp)
        }
    }
    total = 'Rp' + total.toLocaleString('en-US')
    return total
}

function calculateQuantity(){
    total = 0
    for(let i = 0; i < checkBoxInputs.length; i++){
        // Kalau dichecked
        if(checkBoxInputs[i].checked){
            total += parseInt(formQty[i].value);
        }
    }
    total = total + ' Barang'
    return total
}