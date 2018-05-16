<?php
include_once("validaciones.php");
include_once("conexion.php");
    class caja{
    // ----------------- A T R I B U T O S ---------------------        
        private $id;
        private $nombre;
        private $descripcion;        
        private $usuarioActivo;
        private $ultimoUsuario;
        private $saldo;
    // ------------- C O N S T R U C T O R  ----------------------
        public function __construct(){
            $id = "";
            $nombre = "";
            $descripcion = "";
            $usuarioActivo = "";
            $ultimoUsuario = "";
            $saldo = "";
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------
        public function getId() { return $this->id; }    
        public function getNombre() { return $this->nombre; }    
        public function getDescripcion()    { return $this->descripcion; }    
        public function getUsuarioActivo() { return $this->usuarioActivo; }    
        public function getUltimoUsuario() { return $this->ultimoUsuario; }    
        public function getSaldo() { return $this->saldo; }    

        public function setId($id) { $this->id = $id; }    
        public function setNombre($nombre) { $this->id = $nombre; }    
        public function setDescipcion($descripcion) { $this->id = $descripcion; }    
        public function setUsuarioActivo($usuarioActivo){ $this->id = $usuarioActivo; }    
        public function setUltimoUsuario($ultimoUsuario) { $this->id = $ultimoUsuario; }    
        public function setSaldo($saldo)  { $this->id = $saldo; }    
        
    // ---------- M E T O D O S   F U N C I O N A L E S ------------      
    
        private function getCajas(){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, descripcion, usuarioActivo, ultimoUsuario, saldo FROM caja ORDER BY id ASC");
            return $result;
        }
        public function getCajasJSON(){
            $result =  $this->getCajas();
            foreach($result as $row){
                $arrayCajas= array('id' => $row['id'], 'nombre' => $row['nombre'], 'descripcion' => $row['descripcion'], 'usuarioActivo' => $row['usuarioActivo'], 'ultimoUsuario' => $row['ultimoUsuario'], 'saldo' => $row['saldo']);
                $cajasJson = json_encode($arrayCajas);
                return $cajasJson;
            }
        }

        public function getCboxCajas($idcbox){
            $result = $this->getCajas();

            echo "<div class='input-group mb-3'>";
            echo "    <div class='input-group-prepend'>";
            echo "        <label class='input-group-text' for='cbx_cajas'>Cajas</label>";
            echo "    </div>";
            echo "    <select class='custom-select' id='".$idcbox."' name='".$idcbox."'>";

            foreach($result as $row){
                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }

            echo "</select>";
            echo "</div>";
        }
            
    }
?>