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
    <meta http-equiv="cache-control" content="no-cache" />

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
        <input type="file" id="fileToUpload" name="fileToUpload" class="inputFileLogo" onchange="uploadFoto()">
        <input type="hidden" id="updatePhotoId" name="updatePhotoId">
    </form>
    <?php include_once("header.php"); ?>

    <crumb>
        <span>Inicio > Clientes</span>
    </crumb>

    <!-- Titulo de la pantalla -->
    <h2 class="container">Clientes</h2>

    <div class="container input-group">
        <input type="text" class="form-control" id="txt_Buscador" name="txt_Buscador" onkeyup="onKeyDownHandler(event);" placeholder="Escribe el nombre del cliente o parte de este para realizar una busqueda..."
            autocomplete="off">
        <div class="input-group-btn">
            <button class="btn btn-default" type="" id="btnBuscar" name="btnBuscar" onclick="buscarByEmail()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <br>
    <form id='clientesList' name='clientesList' action="procesa_clientes.php" class="container" method="POST">
        <!-- Add cliente link -->
        <a data-toggle="modal" href="#myModal">Agregar nuevo cliente</a>

        <!-- users table -->
        <div id="divClients" name="divClients">
        </div>

    </form>


    <!-- Trigger the modal with a button -->


    <!-- Modal NEW USER-->
        <form id='clienteNew' name='clienteNew' action="procesa_clientes.php" method="POST">
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Insertar cliente</h4>
                        <button type="button" id="modalNewClose" class="close" data-dismiss="modal">&times;</button>
                     </div>

                    <div class="modal-body">
                        <label class="sr-only" for="txt_rfc">RFC</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">RFC</div>
                            </div>
                            <input type="text" class="form-control mayusculas" name="txt_rfc" id="txt_rfc" placeholder="RFC" maxlength="13" minlength="12"
                                required>
                        </div>

                        <label class="sr-only" for="txt_nombre">Nombre</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nombre</div>
                            </div>
                            <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre" maxlength="255" required>
                        </div>

                        <label class="sr-only" for="txt_correo">Correo</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Correo</div>
                            </div>
                            <input type="email" class="form-control" name="txt_correo" id="txt_correo" placeholder="Correo" maxlength="255" required>
                        </div>

                        <label class="sr-only" for="txt_telefono">Teléfono</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Teléfono</div>
                            </div>
                            <input type="number" class="form-control" name="txt_telefono" id="txt_telefono" placeholder="Teléfono" max="9999999999">
                        </div>

                        <label class="sr-only" for="txt_domicilio">Domicilio</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Domicilio</div>
                            </div>
                            <input type="text" class="form-control" name="txt_domicilio" id="txt_domicilio" placeholder="Domicilio" maxlength="255">
                        </div>

                        <label class="sr-only" for="txt_ciudad">Ciudad</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Ciudad</div>
                            </div>
                            <input type="text" class="form-control" name="txt_ciudad" id="txt_ciudad" placeholder="Ciudad" maxlength="255">
                        </div>


                     </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Insertar" id="btnInsertar" name="btnInsertar" class="btn btn-success" onclick="createClientAJAX()">
                     </div>
                </div>

            </div>
            </div>
        </form>
    <!-- Modal EDIT USER-->
        <form id='clienteEdit' name='clienteEdit' action="procesa_clientes.php" method="POST">
        <div id="modalEdit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar cliente</h4>
                        <button type="button" id="modalEditClose" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    <div class="modal-body">
                        <!-- ID -->
                        <label class="sr-only" for="txt_edit_id">Id</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Id</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_id" id="txt_edit_id" readonly placeholder="Id">
                        </div>
                        
                        <!-- RFC -->                        
                        <label class="sr-only" for="txt_edit_rfc">RFC</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">RFC</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_rfc" id="txt_edit_rfc" placeholder="RFC" maxlength="13" minlenggth="12" required>
                        </div>

                        <!-- Nombre -->                        
                        <label class="sr-only" for="txt_edit_nombre">Nombre</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Nombre</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_nombre" id="txt_edit_nombre" placeholder="Nombre" maxlength="255" required>
                        </div>

                        <!-- Correo -->
                        <label class="sr-only" for="txt_edit_correo">Correo</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Correo</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_correo" id="txt_edit_correo" placeholder="Correo" maxlength="255" required>
                        </div>

                        <!-- Telefono -->
                        <label class="sr-only" for="txt_edit_telefono">Teléfono</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Teléfono</div>
                            </div>
                            <input type="number" class="form-control" name="txt_edit_telefono" id="txt_edit_telefono" placeholder="Teléfono" max="9999999999">
                        </div>
                        
                        <!-- Domicilio -->
                        <label class="sr-only" for="txt_edit_domicilio">Domicilio</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Domicilio</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_domicilio" id="txt_edit_domicilio" placeholder="Domicilio">
                        </div>

                        <!-- Ciudad -->
                        <label class="sr-only" for="txt_edit_ciudad">Ciudad</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Ciudad</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_ciudad" id="txt_edit_ciudad" placeholder="Ciudad">
                        </div>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Actualizar" id="btnActualizar" name="btnActualizar" class="btn btn-primary" onclick="updateTableClients()">
                        </div>
                </div>

            </div>
        </div>
     </form>

    <!-- Modal DELETE USER-->
      <form id='clienteDelete' name='clienteDelete' action="procesa_clientes.php" method="POST">
        <div id="modalDelete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">¿Eliminar cliente?</h4>
                        <button type="button" id="modalDeleteClose" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="lbl_ID" name="lbl_ID"> ID:
                        <label id="lbl_id">id</label>
                        <br> Nombre:
                        <label id="lbl_nombre">Nombre</label>
                        <br> RFC:
                        <label id="lbl_rfc">RFC</label>
                        <br> Correo:
                        <label id="lbl_correo">Correo</label>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Confirmar" id="btnEliminar" name="btnEliminar" class="btn btn-danger" onclick="deleteClientAJAX()">
                    </div>
                </div>

            </div>
        </div>
    </form>


</body>

</html>