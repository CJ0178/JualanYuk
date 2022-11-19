// Plus minus
buttonMinus = document.getElementsByClassName('kotakMin')[0]
buttonPlus = document.getElementsByClassName('kotakTambah')[0]
inputQty = document.getElementById('qtyBeli')

buttonPlus.addEventListener('click', ()=>{
    console.log('hi');
    inputQty.value++
})

buttonMinus.addEventListener('click', ()=>{
    if(inputQty.value-1 >= 1){
        inputQty.value--
    } else{
        inputQty.value = 1
    }
})

// Submit jika pencet tombol keranjang
buttonKeranjang = document.getElementsByClassName('tulisanKeranjang')[0]
formKeranjang = document.getElementById('formKeranjang')

console.log(buttonKeranjang);
buttonKeranjang.addEventListener('click', ()=>{
    
    formKeranjang.submit()
})