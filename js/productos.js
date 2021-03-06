

function buscarByNombre(){    
    var button = "btnBuscar";
    var concepto = document.getElementById('txt_Buscador').value;
    $.ajax(
        {
            type:"POST",
            url: "procesa_productos.php", 
            data: "conceptoABuscar=" + concepto + "&" + button +"=sa",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                document.getElementById('divProducts').innerHTML = result;
            }						
        });					

}

function onKeyDownHandler(event) {
        buscarByNombre();     
}

function deleteProduct(product){
    id = product.id.replace("delete_","")
    document.getElementById("lbl_ID").value          =  id;
    document.getElementById("lbl_id").innerHTML          =  id;
    document.getElementById("lbl_concepto").innerHTML      = document.getElementById("concepto_row" + id).innerHTML;
    document.getElementById("lbl_stock").innerHTML      = document.getElementById("stock_row" + id).innerHTML;
    document.getElementById("lbl_precioUnitario").innerHTML      = document.getElementById("precioUnitario_row" + id).innerHTML;
} 

function openProduct(user){
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
                var productJson = JSON.parse(this.responseText);
                document.getElementById("hiddenEdit_ID").value          = productJson.id;

                document.getElementById("txt_edit_id").value          = productJson.id;
                document.getElementById("txt_edit_precioUnitario").value      = productJson.precioUnitario;
                document.getElementById("txt_edit_stock").value      = productJson.stock;
                document.getElementById("txt_edit_descuento").value      = productJson.descuento;
                document.getElementById("txt_edit_concepto").value      = productJson.concepto;
            
            }
        };
        xmlhttp.open("POST","procesa_productos.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getDataProducto=true&id="+id);
    
        //#endregion

       
    }
    //#endregion
}

function updateTableProducts(){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //#region AJAX para actualizar el registro 
    var data =  "btnActualizar=true"+
                "&hiddenEdit_ID="+            document.getElementById("hiddenEdit_ID").value +
                "&txt_edit_id="+            document.getElementById("txt_edit_id").value.toString().toUpperCase()+
                "&txt_edit_concepto="+        document.getElementById("txt_edit_concepto").value+
                "&txt_edit_precioUnitario="+        document.getElementById("txt_edit_precioUnitario").value+
                "&txt_edit_stock="+           document.getElementById("txt_edit_stock").value+
                "&txt_edit_descuento="+           document.getElementById("txt_edit_descuento").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               if(this.responseText == "No hubo error")
                show_snackbar("Registro actualizado correctamente." , 3000);
                else    
               show_snackbar("Error al guardar los cambios.", 3000);
               rellenarTabla();
            }
        };
        xmlhttp.open("POST","procesa_productos.php",true);
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

function deleteProductAJAX(){
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
        xmlhttp.open("POST","procesa_productos.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    //#endregion
    $('#modalDeleteClose').trigger('click'); 
    
    
}

function createProductAJAX(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_productos.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "btnInsertar=true"+
            "&txt_id="+             document.getElementById("txt_id").value.toString().toUpperCase() +
            "&txt_concepto="+             document.getElementById("txt_concepto").value+
            "&txt_stock="+                document.getElementById("txt_stock").value+
            "&txt_descuento="+                document.getElementById("txt_descuento").value+
            "&txt_precioUnitario="+             document.getElementById("txt_precioUnitario").value,
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
    document.getElementById("txt_descuento").value = "";
    document.getElementById("txt_precioUnitario").value = "";
    
}