$( document ).ready(function() {
    createCboxClientes();
});


function createCboxClientes(){
        
    const cboxUsuario = document.getElementById('cbox_cliente');
    $.ajax(
        {
            type:"POST",
            url: "procesa_clientes.php", 
            data: "getListJSON=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != ""){
                    const clientes = JSON.parse(result);
                    for (let i = 0; i < clientes.length; i++) {
                        var element = document.createElement('option')
                        element.id = clientes[i]['id'];
                        element.textContent = clientes[i]['nombre'];
                        element.value = clientes[i]['id'];
                        cboxUsuario.appendChild(element);
                        }
                    }
                    else{
                        show_snackbar("No se pudo recuperar la lista de clientes o no existe ninguno.", 3000);
                    }
                }						
        });   
}