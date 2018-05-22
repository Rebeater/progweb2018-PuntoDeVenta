<?php
include 'Clases/conexion.php';
include 'Clases/usuario.php';

	class ValidarUsuario extends conexion{
		protected $cnx; /** conexion**/
		
		private function getConexion(){
			$this->cnx = $this->conectarse();
		}
		
		private function desconectar(){
			self::$cnx = null;
		}
		
		
		public function login($correo, $contraseña){
			session_start();
			
			$conex = new conexion;
			$puesto = "";
			
			$cons = "SELECT id, puesto, correo FROM usuario WHERE correo ='" .$correo."' AND contrasena ='" .$contraseña."'";
			
			$this->getConexion();
			
			$result = $conex->Consultar($cons);
			
			foreach($result as $row){
				$puesto = $row['puesto'];
				$_SESSION["usuario"] = $correo;
				$_SESSION["idUsuario"] = $row['id'];
				$_SESSION['logged'] = true;
				if($puesto == "Supervisor"){
					echo "idhid";
					$_SESSION["puesto"] = "Supervisor";
					header("location: Supervisor.php");
				}
				if($puesto == "1"){
					$_SESSION["puesto"] = "Administrador";
					header("location: mantenimiento_Usuarios.php");
				}
				if($puesto == "4"){
					$_SESSION["puesto"] = "Caja";
					header("location: puntoventa.php");
				}
				if($puesto == "2"){
					$_SESSION["puesto"] = "Ventas";
					header("location: puntoventa.php");
				}
			}
			
			
			
		}
		
	}
?>