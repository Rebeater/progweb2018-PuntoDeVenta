<?php 
    include_once("Clases/usuario.php");
    include_once("Clases/validaciones.php");
    
$valida = new validaciones();
    
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $mi_error = false;
    $usr = new usuario();	
	if (isset($_POST['btnInsertar'])){
         //guardar del post 
        $nombre     = $valida->test_input($_POST['txt_nombre']);
        $correo     = $valida->test_input($_POST['txt_correo']);
        $contrasena = $valida->test_input($_POST['txt_contrasena']);
        $puesto     = $valida->test_input($_POST['cbx_puesto']);
        $tel        = $valida->test_input($_POST['txt_telefono']);
        $domicilio  = $valida->test_input($_POST['txt_domicilio']);
        $fechaAlta  = $valida->test_input($_POST['date_Nacimiento']);
        $fechaNacimiento = $valida->test_input($_POST['date_Nacimiento']);
        $usr->setNombre($nombre);
        $usr->setCorreo($correo);
        $usr->setContrasena($contrasena);
        $usr->setPuesto($puesto);
        $usr->setTelefono($tel);
        $usr->setDomicilio($domicilio);
        $usr->setFechaNacimiento($fechaNacimiento);
        $usr->setFechaAlta($fechaAlta);
        $usr->Insertar();
	} elseif ( isset($_POST['btnActualizar'])){
        $id         = $valida->test_input($_POST['txt_edit_id']);
        $nombre     = $valida->test_input($_POST['txt_edit_nombre']);
        $correo     = $valida->test_input($_POST['txt_edit_correo']);
        $contrasena = $valida->test_input($_POST['txt_edit_contrasena']);
        $puesto     = $valida->test_input($_POST['cbx_edit_puesto']);
        $tel        = $valida->test_input($_POST['txt_edit_telefono']);
        $domicilio  = $valida->test_input($_POST['txt_edit_domicilio']);
        $fechaNacimiento = $valida->test_input($_POST['date_edit_Nacimiento']);
        $usr->setId($id);
        $usr->setNombre($nombre);
        $usr->setCorreo($correo);
        $usr->setContrasena($contrasena);
        $usr->setPuesto($puesto);
        $usr->setTelefono($tel);
        $usr->setDomicilio($domicilio);
        $usr->setFechaNacimiento($fechaNacimiento);

		$usr->Editar();
	} elseif ( isset($_POST['btnEliminar'])){

        $id = $valida->test_input($_POST['lbl_ID']);
        $usr = new usuario();
        $usr->setId($id);
        $usr->Eliminar();
        
	} else {
	    echo "Nada";
    }
    header("Location: mantenimiento_Usuarios.php"); 

}
        
?> 