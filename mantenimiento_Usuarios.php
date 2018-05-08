<?php 
    include_once("Clases/conexion.php");
    include_once("Clases/usuario.php");
    include_once("Clases/puesto.php");
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
    <script src="js/usuarios.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include_once("header.php"); ?>
    
    <form id='usuariosList' name='usuariosList' action="procesa_Usuarios.php" class="container" method="POST">
        
        <crumb>
          <span>Inicio > Usuarios</span>
        </crumb>




        <h2>Usuarios</h2>
        <!--<input type="text" id="txt_Buscador" name="txt_Buscador" class="buscador" onKeyUp="buscar();" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
        <input type="submit" class="btn btn-default" id="btnBuscar"    name="btnBuscar" value="Buscar">-->
        <div class="input-group">
    <input type="text" class="form-control" id="txt_Buscador" name="txt_Buscador" onKeyUp="buscar();" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit" id="btnBuscar"    name="btnBuscar">
      <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
        <br>
        <a data-toggle="modal" href="#myModal">Agregar nuevo usuario</a>
        <div id="divUsers" name="divUsers" class="col">
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
      
      
        <label class="sr-only" for="txt_correo">Correo</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Correo</div>
          </div>
          <input type="text" class="form-control"  name="txt_correo" id="txt_correo" placeholder="Correo">
        </div>

        <label class="sr-only" for="txt_contrasena">Contraseña</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Contraseña</div>
          </div>
          <input type="password" class="form-control"  name="txt_contrasena" id="txt_contrasena" placeholder="Contraseña">
        </div>
            
        <label class="sr-only" for="txt_contrasena">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre</div>
          </div>
          <input type="text" class="form-control"  name="txt_nombre" id="txt_nombre" placeholder="Nombre">
        </div>

            <?php 
              $puesto = new puesto();
              $puesto->LeerTodo("cbx_puesto");
            ?>
        <label class="sr-only" for="txt_telefono">Teléfono</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Teléfono</div>
          </div>
          <input type="number" class="form-control"  name="txt_telefono" id="txt_telefono" placeholder="Teléfono">
        </div>

        <label class="sr-only" for="txt_domicilio">Domicilio</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Domicilio</div>
          </div>
          <input type="text" class="form-control"  name="txt_domicilio" id="txt_domicilio" placeholder="Domicilio">
        </div>

        <label class="sr-only" for="date_Nacimiento">Fecha Nacimiento</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Fecha Nacimiento</div>
          </div>
          <input type="date" class="form-control"  name="date_Nacimiento" id="date_Nacimiento" placeholder="Fecha Nacimiento">
        </div>

            
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


<label class="sr-only" for="txt_edit_nombre">Id</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Id</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_id" id="txt_edit_id"  readonly placeholder="Id">
        </div>

      <label class="sr-only" for="txt_edit_correo">Correo</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Correo</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_correo" id="txt_edit_correo" placeholder="Correo">
        </div>

        <label class="sr-only" for="txt_edit_contrasena">Contraseña</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Contraseña</div>
          </div>
          <input type="password" class="form-control"  name="txt_edit_contrasena" id="txt_edit_contrasena" placeholder="Contraseña">
        </div>
            
        <label class="sr-only" for="txt_edit_nombre">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_nombre" id="txt_edit_nombre" placeholder="Nombre">
        </div>

            
            <?php 
              $puesto = new puesto();
              $puesto->LeerTodo("cbx_edit_puesto");
            ?>


        <label class="sr-only" for="txt_edit_telefono">Teléfono</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Teléfono</div>
          </div>
          <input type="number" class="form-control"  name="txt_edit_telefono" id="txt_edit_telefono" placeholder="Teléfono">
        </div>

        <label class="sr-only" for="txt_edit_domicilio">Domicilio</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Domicilio</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_domicilio" id="txt_edit_domicilio" placeholder="Domicilio">
        </div>

        <label class="sr-only" for="date_edit_Nacimiento">Fecha Nacimiento</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Fecha Nacimiento</div>
          </div>
          <input type="date" class="form-control"  name="date_edit_Nacimiento" id="date_edit_Nacimiento" placeholder="Fecha Nacimiento">
        </div>

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


