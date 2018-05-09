<?php
include_once("ValidarUsuario.php");
    $valUsu = new ValidarUsuario();
    $valUsu->login($_POST["correo"], $_POST["contraseña"]);
    if(!isset($_SESSION["puesto"]))
        header("location:Login.php"); 
?>
