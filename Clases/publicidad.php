<?php
include_once("validaciones.php");
include_once("conexion.php");
    class publicidad{
    // ----------------- A T R I B U T O S ---------------------        
               // promo { id, titulo, descripcio, img, status } 
        private $id;
        private $titulo;
        private $descripcion;        
        private $img;
        private $status;
    // ------------- C O N S T R U C T O R  ----------------------
        public function __construct($id=""){
            $this->id            = $id;
            $this->titulo        = "";
            $this->descripcion   = "";
            $this->img           = "";
            $this->status        = false;
            
            if($id!=""){
                try{
                    $conex = new conexion();
                    $result = $conex->Consultar("Select id, titulo, descripcion, img, status FROM publicidad where id = ".$id."");
                    foreach ($result as $caja) {
                        $this->id            =  $caja['id'];
                        $this->titulo        =  $caja['titulo'];
                        $this->descripcion   =  $caja['descripcion'];
                        $this->img =  $caja['img'];
                        $this->status         =  $caja['status'];
                    }
                }
                catch(exception $e){
                }          
            }  
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------
        public function getId()                          { return $this->id;            }    
        public function getTitulo()                      { return $this->titulo;        }    
        public function getDescripcion()                 { return $this->descripcion;   }    
        public function getImg()                         { return $this->img;           }    
        public function getStatus()                      { return $this->status;        }    

        public function setId($id)                       { $this->id = $id;             }    
        public function setTitulo($titulo)               { $this->titulo = $titulo;         }    
        public function setDescripcion($descripcion)      { $this->descripcion = $descripcion;    }    
        public function setImg($img)                     { $this->img = $img;           }    
        public function setStatus($status)               { $this->status= $status;         }    
        
    // ---------- M E T O D O S   F U N C I O N A L E S ------------      
    
    public function Insertar(){
        try{
            $cadena= "insert into publicidad (titulo, descripcion) VALUES (:titulo, :descripcion)";
            
            $conex=new conexion();
            $conn = $conex->conectarse();
            $stmt = $conn->prepare($cadena);

            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descripcion', $this->descripcion);                    
            
            if($stmt->execute())
            {
                $conex = new conexion();
                $result = $conex->Consultar("SELECT id FROM publicidad ORDER BY id DESC LIMIT 1");
                $idInsertado = 0;

                
                foreach ($result as $row) {
                    $idInsertado = $row['id'];
                }
                return $idInsertado;
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

    private function getArrayPublicidad($title){            
        $conex = new conexion();
        $result = $conex->Consultar("Select id, titulo,descripcion , img, status from publicidad where titulo like ". "'%%'");
        //echo "Select id, titulo,descripcion , img, status from publicidad where titulo like ". "'%%'";    
        return $result;
    }

    public function getArrayPublicidadJSON($titulo=''){
        $result = $this->getArrayPublicidad($titulo);
        $arrPromo;
        foreach($result as $row){
            $arrPromo[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'img' => $row['img'], 'descripcion' => $row['descripcion'], 'status' => $row['status']);
        }
        $PromosJson = json_encode($arrPromo);
        return $PromosJson;
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

    public function updateCampo($campo="", $data = ""){
        try{
            $cadena= "update publicidad set ".$campo."=:data WHERE id=:id";
            $conex=new conexion();
            $conn = $conex->conectarse();
            $stmt = $conn->prepare($cadena);

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':data', $this->data);
        

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
}
?>