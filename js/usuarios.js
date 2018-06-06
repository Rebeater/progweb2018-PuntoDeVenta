var id;


function openUser(user){
    id = user.id.replace("edit_","")
    if (id == "") {
        return;
    } else { 

        $.ajax(
            {
                type:"POST",
                url: "Procesa_Usuarios.php", 
                data: "getDataUser=" + "true" + "&id="+id,
                contentType: "application/x-www-form-urlencoded",
                success: function(result){
                    if(result != ""){
                        var usrJson = JSON.parse(result);
                        document.getElementById("photo-EditUsr").src = "img/perfiles/" + usrJson.id + ".png";
                        $('#txt_edit_id').val(usrJson.id);
                        $('#txt_edit_correo').val(usrJson.correo);
                        $('#txt_edit_contrasena').val("");
                        $('#txt_edit_nombre').val(usrJson.nombre);
                        $('#txt_edit_telefono' ).val(usrJson.telefono);
                        $('#txt_edit_domicilio' ).val(usrJson.domicilio);
                        $('#date_edit_Nacimiento').val(usrJson.fechaNacimiento);
                    }						
                }
            });   
        
        //#region AJAX para el combobox del puesto
    
        $.ajax(
            {
                type:"GET",
                url: "Procesa_Usuarios.php", 
                data: "u="+id,
                contentType: "application/x-www-form-urlencoded",
                success: function(result){
                    if(result != ""){
                        document.getElementById("cbx_edit_puesto" ).innerHTML = result;
                      
                    }						
                }
            });   

    }
    //#endregion
}

function deleteUser(user){
    id = user.id.replace("delete_","")
    document.getElementById("lbl_ID").value          =  id;
    document.getElementById("lbl_id").innerHTML          =  id;
    document.getElementById("lbl_correo").innerHTML      = document.getElementById("correo_row" + id).innerHTML;
    document.getElementById("lbl_nombre").innerHTML      = document.getElementById("nombre_row" + id).innerHTML;
    document.getElementById("lbl_puesto").innerHTML      = document.getElementById("puesto_row" + id).innerHTML;
} 

function updateTableUsers(){

    $.ajax(
        {
            type:"POST",
            url: "Procesa_Usuarios.php", 
            data: "btnActualizar=true"+
            "&txt_edit_id="+            document.getElementById("txt_edit_id").value+
            "&txt_edit_nombre="+        document.getElementById("txt_edit_nombre").value+
            "&txt_edit_correo="+        document.getElementById("txt_edit_correo").value+
            "&txt_edit_contrasena="+    document.getElementById("txt_edit_contrasena").value+
            "&cbx_edit_puesto="+        document.getElementById("cbx_edit_puesto").value+
            "&txt_edit_telefono="+      document.getElementById("txt_edit_telefono").value+
            "&txt_edit_domicilio="+     document.getElementById("txt_edit_domicilio").value+
            "&date_edit_Nacimiento="+   document.getElementById("date_edit_Nacimiento").value,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != ""){
                    $.ajax(
                        {
                            type:"POST",
                            url: "Procesa_Usuarios.php", 
                            data: "getTabla=true",
                            contentType: "application/x-www-form-urlencoded",
                            success: function(result){
                                if(result != ""){
                                    document.getElementById("divUsers").innerHTML =  result;
                                    $("#modalEdit").hide();
                                    $('.modal-backdrop').remove();
                                }						
                            }
                        });   
                }						
            }
        });   



    //#region AJAX para la tabla
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

           

        }
    };
    xmlhttp.open("POST","Procesa_Usuarios.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //#endregion


}


$('#btnBuscar').click(function (){
    alert("ko");
});


function buscarByNombre(){    
    var button = "btnBuscar";
    var nombre = document.getElementById('txt_Buscador').value;
    $.ajax(
        {
            type:"POST",
            url: "procesa_Usuarios.php", 
            data: "nombreABuscar=" + nombre + "&" + button +"=sa",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                document.getElementById('divUsers').innerHTML = result;
            }						
        });					

}


function onKeyDownHandler(event) {
        buscarByNombre();     
}


 function cambiarFoto(id){    
     document.getElementById("updatePhotoId").value = id;
     $('#fileToUpload').trigger('click');    
 }

 
 function uploadFoto() {
        var upload = document.getElementById('fileToUpload');
        var image = upload.files[0];
        $.ajax({
          url:"procesa_upload.php",
          type: "POST",
          data: new FormData($('#uploadImg')[0]),
          contentType: false,
          cache: false,
          processData:false,
          success:function (msg) {
            document.getElementById('uploadImg').innerHTML = msg;
          }
        });
};


function iconpass(){
    $('#icon-pass').toggleClass('fa-unlock');
    if($('#txt_edit_contrasena')[0].type == 'password'){
        $('#txt_edit_contrasena')[0].type = 'text';
    }else if($('#txt_edit_contrasena')[0].type == 'text'){
        $('#txt_edit_contrasena')[0].type = 'password';
    }
    
}

function iconpass(){
    $('#icon-pass').toggleClass('fa-unlock');
    if($('#txt_edit_contrasena')[0].type == 'password'){
        $('#txt_edit_contrasena')[0].type = 'text';
    }else if($('#txt_edit_contrasena')[0].type == 'text'){
        $('#txt_edit_contrasena')[0].type = 'password';
    }
}