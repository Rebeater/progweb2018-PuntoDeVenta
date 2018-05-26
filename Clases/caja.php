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
        public function __construct($id=""){
            $this->id            = $id;
            $this->nombre        = "";
            $this->descripcion   = "";
            $this->usuarioActivo = "";
            $this->ultimoUsuario = "";
            $this->saldo         = 0;
            
            if($id!=""){
                try{
                    $conex = new conexion();
                    $result = $conex->Consultar("Select id, nombre, descripcion, usuarioActivo, ultimoUsuario, saldo FROM caja where id = ".$id."");
                    foreach ($result as $caja) {
                        $this->id            =  $caja['id'];
                        $this->nombre        =  $caja['nombre'];
                        $this->descripcion   =  $caja['descripcion'];
                        $this->usuarioActivo =  $caja['usuarioActivo'];
                        $this->ultimoUsuario =  $caja['ultimoUsuario'];
                        $this->saldo         =  $caja['saldo'];
                    }
                }
                catch(exception $e){
                }          
            }  
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------
        public function getId()                          { return $this->id;            }    
        public function getNombre()                      { return $this->nombre;        }    
        public function getDescripcion()                 { return $this->descripcion;   }    
        public function getUsuarioActivo()               { return $this->usuarioActivo; }    
        public function getUltimoUsuario()               { return $this->ultimoUsuario; }    
        public function getSaldo()                       { return $this->saldo;         }    

        public function setId($id)                       { $this->id = $id;             }    
        public function setNombre($nombre)               { $this->nombre = $nombre;         }    
        public function setDescipcion($descripcion)      { $this->descripcion = $descripcion;    }    
        public function setUsuarioActivo($usuarioActivo) { $this->UsuarioActivo = $usuarioActivo;  }    
        public function setUltimoUsuario($ultimoUsuario) { $this->ultimoUsuario = $ultimoUsuario;  }    
        public function setSaldo($saldo)                 { $this->saldo = $saldo;          }    
        
    // ---------- M E T O D O S   F U N C I O N A L E S ------------      
    
        private function getCajas(){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, descripcion, usuarioActivo, ultimoUsuario, saldo FROM caja ORDER BY id ASC");
            return $result;
        }

        public function getCajasDisponibles(){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, nombre, descripcion, usuarioActivo, ultimoUsuario, saldo FROM caja where usuarioActivo = ''  ORDER BY id ASC");
            return $result;
        }

        public function getCajasJSON(){
            $result =  $this->getCajas();
            $arrayCajas;
            foreach($result as $row){
                $arrayCajas[] = array('id' => $row['id'], 'nombre' => $row['nombre'], 'descripcion' => $row['descripcion'], 'usuarioActivo' => $row['usuarioActivo'], 'ultimoUsuario' => $row['ultimoUsuario'], 'saldo' => $row['saldo']);
            }
            return json_encode($arrayCajas);
        }

        public function getCboxCajas($idcbox){
            $result = $this->getCajasDisponibles();

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
        
        public function actualizarCampo($campo, $value){
            try{
                $cadena= "update caja set ".$campo."=:value WHERE id=".$this->id;
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':value', $value);                    

				if($stmt->execute())
				{
					return true;
				}
				else
				{
                    
                    foreach($stmt->errorInfo() as $errores){
                        echo "<br>";
                        echo $errores;
                    }
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