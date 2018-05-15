<?php
include_once("validaciones.php");
include_once("conexion.php");

    class cliente{
    // ----------------- A T R I B U T O S ---------------------        

        private $id; 
        private $rfc;
        private $nombre;
        private $correo;
        private $telefono;
        private $domicilio;
        private $ciudad;

    // ------------- C O N S T R U C T O R  ----------------------
        
        public function __construct($id=""){
            $this->id = "";
            $this->rfc= "";
            $this->nombre= "";
            $this->correo= "";
            $this->telefono= "";
            $this->domicilio= "";
            $this->ciudad= "";
            if($id !=""){
                try{
                    $conex = new conexion();
                    $result = $conex->Consultar("Select id, rfc, nombre, correo, telefono, domicilio, ciudad from usuario where id = ".$id);
                    foreach($result as $row){
                        $this->id = $row['id'];
                        $this->rfc = $row['rfc'];
                        $this->nombre = $row['nombre'];
                        $this->correo = $row['correo'];
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
        public function getCorreo() { return $this->correo; }
        public function getTelefono() { return $this->telfono; }
        public function getDomicilio() { return $this->domiciio; }
        public function getCiudad() { return $this->ciudad; }

        public function setId($id) { $this->id = $id; }
        public function setRfc($rfc) { $this->rfc = $rfc; }
        public function setNombre($nombre) { $this->nombre = $nombre; }
        public function setCorreo($correo) { $this->correo = $correo; }
        public function setTelefono($telefono) { $this->telefono = $telefono; }
        public function setDomicilio($domiclio) { $this->domicilio = $domiclio; }
        public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    
    // ---------- M E T O D O S   F U N C I O N A L E S ------------      
        
        public function Insertar(){
            try{
                $cadena= "insert into cliente (rfc, nombre, correo, telefono, domicilio, ciudad) VALUES (:rfc, :nombre, :correo, :telefono, :domicilio, :ciudad)";
                
                $conex=new conexion();
                $conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':rfc', $this->rfc);
                $stmt->bindParam(':nombre', $this->nombre);                    
                $stmt->bindParam(':correo', $this->correo);                    
                $stmt->bindParam(':telefono', $this->telefono);
                $stmt->bindParam(':domicilio', $this->domicilio);
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

        public function editar(){
            try{
                $cadena= "update cliente set rfc=:rfc, nombre=:nombre, correo=:correo, telefono=:telefono, domicilio=:domicilio, ciudad=:ciudad WHERE id=:id";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':rfc', $this->rfc);                    
                $stmt->bindParam(':nombre', $this->nombre);                    
                $stmt->bindParam(':correo', $this->correo);                    
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
            $result = $conex->Consultar("Select id, rfc, nombre, correo, telefono, domicilio, ciudad from cliente where nombre like '%".$nombre."%'");
            return $result;
        }

        public function getArrayClientesJSON($nombre=""){
            $result = $this->getArrayClientes($nombre);
            foreach($result as $row){
                $arrClient = array('id' => $row['id'], 'rfc' => $row['rfc'], 'nombre' => $row['nombre'], 'correo' => $row['correo'], 'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'ciudad' => $row['ciudad']);
                $clientsJson = json_encode($arrClient);
                return $clientsJson;
            }
        }

        public function getTablaClientes($nombre=""){
            try{
                $clients_array = $this->getArrayClientes($nombre);
                $string ="";

                $string = $string."<div id='divClients' name='divClients'>";
                
                $string = $string."<div class='table-container'>";
                $string = $string."<table id='tabla_clientes' class='table table-hover table-striped table-rwd'>";
                $string = $string."<thead>";
                $string = $string."<tr>";
                $string = $string."<th>Id</th>";
                $string = $string."<th>Nombre</th>";
                $string = $string."<th>RFC</th>";
                $string = $string."<th>Correo</th>";
                $string = $string."<th>Teléfono </th>";
                $string = $string."<th>Domicilio</th>";
                $string = $string."<th>Ciudad</th>";
                $string = $string."<th>Opciones</th>";
                $string = $string."</tr>";
                $string = $string."</thead>";
                $string = $string."<tbody>";

                ///echo $row['id']." ".$row['rfc']." ".$row['nombre']." ".$row['telefono']." ".$row['domicilio']." ".$row['ciudad']."<br>";
                if(isset($clients_array)){
                    foreach ($clients_array as $row) {
                        $string = $string."<tr id='".$row['id']."'>";
                        $string = $string."<td id='id_row".$row['id']."' style='text-align:center'>";
                        $string = $string.$row['id'];
                        $string = $string."</td>";

                        $string = $string."<td> <span id='nombre_row".$row['id']."'>";
                            $string = $string.$row['nombre'];
                        $string = $string."</span></td>";

                        $string = $string."<td>";
                            $string = $string."<span id='rfc_row".$row['id']."'>".$row['rfc']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td>";     
                            $string = $string."<span id='correo_row".$row['id']."'>".$row['correo']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td> <span id='telefono_row".$row['id']."'>";
                            $string = $string.$row['telefono'];
                        $string = $string."</span></td>";

                        $string = $string."<td> <span id='domicilio_row".$row['id']."'>";
                            $string = $string.$row['domicilio'];
                        $string = $string."</span></td>";

                        $string = $string."<td> <span id='ciudad_row".$row['id']."'>";
                            $string = $string.$row['ciudad'];
                        $string = $string."</span></td>";

                        $string = $string."<td id='opciones_row".$row['id']."'>";
                            $string = $string."<div style='text-align: center; font-size: 1.25em;'> ";
                            $string = $string."<a data-toggle='modal' href='#modalEdit' onClick='openClient(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                            $string = $string."<a data-toggle='modal' href='#modalDelete' onClick='deleteClient(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
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
    
        private function getClienteByCampo($campo, $data){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, rfc, nombre, correo, telefono, domicilio, ciudad from cliente where ".$campo." = '".$data."'");
            return $result;
        }
        
        public function getClientByCampoJSON($campo="nombre", $data=""){
            try{
                $result = $this->getClienteByCampo($campo, $data);
                foreach($result as $row){
                    $Client = array('id' => $row['id'], 'rfc' => $row['rfc'], 'nombre' => $row['nombre'], 'correo' => $row['correo'], 'telefono' => $row['telefono'],'domicilio' => $row['domicilio'],'ciudad' => $row['ciudad']);                
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
                    $this->setCorreo($row['correo']);
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