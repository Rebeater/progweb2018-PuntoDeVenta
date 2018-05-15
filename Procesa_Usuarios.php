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
        echo "btnActualizar";
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
        echo $id;
        echo $tel;
        echo $nombre;
        $usr->Editar();
        exit();
	} else if ( isset($_POST['btnEliminar'])){
        $id = $valida->test_input($_POST['lbl_ID']);
        $usr = new usuario();
        $usr->setId($id);
        $usr->Eliminar();
    } else if ( isset($_POST['btnBuscar'])){
        if(isset($_POST['nombreABuscar'])){
            $nombre =  $_POST['nombreABuscar'];
            $usr = new usuario();
            $usr->LeerTodobyCampo("nombre", $nombre );
        }
        else  {
            echo "No existe valor a buscar";
        }
        exit();
    } 
    else if(isset($_POST['getDataUser'])){
        if(isset($_POST['id'])){
            $usr = new usuario();
            $id = $valida->test_input($_POST['id']);
            $usr->getUserById($id);           
            exit();
        }
    }
    else if(isset($_POST['getTabla'])){
        $usr = new usuario();
        $usr->LeerTodo();
        exit();
    }
    else {
	    echo "Nada";
    }
   header("Location: mantenimiento_Usuarios.php"); 

}
else if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    if(isset($_GET['u'])){

        $usr = new usuario();
        $id = $valida->test_input($_GET['u']);
        
        $usr->setId($id) ;
        $usr->cbxEditpuesto($id);
        
    }
}
        
?> 