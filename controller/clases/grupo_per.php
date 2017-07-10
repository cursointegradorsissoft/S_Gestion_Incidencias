<?php
	class Grupos
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "tabgru";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tabgru";
			$condicion = "codgru='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "tabgru";
			$condicion = "codgru='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}
	}
?>