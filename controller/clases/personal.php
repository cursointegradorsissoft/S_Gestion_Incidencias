<?php
	class Personal
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "tpers";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tpers";
			$condicion = "PERCOD='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "tpers";
			$condicion = "PERCOD='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>