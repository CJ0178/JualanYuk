window.onload = function(){
    buttonSimpan = document.getElementById('buttonSimpan')
    form = document.getElementById('form')
    
    buttonSimpan.addEventListener('click', ()=>{
        form.submit()
    })

    buttonHamburger = document.getElementById('hamburger')
    dropdownMenu = document.getElementsByClassName('dropdownMenu')[0]
    
    buttonHamburger.addEventListener('click', function(){
        dropdownMenu.classList.toggle('displayNone')
    })
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(".gambarProduk").attr("style","background-image:url("+e.target.result + ");");
        };

        reader.readAsDataURL(input.files[0]);
    }
}