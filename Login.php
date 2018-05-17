<!Doctype html>
<?php 
session_start(['read_and_close'  => true]);

if(isset($_SESSION["puesto"]) && isset($_SESSION['usuario'])){
	header("location:index.php");    
}
else{
	
	
}
?>
<html>
<meta charset="utf-8">
<meta http-equiv="cache-control" content="no-cache" />
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<title>Login</title>
	<h1 class="bg-secondary text-white" style = "text-align: center;">Login</h1>
</head>
<body>
<div class = "row">

	<div class = "col">
		
	</div>
	
	<div class = "col">
		
	</div>
	
	<div class = "col">
		
	</div>
	

	<div class = "col">
	
		<form method="post" action="<?php echo htmlspecialchars('Accion.php');?>">
			Usuario:
			<br>
			<input type = "email" name = "correo" placeholder = "Correo" maxlength="30">
			<br>
			Contraseña:
			<br>
			<input type = "password" name = "contraseña" placeholder = "contraseña" maxlength = "10">
			<br>
			<input type = "submit" value = "Ingresar">
			
		</form>
	</div>
	
	<div class = "col">
		
	</div>

	<div class = "col">
		
	</div>
	
	<div class = "col">
		
	</div>
	
</div>


	
</body>
</html>