

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
                var proveedorJson = JSON.parse(this.responseText);
                document.getElementById("hiddenEdit_ID").value          = proveedorJson.id;

                document.getElementById("txt_edit_id").value          = proveedorJson.id;
                document.getElementById("txt_edit_precioUnitario").value      = proveedorJson.precioUnitario;
                document.getElementById("txt_edit_stock").value      = proveedorJson.stock;
                document.getElementById("txt_edit_concepto").value      = proveedorJson.concepto;
            
            }
        };
        xmlhttp.open("POST","procesa_proveedores.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getDataProducto=true&id="+id);
    
        //#endregion

       
    }
    //#endregion
}

function updateTableProveedores(){
    alert("asdfasdfasd");
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //#region AJAX para actualizar el registro 
    var data =  "btnActualizar=true"+
                "&hiddenEdit_ID="+            document.getElementById("hiddenEdit_ID").value+
                "&txt_edit_id="+            document.getElementById("txt_edit_id").value+
                "&txt_edit_nombre="+        document.getElementById("txt_edit_nobmre").value+
                "&txt_edit_telefono="+        document.getElementById("txt_edit_telefono").value+
                "&txt_edit_nombre_social="+           document.getElementById("txt_edit_nombre_social").value;+
                "&txt_edit_ciudad="+           document.getElementById("txt_edit_ciudad").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               if(this.responseText == "No hubo error")
                show_snackbar("Registro actualizado correctamente." , 3000);
                else    
               show_snackbar("Error al guardar los cambios.", 3000);
               rellenarTabla();
            }
        };
        xmlhttp.open("POST","procesa_proveedores.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    //#endregion
    $('#modalEditClose').trigger('click'); 

}

function rellenarTabla(){
    //#region AJAX para la tabla
    $.ajax(
        {
            type:"POST",
            url: "procesa_productos.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "getTabla=true",
            success: function(result){
                if("Error" == result){
                    show_snackbar("Error al cargar los datos.", 3000);
                }else{
                 document.getElementById("divProducts").outerHTML = result;
                }
            }
        });

    //#endregion
}

function deleteProveedorAJAX(){
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
                    show_snackbar("Registro eliminado correctamente.", 3000);
                else    
                    show_snackbar("Error al guardar los cambios.", 3000);
                    rellenarTabla();
            }
        };
        xmlhttp.open("POST","procesa_proveedores.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    //#endregion
    $('#modalDeleteClose').trigger('click'); 
    
    
}

function createProveedorAJAX(){ 
    $.ajax(
        {
            type:"POST",
            url: "procesa_proveedor.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "btnInsertar=true"+
            "&txt_id="+             document.getElementById("txt_id").value+
            "&txt_nombre="+             document.getElementById("txt_nombre").value+
            "&txt_=telefono"+             document.getElementById("txt_telefono").value+
            "&txt_nombre_social="+                document.getElementById("txt_nombre_social").value+
            "&txt_ciudad="+             document.getElementById("txt_ciudad").value,
            success: function(result){
                    if(result == "No hubo error")
                        show_snackbar("Registro creado correctamente." , 3000);
                    else    
                        show_snackbar("Error al guardar los cambios.", 3000);
                    rellenarTabla();
            }
        });


    //#endregion
    $('#modalNewClose').trigger('click'); 
    document.getElementById("txt_id").value = "";
    document.getElementById("txt_concepto").value = "";
    document.getElementById("txt_stock").value = "";
    document.getElementById("txt_precioUnitario").value = "";
    
}