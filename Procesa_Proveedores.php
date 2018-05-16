<?php 
    include_once("Clases/mantenimiento_proveedores.php");
    include_once("Clases/validaciones.php");
    
$valida = new validaciones();
    
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $mi_error = false;
    $pro = new mantenimiento_proveedores();	
	if (isset($_POST['btnInsertar'])){
         //guardar del post 
        $nombre     = $valida->test_input($_POST['txt_nombre']);
        $id     = $valida->test_input($_POST['txt_id']);
        $tel        = $valida->test_input($_POST['txt_telefono']);
        $nombre_social  = $valida->test_input($_POST['txt_nombre_social']);
        $ciudad = $valida->test_input($_POST['ciudad_proveedor']);
        $pro->setNombre($nombre);
        $pro->setID($id);
        $pro->setTelefono($tel);
        $pro->setNombre_social($nombre_social);
        $pro->setCiudad($ciudad);
        $pro->Insertar();
	} elseif ( isset($_POST['btnActualizar'])){
        echo "btnActualizar";
        $id         = $valida->test_input($_POST['txt_edit_id']);
        $nombre     = $valida->test_input($_POST['txt_edit_nombre']);
        $tel        = $valida->test_input($_POST['txt_edit_telefono']);
        $nombre_social  = $valida->test_input($_POST['txt_edit_nombre_social']);
        $ciudad     = $valida->test_input($_POST['txt_edit_ciudad']);
        $pro->setId($id);
        $pro->setNombre($nombre);
        $pro->setTelefono($tel);
        $pro->setNombre_social($nombre_social);
        $pro->setCiudad($ciudad);
        echo $id;
        echo $tel;
        echo $nombre;
        $pro->Editar();
        exit();
	} else if ( isset($_POST['btnEliminar'])){
        $id = $valida->test_input($_POST['lbl_ID']);
        $pro = new mantenimiento_proveedores();
        $pro->setId($id);
        $pro->Eliminar();
    } else if ( isset($_POST['btnBuscar'])){
        echo "buscar";
    } 
    else if(isset($_POST['getDataUser'])){
        if(isset($_POST['id'])){
            $pro = new usuario();
            $id = $valida->test_input($_POST['id']);
            $pro->getUserById($id);           
            exit();
        }
    }
    else if(isset($_POST['getTabla'])){
        $pro = new usuario();
        $pro->LeerTodo();
        exit();
    }
    else {
	    echo "Nada";
    }
   header("Location: proveedores.php"); 

}
else if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    if(isset($_GET['u'])){

        $pro = new usuario();
        $id = $valida->test_input($_GET['u']);
        
        $pro->setId($id) ;
        $pro->cbxEditpuesto($id);
        
    }
}
        
?> 