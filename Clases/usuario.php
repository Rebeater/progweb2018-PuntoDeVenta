<?php 
    include_once("validaciones.php");
    include_once("conexion.php");

    class usuario{
        private $id;
        private $nombre;
        private $correo;
        private $contrasena;
        private $puesto;
        private $telefono;
        private $domicilio;
        private $fechaNacimiento;
        private $fechaAlta;

//#region Declaracion de atributos get set
        public function getId(){ return $id; }
        
        public function setNombre($Nombre){ $this->$nombre = $Nombre; }
        public function getNombre(){ return $this->$nombre; }

        public function setCorreo($Correo){ $this->$correo = $Correo; }
        public function getCorreo(){ return $this->$correo; }

        public function setContrasena($Contrasena){ $this->$contrasena = $Contrasena; }
        public function getContrasena(){ return $this->$contrasena; }

        public function setPuesto($Puesto){ $this->$puesto = $Puesto; }
        public function getPuesto(){ return $this->$puesto; }

        public function setTelefono($Telefono){ $this->$telefono = $Telefono; }
        public function getTelefono(){ return $this->$telefono; }

        public function setDomicilio($Domicilio){ $this->$domicilio = $Domicilio; }
        public function getDomicilio(){ return $this->$domicilio; }

        public function setFechaNacimiento($FechaNacimiento){ $this->$fechaNacimiento = $FechaNacimiento; }
        public function getFechaNacimiento(){ return $this->$fechaNacimiento; }

        public function setFechaAlta($FechaAlta){ $this->$fechaAlta = $FechaAlta; }
        public function getFechaAlta(){ return $this->$fechaAlta; }
//#endregion


//#region CRUD = Create, Read, Update, Delete
        public function Insertar(){
            try{
                $cadena="INSERT INTO usuario (nombre, correo, contraseña, puesto, telefono, domicilio, fechaNacimiento, fechaAlta) VALUES (:nombre, :correo, :contraseña, :puesto, :telefono, :domicilio, :fechaNacimiento, :fechaAlta)";
				$conex=new conexion();
				$conn = $conex->conectarse();
				$stmt = $conn->prepare($cadena);
				echo $cadena;
				
                $stmt->bindParam(':nombre', $this->$nombre);
				$stmt->bindParam(':correoid', $this->$correo);
				$stmt->bindParam(':contraseña', $this->$contraseña);
				$stmt->bindParam(':puesto', $this->$puesto);
				$stmt->bindParam(':telefono', $this->$telefono);
				$stmt->bindParam(':domicilio', $this->$domicilio);
				$stmt->bindParam(':fechaNacimiento', $this->$fechaNacimiento);
				$stmt->bindParam(':fechaAlta', $this->$fechaAlta);
				
				if($stmt->execute())
				{
					echo "No hubo error";
					return true;
				}
				else
				{
					echo "No hubo error";
					return false;
				}
				$conn = null;
            }catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}



        }
        
        public function LeerTodo(){
            $conex = new conexion();
            $resultado = $conex->Consultar("Select id, nombre, correo, puesto, telefono, domicilio, fechaNacimiento, fechaAlta from usuario ORDER BY id ASC");

            echo "<table id='tabla_usuarios' class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Nombre</th>";
            echo "<th>Correo</th>";
            echo "<th>Puesto</th>";
            echo "<th>Teléfono </th>";
            echo "<th>Domicilio</th>";
            echo "<th>Fecha Nacimiento</th>";
            echo "<th>Fecha Alta </th>";
            echo "<th>Opciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach($resultado as $row){
                echo "<tr id='".$row['id']."'>";
                    echo "<td id='id_row".$row['id']."' style='text-align:center'>";
                        echo $row['id'];
                    echo "</td>";

                    echo "<td id='nombre_row".$row['id']."'>";
                        echo $row['nombre'];
                    echo "</td>";

                    echo "<td id='correo_row".$row['id']."'>";
                        echo $row['correo'];
                    echo "</td>";

                    echo "<td id='puesto_row".$row['id']."'>";
                        echo $row['puesto'];
                    echo "</td>";

                    echo "<td id='telefono_row".$row['id']."'>";
                        echo $row['telefono'];
                    echo "</td>";

                    echo "<td id='domicilio_row".$row['id']."'>";
                        echo $row['domicilio'];
                    echo "</td>";

                    echo "<td id='fechaNacimiento_row".$row['id']."'>";
                        echo $row['fechaNacimiento'];
                    echo "</td>";

                    echo "<td id='fechaAlta_row".$row['id']."'>";
                        echo $row['fechaAlta'];
                    echo "</td>";

                    echo "<td id='opciones_row".$row['id']."'>";
                        echo "<div style='text-align: center; font-size: 1.25em;'> ";
                        echo "<a href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                        echo "<a href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        }
//#endregion




    }
?>