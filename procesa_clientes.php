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
            $ciudad  = $valida->test_input($_POST['txt_ciudad']);

            $client->setNombre($nombre);
            $client->setRfc($rfc);
            $client->setTelefono($tel);
            $client->setDomicilio($domicilio);
            $client->setCiudad($ciudad);
            $client->Insertar();
        }
        else if ( isset($_POST['btnEliminar'])){
            $id = $valida->test_input($_POST['lbl_ID']);
            $client = new cliente();
            $client->setId($id);
            $client->Eliminar();
        }
    }

?>