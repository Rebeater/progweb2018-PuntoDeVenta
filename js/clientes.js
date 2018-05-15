
function buscarByNombre(){    
    var button = "btnBuscar";
    var nombre = document.getElementById('txt_Buscador').value;
    $.ajax(
        {
            type:"POST",
            url: "procesa_clientes.php", 
            data: "nombreABuscar=" + nombre + "&" + button +"=sa",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                document.getElementById('divClients').innerHTML = result;
            }						
        });					

}


function onKeyDownHandler(event) {
        buscarByNombre();     
}


function deleteClient(client){
    id = client.id.replace("delete_","")
    document.getElementById("lbl_ID").value          =  id;
    document.getElementById("lbl_id").innerHTML          =  id;
    document.getElementById("lbl_nombre").innerHTML      = document.getElementById("nombre_row" + id).innerHTML;
    document.getElementById("lbl_rfc").innerHTML      = document.getElementById("rfc_row" + id).innerHTML;
} 