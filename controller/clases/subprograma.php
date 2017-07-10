<?php
	class SubPrograma
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "tsubpro";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tsubpro";
			$condicion = "codspro='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "tsubpro";
			$condicion = "codspro='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>