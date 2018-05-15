<?php 
    include_once("validaciones.php");
    include_once("conexion.php");

    class usuario{
        private $id;
        private $nombre = "";
        private $correo;
        private $contrasena;
        private $puesto;
        private $telefono;
        private $domicilio;
        private $fechaNacimiento;
        private $fechaAlta;
    
//#region Declaracion de atributos get set
        public function setId($id){ 
            $this->id = $id;
        }
        public function getId(){ 
            return $this->$id; 
        }
        
        public function setNombre($name){ 
            $this->nombre = $name;
         }
        public function getNombre(){ 
            return $this->nombre;
         }

        
         public function setCorreo($correo){ $this->correo = $correo; }
        public function getCorreo(){ return $this->correo; }

        public function setContrasena($contrasena){ $this->contrasena = $contrasena; }
        public function getContrasena(){ return $this->contrasena; }
        
        public function setPuesto($puesto){ $this->puesto = $puesto; }
        public function getPuesto(){ return $this->puesto; }

        public function setTelefono($telefono){ $this->telefono = $telefono; }
        public function getTelefono(){ return $this->telefono; }

        public function setDomicilio($domicilio){ $this->domicilio = $domicilio; }
        public function getDomicilio(){ return $this->domicilio; }

        public function setFechaNacimiento($fechaNacimiento){ $this->fechaNacimiento = $fechaNacimiento; }
        public function getFechaNacimiento(){ return $this->fechaNacimiento; }

        public function setFechaAlta($fechaAlta){ $this->fechaAlta = $fechaAlta; }
        public function getFechaAlta(){ return $this->fechaAlta; }
//#endregion


//#region CRUD = Create, Read, Update, Delete
        public function Insertar(){
            try{
                $cadena= "INSERT INTO usuario (nombre, correo, contrasena, puesto, telefono, domicilio, fechaNacimiento, fechaAlta) VALUES (:nombre, :correo, :contrasena, :puesto, :telefono, :domicilio, :fechaNacimiento, :fechaAlta)";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':nombre', $this->nombre);                    
				$stmt->bindParam(':correo', $this->correo);
				$stmt->bindParam(':contrasena', $this->contrasena);
				$stmt->bindParam(':puesto', $this->puesto);
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':domicilio', $this->domicilio);
				$stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
                $stmt->bindParam(':fechaAlta', $this->fechaAlta);                
            
				if($stmt->execute())
				{
					echo "No hubo error";
					return true;
				}
				else
				{
                    
                    foreach($stmt->errorInfo() as $errores){
                        echo "<br>";
                        echo $errores;}
                        echo "<br>";
                    
					echo "hubo error";
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
            $resultadoPuestos = $conex->Consultar("Select id, nombre from puestos ORDER BY id ASC");
            
            $array_Puestos = array();
            foreach($resultadoPuestos as $row){
                $array_Puestos += [$row['id']=> $row['nombre']];
            }
            echo "<div class='table-container'>";
            echo "<table id='tabla_usuarios' class='table table-striped table-rwd'>";
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

                    echo "<td> <span id='nombre_row".$row['id']."'>";
                        echo $row['nombre'];
                    echo "</span></td>";

                    echo "<td>";
                        echo "<span id='correo_row".$row['id']."'>".$row['correo']."</span>";
                    echo "</span></td>";

                    

                    echo "<td> <span id='puesto_row".$row['id']."'>";
                        echo $array_Puestos[$row['puesto']];
                    echo "</span></td>";

                    echo "<td> <span id='telefono_row".$row['id']."'>";
                        echo $row['telefono'];
                    echo "</span></td>";

                    echo "<td> <span id='domicilio_row".$row['id']."'>";
                        echo $row['domicilio'];
                    echo "</span></td>";

                    echo "<td> <span id='fechaNacimiento_row".$row['id']."'>";
                        echo $row['fechaNacimiento'];
                    echo "</span></td>";

                    echo "<td> <span id='fechaAlta_row".$row['id']."'>";
                        echo $row['fechaAlta'];
                    echo "</span></td>";

                    echo "<td id='opciones_row".$row['id']."'>";
                        echo "<div style='text-align: center; font-size: 1.25em;'> ";
                        echo "<a data-toggle='modal' href='#modalEdit' onClick='openUser(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                        echo "<a data-toggle='modal' href='#modalDelete' onClick='deleteUser(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody> </table>";
            echo "</div>";
        }

        public function editar(){
            try{
                $cadena= "update usuario set nombre=:nombre, correo=:correo, contrasena=:contrasena, puesto=:puesto, telefono=:telefono, domicilio=:domicilio, fechaNacimiento=:fechaNacimiento WHERE id=:id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nombre', $this->nombre);                    
				$stmt->bindParam(':correo', $this->correo);
				$stmt->bindParam(':contrasena', $this->contrasena);
				$stmt->bindParam(':puesto', $this->puesto);
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':domicilio', $this->domicilio);
				$stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            
                //echo $this->id;

				if($stmt->execute())
				{
					echo "No hubo error";
					return true;
				}
				else
				{
                    
                    foreach($stmt->errorInfo() as $errores){
                        echo "<br>";
                        echo $errores;}
                        echo "<br>";
                    
					echo "hubo error";
					return false;
				}
				$conn = null;
            }catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			} 
        }

        public function Eliminar(){
            try{
                $cadena= "delete from usuario where id = :id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
            
                echo $this->id;

				if($stmt->execute())
				{
					echo "No hubo error";
					return true;
				}
				else
				{
                    
                    foreach($stmt->errorInfo() as $errores){
                        echo "<br>";
                        echo $errores;}
                        echo "<br>";
                    
					echo "hubo error";
					return false;
				}
				$conn = null;
            }catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			} 
        }

        public function getUserById($id){  
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, correo, contrasena, puesto, telefono, domicilio, fechaNacimiento, fechaAlta from usuario where id = ".$id);
            foreach($result as $row){
                $arrUsr = array('id' => $row['id'], 'nombre' => $row['nombre'],'correo' => $row['correo'],'contrasena' => $row['contrasena'],'puesto' => $row['puesto'],'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'fechaAlta' => $row['fechaAlta'],'fechaNacimiento' => $row['fechaNacimiento']);
                
                $usrJson = json_encode($arrUsr);
                echo $usrJson;
            }
           
        }

        public function getUserByEmail($email){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, correo, contrasena, puesto, telefono, domicilio, fechaNacimiento, fechaAlta from usuario where correo = '".$email."'");
            foreach($result as $row){
                $arrUsr = array('id' => $row['id'], 'nombre' => $row['nombre'],'correo' => $row['correo'],'contrasena' => $row['contrasena'],'puesto' => $row['puesto'],'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'fechaAlta' => $row['fechaAlta'],'fechaNacimiento' => $row['fechaNacimiento']);                

                $this->id = $row['id'];
                
                
                $this->setNombre($row['nombre']);
                $this->setCorreo($row['correo']);
                $this->setContrasena($row['contrasena']);
                $this->setPuesto($row['puesto']);
                $this->setTelefono($row['telefono']);
                $this->setDomicilio($row['domicilio']);
                $this->setFechaAlta($row['fechaAlta']);
                $this->setFechaNacimiento($row['fechaNacimiento']);
                
                $usrJson = json_encode($arrUsr);
                //echo $usrJson;
                return isset($this->id) ? $this->id : "";
                
            }
        }

//#endregion

        public function cbxEditpuesto($id){
            $conex = new conexion();
            $resultado = $conex->Consultar("Select id, nombre FROM puestos ORDER BY id ASC");
            $resultadoUsr = $conex->Consultar("Select puestos.id FROM puestos, usuario WHERE usuario.puesto = puestos.id AND usuario.id = ".$id);
            $selected = "";          
            $str = "";

            foreach($resultadoUsr as $usr){
                    $str = $usr['id'];
            }

            foreach($resultado as $row){
                if($row['id'] == $str )
                    $select= "Selected";
                    else{
                        $select= "";
                    }
                echo "<option ".$select." value='".$row['id']."'>".$row['nombre']."</option>";
            }
        }


        public function LeerTodobyCampo($campo, $data){
            $conex = new conexion();
            $resultado = $conex->Consultar("Select id, nombre, correo, puesto, telefono, domicilio, fechaNacimiento, fechaAlta from usuario WHERE ".$campo." like '%".$data."%'  ORDER BY id ASC");
            $resultadoPuestos = $conex->Consultar("Select id, nombre from puestos ORDER BY id ASC");
            $array_Puestos = array();
            foreach($resultadoPuestos as $row){
                $array_Puestos += [$row['id']=> $row['nombre']];
            }
            echo "<div class='table-container'>";
            echo "<table id='tabla_usuarios' class='table table-striped table-rwd'>";
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

                    echo "<td> <span id='nombre_row".$row['id']."'>";
                        echo $row['nombre'];
                    echo "</span></td>";

                    echo "<td>";
                        echo "<span id='correo_row".$row['id']."'>".$row['correo']."</span>";
                    echo "</span></td>";

                    

                    echo "<td> <span id='puesto_row".$row['id']."'>";
                        echo $array_Puestos[$row['puesto']];
                    echo "</span></td>";

                    echo "<td> <span id='telefono_row".$row['id']."'>";
                        echo $row['telefono'];
                    echo "</span></td>";

                    echo "<td> <span id='domicilio_row".$row['id']."'>";
                        echo $row['domicilio'];
                    echo "</span></td>";

                    echo "<td> <span id='fechaNacimiento_row".$row['id']."'>";
                        echo $row['fechaNacimiento'];
                    echo "</span></td>";

                    echo "<td> <span id='fechaAlta_row".$row['id']."'>";
                        echo $row['fechaAlta'];
                    echo "</span></td>";

                    echo "<td id='opciones_row".$row['id']."'>";
                        echo "<div style='text-align: center; font-size: 1.25em;'> ";
                        echo "<a data-toggle='modal' href='#modalEdit' onClick='openUser(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                        echo "<a data-toggle='modal' href='#modalDelete' onClick='deleteUser(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody> </table>";
            echo "</div>";
        }



    }
?>