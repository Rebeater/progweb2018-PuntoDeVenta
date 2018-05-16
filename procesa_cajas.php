<?php
    include_once("Clases/producto.php");
    include_once("Clases/validaciones.php");
    session_start();    

    $valida = new validaciones();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        $mi_error = false;

         /* Si la opcion es Buscar*/
         if ( isset($_POST['setCaja'])){ 
            $caja = "error";
            $_SESSION['CajaActiva'] =  $valida->test_input($_POST['setCaja']);
            $caja = $_SESSION['CajaActiva'];
            echo $caja;
            exit();
        }
    }

?>