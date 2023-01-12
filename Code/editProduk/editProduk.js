buttonSave = document.getElementsByClassName('tulisanKeranjang')[0]
form = document.getElementById('buttonSave')

buttonSave.addEventListener('click', ()=>{
    if(confirm('Yakin data sudah benar?')){
        form.submit()
    }
})

buttonDelete = document.getElementById('buttonDelete')
itemId = document.getElementById('itemId').value

buttonDelete.addEventListener('click', function(){
    if(confirm('yakin?')){
        window.location = "../delete.php?id="+itemId
    }
})