<?php
	include ("Clases/conexion.php");
	include ("Clases/funciones.php");
	$errores = array();

	if(empty($_POST)){
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache" />
    <script src="js/jquery-3.3.1.min.js"></script>

	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
	<script src="js/bootstrap.min.js" ></script>
	
	<link rel="stylesheet" href="css/grid-login.css" >
	<title>Recuperar Password</title>
</head>
<body style="background:#f1f1f1">
	<header style="height: 43px; background: #34495E;">
		
	</header>
	
	<div class="grid-container">
		<form id="loginform" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
			<h4 id="title" >Olvidé mi contraseña</h4>
			<p id="lblInstructions">Ingresa tu correo electrónico</p>
			<input  type="email"  class="form-control" id="email"     name="email" placeholder="Ingresa tu correo electrónico" required autofocus>
			<button type="submit" class="form-control" id="btn-login" name="btn-login" >Siguiente</button>
			<a href="login.php" id="linkBack">Regresar</a>
		</form>
	</div>                     
</body>
</html>