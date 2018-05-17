<?php
    include_once("ValidarSesion.php");
    include_once("Clases/conexion.php");
    include_once("Clases/usuario.php");
    include_once("Clases/puesto.php");
    include_once("Clases/producto.php");
    include_once("Clases/caja.php")
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
    <link rel="stylesheet" href="css/grid-style.css">
    <script src="js/puntodeventa.js"></script>    
    <title>Punto de venta</title>
</head>
<body>
    <!--#region HEADER -->
        <form id='uploadImg' name='uploadImg' action="procesa_upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileToUpload" name="fileToUpload" class="inputFileLogo" onchange="uploadFoto()">
            <input type="hidden" id="updatePhotoId" name="updatePhotoId">
        </form>
        <?php include_once("header.php"); ?>

    <!--#endregion-->
    
    <main id="PuntoDeVenta" class="hidden">
    <div class="grid-container">
            <div class="grid-main table-container">
                    <table id='tabla_productos' style="max-height: 200px;" class='table table-hover table-striped'>
                            <thead>
                            <tr>
                            <th>Codigo</th>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Precio U.</th>
                            <th>Monto</th>
                            <th>Canc</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                                                                        
                            </tbody> 
                        </table>
            </div>

            <div class="grid-promocional">
                <!-- CARGAR PROMOCIONES -->
                <img class="mySlides" src="img/promocionales/promo1.png" style="margin: auto; padding:0px;" width="350px" height="auto">
                <img class="mySlides" src="img/promocionales/promo2.png" style="margin: auto; padding:0px;" width="350px" height="auto">
                <img class="mySlides" src="img/promocionales/promo3.png" style="margin: auto; padding:0px;" width="350px" height="auto">
            </div>


            <div class="grid-totales">
                <div class="grid-container-totales">
                    <div id="totalAcumulado" style="border-bottom:1px solid black">
                        $<span id="lbl_totalDinero">00.00</span> <br>
                        <span>total</span> 
                    </div>
                    <div id="datosVenta" style="border-bottom:1px solid black">
                        Caja:   
                        <span id="lbl_caja">0
                        </span><br>
                        Cajero: <span id="lbl_cajero"><?php echo $usrLogged->getNombre(); ?></span><br>
                        Total Articulos: <span id="lbl_totalArticulos">0</span><br>
                    </div>
                    <div id="datosCliente">
                        Cliente: <span id="lbl_cliente">General</span>
                    </div>
                </div>
            </div>


            <div class="grid-codigo">
                <div class="container input-group">
                    <input type="text" class="form-control mayusculas" id="txt_Buscador" name="txt_Buscador" onkeyup="" placeholder="Codigo..." autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="" id="btnBuscar" name="btnBuscar" onclick="addProduct()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>


            <div class="grid-pagar">
                <input type="button" id="btnPagar" name="btnPagar" class="btn btn-success" value="Pagar" onclick="registrarVenta();">
            </div>
            </div>     
    </main>
    


    <!-- Modal Select Caja-->
        <div id="modalCaja" class="" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Seleccionar caja</h4>
                        <button type="button" id="modalCajaClose" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    <div class="modal-body">                        
                        <!-- ID -->
                        <?php 
                            $cajas = new caja();
                            $cajas->getCboxCajas("cboxCajas");
                        ?>
                        
                    <div class="modal-footer">
                        <input type="button" value="Seleccionar" id="btnSeleccionar" name="btnSeleccionar" class="btn btn-primary" onclick="establecerCaja()">
                        </div>
                </div>

            </div>
        </div>


    <script>
            var myIndex = 0;
            carousel();
            
            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";  
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
                setTimeout(carousel, 2000); // Change image every 2 seconds
            }
    </script>
</body>
</html>