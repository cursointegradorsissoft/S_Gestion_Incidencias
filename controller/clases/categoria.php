<?php
	class Categoria
	{
		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "categoria";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}


		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "categoria";
			$condicion = "IdCategoria='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function eliminar($codigo)
		{
			$tabla= "categoria";
			$condicion = "IdCategoria='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>