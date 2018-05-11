<?php
    class configuracion{
        
    // ----------------- A T R I B U T O S ---------------------

        private $companyName;
        private $correoSoporte;
        private $passCorreoSoporte;

    // ------------- C O N S T R U C T O R E S ------------------

        public function __construct(){
            // Recupera y establece los datos de la configuración
            try{
                $conex = new conexion();
                $result = $conex->Consultar("Select companyName, correoSoporte, passCorreoSoporte from configuracion");
                foreach($result as $row){
                    $this->companyName = $row['companyName'];
                    $this->correoSoporte = $row['correoSoporte'];
                    $this->passCorreoSoporte = $row['passCorreoSoporte'];
                }   
            } catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}

        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------

        public function getCompanyName() {   return $this->companyName;  }

        public function getCorreoSoporte() {   return $this->correoSoporte;    }

        public function getPasCorreoSoporte() { return $this->passCorreoSoporte;    }

        public function setCompanyName($companyName) {  $this->companyName = $companyName;  }

        public function setCorreoSoporte($correoSoporte) {  $this->correoSoporte = $correoSoporte;  }

        public function setPasCorreoSoporte($passCorreoSoporte) {   $this->passCorreoSoporte = $passCorreoSoporte;  }

    // ---------- M E T O D O S   F U N C I O N A L E S ------------      

    }
?>