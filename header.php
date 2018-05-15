<?php 
include_once("Clases/configuracion.php");
include_once("Clases/menu.php");
include_once("Clases/usuario.php");
	$usrLogged = new usuario();
	$email = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "";	
	$usrId =  $usrLogged->getUserByEmail($email);
	$_SESSION['idActual'] = $usrId;
	$conf = new configuracion();
?>
<script src="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">    
	<link rel="stylesheet" href="css/style.css">	
<header style=' display: -webkit-inline-box;'>
	<!-- toggle button -->
	<span id='button-menu' class='fa fa-bars'></span> 
	<span class="companyName"> 
		<?php  echo $conf->getCompanyName();?> 
	</span>
	
	<!-- Ventana previa Usuario -->
	<form id='frm_prevUser' name='frm_prevUser' action="prevUser.php" method="POST" class="">
			<img id="photo-prev" class="photo-prev" alt=""  <?php echo ($usrId != "") ? "src='img/perfiles/".$usrId.".png'" : "src='img/perfiles/user.png'";  ?> height="35" width="35">
		
	</form>

 	<nav class='navegacion'>
	<?php 
		$mn = new menu();
		$mn->RegresaMenu();
	?>	
	</nav>	
    </header>


<seccion id="card-user" class="prevUser">
			<div>
				<img alt="" id="photo-prev2" height="90" width="90" <?php echo ($usrId != "") ? "src='img/perfiles/".$usrId.".png'" : "src='img/perfiles/user.png'";?> <?php echo " onclick='cambiarFoto(".$_SESSION['idActual'].")'";?> >
				<ul>
					<li><p id="frm_prevUser_lblName">
						<?php
						  echo $usrLogged->getNombre();
						?>

					</p></li>	
					<li><p id="frm_prevUser_lblEmail">
						<?php
						 echo $usrLogged->getCorreo();
						?>
					</p></li>	
					<li><input class="btn btn-primary" type="submit" id="btn_prevUsr_Cuenta" name="btn_prevUsr_Cuenta" value="Mi cuenta"></li>	
				</ul>
			</div>
			<div class="line"></div>
			<div>
				<ul class="ulHorizontal">
					<li><input class="btn btn-ligth" type="submit" id="btn_prevUsr_help" name="btn_prevUsr_help" value="Ayuda"></li>
					<li><input class="btn" type="submit" id="btn_prevUsr_logout" name="btn_prevUsr_logout" value="Cerrar Sesión"></li>
				</ul>
			</div>
		</seccion>



<script src='js/mostrarNav.js'></script>