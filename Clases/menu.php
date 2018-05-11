<?php
	include_once("conexion.php");
	class menu
	{
		private $id;
		private $nombre;
		private $url;
		private $padre;
		
		public function setPadre($valor)
		{
			$this->padre = $valor;
		}		
		public function getPadre()
		{
			return $this->padre;
		}

		public function seturl($valor)
		{
			$this->url=$valor;
		}
		public function geturl()
		{
			return $this->url;
		}		
		
		public function setNombre($valor)
		{
			$this->nombre=$valor;
		}		
		public function getNombre()
		{
			return $this->nombre;
		}
		
		public function setID($valor)
		{
			$validador=new validaciones();
			if($validador->onlyNum($valor))
			{
				$this->id=$valor;
			}
			else
			{
				$this->ERROR=true;
			}
		}
		public function getID()
		{
			return $this->id;
		}
		
		/*Edita el enlace guardando el ID de la secci�n*/
		public function Insertar()
		{
			try {
				$cadena="INSERT INTO menus (id, nombre, url, padre) VALUES (:id, :nombre, :url, :padre)";
				$conex=new conexion();
				$conn = $conex->conectarse();
				$stmt = $conn->prepare($cadena);
				echo $cadena;
				
				$stmt->bindParam(':id', $this->id);
				$stmt->bindParam(':nombre', $this->nombre);
				$stmt->bindParam(':url', $this->url);
				$stmt->bindParam(':padre', $this->padre);
				
				if($stmt->execute())
				{
					echo "No hubo error";
					return true;
				}
				else
				{
					echo "No hubo error";
					return false;
				}
				$conn = null;
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		
		/*Edita el enlace guardando el ID de la secci�n*/
		public function Editar()
		{
			try
			{
				$cadena="UPDATE menus SET nombre = :nombre, url = :url, padre = :padre WHERE id = :id";
				$conex=new conexion();
				$conn = $conex->conectarse();
				$stmt = $conn->prepare($cadena);	
				$stmt->bindParam(':nombre', $this->nombre);
				$stmt->bindParam(':url', $this->url);
				$stmt->bindParam(':padre', $this->padre);
				$stmt->bindParam(':id', $this->id);
				if($stmt->execute())
					return true;
				else
					return false;
			}
			catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
				return false;
			}				
		}

		public function Borrar()
		{
			try {
				$cadena="DELETE FROM menus WHERE id=:id";
				echo $cadena;
				$conex=new conexion();
				$conn = $conex->conectarse();
				$stmt = $conn->prepare($cadena);
				$stmt->bindParam(':id', $this->id);
				if($stmt->execute())
					return true;
				else
					return false;
			}
			catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
				return false;
			}			
		}		
		
		/*Revisa si el item del menu esta publicado*/
		public function Disponible()
		{
			$conex=new conexion();
			$resultado=$conex->Consultar("SELECT publicado FROM menu WHERE id=".$this->id);
			if($fila=mysql_fetch_array($resultado))
			{
				if($fila[0]==1)
					return true;
			}
			return false;
		}
		
		public function LeerTodos_Tabla()
		{
			$conex=new conexion();
			$resultado=$conex->Consultar("select id, nombre, url, padre FROM menus ORDER BY id asc");
			
			//echo "<form action='menu_procesa.php' method='POST'>";
            echo "<table id='tabla_menus' class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Nombre</th>";
            echo "<th>Url</th>";
			echo "<th>Padre</th>";
           echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
					
			foreach ($resultado as $row)
			{
				echo "<tr id='".$row['id']."' onclick=menu_datos(this)>";
				echo "<td id='id_row" . $row['id'] . "' style='text-align:center'>";
				echo $row['id']; 
				echo "</td>";				
				echo "<td id='nombre_row" . $row['id'] . "'>";
				echo $row['nombre']; 
				echo "</td>";
				echo "<td id='url_row" . $row['id'] . "'>";
				echo $row['url']; 
				echo "</td>";
				echo "<td id='padre_row" . $row['id'] . "' style='text-align:center'>";
				echo $row['padre']; 
				echo "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</form>"; 
		}
		
		/*Obtiene todos los items del menu para el administrador*/
		public function RegresaMenu()
		{
			$conex=new conexion();
			$resultado=$conex->Consultar("select id, nombre, url, padre FROM menus Where padre= -1 ORDER BY id asc");

		    
		    echo "	<ul class='menu'>";
            echo "		<li class='title-menu'>Menu</li>";
		
			foreach ($resultado as $row)
			{
                $hijos  =$this->tieneHijos($row['id']);
                echo "<li class='";
                echo ($hijos)? "item-submenu" : "";
                echo "' menu='".$row['id']."'>";
                echo "<a ";	
                echo ($row['url'] != "")? "href='".$row['url'] : "";
                echo "'><span class='icon-menu'></span>";

                echo $row['nombre'];
                echo ($hijos)? "<i class='fa fa-angle-right iconRigh'></i>" : "";   
            
                echo "</a>";
				$this->RegresaHijos($row['id'], $row['nombre']);
				echo "</li>";
			}
            echo "	</ul>";
            
		}
		public function RegresaHijos($Padre, $namePadre)
		{
			$conex=new conexion();
			$resultado=$conex->Consultar("select id, nombre, url, padre FROM menus Where padre= " . $Padre. " ORDER BY id asc");
			
			if ($resultado == null)
				return;
            
						
            if ($resultado->rowCount() > 0){
                
                echo "<ul class='submenu'>";
                echo "<li class='title-menu'><span class='icon-menu'></span>".$namePadre."</li>";
                echo "<li class='go-back'>Atras</li>";
            }
				//echo "<ul>";
			
			foreach ($resultado as $row)
			{
                echo "<li>";
                echo "<a ";	
                echo (isset($row['url']))? "href='".$row['url'] : "";
                
                //echo $row['url'];
                echo "'>";
				echo $row['nombre'];			
				echo "</a>";
				$this->RegresaHijos($row['id'], $row['nombre']);
				echo "</li>";
			}		
			if ($resultado->rowCount() > 0)		
                echo "</ul>";
		}


        public function tieneHijos($id){
            $conex=new conexion();
			$resultado=$conex->Consultar("select id, nombre, url, padre FROM menus Where padre= " . $id. " ORDER BY id asc");
			
			if ($resultado == null)
                return false;
            else if ($resultado->rowCount() > 0)
                return true;
        }
	}
?>