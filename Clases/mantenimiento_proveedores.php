<?php 
    include_once("validaciones.php");
    include_once("conexion.php");

    class mantenimiento_proveedores{
        private $id;
        private $nombre = "";
        private $telefono;
        private $nombre_social;
        private $ciudad;
    
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

        public function setTelefono($telefono){ $this->telefono = $telefono; }
        public function getTelefono(){ return $this->telefono; }

        public function setNombre_social($nombre_social){ $this->nombre_social = $nombre_social; }
        public function getNombre_social(){ return $this->nombre_social; }

        public function setCiudad($ciudad){ $this->ciudad = $ciudad; }
        public function getCiudad(){ return $this->ciudad; }

//#endregion


//#region CRUD = Create, Read, Update, Delete
        public function Insertar(){
            try{
                $cadena= "INSERT INTO proveedores (id, nombre, telefono, nombre_social, ciudad) VALUES (null, :nombre, :telefono, :nombre_social, :ciudad)";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                //$stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nombre', $this->nombre);                    
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':nombre_social', $this->nombre_social);
				$stmt->bindParam(':ciudad', $this->ciudad);
            
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
            $resultado = $conex->Consultar("Select id, nombre, telefono, nombre_social, ciudad from proveedores ORDER BY id ASC");
            
            /*$array_Puestos = array();
            foreach($resultadoPuestos as $row){
                $array_Puestos += [$row['id']=> $row['nombre']];
            }*/
            
            echo "<table id='tabla_usuarios' class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Nombre</th>";
            echo "<th>Teléfono </th>";
            echo "<th>Razón Social</th>";
            echo "<th>Ciudad</th>";
            echo "<th>Opciones</th>";            
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            if(!empty($resultado)){
            foreach($resultado as $row){
                echo "<tr id='".$row['id']."'>";
                    echo "<td id='id_row".$row['id']."' style='text-align:center'>";
                        echo $row['id'];
                    echo "</td>";

                    echo "<td> <span id='nombre_row".$row['id']."'>";
                        echo $row['nombre'];
                    echo "</span></td>";

                    echo "<td> <span id='telefono_row".$row['id']."'>";
                        echo $row['telefono'];
                    echo "</span></td>";

                    echo "<td> <span id='nombre_social_row".$row['id']."'>";
                        echo $row['nombre_social'];
                    echo "</span></td>";

                    echo "<td> <span id='ciudad_row".$row['id']."'>";
                        echo $row['ciudad'];
                    echo "</span></td>";

                    echo "<td id='opciones_row".$row['id']."'>";
                        echo "<div style='text-align: center; font-size: 1.25em;'> ";
                        echo "<a data-toggle='modal' href='#modalEdit' onClick='openProveedor(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                        echo "<a data-toggle='modal' href='#modalDelete' onClick='deleteProveedor(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody> </table>";
        }
        }

        public function editar($hidenid){
            try{
                $cadena= "update proveedores set nombre=:nombre, telefono=:telefono, nombre_social=:nombre_social, ciudad=:ciudad WHERE id=:id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $hidenid);
                $stmt->bindParam(':nombre', $this->nombre);                    
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':nombre_social', $this->nombre_social);
				$stmt->bindParam(':ciudad', $this->ciudad);
            
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
                $cadena= "delete from proveedores where id = :id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
            
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
            $result = $conex->Consultar("Select id, nombre, correo, contrasena, puesto, telefono, nombre_social, fechaNacimiento, fechaAlta from usuario where id = ".$id);
            foreach($result as $row){
                $arrUsr = array('id' => $row['id'], 'nombre' => $row['nombre'],'correo' => $row['correo'],'contrasena' => $row['contrasena'],'puesto' => $row['puesto'],'telefono' => $row['telefono'],'nombre_social' => $row['nombre_social'],'fechaAlta' => $row['fechaAlta'],'fechaNacimiento' => $row['fechaNacimiento']);
                
                $usrJson = json_encode($arrUsr);
                echo $usrJson;
            }
           
        }

        public function getTablaProveedor($concepto=""){
            try{
                $proveedores_array = $this->getArrayProveedor($concepto);
                $string ="";

                $string = $string."<div id='divProveedores' name='divProveedores'>";
                
                $string = $string."<div class='table-container'>";
                $string = $string."<table id='tabla_proveedores' class='table table-hover table-striped table-rwd'>";
                $string = $string."<thead>";
                $string = $string."<tr>";
                $string = $string."<th>ID</th>";
                $string = $string."<th>Nombre</th>";
                $string = $string."<th>Telefono</th>";
                $string = $string."<th>Razón social</th>";
                $string = $string."<th>Ciudad</th>";
                $string = $string."<th>Opciones</th>";
                $string = $string."</tr>";
                $string = $string."</thead>";
                $string = $string."<tbody>";

                ///echo $row['id']." ".$row['rfc']." ".$row['nombre']." ".$row['telefono']." ".$row['domicilio']." ".$row['ciudad']."<br>";
                if(isset($proveedores_array)){
                    foreach ($proveedores_array as $row) {
                        $string = $string."<tr id='".$row['id']."'>";
                        $string = $string."<td id='id_row".$row['id']."' style='margin-left:1em'>";
                        $string = $string.$row['id'];
                        $string = $string."</td>";

                        $string = $string."<td> <span id='nombre_row".$row['id']."'>";
                            $string = $string.$row['nombre'];
                        $string = $string."</span></td>";

                        $string = $string."<td>";
                            $string = $string."<span id='telefono_row".$row['id']."'>".$row['telefono']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td>";     
                            $string = $string."<span id='nombre_social_row".$row['id']."'>".$row['nombre_social']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td>";     
                            $string = $string."<span id='ciudad_row".$row['id']."'>".$row['ciudad']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td id='opciones_row".$row['id']."'>";
                            $string = $string."<div style='text-align: center; font-size: 1.25em;'> ";
                            $string = $string."<a data-toggle='modal' href='#modalEdit' onClick='openProveedor(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                            $string = $string."<a data-toggle='modal' href='#modalDelete' onClick='deleteProveedor(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                            $string = $string."</div>";
                        $string = $string."</td>";
                        $string = $string."</tr>";
                    }
                    $string = $string."</tbody> </table>";
                    $string = $string."</div>";
                    $string = $string."</div>";
                    echo $string;
                }else{
                    echo "Error";
                }
            }
            catch(Exception $e)
			{
                echo "Error";
				//echo "Error: " . $e->getMessage();
			} 
        }

        private function getArrayProveedor($concepto){            
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, telefono, nombre_social, ciudad from proveedores where nombre like '%".$concepto."%' or nombre_social like '%".$concepto."%'");
            return $result;
        }

        private function getProveedorByCampo($campo, $data){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, telefono, nombre_social, ciudad from proveedores where ".$campo." = '".$data."'");
            return $result;
        }

        public function getProveedorByCampoJSON($campo="nombre", $data=""){
            try{
                $result = $this->getProveedorByCampo($campo, $data);
                foreach($result as $row){                        
                    $productJson = json_encode($row);
                    return $productJson;
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }  

//#endregion
    }
?>