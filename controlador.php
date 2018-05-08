<?php
include 'ValidarUsuario.php';

	
	class controlador{
		
		public function login($correo, $contraseña){
			$valusu = new ValidarUsuario();
			$obj_usuario = new usuario();
			$obj_usuario->setCorreo($correo);
			$obj_usuario->setContrasena($contraseña);
			
			return $valusu->login($obj_usuario);
		}

	}
?>