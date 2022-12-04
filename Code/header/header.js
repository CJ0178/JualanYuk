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