<?php
include_once("validaciones.php");
include_once("conexion.php");

    class venta{
    // ----------------- A T R I B U T O S ---------------------        
        
        private $id;
        private $cliente;
        private $vendedor;
        private $fecha;
        private $total;

    // ------------- C O N S T R U C T O R  ----------------------

        public function __construct(){
            $this->id = "";
            $this->cliente = "";
            $this->vendedor = "";
            $this->fecha = "";
            $this->total = "";
        }

    // ---------- M E T O D O S   D E   A C C E S O ---------------

        public function getId() { return $this->id; }    
        public function getCliente() { return $this->cliente; }    
        public function getVendedor() { return $this->vendedor; }    
        public function getFecha() { return $this->fecha; }    
        public function getTotal() { return $this->total; }    

        public function setId($id) { $this->id = $id; }    
        public function setCliente($cliente) {$this->cliente = $cliente; }    
        public function setVendedor($vendedor) { $this->vendedor = $vendedor; }    
        public function setFecha($fecha) {  $this->fecha = $fecha; }    
        public function setTotal($total) {  $this->total = $total; }    

    // ---------- M E T O D O S   F U N C I O N A L E S ------------      

        public function Insertar(){
            try{
                
                $cadena= "insert into ventas (cliente, vendedor, fecha, total) VALUES (:cliente, :vendedor, :fecha, :total)";

                $conex=new conexion();
                $conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':cliente', $this->cliente);
                $stmt->bindParam(':vendedor', $this->vendedor);
                $stmt->bindParam(':fecha', $this->fecha);                    
                $stmt->bindParam(':total', $this->total);                    
                if($stmt->execute())
                {
                    $conex = new conexion();
                    $result = $conex->Consultar("SELECT id FROM ventas ORDER BY id DESC LIMIT 1");
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
        
        public function getPrecioUnitario($idProducto){
                $conex = new conexion();
                $result = $conex->Consultar("SELECT precioUnitario FROM producto where id = '".$idProducto."'");
                $precio = 0;
                foreach ($result as $row) {
                    $precio = $row['precioUnitario'];
                }
                return $precio;
        }

        public function InsertarRegistroVenta($idVenta, $idProducto, $cantidad){
            try{
                $precioUnitario = $this->getPrecioUnitario($idProducto);
                $monto = $precioUnitario * $cantidad; 
            
                $cadena= "insert into registroventa (idVenta, idProducto, precioUnitario, cantidad, monto) VALUES (:idVenta, :idProducto, :precioUnitario, :cantidad, :monto)";

                $conex=new conexion();
                $conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':idVenta', $idVenta);
                $stmt->bindParam(':idProducto', $idProducto);
                $stmt->bindParam(':precioUnitario', $precioUnitario);                    
                $stmt->bindParam(':cantidad', $cantidad);                    
                $stmt->bindParam(':monto', $monto);                    
                if($stmt->execute())
                {
                    echo "Sin errores";
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
                $cadena= "update producto set id=:id, concepto=:concepto, stock=:stock, precioUnitario=:precioUnitario WHERE id=:hiddenID";
				$conex=new conexion();
				$conn = $conex->conectarse();
                $stmt = $conn->prepare($cadena);

                $stmt->bindParam(':hiddenID', $hiddenID);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':concepto', $this->concepto);                    
                $stmt->bindParam(':stock', $this->stock);                    
                $stmt->bindParam(':precioUnitario', $this->precioUnitario);                    
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
            $result = $conex->Consultar("Select id, concepto, stock, precioUnitario from producto where concepto like '%".$concepto."%'");
            return $result;
        }

        public function getArrayProductosJSON($concepto=""){
            $result = $this->getArrayProductos($concepto);
            foreach($result as $row){
                $arrProduct = array('id' => $row['id'], 'concepto' => $row['concepto'], 'stock' => $row['stock'], 'precioUnitario' => $row['precioUnitario']);
                $productosJson = json_encode($arrProduct);
                return $productosJson;
            }
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
                            $string = $string."<span id='precioUnitario_row".$row['id']."'>".$row['precioUnitario']."</span>";
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
            $result = $conex->Consultar("Select id, concepto, stock, precioUnitario from producto where ".$campo." = '".$data."'");
            return $result;
        }
        
        public function getProductoByCampoJSON($campo="concepto", $data=""){
            try{
                $result = $this->getProductoByCampo($campo, $data);
                foreach($result as $row){
                    $Product = array('id' => $row['id'], 'concepto' => $row['concepto'], 'stock' => $row['stock'], 'precioUnitario' => $row['precioUnitario']);                
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
                }
            } catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }
    
    }
?>