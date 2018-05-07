<?php 
    include_once("validaciones.php");
    include_once("conexion.php");

    class puesto{
        private $id;
        private $nombre = "";
    
//#region Declaracion de atributos get set
        public function setId($id){ 
            $this->id = $id;
        }
        public function getId(){ return $this->$id; }
        
        public function setNombre($name){ 
            $this->nombre = $name;
         }
        public function getNombre(){ 
            return $this->nombre;
         }
//#endregion


//#region CRUD = Create, Read, Update, Delete
        public function Insertar(){
            try{
                $cadena= "INSERT INTO puesto (nombre) VALUES (:nombre)";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':nombre', $this->nombre);                    

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
        
        public function LeerTodo($name){
            $conex = new conexion();
            $resultado = $conex->Consultar("Select id, nombre FROM puestos ORDER BY id ASC");
                                                          
            echo "<div class='input-group mb-3'>";
            echo "    <div class='input-group-prepend'>";
            echo "        <label class='input-group-text' for='cbx_puesto'>Puesto</label>";
            echo "    </div>";
            echo "    <select class='custom-select' id='".$name."' name='".$name."'>";
            
            foreach($resultado as $row){
                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }

            echo "</select>";
            echo "</div>";
        }

        public function editar(){
            try{
                $cadena= "update puesto set nombre=:nombre WHERE id=:id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nombre', $this->nombre);                    

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

        public function Eliminar(){
            try{
                $cadena= "delete from puesto where id = :id";
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

//#endregion
    }
?>