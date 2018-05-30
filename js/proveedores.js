$( document ).ready(function() {
    txt_nombre        = $('#txt_nombre');
    txt_telefono      = $('#txt_telefono');
    txt_nombre_social = $('#txt_nombre_social');
    txt_ciudad        = $('#txt_ciudad');
});

function buscarByNombre(){    
    var button = "btnBuscar";
    var concepto = document.getElementById('txt_Buscador').value;
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedores.php", 
            data: "ProveedorABuscar=" + concepto + "&" + button +"=true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                document.getElementById('divUsers').innerHTML = result;
            }						
        });					

}

function onKeyDownHandler(event) {
        buscarByNombre();     
}

function deleteProveedor(product){
    id = product.id.replace("delete_","")
    document.getElementById("lbl_ID").value          =  id;
    document.getElementById("lbl_id").innerHTML          =  id;
    document.getElementById("lbl_nombre").innerHTML      = document.getElementById("nombre_row" + id).innerHTML;
    document.getElementById("lbl_telefono").innerHTML      = document.getElementById("telefono_row" + id).innerHTML;
    document.getElementById("lbl_nombre_social").innerHTML      = document.getElementById("nombre_social_row" + id).innerHTML;
    document.getElementById("lbl_ciudad").innerHTML      = document.getElementById("ciudad_row" + id).innerHTML;
} 

function openProveedor(user){
    id = user.id.replace("edit_","")
    if (id == "") {
        return;
    } else { 

        $.ajax(
            {
                type:"POST",
                url: "procesa_proveedores.php", 
                data: "getDataProveedor=true" + "&id="+id,
                contentType: "application/x-www-form-urlencoded",
                success: function(result){
                    var proveedorJson = JSON.parse(result);
                    $('#hiddenEdit_ID').val(proveedorJson.id);
                    $('#txt_edit_id').val(proveedorJson.id);
                    $('#txt_edit_nombre').val(proveedorJson.nombre);
                    $('#txt_edit_telefono').val(proveedorJson.telefono);
                    $('#txt_edit_nombre_social').val(proveedorJson.nombre_social);
                    $('#txt_edit_ciudad').val(proveedorJson.ciudad);
                }						
            });		
    }
}

function updateTableProveedores(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedores.php", 
            data: "btnActualizar=true"+
            "&hiddenEdit_ID="         + $('#hiddenEdit_ID').val()+
            "&txt_edit_id="           + $('#txt_edit_id').val()+
            "&txt_edit_nombre="       + $('#txt_edit_nombre').val()+
            "&txt_edit_telefono="     + $('#txt_edit_telefono').val()+
            "&txt_edit_nombre_social="+ $('#txt_edit_nombre_social').val() +
            "&txt_edit_ciudad="       + $('#txt_edit_ciudad').val(),
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result == "No hubo error")
                    show_snackbar("Registro actualizado correctamente." , 3000);
                else    
                    show_snackbar("Error al guardar los cambios.", 3000);
                rellenarTabla();
            }						
        });		
    $('#modalEditClose').trigger('click'); 
}

function rellenarTabla(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedores.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "getTabla=true",
            success: function(result){
                if("Error" == result){
                    show_snackbar("Error al cargar los datos.", 3000);
                }else{
                 document.getElementById("divUsers").innerHTML = result;
                }
            }
        });
}

function createProveedorAJAX(){ 
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedores.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "btnInsertar=true"+
            "&txt_nombre="+        txt_nombre.val()+
            "&txt_telefono="+      txt_telefono.val()+
            "&txt_nombre_social="+ txt_nombre_social.val()+
            "&txt_ciudad="+        txt_ciudad.val(),
            success: function(result){
                    if(result == "No hubo error")
                        show_snackbar("Registro creado correctamente." , 3000);
                    else    
                        show_snackbar("Error al guardar los cambios.", 3000);
                    rellenarTabla();
            }
        });
    $('#modalNewClose').trigger('click'); 
    txt_nombre.val("");
    txt_telefono.val("");
    txt_nombre_social.val("");
    txt_ciudad.val("");
    
}

function deleteProveedorAJAX(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedores.php", 
            data: "btnEliminar=true"+ "&lbl_ID="+ document.getElementById("lbl_ID").value,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result == "No hubo error")
                    show_snackbar("Registro eliminado correctamente.", 3000);
                else    
                    show_snackbar("Error al guardar los cambios.", 3000);
                rellenarTabla();
            }						
        });		
    $('#modalDeleteClose').trigger('click'); 
   
}
