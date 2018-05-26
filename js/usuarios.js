var id;


function openUser(user){
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
                document.getElementById("photo-EditUsr").src = "img/perfiles/" + usrJson.id + ".png";
                //document.getElementById('').src = "img/perfiles/" + usrJson.id;
                document.getElementById("txt_edit_id").value          = usrJson.id;
                document.getElementById("txt_edit_correo").value      = usrJson.correo;
                document.getElementById("txt_edit_contrasena").value  = usrJson.contrasena;
                document.getElementById("txt_edit_nombre").value      = usrJson.nombre;
                document.getElementById("txt_edit_telefono" ).value   = usrJson.telefono;
                document.getElementById("txt_edit_domicilio" ).value  = usrJson.domicilio;
                document.getElementById("date_edit_Nacimiento").value = usrJson.fechaNacimiento;
            
            }
        };
        xmlhttp.open("POST","Procesa_Usuarios.php",false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getDataUser=true&id="+id);
    
        //#endregion

        //#region AJAX para el combobox del puesto
    
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cbx_edit_puesto" ).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","Procesa_Usuarios.php?u="+id,true);
        xmlhttp.send();
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
                "&txt_edit_contrasena="+    document.getElementById("txt_edit_contrasena").value+
                "&cbx_edit_puesto="+        document.getElementById("cbx_edit_puesto").value+
                "&txt_edit_telefono="+      document.getElementById("txt_edit_telefono").value+
                "&txt_edit_domicilio="+     document.getElementById("txt_edit_domicilio").value+
                "&date_edit_Nacimiento="+   document.getElementById("date_edit_Nacimiento").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               // $("#divUsers").innerHTML =  this.responseText;

            }
        };
        xmlhttp.open("POST","Procesa_Usuarios.php",false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
        btnActualizar
    //#endregion





    //#region AJAX para la tabla
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("divUsers").innerHTML =  this.responseText;
            $("#modalEdit").hide();
            $('.modal-backdrop').remove();

        }
    };
    xmlhttp.open("POST","Procesa_Usuarios.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("getTabla=true");
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