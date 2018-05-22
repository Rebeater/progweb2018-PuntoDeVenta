<?php
    include_once("Clases/caja.php");
    session_start();
    
    //region LIBERAR LA CAJA AL CERRAR SESIÓN
    if(isset($_SESSION['CajaActiva'])){
        if($_SESSION['CajaActiva'] != ""){
            $caja = new caja(isset($_SESSION['CajaActiva']));
            $caja->actualizarCampo("usuarioActivo","");
            $caja->actualizarCampo("ultimoUsuario",$_SESSION["idUsuario"]);
        }
    }
    //endregion





    session_destroy();
    header("location:Login.php");
?>