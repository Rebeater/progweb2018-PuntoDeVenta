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
    <script src="js/ajustes.js"></script>
    
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid-style.css">
    <title>Ajustes</title>
</head>
<body>
    <form id='uploadImg_Ajustes' name='uploadImg_Ajustes' action="procesa_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="fileToUpload_Ajustes" name="fileToUpload" class="inputFileLogo">
         <input type="hidden" id="updatePhotoId_Ajustes" name="updatePhotoId_Ajustes">
    </form>
    <?php include_once("header.php"); ?>

    <crumb>
        <span>Inicio > Ajustes</span>
    </crumb>
    
    <!--<form id='frmAjustes' name='frmAjustes' action="procesa_ajustes.php" method="POST">    -->
<div class="container grid-container-ajustes" >
    <div id="div_datosEmpresa" style="grid-area: div_datosEmpresa;">
        <h3>Datos de la empresa</h3>

        <p>Nombre de la empresa</p>
            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Nombre de la empresa" required>

        <div id="divDomicilio" class="grid-container-domicilio">
            <p style="grid-area:lblDomicilio">Domicilio</p>
            <select            style="grid-area:pais"         class="form-control"  id="cbx_pais"      name="cbx_pais"      placeholder="País">
            <input type="text" style="grid-area:cp"           class="form-control"  id="txt_cp"        name="txt_cp"        placeholder="CP">
            <input type="text" style="grid-area:ciudad"       class="form-control"  id="txt_ciudad"    name="txt_ciudad"    placeholder="Ciudad">
            <input type="text" style="grid-area:estado"       class="form-control"  id="txt_estado"    name="txt_estado"    placeholder="Estado">
            <input type="text" style="grid-area:txtdomicilio" class="form-control"  id="txt_domicilio" name="txt_domicilio" placeholder="Domicilio">
        </div>
        <div class="grid-container-telefono">
            <p                 style="grid-area:lbltel" >Teléfono</p>
            <input type="tel"  style="grid-area:telcode" class="form-control " id="txt_telefonoCode" name="txt_telefonoCode" placeholder="00" >
            <input type="tel"  style="grid-area:tel"     class="form-control " id="txt_telefono"     name="txt_telefono"     placeholder="Teléfono">
        </div>
        <p>Correo electronico</p>
        <input type="email"    class="form-control" id="txt_correo"            name="txt_correo"            placeholder="Correo electronico" >
        <p>Soporte</p>
        <input type="email"    class="form-control" id="txt_correoSoporte"     name="txt_passCorreoSoporte" placeholder="Correo electronico Soporte" autocomplete="off"  appnoautocomplete="">
        <input type="password" class="form-control" id="txt_passCorreoSoporte" name="txt_passSoporte"       placeholder="Contraseña soporte"         autocomplete="off"  appnoautocomplete="">  
    </div>

    <div id="div_Personalizacion" style="grid-area: div_Personalizacion; ">
        <h3>Personalización</h3>
        <p>logo</p>
        <div class="grid-content-logo" id="divLogo"  style="width: 100%">
            <img    class="rounded" style="grid-area:imgLogo; margin:auto; width: 21em;" alt="logo" id="logo"        name="logo"    value="img\photo.png"    src="img\photo.png"  >
            <input type="button" class="btn form-control btn-primary " style="grid-area:btnSubir;"      id="btnSubir"    name="btnSubir"    value="Subir" onclick="cambiarFoto()">
            <input type="button" class="btn form-control btn-danger"   style="grid-area:btnEliminar;"   id="btnEliminar" name="btnEliminar" value="Eliminar">
        </div>
        <p>Descripción de la empresa</p>
        <textarea class="form-control" id="txt_Descripcion" name="txt_Descripcion" cols="30" rows="4" placeholder="Descripción de la empresa"></textarea><br>
        <input type="button" class="btn form-control btn-success" id="btnGuardar" name="btnGuardar" value="Guardar" onclick="saveData();">   
    </div>
</div>
<!--</form>-->

        <br>            



</body>
</html>

 <input
        