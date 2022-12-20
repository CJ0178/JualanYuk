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