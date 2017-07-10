<?php
	class Actividad
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "tacti";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		public static function insertardetalle($data)
		{
			$tabla= "fotoact";
			$v=funciones::insertar($tabla,$data);
			return $v;
		}

		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tacti";
			$condicion = "actcod='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "tacti";
			$condicion = "actcod='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

		public static function eliminardetalle($codigo)
		{
			$tabla= "fotoact";
			$condicion = "codact='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>