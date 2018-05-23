<?php
include_once("validaciones.php");
include_once("conexion.php");

    class producto{
    // ----------------- A T R I B U T O S ---------------------        
        
        private $id;
        private $concepto;
        private $stock;
        private $precioUnitario;
        private $descuento;

    // ------------- C O N S T R U C T O R  ----------------------

        public function __construct($id=""){
            $this->id = "";
            $this->concepto= "";
            $this->stock= "";
            $this->precioUnitario= "";
            if($id !=""){
                try{
                    $conex = new conexion();
                    $result = $conex->Consultar("Select id, concepto, stock, precioUnitario from producto where id = '".$id."'");
                    foreach($result as $row){
                        $this->id = $row['id'];
                        $this->concepto = $row['concepto'];
                        $this->stock = $row['stock'];
                        $this->precioUnitario = $row['precioUnitario'];
                    }   
                } catch(PDOException $e)
			    {
    				echo "Error: " . $e->getMessage();
                }
            }
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------

        public function getId() { return $this->id; }    
        public function getConcepto() { return $this->concepto; }    
        public function getStock() { return $this->stock; }    
        public function getPrecioUnitario() { return $this->precioUnitario; }    
        public function getDescuento() { return $this->descuento; }    

        public function setId($id) { $this->id = $id; }    
        public function setConcepto($concepto) {$this->concepto = $concepto; }    
        public function setStock($stock) { $this->stock = $stock; }    
        public function setPrecioUnitario($precioUnitario) {  $this->precioUnitario = $precioUnitario; }    
        public function setDescuento($descuento) {  $this->descuento = $descuento; }    

    // ---------- M E T O D O S   F U N C I O N A L E S ------------      

        public function Insertar(){
            try{
                $cadena= "insert into producto (id, concepto, stock, precioUnitario, descuento) VALUES (:id, :concepto, :stock, :precioUnitario, :descuento)";

                $conex=new conexion();
                $conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':concepto', $this->concepto);
                $stmt->bindParam(':stock', $this->stock);                    
                $stmt->bindParam(':precioUnitario', $this->precioUnitario);                    
                $stmt->bindParam(':descuento', $this->descuento);                    
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

        public function editar($hiddenID){
            try{
                $cadena= "update producto set id=:id, concepto=:concepto, stock=:stock, precioUnitario=:precioUnitario, descuento=:descuento WHERE id=:hiddenID";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':hiddenID', $hiddenID);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':concepto', $this->concepto);                    
                $stmt->bindParam(':stock', $this->stock);                    
                $stmt->bindParam(':precioUnitario', $this->precioUnitario);                    
                $stmt->bindParam(':descuento', $this->descuento);
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
                $cadena= "delete from producto where id = :id";
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

        private function getArrayProductos($concepto){            
            $conex = new conexion();
            $result = $conex->Consultar("Select id, concepto, stock, precioUnitario, descuento from producto where concepto like '%".$concepto."%'");
            return $result;
        }

        public function getArrayProductosJSON($concepto=""){
            $result = $this->getArrayProductos($concepto);
            $arrProduct;
            foreach($result as $row){
                $arrProduct[] = array('id' => $row['id'], 'concepto' => $row['concepto'], 'stock' => $row['stock'], 'precioUnitario' => $row['precioUnitario'], 'descuento' => $row['descuento'] );
            }

            return isset($arrProduct) ? json_encode($arrProduct) : "";
        }

        public function getTablaProductos($concepto=""){
            try{
                $productos_array = $this->getArrayProductos($concepto);
                $string ="";

                $string = $string."<div id='divProducts' name='divProducts'>";
                
                $string = $string."<div class='table-container'>";
                $string = $string."<table id='tabla_productos' class='table table-hover table-striped table-rwd'>";
                $string = $string."<thead>";
                $string = $string."<tr>";
                $string = $string."<th>Id</th>";
                $string = $string."<th>Concepto</th>";
                $string = $string."<th>Stock</th>";
                $string = $string."<th>Precio Unitario</th>";
                $string = $string."<th>Descuento</th>";
                $string = $string."<th>Opciones</th>";
                $string = $string."</tr>";
                $string = $string."</thead>";
                $string = $string."<tbody>";

                ///echo $row['id']." ".$row['rfc']." ".$row['nombre']." ".$row['telefono']." ".$row['domicilio']." ".$row['ciudad']."<br>";
                if(isset($productos_array)){
                    foreach ($productos_array as $row) {
                        $string = $string."<tr id='".$row['id']."'>";
                        $string = $string."<td id='id_row".$row['id']."' style='margin-left:1em'>";
                        $string = $string.$row['id'];
                        $string = $string."</td>";

                        $string = $string."<td> <span id='concepto_row".$row['id']."'>";
                            $string = $string.$row['concepto'];
                        $string = $string."</span></td>";

                        $string = $string."<td>";
                            $string = $string."<span id='stock_row".$row['id']."'>".$row['stock']."</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td>";     
                            $string = $string."<span>$</span><span id='precioUnitario_row".$row['id']."'>".$row['precioUnitario']."</span>";
                        $string = $string."</span></td>";
                       
                        $string = $string."<td>";     
                            $string = $string."<span id='descuento_row".$row['id']."'>".$row['descuento']."</span><span>%</span>";
                        $string = $string."</span></td>";

                        $string = $string."<td id='opciones_row".$row['id']."'>";
                            $string = $string."<div style='text-align: center; font-size: 1.25em;'> ";
                            $string = $string."<a data-toggle='modal' href='#modalEdit' onClick='openProduct(this)' id='edit_".$row['id']."' href='#' class='far fa-edit' style='color:black; margin-right: 5px;'></a>";
                            $string = $string."<a data-toggle='modal' href='#modalDelete' onClick='deleteProduct(this)' id='delete_".$row['id']."' href='#' class='far fa-trash-alt' style='color: rgba(255,0, 0, 0.8);'></a>";
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

        private function getProductoByCampo($campo, $data){
            $conex = new conexion();
            $result = $conex->Consultar("Select id, concepto, stock, precioUnitario, descuento from producto where ".$campo." = '".$data."'");
            return $result;
        }
        
        public function getProductoByCampoJSON($campo="concepto", $data=""){
            try{
                $result = $this->getProductoByCampo($campo, $data);
                foreach($result as $row){
                    $Product = array('id' => $row['id'], 'concepto' => $row['concepto'], 'stock' => $row['stock'], 'precioUnitario' => $row['precioUnitario'], 'descuento' => $row['descuento']);                
                    $productJson = json_encode($Product);
                    return $productJson;
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }   

        public function getProductByCampo($campo="concepto", $data=""){
            try{ 
                $result = $this->getProductoByCampo($campo, $data);
                foreach($result as $row){
                    $this->id = $row['id'];
                    $this->setConcepto($row['concepto']);
                    $this->setStock($row['stock']);
                    $this->setPrecioUnitario($row['precioUnitario']);
                    $this->setDescuento($row['descuento']);
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }
    
    }
?>