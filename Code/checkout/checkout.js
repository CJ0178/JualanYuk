buttonCheckout = document.getElementsByClassName('tombolCekot')[0]

buttonCheckout.addEventListener('click', function(){
    parameter = document.getElementsByClassName('hidden')[0].innerHTML
    document.location.href = '../checkoutProcess.php?list='+parameter
})

// Untuk header
window.onload = function(){
    buttonSearch = document.getElementById('search1')
    kotakMuncul = document.getElementById('search2')
    buttonSearch.addEventListener('click', ()=>{
        kotakMuncul.classList.toggle('displayNone')
        buttonSearch.classList.add('displayNone')
    })
}