var id;

function openUser(user){
    id = user.id.replace("edit_","")
    document.getElementById("txt_edit_id").value          = id;
    document.getElementById("txt_edit_correo").value      = document.getElementById("correo_row" + id).innerHTML;
    //document.getElementById("txt_edit_contrasena").value  = document.getElementById("contrasena_row" + id).innerHTML;
    document.getElementById("txt_edit_nombre").value      = document.getElementById("nombre_row" + id).innerHTML;
    document.getElementById("cbx_edit_puesto").value      = document.getElementById("puesto_row" + id).innerHTML;
    document.getElementById("txt_edit_telefono" ).value   = document.getElementById("telefono_row" + id).innerHTML;
    document.getElementById("txt_edit_domicilio" ).value  = document.getElementById("domicilio_row" + id).innerHTML;
    document.getElementById("date_edit_Nacimiento").value = document.getElementById("fechaNacimiento_row" + id).innerHTML;

}

function deleteUser(user){
    id = user.id.replace("delete_","")
    document.getElementById("lbl_ID").value          =  id;
    document.getElementById("lbl_id").innerHTML          =  id;
    document.getElementById("lbl_correo").innerHTML      = document.getElementById("correo_row" + id).innerHTML;
    document.getElementById("lbl_nombre").innerHTML      = document.getElementById("nombre_row" + id).innerHTML;
    document.getElementById("lbl_puesto").innerHTML      = document.getElementById("puesto_row" + id).innerHTML;
}