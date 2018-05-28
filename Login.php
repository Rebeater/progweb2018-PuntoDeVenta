<!Doctype html>
<?php 
	session_start(['read_and_close'  => true]);

	if(isset($_SESSION["puesto"]) && isset($_SESSION['usuario'])){
		header("location:index.php");    
	}
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="cache-control" content="no-cache" />
	<script src="js/jquery-3.3.1.min.js"></script>
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
			<span>Constraseña</span>			
			<a href="recuperar.php" target:"_blank" style="float:right; margin-bottom:.5em;">¿Olvidaste tu contraseña?</a>
			<input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" maxlength = "10">
			<input type="checkbox" id="cbox_showPass" > Mostrar contraseña
			<input type="submit"   class="form-control btn-primary" value = "Ingresar">
		</div>
	</form>

<script>
	$( document ).ready(function() {
		cboxShowPass = $('#cbox_showPass');
		txtPass = $('#contraseña');

		cboxShowPass.change(function(){
			if(cboxShowPass[0].checked == true)
				txtPass.get(0).type = 'text';
			else if(cboxShowPass[0].checked == false)
				txtPass.get(0).type = 'password';
		});
	});
</script>
</body>
</html>