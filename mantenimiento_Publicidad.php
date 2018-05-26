<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">
    <script src="js/bootstrap-toggle.js"></script>
    <script src="js/publicidad.js"></script>
    <link rel="stylesheet" href="css/bootstrap-toggle.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid-style.css">
    <title>Mantenimiento Publicidad</title>
</head>
<body>
    <crumb>
        <span>Inicio > Publicidad</span>
    </crumb>
    
    <!-- Titulo de la pantalla -->
    <h2 class="container">Publicidad</h2>
    
    <form id='productosList' name='productosList' action="procesa_productos.php" class="container" method="POST">
        
        <a data-toggle="modal" href="#myModal">Agregar nuevo publicidad</a>
        
        <div style="margin-top: 2em"  id="divPublicidad" name="divPublicidad" class="grid-container-publicidad">
    
            <!-- Card Prueba
            
                 <div class="card" id="card1" name ="card1" style="width: 18rem;">
                     <img id="card-img1" name="card-img1" class="card-img-top" src="/img/promocionales/promo1.png" alt="Card image cap">
                     <div class="card-body">
                         <h5 id="card-title1" name="card-title1" class="card-title">Promocional 1</h5>
                         <p id="card-text1" name="card-text1" class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro architecto animi quas repellat, quo dolorem est </p>
                         <input id="toggle1" name="toggle1" type="checkbox" checked data-toggle="toggle" data-on="Activo" data-off="No activo" data-onstyle="success" data-offstyle="danger">
                         <button>editar</button>
                     </div>
                 </div>
            -->

            </div>
        </form>  
        <!-- Trigger the modal with a button -->     
        <!-- Modal NEW PRODUCTO-->
        <form id='pubicidadNew' name='pubicidadNew' action="" method="POST">
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Insertar publicidad</h4>
                            <button type="button" id="modalNewClose" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <div class="modal-body">
                            <!-- Titulo-->
                            <label class="sr-only" for="txt_Titulo">Título</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Título</div>
                                </div>
                                <input type="text" class="form-control" name="txt_Titulo" id="txt_Titulo" placeholder="Título" >
                            </div>
                            
                            <!-- Descripcion -->
                            <label class="sr-only" for="txt_Descripcion">Descripcion</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Descripcion</div>
                                </div>
                                <input type="text" class="form-control" name="txt_Descripcion" id="txt_Descripcion" placeholder="Descripcion" >
                            </div>

                            <!-- img -->
                                <div  class="input-group-text" >Imagen</div>
                                <input  style="margin-top: .6em; margin-left:1em " type="file" id="publicidadfileToUpload" name="publicidadfileToUpload">
                                <input type="hidden" id="updatePhotoIdPublicidad" name="updatePhotoIdPublicidad">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <input type="button" value="Insertar" id="btnInsertar" name="btnInsertar" class="btn btn-success" onclick=" createPublicidad()">
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
                                        
                                        <!-- Descuento -->                        
                                        <label class="sr-only" for="txt_edit_descuento">Descuento</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Descuento (%)</div>
                                            </div>
                                            <input type="number" class="form-control" name="txt_edit_descuento" step='1' value='0' id="txt_edit_descuento" placeholder="Descuento"   max="100"  required>
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