$( document ).ready(function() {
    loadItems();
});

function loadItems(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_publicidad.php", 
            data: "getPromosJSON="+ "true"+"&title=''" ,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result!= ""){
                var promos = JSON.parse(result);
                // promo { id, titulo, descripcio, img, status } 
                for (let i = 0; i < promos.length; i++) {
                    var id = promos[i].id;
                    var card = document.createElement('div');                    
                    var innerHTML = 
                        "<img id='card-img" + id +"' name='card-img" + id +"' class='card-img-top' src='" + promos[i].img +"' alt='Card image cap'>"+
                        "<div class='card-body'>"+
                            "<h5 id='card-title" + id +"' name='card-title" + id +"' class='card-title'>" + promos[i].titulo + "</h5>"+
                            "<p id='card-text" + id +"' name='card-text" + id +"' class='card-text'> " + promos[i].descripcion + " </p>"+
                            
                            "<div class='toggle btn btn-success' data-toggle='toggle' style='width: 108.781px; height: 38px;'>"+

                            "<input id='toggle" + id +"' name='toggle" + id +"' type='checkbox' "+ ((promos[i].enable)? "cheked": "") + " data-toggle='toggle' data-on='Activo' data-off='No activo' data-onstyle='success' data-offstyle='danger'>"+

                            "<div class='toggle-group'><label class='btn btn-success toggle-on'>Activo</label>"+
                            "<label class='btn btn-danger active toggle-off'>No activo</label><span class='toggle-handle btn btn-default'></span></div></div>"+


                            "<button>editar</button>"+
                        "</div>"+
                    "</div>";
                    document.getElementById("divPublicidad").appendChild(card);
                    card.outerHTML = "<div class='card' id='card" + id +"' name ='card" + id +"' style='width: 18rem;'>"+ innerHTML;
                   }
                }
            }
        });					

}


function subirFoto(id){
    document.getElementById('updatePhotoIdPublicidad').value = id;

    var publicidadfileToUpload = document.getElementById('publicidadfileToUpload');
    var updatePhotoIdPublicidad = document.getElementById('updatePhotoIdPublicidad');
    /*var upload = document.getElementById('fileToUpload');
    var image = upload.files[0];*/
    $.ajax(
        {
            type: "POST",
            url: "procesa_upload.php",
            //data: new FormData($('#uploadImgPublicidad')[0]), updatePhotoIdPublicidad
            contentType: false,
            data: "updatePhotoIdPublicidad=" + updatePhotoIdPublicidad + "&publicidadfileToUpload=" + publicidadfileToUpload,
            cache: false,
            processData:false,
            success: function (result) {
                if(result == "The file has been uploaded"){
                    AsignarImg(result,id);
                }
                else{
                    document.getElementById('uploadImg').innerHTML = result;
                }
      }
    });
}

function AsignarImg(imgStr, id){
    $.ajax(
        {
            type:"POST",
            url: "procesa_publicidad.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "setImg=true"+
            "&imgStr="      +  imgStr+
            "&id=" +  id,
            success: function(result){
                if(result != "")
                    show_snackbar("EXITO !!!!!!!!!!!!!!!!!!!!!!!."); 
                else    
                    show_snackbar("Error al guardar los cambios.");
            }
        });
}

function createPublicidad(path){
    $.ajax(
        {
            type:"POST",
            url: "procesa_publicidad.php", 
            contentType: "application/x-www-form-urlencoded",
            data:  "btnInsertar=true"+
            "&txt_Titulo="      +  document.getElementById("txt_Titulo").value+
            "&txt_Descripcion=" +  document.getElementById("txt_Descripcion").value,
            success: function(result){
                    if(result != "")
                        subirFoto(result);
                    else    
                        show_snackbar("Error al guardar los cambios.");
            }
        });




    /*$('#modalNewClose').trigger('click'); */
    
}

/*
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
*/
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

