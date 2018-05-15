<?php 
    include_once("Clases/conexion.php");
    include_once("Clases/usuario.php");
    include_once("Clases/puesto.php");
    include_once("ValidarSesion.php");
    include_once("Clases/cliente.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache"/>

    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">    
    <script src="js/clientes.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Mantenimiento Clientes</title>
</head>
<body>
    <form id='uploadImg' name='uploadImg' action="procesa_upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileToUpload"  name="fileToUpload" class="inputFileLogo" onchange="uploadFoto()">
            <input type="hidden" id="updatePhotoId" name="updatePhotoId">
    </form>
    <?php include_once("header.php"); ?>

    <crumb>
        <span>Inicio > Clientes</span>
    </crumb>
    
    <!-- Titulo de la pantalla -->
    <h2 class="container">Clientes</h2>

    <div class="container input-group">
      <input type="text" class="form-control" id="txt_Buscador" name="txt_Buscador" onkeyup="onKeyDownHandler(event);" placeholder="Escribe el nombre del cliente o parte de este para realizar una busqueda..." autocomplete="off">
      <div class="input-group-btn">
        <button class="btn btn-default" type="" id="btnBuscar"  name="btnBuscar" onclick="buscarByEmail()">
            <i class="fas fa-search"></i>
        </button>
      </div>
    </div><br>
    <form id='clientesList' name='clientesList' action="procesa_clientes.php" class="container" method="POST">
    <!-- Add cliente link -->
    <a data-toggle="modal" href="#myModal">Agregar nuevo cliente</a>

    <!-- users table -->
    <div id="divClients" name="divClients">
        <?php  
            $client = new cliente();
            $client->getTablaClientes();
        ?>
    </div>

    

    <!-- Trigger the modal with a button -->


<!-- Modal NEW USER-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Insertar cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">            
      
      
        <label class="sr-only" for="txt_rfc">RFC</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">RFC</div>
          </div>
          <input type="text" class="form-control mayusculas"  name="txt_rfc" id="txt_rfc" placeholder="RFC" maxlength="13">
        </div>

       
            
        <label class="sr-only" for="txt_nombre">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Nombre</div>
          </div>
          <input type="text" class="form-control"  name="txt_nombre" id="txt_nombre" placeholder="Nombre" maxlength="255">
        </div>
            
        <label class="sr-only" for="txt_telefono">Teléfono</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Teléfono</div>
          </div>
          <input type="number" class="form-control"  name="txt_telefono" id="txt_telefono" placeholder="Teléfono" max="9999999999">
        </div>

        <label class="sr-only" for="txt_domicilio">Domicilio</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Domicilio</div>
          </div>
          <input type="text" class="form-control"  name="txt_domicilio" id="txt_domicilio" placeholder="Domicilio" maxlength="255">
        </div>

        <label class="sr-only" for="txt_ciudad">Ciudad</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">Ciudad</div>
          </div>
          <input type="text" class="form-control"  name="txt_ciudad" id="txt_ciudad" placeholder="Ciudad" maxlength="255">
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
      
      
      <img alt="" id="photo-EditUsr" height="120" width="120" src='img/perfiles/user.png' onclick="cambiarFoto(document.getElementById('txt_edit_id').value)" >
      


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
          <div class="input-group-btn">
          <i id="icon-pass" class="fas fa-lock" onclick="iconpass()"></i>
          </div>
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
            Nombre: <label id="lbl_nombre">Nombre</label><br>
            RFC: <label id="lbl_rfc">RFC</label>
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