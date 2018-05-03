<?php
	class validaciones
	{
		private $palabras =array('<','>','/*','//','delete');
		private $mansaje;
		
		public function getMensaje()
		{
			return $this->mensaje;
		}
		
		function test_input($data) 
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}		
		//Solo números
		public function onlyNum($valor)
		{
			if(!preg_match("/^[0-9]+$/", $valor)!=0)
			{
				return false;
			}
			else
			{
				$this->mensaje="-Solo Números.";
				return true;
			}
		}
		//solo números y letras
		public function onlyNumLet($valor)
		{
			if(!preg_match("/^[0-9a-zA-Z]*$/", $valor)!=0)
			{
				return false;
			}
			else
			{
				$this->mensaje="-No puede incluir caracteres especiales ni acentuados.";
				return true;
			}
		}
		
		
		private function elimina_acentos($cadena)
		{
			$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
			$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
			return(strtr($cadena,$tofind,$replac));
		}
		
		public function Seguridad($cadena)
		{
			$resultado=true;
			/*
			for($i=0;$i<count($this->palabras);$i++)
			{
				if(substr_count($cadena,$this->palabras[$i])>0)
				{
					$this->mensaje="-Caracteres Invalidos!.";
					$resultado= false;
				}
			}*/
			$cadena=strip_tags($cadena);
			$cadena=addslashes($cadena);
			//return $resultado;
			return $cadena;
		}
	}
?>
