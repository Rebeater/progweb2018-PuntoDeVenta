<?php 
    include_once("Clases/conexion.php");
    include_once("Clases/usuario.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mantenimiento Usuarios</title>
    <meta http-equiv="cache-control" content="no-cache"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Cargar Head -->

    <div class="container">
        <h2>Usuarios</h2>
        <input class="buscador" type="text" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
        <input type="submit" value="Buscar">
        <br>
        <a href="#">Agregar nuevo usuario</a>
        <div class="col">
            <?php  
                $user = new usuario();
                $user->LeerTodo();
            ?>
        </div>
    </div>


</body>
</html>


