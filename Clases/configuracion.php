<?php
    include_once("validaciones.php");
    include_once("conexion.php");
    class configuracion{
        
    // ----------------- A T R I B U T O S ---------------------

        private $companyName;
        private $pais;
        private $cp;
        private $ciudad;
        private $estado;
        private $domicilio;
        private $telefonoCode;
        private $telefono;
        private $correo;
        private $correoSoporte;
        private $passCorreoSoporte;
        private $img;
        private $descripcion;

    // ------------- C O N S T R U C T O R E S ------------------

        public function __construct(){
            // Recupera y establece los datos de la configuraciÃ³n
            try{
                $conex = new conexion();
                $result = $conex->Consultar("Select 
                                    companyName, pais, cp, ciudad, estado, domicilio, telefonoCode, telefono, correo, 
                                    correoSoporte, passCorreoSoporte, logo, descripcion 
                                        from configuracion");
                foreach($result as $row){
                    $this->companyName = $row['companyName'];
                    $this->pais = $row['pais'];
                    $this->cp = $row['cp'];
                    $this->ciudad = $row['ciudad'];
                    $this->estado = $row['estado'];
                    $this->domicilio = $row['domicilio'];
                    $this->telefonoCode = $row['telefonoCode'];
                    $this->telefono = $row['telefono'];
                    $this->correo = $row['correo'];
                    $this->correoSoporte = $row['correoSoporte'];
                    $this->passCorreoSoporte = $row['passCorreoSoporte'];
                    $this->img = $row['logo'];
                    $this->descripcion = $row['descripcion'];
                }   
            } catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}

        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------

        public function getCompanyName() {   return $this->companyName;  }

        public function getPais() {   return $this->Pais;  }

        public function getCP() {   return $this->cp;  }

        public function getCiudad() {   return $this->ciudad;  }

        public function getEstado() {   return $this->estado;  }

        public function getDomicilio() {   return $this->domicilio;  }

        public function getTelefonoCode() {   return $this->telefonoCode;  }

        public function getTelefono() {   return $this->telefono;  }

        public function getCorreo() {   return $this->correo;    }

        public function getCorreoSoporte() { return $this->passCorreoSoporte;    }

        public function getPasCorreoSoporte($companyName) {  $this->companyName = $companyName;  }

        public function getImg() {   return $this->img;  }

        public function getDescripcion() {   return $this->descripcion;  }



        public function setCompanyName($companyName) {  $this->companyName=$companyName;  }

        public function setPais($pais) {  $this->pais=$pais;  }

        public function setCP($cp) {  $this->cp=$cp;  }

        public function setCiudad($ciudad) {  $this->ciudad=$ciudad;  }

        public function setEstado($estado) {  $this->estado=$estado;  }

        public function setDomicilio($domicilio) {  $this->domicilio=$domicilio;  }

        public function setTelefonoCode($telefonoCode) {  $this->telefonoCode=$telefonoCode;  }

        public function setTelefono($telefono) {  $this->telefono=$telefono;  }

        public function setCorreo($correo) {  $this->correo=$correo;  }

        public function setCorreoSoporte($correoSoporte) {  $this->correoSoporte=$correoSoporte;  }

        public function setPasCorreoSoporte($passCorreoSoporte) {  $this->passCorreoSoporte=$passCorreoSoporte;  }        

        public function setImg($img) {  $this->img>=$img;  }

        public function setDescripcion($descripcion) {  $this->descripcion=$descripcion;  }

    // ---------- M E T O D O S   F U N C I O N A L E S ------------      

    public function loadData(){
        $conex = new conexion();
        $result = $conex->Consultar("Select companyName, pais, cp, ciudad, estado, domicilio, telefonoCode, telefono, correo, correoSoporte, passCorreoSoporte, descripcion, logo
                                    From configuracion");
        foreach($result as $row){
            $arrConf = array('companyName'=>$row['companyName'], 'pais'=>$row['pais'], 'cp'=>$row['cp'], 
                             'ciudad'=>$row['ciudad'], 'estado'=>$row['estado'], 
                             'domicilio'=>$row['domicilio'], 'telefonoCode'=>$row['telefonoCode'], 
                             'telefono'=>$row['telefono'], 'correo'=>$row['correo'], 
                             'correoSoporte'=>$row['correoSoporte'], 'passCorreoSoporte'=>$row['passCorreoSoporte'],
                             'descripcion'=>$row['descripcion'], 'img'=>$row['logo']);
        }
        $confJSON = json_encode($arrConf);
        return $confJSON;
    }

    public function saveData($ajustesJSON){
        $conf = json_decode($ajustesJSON);

        $this->setCompanyName($conf->companyName);
        $this->setPais($conf->pais);
        $this->setCP($conf->cp);
        $this->setCiudad($conf->ciudad);
        $this->setEstado($conf->estado);
        $this->setDomicilio($conf->domicilio);
        $this->setTelefonoCode($conf->telefonoCode);
        $this->setTelefono($conf->telefono);
        $this->setCorreo($conf->correo);
        $this->setCorreoSoporte($conf->correoSoporte);
        $this->setPasCorreoSoporte($conf->passCorreoSoporte);
        $this->setimg($conf->img);
        $this->setDescripcion($conf->descripcion);

        try{
            $cadena= "update configuracion set companyName=:companyName, pais=:pais, cp=:cp, ciudad=:ciudad, estado=:estado, 
                        domicilio=:domicilio, telefonoCode=:telefonoCode, telefono=:telefono, correo=:correo, correoSoporte=:correoSoporte,
                        passCorreoSoporte=:passCorreoSoporte, logo=:logo, descripcion=:descripcion WHERE 1";
            $conex=new conexion();
            $conn = $conex->conectarse();
            $stmt = $conn->prepare($cadena);

            $stmt->bindParam(':companyName', $this->companyName);
            $stmt->bindParam(':pais', $this->pais);
            $stmt->bindParam(':cp', $this->cp);
            $stmt->bindParam(':ciudad', $this->ciudad);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':domicilio', $this->domicilio);
            $stmt->bindParam(':telefonoCode', $this->telefonoCode);
            $stmt->bindParam(':telefono', $this->telefono);                    
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':correoSoporte', $this->correoSoporte);
            $stmt->bindParam(':passCorreoSoporte', $this->passCorreoSoporte);
            $stmt->bindParam(':logo', $this->img);
            $stmt->bindParam(':descripcion', $this->descripcion);
        
            //echo $this->id;

            if($stmt->execute())
            {
                echo "Datos guardados con Exito";
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