buttonMinus = document.getElementsByClassName('kotakMin')[0]
buttonPlus = document.getElementsByClassName('kotakTambah')[0]
inputQty = document.getElementById('qtyBeli')

buttonPlus.addEventListener('click', ()=>{
    inputQty.value++
})

buttonMinus.addEventListener('click', ()=>{
    if(inputQty.value-1 >= 1){
        inputQty.value--
    } else{
        inputQty.value = 1
    }
})