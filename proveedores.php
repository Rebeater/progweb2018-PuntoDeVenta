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

          <div class="container">
        <crumb>
          <span>Inicio > Proveedores</span>
        </crumb>

        <h2>Proveedores </h2>
        <!-- Buscador -->
        <!-- Bscador <input type="text" id="txt_Buscador" name="txt_Buscador" class="buscador" onKeyUp="buscar();" placeholder="Escribe el nombre del usuario o parte de este para realizar una busqueda...">
        <input type="submit" class="btn btn-default" id="btnBuscar"    name="btnBuscar" value="Buscar">-->
        <div class="input-group">
          <input type="text" class="form-control" id="txt_Buscador" href='js/proveedores.js:;' name="txt_Buscador" onKeyUp="onKeyDownHandler();" placeholder="Escriba el nombre del proveedor o la razón social para realizar una busqueda...">
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
                <button type="button" id="modalNewClose" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body">            
                <label class="sr-only" for="txt_nombre">Nombre</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Nombre</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_nombre" id="txt_nombre" placeholder="Nombre" size="40" maxlength="40" autofocus>
                </div>

                <label class="sr-only" for="txt_telefono">Teléfono</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Teléfono</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_telefono" id="txt_telefono" size="10" placeholder="Teléfono" maxlength="10">
                </div>

                <label class="sr-only" for="txt_nombre_social">Razón social</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Razón social</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_nombre_social" id="txt_nombre_social" placeholder="Razón social" maxlength="20">
                </div>

                <label class="sr-only" for="txt_ciudad">Ciudad</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Ciudad</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_ciudad" id="txt_ciudad" placeholder="Ciudad">
                </div>

                    
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button value="Insertar" id="btnInsertar"  name="btnInsertar" class="btn btn-success" onClick="createProveedorAJAX()">Insertar</button>
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
                <button type="button" id="modalEditClose" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">            
              <input type="hidden" id="hiddenEdit_ID" name="hiddenEdit_ID">

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
                  <input type="text" class="form-control"  name="txt_edit_telefono" id="txt_edit_telefono" placeholder="Teléfono" maxlength="10">
                </div>

                <label class="sr-only" for="txt_edit_nombre_social">Razón social</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Razón social</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_edit_nombre_social" id="txt_edit_nombre_social" placeholder="Razón social">
                </div>

                <label class="sr-only" for="txt_edit_ciudad">Ciudad</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Ciudad</div>
                  </div>
                  <input type="text" class="form-control"  name="txt_edit_ciudad" id="txt_edit_ciudad" placeholder="Ciudad">
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="button" value="Actualizar" id="btnActualizar"  name="btnActualizar" class="btn btn-primary" onclick="updateTableProveedores()" >
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
                <button type="button" id="modalDeleteClose" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">            
                    <input type="hidden" id="lbl_ID" name="lbl_ID">
                    ID:
                    <label id="lbl_id">id</label>
                    <br>Nombre: 
                    <label id="lbl_nombre">nombre</label>
                    <br> Teléfono:
                    <label id="lbl_telefono">Teléfono</label>
                    <br> Razón Social:
                    <label id="lbl_nombre_social">Nombre Social</label>
                    <br> Ciudad:
                    <label id="lbl_ciudad">Ciudad</label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="submit" value="Confirmar" id="btnEliminar"  name="btnEliminar" class="btn btn-danger" onClick = "deleteProveedorAJAX()" >
              </div>
            </div>

          </div>
        </div>
        </div>  
</body>
</html>


