<!Doctype html>
<?php 
session_start(['read_and_close'  => true]);

if(isset($_SESSION["puesto"]) && isset($_SESSION['usuario'])){
	header("location:index.php");    
}
else{
	
	
}
?>
<html lang="es">
<meta charset="utf-8">
<meta http-equiv="cache-control" content="no-cache" />
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.js"></script>
	<title>Login</title>
</head>
<body class="bodylogin">
	<form method="post" action="<?php echo htmlspecialchars('Accion.php');?>" >
		
		<div class="login-container">
			<h1>Bienvenido!</h1>
			<p>Correo</p>			
			<input type="text" 	   class="form-control" id="correo" 	name = "correo"   placeholder="Correo"     maxlength="30" autofocus>
			<p>Constraseña</p>			
			<input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" maxlength = "10">
			<input type="checkbox"> Mostrar contraseña
			<input type="submit"   class="form-control btn-primary" value = "Ingresar">
		</div>
	</form>

</body>
</html>