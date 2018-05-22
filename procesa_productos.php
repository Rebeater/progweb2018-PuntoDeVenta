<?php
    include_once("Clases/producto.php");
    include_once("Clases/validaciones.php");

    $valida = new validaciones();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        $mi_error = false;

         /* Si la opcion es Buscar*/
         if ( isset($_POST['btnBuscar'])){ 
            if(isset($_POST['conceptoABuscar'])){
                $concepto =  $_POST['conceptoABuscar'];
                $product = new producto();
                $product->getTablaProductos($concepto);
            }
            else  {
                echo "No existe valor a buscar";
            }
            exit();
        }
        else if(isset($_POST['btnInsertar'])){
            $product        = new producto();
            $id             = $valida->test_input($_POST['txt_id']);
            $concepto       = $valida->test_input($_POST['txt_concepto']);
            $stock          = $valida->test_input($_POST['txt_stock']);
            $precioUnitario = $valida->test_input($_POST['txt_precioUnitario']);
            $descuento      = $valida->test_input($_POST['txt_descuento']);

            $product->setId($id);
            $product->setConcepto($concepto);
            $product->setStock($stock);
            $product->setPrecioUnitario($precioUnitario);
            $product->setDescuento($descuento);
            $product->Insertar();
            exit();
        }
        else if ( isset($_POST['btnEliminar'])){
            $id = $valida->test_input($_POST['lbl_ID']);
            $product = new producto();
            $product->setId($id);
            $product->Eliminar();
            exit();
        }
        else if(isset($_POST['getDataProducto'])){
            if(isset($_POST['id'])){
                $product = new producto();
                $id = $valida->test_input($_POST['id']);
                echo $product->getProductoByCampoJSON("id",$id);
            }
            exit();
        } elseif (isset($_POST['btnActualizar'])){
            $product = new producto();
            $hidenid             = $valida->test_input($_POST['hiddenEdit_ID']);
            $id             = $valida->test_input($_POST['txt_edit_id']);
            $concepto       = $valida->test_input($_POST['txt_edit_concepto']);
            $stock          = $valida->test_input($_POST['txt_edit_stock']);
            $precioUnitario = $valida->test_input($_POST['txt_edit_precioUnitario']);
            $descuento = $valida->test_input($_POST['txt_edit_descuento']);
            $product->setId($id);
            $product->setConcepto($concepto);
            $product->setStock($stock);
            $product->setPrecioUnitario($precioUnitario);
            $product->setDescuento($descuento);            
            $product->Editar($hidenid);
            exit();
        }else if(isset($_POST['getTabla'])){
            $product = new producto();
            $product->getTablaProductos("");
            exit();
        }
    }

?>