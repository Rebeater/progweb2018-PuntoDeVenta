<?php
    include_once("Clases/venta.php");
    include_once("Clases/validaciones.php");
    session_start();
    $valida = new validaciones();
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
            $mi_error = false;

            /* Si la opcion es Buscar*/
         if ( isset($_POST['insertarVenta'])){ 
            $venta = new venta();
            
            $venta->setCliente($_POST["cliente"]);
            $venta->setVendedor($_POST["vendedor"]);
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
         else if (isset($_POST['guardarVenta'])){ 
            if($_POST["guardarVenta"] != '[]') 
            {
                $ventaGuardada =  $_POST["guardarVenta"];
            
                $cliente =  $_POST["cliente"];
                $_SESSION['ventaGuardada'] = $ventaGuardada;            
                $_SESSION['ventaGuardadaClient'] = $cliente;
                //echo $cliente;// $_SESSION['ventaGuardada'];            
            }
            else{
                $_SESSION['ventaGuardada'] = null;
            }
            exit();
         }
         else if ( isset($_POST['recuperarVenta'])){ 
            if(isset($_SESSION['ventaGuardada'])){                
                echo $_SESSION['ventaGuardada'];
                exit();
            }
            echo "venta no definida";
            exit();
         }
         else if(isset($_POST['getVentaGuardadaClient'])){
            if(isset($_SESSION['ventaGuardadaClient'])){
                echo $_SESSION['ventaGuardadaClient'];
            }
            exit();
         }
    }
?>