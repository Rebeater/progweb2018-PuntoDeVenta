<?php
    include_once("Clases/venta.php");
    include_once("Clases/validaciones.php");

    $valida = new validaciones();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
            $mi_error = false;

            /* Si la opcion es Buscar*/
         if ( isset($_POST['insertarVenta'])){ 
            $venta = new venta();
            
            $venta->setCliente($_POST["cliente"]);
            $venta->setVendedor($_POST["vendedor"]);
            $venta->setFecha($_POST["fecha"]);
            $venta->setTotal( $_POST["total"]);
            
            echo $venta->Insertar();

            exit();
        }
        else if ( isset($_POST['insertarVentas'])){ 
            $idVenta = $_POST["idVenta"];
            $idProducto = $_POST["idProducto"];
            $cantidad = $_POST["cantidad"];
            $venta = new venta();


            $venta->InsertarRegistroVenta($idVenta, $idProducto, $cantidad);
            exit();
         }
    }
?>