<?php
include_once("validaciones.php");
include_once("conexion.php");

    class cliente{
    // ----------------- A T R I B U T O S ---------------------        

        private $id; 
        private $rfc;
        private $nombre;
        private $telefono;
        private $domicilio;
        private $ciudad;

    // ------------- C O N S T R U C T O R  ----------------------
        
        public function __construct($id=""){
            $this->id = "";
            $this->rfc= "";
            $this->nombre= "";
            $this->telefono= "";
            $this->domicilio= "";
            $this->ciudad= "";
            if($id !=""){
                try{
                    $conex = new conexion();
                    $result = $conex->Consultar("Select id, rfc, nombre, telefono, domicilio, ciudad from usuario where id = ".$id);
                    foreach($result as $row){
                        $this->id = $row['id'];
                        $this->rfc = $row['rfc'];
                        $this->nombre = $row['nombre'];
                        $this->telefono = $row['telefono'];
                        $this->domicilio = $row['domicilio'];
                        $this->ciudad = $row['ciudad'];
                    }   
                } catch(PDOException $e)
			    {
    				echo "Error: " . $e->getMessage();
                }
            }
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------

        public function getId() { return $this->id; }
        public function getRfc() { return $this->rfc; }
        public function getNombre() { return $this->nombre; }
        public function getTelefono() { return $this->telfono; }
        public function getDomicilio() { return $this->domiciio; }
        public function getCiudad() { return $this->ciudad; }

        public function setId($id) { $this->id = $id; }
        public function setRfc($rfc) { $this->rfc = $rfc; }
        public function setNombre($nombre) { $this->nombre = $nombre; }
        public function setTelefono($telefono) { $this->telefono = $telefono; }
        public function setDomicilio($domiclio) { $this->domicilio = $domiclio; }
        public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    
    // ---------- M E T O D O S   F U N C I O N A L E S ------------      
        
        public function Insertar(){
            try{
                $cadena= "insert into cliente (rfc, nombre, telefono, domicilio, ciudad) VALUES (:rfc, :nombre, :telefono, :domicilio, :ciudad)";
                
                $conex=new conexion();
                $conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':rfc', $this->rfc);
                $stmt->bindParam(':nombre', $this->nombre);                    
                $stmt->bindParam(':telefono', $this->telefono);
                $stmt->bindParam(':domicilio', $this->domicilio);
                $stmt->bindParam(':ciudad', $this->ciudad);
                echo "domicilio:".$this->domicilio. "~";
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

        public function editar(){
            try{
                $cadena= "update cliente set rfc=:rfc, nombre=:nombre, telefono=:telefono, domicilio=:domicilio, ciudad=:ciudad WHERE id=:id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nombre', $this->nombre);                    
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':domicilio', $this->domicilio);
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
                $cadena= "delete from cliente where id = :id";
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

        private function getArrayClientes($nombre){            
            $conex = new conexion();
            $result = $conex->Consultar("Select id, rfc, nombre, telefono, domicilio, ciudad from cliente where nombre like '%".$nombre."%'");
            return $result;
        }

        public function getArrayClientesJSON($nombre=""){
            $result = $this->getArrayClientes($nombre);
            foreach($result as $row){
                $arrClient = array('id' => $row['id'], 'rfc' => $row['rfc'], 'nombre' => $row['nombre'],'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'ciudad' => $row['ciudad']);
                $clientsJson = json_encode($arrClient);
                return $clientsJson;
            }
        }

        public function getTablaClientes($nombre=""){
            $clients_array = $this->getArrayClientes($nombre);
            
            echo "<div class='table-container'>";
            echo "<table id='tabla_clientes' class='table table-striped table-rwd'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Nombre</th>";
            echo "<th>RFC</th>";
            echo "<th>Teléfono </th>";
            echo "<th>Domicilio</th>";
            echo "<th>Ciudad</th>";
            echo "<th>Opciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            ///echo $row['id']." ".$row['rfc']." ".$row['nombre']." ".$row['telefono']." ".$row['domicilio']." ".$row['ciudad']."<br>";

            foreach ($clients_array as $row) {
                echo "<tr id='".$row['id']."'>";
                echo "<td id='id_row".$row['id']."' style='text-align:center'>";
                    echo $row['id'];
                echo "</td>";

                echo "<td> <span id='nombre_row".$row['id']."'>";
                    echo $row['nombre'];
                echo "</span></td>";

                echo "<td>";
                    echo "<span id='rfc_row".$row['id']."'>".$row['rfc']."</span>";
                echo "</span></td>";

                echo "<td> <span id='telefono_row".$row['id']."'>";
                    echo $row['telefono'];
                echo "</span></td>";

                echo "<td> <span id='domicilio_row".$row['id']."'>";
                    echo $row['domicilio'];
                echo "</span></td>";

                echo "<td> <span id='ciudad_row".$row['id']."'>";
                    echo $row['ciudad'];
                echo "</span></td>";

                echo "<td id='opciones_row".$row['id']."'>";
                    echo "<div style='text-align: center; font-size: 1.25em;'> ";
                    echo "<a data-toggle='modal' href='#modalEdit' onClick='openClient(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                    echo "<a data-toggle='modal' href='#modalDelete' onClick='deleteClient(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
                    echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody> </table>";
            echo "</div>";
        }
    
        private function getClienteByCampo($campo, $data){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, rfc, nombre, telefono, domicilio, ciudad from cliente where ".$campo." = '".$data."'");
            return $result;
        }
        
        public function getClientByCampoJSON($campo="nombre", $data=""){
            try{
                $result = $this->getClienteByCampo($campo, $data);
                foreach($result as $row){
                    $Client = array('id' => $row['id'], 'rfc' => $row['rfc'],'nombre' => $row['nombre'],'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'ciudad' => $row['ciudad']);                
                    $clientJson = json_encode($Client);
                    return $clientJson;
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }   

        public function getClientByCampo($campo="nombre", $data=""){
            try{ 
                $result = $this->getClienteByCampo($campo, $data);
                foreach($result as $row){
                    $this->id = $row['id'];
                    $this->setRfc($row['rfc']);
                    $this->setNombre($row['nombre']);
                    $this->setTelefono($row['telefono']);
                    $this->setDomicilio($row['domicilio']);
                    $this->setCiudad($row['ciudad']);
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>