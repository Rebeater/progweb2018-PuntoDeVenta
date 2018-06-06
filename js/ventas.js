$( document ).ready(function() {
    var date_Desde = $('#date_Desde');
    var date_Hasta = $('#date_Hasta');
    var cbox_Cliente = $('cbox_Cliente');

    loadDefault();
    $('#btnBuscar').click(function (){
        getVentas();
    });
});


function createCboxClientes(){

    const cboxUsuario = document.getElementById('cbox_Cliente');
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

function loadDefault(){
    date_Desde.value = '2000-01-01';

    var today = new Date();
    var year  = today.getFullYear();
    var month = ((String)(today.getMonth()+1).length == 1)? "0"+(today.getMonth()+1) :(today.getMonth()+1) ;
    var d     = ((String)(today.getDate()).length == 1)? "0"+(today.getDate()) :(today.getDate()) ; 
    
    date_Hasta.value = year+"-"+month+"-"+d;
    createCboxClientes();
}




function getVentas(){
    var parametros = new Object();
            parametros.desde = date_Desde.value;
            parametros.hasta = date_Hasta.value;
            parametros.cliente = cbox_Cliente.value;
    var parametrosJSON = JSON.stringify(parametros);
    $.ajax(
        {
            type:"POST",
            url: "procesa_ventas.php", 
            data: "getVentas=" + "true&parametros="+parametrosJSON,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != ""){
                    const clientes = JSON.parse(parametrosJSON);
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