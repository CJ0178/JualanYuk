// Button beli sekarang
buttonBeliSekarang = document.getElementsByClassName('buttonBeli')
formBeli = document.getElementsByClassName('formBeli')

for(let i = 0; i < buttonBeliSekarang.length; i++){
    buttonBeliSekarang[i].addEventListener('click', function(){
        formBeli[i].submit()
    })
}

var cardPaket = document.getElementsByClassName("cardPaket");
var cardPaket1 = document.getElementsByClassName("cardPaket1");
var cardPaket2 = document.getElementsByClassName("cardPaket2");

for(let i=0; i<cardPaket1.length; i++){
    cardPaket[i].addEventListener('mouseenter', function(){
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })

    cardPaket[i].addEventListener('mouseleave', function(){
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })
}

// Plus min
initPlusMin()

function initPlusMin(){
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
}