<?php
	class usuario
	{
		
		public static function login($query)
		{
			$values = json_decode($query,true);
			$con = "select * from tuser where useali = '".$values['usuario']."' and usecla='".$values['clave']."' ";
			$data = funciones::listadoWhere($con);

			if(mysql_num_rows($data)>0)
			{
				while ($fil=mysql_fetch_array($data)) {
					$return = array(
						'codigo' => $fil[0],
						'usuario' => $fil[1],
						'clave' => $fil[2],
						'estado' => $fil[3]
						);
				}
			}
			else
			{
				$return = "Datos Incorrectos";
			}
			return $return;
		}

		public static function insertar($data)
		{
			$values = json_decode($data,true);
			$tabla= "tuser";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}

		/* PARA CUMPLEAÑOS */
		public static function insertarSaludo($data)
		{
			$values = json_decode($data,true);
			$tabla= "saludos";
			$v=funciones::insertar($tabla,$values);
			return $v;
		}



		public static function modificar($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tuser";
			$condicion = "usecod='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}
		
		public static function modificar2($cond, $data)
		{
			$values = json_decode($data,true);
			$tabla= "tuser";
			$condicion = "useali='$cond' ";
			$v=funciones::modificar($tabla,$condicion,$values);
			return $v;
		}

		public static function eliminar($codigo)
		{
			$tabla= "tuser";
			$condicion = "usecod='$codigo' ";
			$v=funciones::eliminar($tabla,$condicion);
			return $v;
		}

	}
?>