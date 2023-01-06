// Plus minus
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

// Redirect ke checkout jika pencet tombol beli sekarang
buttonBeliSekarang = document.getElementsByClassName('beliSekarang')[0]
itemId = document.getElementById('itemId').value

buttonBeliSekarang.addEventListener('click', function(){
    qty = inputQty.value
    window.location.href = "../checkout/checkout.php?itemId=" + itemId + "&qty=" + qty
})

// Submit jika pencet tombol keranjang
buttonKeranjang = document.getElementsByClassName('tulisanKeranjang')[0]
formKeranjang = document.getElementById('formKeranjang')

buttonKeranjang.addEventListener('click', ()=>{
    
    formKeranjang.submit()
})

// Jalanin header
window.onload = function(){
    buttonSearch = document.getElementById('search1')
    kotakMuncul = document.getElementById('search2')
    buttonSearch.addEventListener('click', ()=>{
        kotakMuncul.classList.toggle('displayNone')
        buttonSearch.classList.add('displayNone')
    })

    buttonHamburger = document.getElementById('hamburger')
    dropdownMenu = document.getElementsByClassName('dropdownMenu')[0]
    console.log('hi');
    
    buttonHamburger.addEventListener('click', function(){
        dropdownMenu.classList.toggle('displayNone')
    })
}

function checkSubmit(e) {
    if(e && e.keyCode == 13) {
       document.forms[0].submit();
    }
 }