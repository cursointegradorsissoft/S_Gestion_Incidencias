<?php
	class Programas
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "programa";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "programa";
			$condicion = "codpro='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "programa";
			$condicion = "codpro='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>