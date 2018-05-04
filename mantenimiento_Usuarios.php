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
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">    
    <link rel="stylesheet" href="css/style.css">
    <script src="js/usuarios.js"></script>
</head>
<body>
    <!-- Cargar Head -->
    <form id='usuariosList' name='usuariosList' action="procesa_Usuarios.php" class="container" method="POST">
    
        <h2>Usuarios</h2>
        <input class="buscador" type="text" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
        <input type="submit" value="Buscar">
        <br>
        <a data-toggle="modal" href="#myModal">Agregar nuevo usuario</a>
        <div class="col">
            <?php  
                $user = new usuario();
                $user->LeerTodo();
            ?>
        </div>

        











    <!-- Trigger the modal with a button -->


<!-- Modal NEW USER-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Insertar usuario</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">            
            <label>Correo</label> <input id="txt_correo" name="txt_correo" type="email" placeholder="Correo"><br>
            <label>Contraseña</label> <input id="txt_contrasena" name="txt_contrasena"  type="password" placeholder="Contraseña"><br>
            <label>Nombre</label> <input id="txt_nombre" name="txt_nombre" type="text" placeholder="Nombre"><br>
            <label>Puesto</label> <input id="cbx_puesto" name="cbx_puesto"  type="text" placeholder="Puesto"><br>
            <label>Teléfono</label> <input id="txt_telefono" name="txt_telefono" type="number" placeholder="Teléfono"><br>
            <label>Domicilio</label> <input id="txt_domicilio" name="txt_domicilio" type="text" placeholder="Domicilio"><br>
            <label>Fecha Nacimiento</label> <input id="date_Nacimiento" name ="date_Nacimiento" type="date">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" value="Insertar" id="btnInsertar"  name="btnInsertar" class="btn">
      </div>
    </div>

  </div>
</div>

    
<!-- Modal EDIT USER-->
<div id="modalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar usuario</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">            
            <label>Id</label> <input id="txt_edit_id" name="txt_edit_id" type="text" readonly><br>
            <label>Correo</label> <input id="txt_edit_correo" name="txt_edit_correo" type="email" placeholder="Correo"><br>
            <label>Contraseña</label> <input id="txt_edit_contrasena" name="txt_edit_contrasena"  type="password" placeholder="Contraseña"><br>
            <label>Nombre</label> <input id="txt_edit_nombre" name="txt_edit_nombre" type="text" placeholder="Nombre"><br>
            <label>Puesto</label> <input id="cbx_edit_puesto" name="cbx_edit_puesto"  type="text" placeholder="Puesto"><br>
            <label>Teléfono</label> <input id="txt_edit_telefono" name="txt_edit_telefono" type="number" placeholder="Teléfono"><br>
            <label>Domicilio</label> <input id="txt_edit_domicilio" name="txt_edit_domicilio" type="text" placeholder="Domicilio"><br>
            <label>Fecha Nacimiento</label> <input id="date_edit_Nacimiento" name ="date_edit_Nacimiento" type="date">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" value="Actualizar" id="btnActualizar"  name="btnActualizar" class="btn">
      </div>
    </div>

  </div>
</div>


<!-- Modal DELETE USER-->
<div id="modalDelete" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">¿Eliminar usuario?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">            
            <input type="hidden" id="lbl_ID" name="lbl_ID">
            ID: <label id="lbl_id">id</label><br>        
            Correo: <label id="lbl_correo">Correo</label><br>
            Nombre: <label id="lbl_nombre">Nombre</label><br>
            Puesto: <label id="lbl_puesto">Puesto</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" value="Confirmar" id="btnEliminar"  name="btnEliminar" class="btn">
      </div>
    </div>

  </div>
</div>









    </form>
</body>
</html>


