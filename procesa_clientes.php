<?php
    include_once("Clases\cliente.php");
    include_once("Clases/validaciones.php");

    $valida = new validaciones();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        $mi_error = false;

         /* Si la opcion es Buscar*/
         if ( isset($_POST['btnBuscar'])){ 
            if(isset($_POST['nombreABuscar'])){
                $nombre =  $_POST['nombreABuscar'];
                $client = new cliente();
                $client->getTablaClientes($nombre);
            }
            else  {
                echo "No existe valor a buscar";
            }
            exit();
        }
        else if(isset($_POST['btnInsertar'])){
            $client = new cliente();
            $nombre     = $valida->test_input($_POST['txt_nombre']);
            $rfc        = $valida->test_input($_POST['txt_rfc']);
            $tel        = $valida->test_input($_POST['txt_telefono']);
            $domicilio  = $valida->test_input($_POST['txt_domicilio']);
            $ciudad     = $valida->test_input($_POST['txt_ciudad']);
            $correo     = $valida->test_input($_POST['txt_correo']);
            $client->setNombre($nombre);
            $client->setRfc($rfc);
            $client->setCorreo($correo);
            $client->setTelefono($tel);
            $client->setDomicilio($domicilio);
            $client->setCiudad($ciudad);
            $client->Insertar();
            exit();
        }
        else if ( isset($_POST['btnEliminar'])){
            $id = $valida->test_input($_POST['lbl_ID']);
            $client = new cliente();
            $client->setId($id);
            $client->Eliminar();
            exit();
        }
        else if(isset($_POST['getDataCliente'])){
            if(isset($_POST['id'])){
                $client = new cliente();
                $id = $valida->test_input($_POST['id']);
                echo $client->getClientByCampoJSON("id",$id);           
            }
            exit();
        } elseif (isset($_POST['btnActualizar'])){
            $client = new cliente();
            $id         = $valida->test_input($_POST['txt_edit_id']);
            $nombre     = $valida->test_input($_POST['txt_edit_nombre']);
            $correo     = $valida->test_input($_POST['txt_edit_correo']);
            $rfc        = $valida->test_input($_POST['txt_edit_rfc']);
            $tel        = $valida->test_input($_POST['txt_edit_telefono']);
            $domicilio  = $valida->test_input($_POST['txt_edit_domicilio']);
            $ciudad     = $valida->test_input($_POST['txt_edit_ciudad']);
            $client->setId($id);
            $client->setNombre($nombre);
            $client->setCorreo($correo);
            $client->setRfc($rfc);
            $client->setTelefono($tel);
            $client->setDomicilio($domicilio);
            $client->setCiudad($ciudad);
            $client->Editar();
            exit();
        }else if(isset($_POST['getTabla'])){
            $client = new cliente();
            $client->getTablaClientes("");
            exit();
        }
        else if(isset($_POST['getListJSON'])){
            $client = new cliente();
            echo $client->getArrayClientesJSON();
            exit();
        }
    }

?>