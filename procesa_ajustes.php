<?php
    include_once("Clases/configuracion.php");
    include_once("Clases/validaciones.php");

    $valida = new validaciones();
    $ajustes = new configuracion();

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        $mi_error = false;

         /* Si la opcion es Buscar*/
         if ( isset($_POST['loadData'])){ 
             echo $ajustes->loadData();
             
            exit();
        }
        else if(isset($_POST['saveData'])){
            $ajustes->saveData($_POST['ajustesJSON']);
            exit();
        }
    }

?>