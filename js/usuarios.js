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

                document.getElementById("txt_edit_id").value          = usrJson.id;
                document.getElementById("txt_edit_correo").value      = usrJson.correo;
                document.getElementById("txt_edit_contrasena").value  = usrJson.contrasena;
                document.getElementById("txt_edit_nombre").value      = usrJson.nombre;
                document.getElementById("txt_edit_telefono" ).value   = usrJson.telefono;
                document.getElementById("txt_edit_domicilio" ).value  = usrJson.domicilio;
                document.getElementById("date_edit_Nacimiento").value = usrJson.fechaNacimiento;
            
            }
        };
        xmlhttp.open("POST","Procesa_Usuarios.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getDataUser=true&id="+id);
    
        //#endregion

        //#region AJAX para el combobox del puesto
    
        /*xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cbx_edit_puesto" ).innerHTML = this.responseText;
                
            }
        };
        xmlhttp.open("GET","Procesa_Usuarios.php?u="+id,true);
        xmlhttp.send();*/
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

