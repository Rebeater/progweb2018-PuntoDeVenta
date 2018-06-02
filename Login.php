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
	<script src="js/popper.js"></script>
	<link rel="stylesheet" href="css/floating-labels.css">
	


	<script src="js/bootstrap.js"></script>
	<title>Login</title>
</head>
<body class="bodylogin">
	<form method="post" action="<?php echo htmlspecialchars('Accion.php');?>" >
		
		<div class="login-container">
			<h1>Bienvenido!</h1>
			<div id="flg-email" class="form-label-group">
				<input type="email" 	   class="form-control" id="correo" 	name = "correo"   placeholder="Correo"     maxlength="30" autofocus>
				<label for="correo">Correo</label>			
			</div>
			<a href='recuperar.php' target:'_blank' style='float:right; padding-top:0; margin: 0 0.5em;'>¿Olvidaste tu contraseña?</a>
			
			<div id="flg-pass" class="form-label-group">
				<input type="password"  class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" data-toggle="tooltip" data-placement="right" data-trigger='manual' title="Mayúsculas activadas" >
				<label id="lblPass" for="contraseña">Contraseña</label>			
			</div>
			<input type="checkbox"  id="cbox_showPass" > Mostrar contraseña
			<input type="submit"    class="form-control btn-primary" value = "Ingresar">
		</div>
	</form>

<script>
	$( document ).ready(function() {
		cboxShowPass = $('#cbox_showPass');
		txtPass = $('#contraseña');
		lblPass = $('#lblPass');

		cboxShowPass.change(function(){
			if(cboxShowPass[0].checked == true)
				txtPass.get(0).type = 'text';
			else if(cboxShowPass[0].checked == false)
				txtPass.get(0).type = 'password';
		});

		txtPass.blur(function(){
			$('#contraseña').tooltip('hide');			
		});

		txtPass.keypress(function (event) {
			kCode = event.keyCode? event.keyCode : event.which;
			sKey = event.shiftKey ? event.shiftKey : ((kCode==16)? true : false);
			if(((kCode>=65&&kCode<=90)&&!sKey)||((kCode>=97&&kCode<=122)&&sKey ))
				$('#contraseña').tooltip('show');
			else
				$('#contraseña').tooltip('hide');
		});
		
/*		txtPass.keyup(function (event){
			var value = txtPass[0].value;
			lblPass[0].innerHTML = (value.length>0)? "Contraseña <a href='recuperar.php' target:'_blank' style='float:right; padding-top:0; margin: 0 0.5em;'>¿Olvidaste tu contraseña?</a>" : "Contraseña" ;
			 
		});*/
		

	});
</script>
</body>
</html>


