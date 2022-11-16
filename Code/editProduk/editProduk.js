buttonSave = document.getElementsByClassName('tulisanKeranjang')[0]
form = document.getElementById('buttonSave')

buttonSave.addEventListener('click', ()=>{
    if(confirm('Yakin data sudah benar?')){
        form.submit()
    }
})