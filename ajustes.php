<?php
 include_once("ValidarSesion.php");
?>
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
    <link rel="stylesheet" href="css/grid-style.css">
    <title>Ajustes</title>
</head>
<body>
    <form id='uploadImg' name='uploadImg' action="procesa_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="fileToUpload" name="fileToUpload" class="inputFileLogo" onchange="uploadFoto()">
        <input type="hidden" id="updatePhotoId" name="updatePhotoId">
    </form>
    <?php include_once("header.php"); ?>

    <crumb>
        <span>Inicio > Ajustes</span>
    </crumb>
    <h2 class="container">Ajustes</h2>
<div class="container grid-container-ajustes" >
    
    <div id="div_datosEmpresa" style="grid-area: div_datosEmpresa;">
        <h3>Datos de la empresa</h3>

        <p>Nombre de la empresa</p>
            <input type="text" class="form-control" id="companyName" placeholder="Nombre de la empresa">

        <div id="divDomicilio" class="grid-container-domicilio">
            <p style="grid-area:lblDomicilio">Domicilio</p>
            <input type="text" style="grid-area:pais" class="form-control"  id="txt_pais"      placeholder="País">
            <input type="text" style="grid-area:estado" class="form-control"  id="txt_estado"    placeholder="Estado">
            <input type="text" style="grid-area:ciudad" class="form-control"  id="txt_ciudad"    placeholder="Ciudad">
            <input type="text" style="grid-area:cp"  class="form-control"  id="txt_cp"        placeholder="CP">
            <input type="text" style="grid-area:txtdomicilio" class="form-control"  id="txt_domicilio" placeholder="Domicilio">
        </div>
        <p>Telefono</p>
            <input type="tel" class="form-control" id="txt_telefono" placeholder="Telefono">

        <p>Correo electronico</p>
        <input type="email" class="form-control" id="txt_correo" placeholder="Correo electronico">
        <p>Soporte</p>
        <input type="email" class="form-control" id="txt_correoSoporte" placeholder="Correo electronico Soporte" autocomplete="off"  appnoautocomplete="">
        
        <input type="password" class="form-control" id="txt_passSoporte" placeholder="Contraseña soporte"  autocomplete="off"  appnoautocomplete="">  
    </div>

    <div id="div_Personalizacion" style="grid-area: div_Personalizacion; ">
        <h3>Personalización</h3>
        <p>logo</p>
        <div id="divLogo" class="grid-content-logo" style="width: 100%">
            <img    class="rounded" style="grid-area:imgLogo; margin:auto; width: 21em;" id="logo"  src="img\photo.png" alt="logo">
            <button class="form-control btn-success " style="grid-area:btnSubir;"        id="btnSubir">   Subir</button>
            <button class="form-control btn-danger"   style="grid-area:btnEliminar;"     id="btnEliminar">Eliminar</button>
        </div>
        <p>Descripción de la empresa</p>
        <textarea class="form-control" name="txt_Descripcion" id="txt_Descripcion" cols="30" rows="5" placeholder="Descripción de la empresa"></textarea>
    </div>
    
</div>
       
                    
</body>
</html>

 <input
        