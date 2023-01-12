window.onload = function(){
    buttonHamburger = document.getElementById('hamburger')
    dropdownMenu = document.getElementsByClassName('dropdownMenu')[0]
    
    buttonHamburger.addEventListener('click', function(){
        dropdownMenu.classList.toggle('displayNone')
    })
}