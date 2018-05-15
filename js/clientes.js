$(document).ready(function(){
    rellenarTabla();
});

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
    document.getElementById("lbl_correo").innerHTML      = document.getElementById("correo_row" + id).innerHTML;
} 

function openClient(user){
    id = user.id.replace("edit_","")
    if (id == "") {
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    
        //#region AJAX para los datos del usario
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var usrJson = JSON.parse(this.responseText);

                document.getElementById("txt_edit_id").value          = usrJson.id;
                document.getElementById("txt_edit_correo").value      = usrJson.correo;
                document.getElementById("txt_edit_rfc").value      = usrJson.rfc;
                document.getElementById("txt_edit_nombre").value      = usrJson.nombre;
                document.getElementById("txt_edit_telefono" ).value   = usrJson.telefono;
                document.getElementById("txt_edit_domicilio" ).value  = usrJson.domicilio;
                document.getElementById("txt_edit_ciudad").value      = usrJson.ciudad;
            
            }
        };
        xmlhttp.open("POST","Procesa_clientes.php",false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getDataCliente=true&id="+id);
    
        //#endregion

       
    }
    //#endregion
}

function updateTableClients(){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //#region AJAX para actualizar el registro 
    var data =  "btnActualizar=true"+
                "&txt_edit_id="+            document.getElementById("txt_edit_id").value+
                "&txt_edit_nombre="+        document.getElementById("txt_edit_nombre").value+
                "&txt_edit_correo="+        document.getElementById("txt_edit_correo").value+
                "&txt_edit_rfc="+           document.getElementById("txt_edit_rfc").value+
                "&txt_edit_telefono="+      document.getElementById("txt_edit_telefono").value+
                "&txt_edit_domicilio="+     document.getElementById("txt_edit_domicilio").value+
                "&txt_edit_ciudad="+        document.getElementById("txt_edit_ciudad").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               if(this.responseText == "No hubo error")
                show_snackbar("Registro actualizado correctamente.");
                else    
               show_snackbar("Error al guardar los cambios.");
               rellenarTabla();
            }
        };
        xmlhttp.open("POST","Procesa_clientes.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    //#endregion
    /*$("#modalEdit").hide();
    $('.modal-backdrop').remove();*/
    $('#modalEditClose').trigger('click'); 

}

function rellenarTabla(){
    //#region AJAX para la tabla
    $.ajax(
        {
            type:"POST",
            url: "Procesa_clientes.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "getTabla=true",
            success: function(result){
                if("Error" == result){
                    show_snackbar("Error al cargar los datos.");
                }else{
                 document.getElementById("divClients").outerHTML = result;
                }
            }
        });

    /*if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if("Error" == this.responseText){
                show_snackbar("Error al cargar los datos.");
            }else{
             document.getElementById("divClients").outerHTML =  this.responseText;
            }

        }
    };
    xmlhttp.open("POST","Procesa_clientes.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("getTabla=true");*/
    //#endregion
}

function deleteClientAJAX(){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //#region AJAX para actualizar el registro 
    var data =  "btnEliminar=true"+ "&lbl_ID="+ document.getElementById("lbl_ID").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText == "No hubo error")
                    show_snackbar("Registro eliminado correctamente.");
                else    
                    show_snackbar("Error al guardar los cambios.");
                    rellenarTabla();
            }
        };
        xmlhttp.open("POST","Procesa_clientes.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    //#endregion
    /*$("#modalDelete").hide();
    $('.modal-backdrop').remove();*/
    $('#modalDeleteClose').trigger('click'); 
    
    
}

function createClientAJAX(){
    $.ajax(
        {
            type:"POST",
            url: "Procesa_clientes.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "btnInsertar=true"+
            "&txt_nombre="+             document.getElementById("txt_nombre").value+
            "&txt_rfc="+                document.getElementById("txt_rfc").value+
            "&txt_correo="+             document.getElementById("txt_correo").value+
            "&txt_telefono="+           document.getElementById("txt_telefono").value+
            "&txt_domicilio="+          document.getElementById("txt_domicilio").value+
            "&txt_ciudad="+             document.getElementById("txt_ciudad").value,
            success: function(result){
                    if(result == "No hubo error")
                        show_snackbar("Registro creado correctamente.");
                    else    
                        show_snackbar("Error al guardar los cambios.");
                    rellenarTabla();
            }
        });



    /*if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //#region AJAX para actualizar el registro 
    var data =  
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText == "No hubo error")
                    show_snackbar("Registro creado correctamente.");
                else    
                    show_snackbar("Error al guardar los cambios.");
                rellenarTabla();
            }
        };
        xmlhttp.open("POST","Procesa_clientes.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
        btnActualizar
    //#endregion
    $("#myModal").hide();
    $('.modal-backdrop').remove();*/
    $('#modalNewClose').trigger('click'); 
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_rfc").value = "";
    document.getElementById("txt_correo").value = "";
    document.getElementById("txt_telefono").value = "";
    document.getElementById("txt_domicilio").value = "";
    document.getElementById("txt_ciudad").value = "";
    
}