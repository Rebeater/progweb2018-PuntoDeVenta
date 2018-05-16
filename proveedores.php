<?php 
    include_once("Clases/conexion.php");
    include_once("Clases/mantenimiento_proveedores.php");
    include_once("Clases/puesto.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mantenimiento proveedores</title>
    <meta http-equiv="cache-control" content="no-cache"/>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">    
    <script src="js/proveedores.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include_once("header.php"); ?>

  <form id='proveedoresList' name='proveedoresList' action="procesa_proveedores.php" class="container" method="POST">
        
    <crumb>
      <span>Inicio > Proveedores</span>
    </crumb>

    <h2>Proveedores </h2>
    <!-- Buscador -->
    <!-- Bscador <input type="text" id="txt_Buscador" name="txt_Buscador" class="buscador" onKeyUp="buscar();" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
    <input type="submit" class="btn btn-default" id="btnBuscar"    name="btnBuscar" value="Buscar">-->
    <div class="input-group">
      <input type="text" class="form-control" id="txt_Buscador" href='js/proveedores.js:;' name="txt_Buscador" onKeyUp="buscar();" placeholder="Escriba el id a buscar...">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit" id="btnBuscar" name="btnBuscar" onClick = "buscarProveedor();">
        <i class="fas fa-search"></i>
        </button>
      </div>
    </div><br>

    <!-- Add user link -->
    <a data-toggle="modal" href="#myModal">Nuevo proveedor</a>

    <!-- users table -->
    <div id="divUsers" name="divUsers" class="col">
        <?php  
            $user = new mantenimiento_proveedores();
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
        <h4 class="modal-title">Ingresar proveedor</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">            
      
      
        <!--<label class="sr-only" for="txt_correo">ID</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">ID</div>
          </div>
          <input type="text" class="form-control"  name="txt_id" id="txt_id" placeholder="ID" size="5" maxlength="5">
        </div>-->
            
        <label class="sr-only" for="txt_contrasena">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre</div>
          </div>
          <input type="text" class="form-control"  name="txt_nombre" id="txt_nombre" placeholder="Nombre" size="40" maxlength="40" >
        </div>

        <label class="sr-only" for="txt_telefono">Teléfono</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Teléfono</div>
          </div>
          <input type="number" class="form-control"  name="txt_telefono" id="txt_telefono" size="10" placeholder="Teléfono" maxlength="10">
        </div>

        <label class="sr-only" for="txt_nombre_social">Nombre social</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre social</div>
          </div>
          <input type="text" class="form-control"  name="txt_nombre_social" id="txt_nombre_social" placeholder="nombre social" maxlength="20">
        </div>

        <label class="sr-only" for="ciudad">Ciudad</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Ciudad</div>
          </div>
          <input type="text" class="form-control"  name="ciudad_proveedor" id="ciudad_proveedor" placeholder="Ciudad">
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
        <h4 class="modal-title">Editar proveedor</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">            


<label class="sr-only" for="txt_edit_id">Id</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Id</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_id" id="txt_edit_id"  readonly placeholder="Id">
        </div>
            
        <label class="sr-only" for="txt_edit_nombre">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_nombre" id="txt_edit_nombre" placeholder="Nombre">
        </div>

        <label class="sr-only" for="txt_edit_telefono">Teléfono</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Teléfono</div>
          </div>
          <input type="number" class="form-control"  name="txt_edit_telefono" id="txt_edit_telefono" placeholder="Teléfono">
        </div>

        <label class="sr-only" for="txt_edit_nombre_social">Nombre social</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre social</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_nombre_social" id="txt_edit_nombre_social" placeholder="nombre social">
        </div>

        <label class="sr-only" for="txt_edit_ciudad">Ciudad</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Ciudad</div>
          </div>
          <input type="text" class="form-control"  name="txt_edit_ciudad" id="date_edit_Nacimiento" placeholder="Ciudad">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="button" value="Actualizar" id="btnActualizar"  name="btnActualizar" class="btn" onclick="updateTableUsers()" >
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" value="Confirmar" id="btnEliminar"  name="btnEliminar" class="btn" >
      </div>
    </div>

  </div>
</div>
    </form>
</body>
</html>

