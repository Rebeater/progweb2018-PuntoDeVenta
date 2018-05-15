<?php 
    include_once("Clases/conexion.php");
    include_once("Clases/usuario.php");
    include_once("Clases/puesto.php");
    include_once("ValidarSesion.php");
    include_once("Clases/producto.php");
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
    <script src="js/productos.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Mantenimiento Productos</title>
</head>

<body>
    <form id='uploadImg' name='uploadImg' action="procesa_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="fileToUpload" name="fileToUpload" class="inputFileLogo" onchange="uploadFoto()">
        <input type="hidden" id="updatePhotoId" name="updatePhotoId">
    </form>
    <?php include_once("header.php"); ?>

    <crumb>
        <span>Inicio > Productos</span>
    </crumb>

    <!-- Titulo de la pantalla -->
    <h2 class="container">Productos</h2>

    <div class="container input-group">
        <input type="text" class="form-control" id="txt_Buscador" name="txt_Buscador" onkeyup="onKeyDownHandler(event);" placeholder="Escribe el concepto del producto o parte de este para realizar una busqueda..."
            autocomplete="off">
        <div class="input-group-btn">
            <button class="btn btn-default" type="" id="btnBuscar" name="btnBuscar" onclick="buscarByEmail()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <br>
    <form id='productosList' name='productosList' action="procesa_productos.php" class="container" method="POST">
        <!-- Add producto link -->
        <a data-toggle="modal" href="#myModal">Agregar nuevo producto</a>

        <!-- users table -->
        <div id="divProducts" name="divProducts">
        </div>

    </form>

    <!-- Trigger the modal with a button -->

    <!-- Modal NEW PRODUCTO-->
        <form id='productoNew' name='productoNew' action="procesa_productos.php" method="POST">
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Insertar producto</h4>
                        <button type="button" id="modalNewClose" class="close" data-dismiss="modal">&times;</button>
                     </div>

                    <div class="modal-body">

                        <!-- ID -->
                        <label class="sr-only" for="txt_id">Id</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Id</div>
                            </div>
                            <input type="text" class="form-control mayusculas" name="txt_id" id="txt_id" placeholder="Id" >
                        </div>

                        <!-- Concepto -->                        
                        <label class="sr-only" for="txt_concepto">Concepto</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Concepto</div>
                            </div>
                            <input type="text" class="form-control" name="txt_concepto" id="txt_concepto" placeholder="Concepto" maxlength="255" required>
                        </div>

                        <!-- Stock -->                        
                        <label class="sr-only" for="txt_stock">Stock</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Stock</div>
                            </div>
                            <input type="number" class="form-control" name="txt_stock" id="txt_stock" placeholder="Stock" maxlength="255" required>
                        </div>

                        <!-- Precio Unitario -->                        
                        <label class="sr-only" for="txt_precioUnitario">Precio Unitario</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Precio Unitario</div>
                            </div>
                            <input type="number" class="form-control" name="txt_precioUnitario" step='0.01' value='0.00' id="txt_precioUnitario" placeholder="Precio Unitario"   max="9999999999"  required>
                        </div>
                     </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Insertar" id="btnInsertar" name="btnInsertar" class="btn btn-success" onclick="createProductAJAX()">
                     </div>
                </div>

            </div>
            </div>
        </form>
    <!-- Modal EDIT USER-->
        <form id='productoEdit' name='productoEdit' action="procesa_productos.php" method="POST">
        <div id="modalEdit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar producto</h4>
                        <button type="button" id="modalEditClose" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    <div class="modal-body">
                    <input type="hidden" id="hiddenEdit_ID" name="hiddenEdit_ID">
                        
                        <!-- ID -->
                        <label class="sr-only" for="txt_edit_id">Id</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Id</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_id" id="txt_edit_id" placeholder="Id">
                        </div>
                        
                        <!-- Concepto -->                        
                         <label class="sr-only" for="txt_edit_concepto">Concepto</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Concepto</div>
                            </div>
                            <input type="text" class="form-control" name="txt_edit_concepto" id="txt_edit_concepto" placeholder="Concepto" maxlength="255" required>
                        </div>

                        <!-- Stock -->                        
                        <label class="sr-only" for="txt_edit_stock">Stock</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Stock</div>
                            </div>
                            <input type="number" class="form-control" name="txt_edit_stock" id="txt_edit_stock" placeholder="Stock" maxlength="255" required>
                        </div>

                        <!-- Precio Unitario -->                        
                        <label class="sr-only" for="txt_edit_precioUnitario">Precio Unitario</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Precio Unitario</div>
                            </div>
                            <input type="number" class="form-control" name="txt_edit_precioUnitario" id="txt_edit_precioUnitario"  step='0.01' value='0.00'  placeholder="Precio Unitario"   max="9999999999"  required>
                        </div>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Actualizar" id="btnActualizar" name="btnActualizar" class="btn btn-primary" onclick="updateTableProducts()">
                        </div>
                </div>

            </div>
        </div>
     </form>

    <!-- Modal DELETE USER-->
      <form id='productoDelete' name='productoDelete' action="procesa_productos.php" method="POST">
        <div id="modalDelete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">¿Eliminar producto?</h4>
                        <button type="button" id="modalDeleteClose" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="lbl_ID" name="lbl_ID"> ID:
                        <label id="lbl_id">id</label>
                        <br> Concepto:
                        <label id="lbl_concepto">Concepto</label>
                        <br> Stock:
                        <label id="lbl_stock">Stock</label>
                        <br> Precio Unitario:
                        <label id="lbl_precioUnitario">Precio Unitario</label>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="button" value="Confirmar" id="btnEliminar" name="btnEliminar" class="btn btn-danger" onclick="deleteProductAJAX()">
                    </div>
                </div>

            </div>
        </div>
    </form>
</body>
</html>