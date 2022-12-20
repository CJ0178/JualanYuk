// Untuk cashier
cardsProduk = document.getElementsByClassName('produkCard')
itemIds = document.getElementsByClassName('itemId')
container = document.getElementsByClassName('bagianBawah')[0]
grandTotal = document.getElementById('grandTotal')

for(let i = 0; i < cardsProduk.length; i++){
    card = cardsProduk[i]
    card.addEventListener('click', function(){
        
        // Buat object ajax
        var xhr = new XMLHttpRequest()
    
        // Cek kesiapan ajax
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                container.innerHTML = xhr.responseText
            }
        }
        // Eksekusi ajax
        xhr.open('GET','../cashierProcess.php?id=' + itemIds[i].innerHTML, true)
        xhr.send()
    })
}

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


// Untuk Navbar
window.onload = function(){
    buttonSearch = document.getElementById('search1')
    kotakMuncul = document.getElementById('search2')
    buttonSearch.addEventListener('click', ()=>{
        kotakMuncul.classList.toggle('displayNone')
        buttonSearch.classList.add('displayNone')
    })
}

function checkSubmit(e) {
    if(e && e.keyCode == 13) {
        document.forms[0].submit();
    }
}

function checkSubmit2(e) {
    if(e && e.keyCode == 13) {
        document.forms[0].submit();
    }
 }

 // Untuk pop up
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