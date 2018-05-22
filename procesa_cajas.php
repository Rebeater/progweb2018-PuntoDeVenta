<?php
    include_once("Clases/producto.php");
    include_once("Clases/validaciones.php");
    include_once("Clases/caja.php");
    session_start();    
    
    $valida = new validaciones();
    
    $caja = new caja();
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        $mi_error = false;
        
         if ( isset($_POST['setCaja'])){ 
            $cajaStr = "error";
            $_SESSION['CajaActiva'] =  $valida->test_input($_POST['setCaja']);
            $cajaStr = $_SESSION['CajaActiva'];
            if($cajaStr != "error"){
                $caja = new caja($cajaStr);
                $caja->actualizarCampo("usuarioActivo",$_SESSION["idUsuario"]);
            }
            echo $cajaStr;
            exit();
        }
        else if(isset($_POST['validaCajaActiva'])){
             
            
            if(isset($_SESSION['CajaActiva']))
            {
                if($_SESSION['CajaActiva'] == ""){
                    echo "";
                }
                else
                    echo $_SESSION['CajaActiva'];
            }
            else {
                echo '';
            }
            exit();
        }
    }

?>