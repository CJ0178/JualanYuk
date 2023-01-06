window.onload = function(){
    buttonSearch = document.getElementById('search1')
    kotakMuncul = document.getElementById('search2')
    buttonSearch.addEventListener('click', ()=>{
        kotakMuncul.classList.toggle('displayNone')
        buttonSearch.classList.add('displayNone')
    })

    buttonHamburger = document.getElementById('hamburger')
    dropdownMenu = document.getElementsByClassName('dropdownMenu')[0]
    
    buttonHamburger.addEventListener('click', function(){
        dropdownMenu.classList.toggle('displayNone')
    })
}

function checkSubmit(e) {
    if(e && e.keyCode == 13) {
        document.forms[0].submit();
    }
}
