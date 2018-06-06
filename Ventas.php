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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid-ventas.css">
    <script src="js/ventas.js"></script>
    <title>Document</title>
</head>
<body>
    <crumb>
        <span>Inicio > Productos</span>
    </crumb>
    <!-- Titulo de la pantalla -->
    <h2 class="container">Listado de Ventas </h2>
<div class="container grid-container">
    <label for="date_Desde"                  name="lbl_Desde"  id="lbl_Desde">Desde</label>
    <input type="date" class="form-control" name="date_Desde" id="date_Desde">

    <label for="date_Hasta"                  name="lbl_Hasta" id="lbl_Hasta" >Hasta</label>
    <input type="date" class="form-control" name="date_Hasta" id="date_Hasta">

    <label for="cbox_cliente"     name="lbl_Cliente"  id="lbl_Cliente">Cliente</label>
    
    <select  class="form-control" name="cbox_Cliente" id="cbox_Cliente"></select>

    <button class="form-control btn btn-primary" name="btnBuscar" id="btnBuscar">Buscar</button>

    <label for="txtVentasTotales"            name="lbl_VentasTotales" id="lbl_VentasTotales">Ventas totales</label>
    <input type="text" class="form-control"  name="txt_VentasTotales"  id="txt_VentasTotales" >
    <label for="txtImporteTotal"             name="lbl_ImporteTotal"  id="lbl_ImporteTotal">Importe Total</label>
    <input type="money" class="form-control" name="txt_ImporteTotal"   id="txt_ImporteTotal" >

    <div id="tablaVentas">
        <div class='table-container'>
            <table id='tabla_clientes' class='table table-hover table-striped table-rwd'>
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Fecha</th>
                        <th>Productos </th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='1'>
                        <td id='id_row1' style='text-align:center'></td>
                        <td> <span id='nombre_row1'></span></td>
                        <td> <span id='rfc1'> </span> </td>
                        <td> <span id='correo_row1'></span></td>
                        <td> <span id='telefono1'></span></td>
                        <td> <span id='domicilio_row1'></span></td>
                        <td> <span id='ciudad_row1'></span></td>
                    </tr>
                </tbody> 
            </table>
        </div>
    </div>

</div>
</body>
</html>
