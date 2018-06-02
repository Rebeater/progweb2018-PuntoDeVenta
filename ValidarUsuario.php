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
			
			$cons = "SELECT id, puesto, correo, contrasena FROM usuario WHERE correo ='" .$correo."'";
			
			$this->getConexion();
			
			$result = $conex->Consultar($cons);
			$usr;
			foreach($result as $row){
				if(password_verify($contraseña, $row['contrasena'])){
					 $usr = array('id' => $row['id'], 'puesto' => $row['puesto'], 'contrasena' => $row['contrasena'], 'correo' => $row['correo']);                
				}
			}

			$puesto = $usr['puesto'];
			$_SESSION["usuario"] = $usr['correo'];
			$_SESSION["idUsuario"] = $usr['id'];
			$_SESSION['logged'] = true;
			switch ($usr['puesto']) {
				case '1': //Admin
					$_SESSION["puesto"] = "Administrador";
					header("location: mantenimiento_Usuarios.php");	
					break;
				case '2': // Ventas
						$_SESSION["puesto"] = "Ventas";
						header("location: puntoventa.php");
					break;
				case '3': // Supervisor
					echo "idhid";
					$_SESSION["puesto"] = "Supervisor";
					header("location: Supervisor.php");
					break;
				case '4': // Caja
					$_SESSION["puesto"] = "Caja";
					header("location: puntoventa.php");
					break;
				default:
					# code...
					break;
			}
						
			
			
		}
		
	}
?>