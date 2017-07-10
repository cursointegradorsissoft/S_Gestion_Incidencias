<?php

	function validar( $usuario, $clave)
	{
		$usuario == "" ? $error='Usuario':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'usuario' => $usuario,
				'clave' => $clave
			);

			$values=json_encode($datos);
			$val= usuario::login($values);
			
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	/* CAMBIA DE ESTADO AL INICIAR SESION O ELIMINAR */
	
	function ValModUsu3($alias, $clave)
	{
		$alias == "" ? $error='Alias':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{

			$datos = array(
				'useest' => $clave,
			);

			$values=json_encode($datos);
			$val= usuario::modificar2($alias,$values);
		}
	}






	function ValRegUsu($codigo,$alias, $clave)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$alias == "" ? $error='Alias':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'usecod' => $codigo,
				'useali' => $alias,
				'usecla' => $clave,
				'useest' => '1'
			);

			$values=json_encode($datos);
			$val= usuario::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}


	/* REGISTRO DESDE EMPLEADO*/
	function ValRegUsu2($codigo,$alias, $clave,$coduse)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$alias == "" ? $error='Alias':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'usecod' => $codigo,
				'useali' => $alias,
				'usecla' => $clave,
				'useest' => '1',
				'coduseper' => $coduse
			);

			$values=json_encode($datos);
			$val= usuario::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}
	/* FIN */



	/* DATOS GENERALES  ( COMPLETOS )  */
	function ValModUsu($codigo,$alias, $clave, $estado)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$alias == "" ? $error='Alias':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{
			$estado == "Habilitado"?$est=1:$est=2;

			$datos = array(
				'useali' => $alias,
				'usecla' => $clave,
				'useest' => $est
			);

			$values=json_encode($datos);
			$val= usuario::modificar($codigo,$values);
		}
	}

	function ValModUsu2($alias, $clave)
	{
		$alias == "" ? $error='Alias':$error='';
		$clave == "" ? $error = "Clave" : $error ='';

		if(strlen($error)==0)
		{

			$datos = array(
				'usecla' => $clave,
			);

			$values=json_encode($datos);
			$val= usuario::modificar2($alias,$values);
		}
	}

	function ValEliUsu($codigo)
	{
		if($codigo!=null)
		{
			$val= usuario::eliminar($codigo);
			header("location:subprograma");
		}
	}



	/* PARA CUMPLEAÑOS */
	function saludos($c,$query)
	{
		$consulta = funciones::listadoReturn($c,$query);
		while($reg=mysql_fetch_array($consulta))
		{
			echo "<section class='imagen'>";
				echo "<img src='themes/images/like.png'>";
			echo "</section>";

			echo "<section class='comentario'>";
				echo "<section class='top'>".utf8_decode($reg[4])."<span>Hace 1 minuto</span></section>";
				echo "<section class='bottom'>".utf8_decode($reg[2])."</section>";
			echo "</section>";
		}
	}

	function insertarsaludo($men, $codami, $nom)
	{
		$men == "" ? $error = "Mensaje" : $error ='';
		$codami == "" ? $error = "Codigo Onomastico" : $error ='';
		$nom == "" ? $error = "Nombres" : $error ='';

		if(strlen($error)==0)
		{
			$tabla = "saludos";
			$campo = "codsal";
			$codigo = funciones::codigo($tabla,$campo);
			$fecha = date('Y-m-d');
			$datos = array(
				'codsal' => $codigo, 
				'fecsal' => $fecha,
				'mensal' => $men,
				'codcum' => $codami,
				'nomemi' => $nom
			);

			$values=json_encode($datos);
			$val= usuario::insertarSaludo($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
	}
		
?>