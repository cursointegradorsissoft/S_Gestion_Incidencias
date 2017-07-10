<?php

	function ValRegCat($codigo,$nombre,$estado)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$nombre == "" ? $error='Nombre':$error='';
		$estado == "" ? $error='Estado':$error='';

		if(strlen($error)==0)
		{
			$datos = array(
				'IdCategoria' => $codigo,
				'NombreCategoria' => $nombre,
				'Estado' => $estado
			);

			$values=json_encode($datos);
			$val= Categoria::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModCat($codigo,$nombre,$estado)
	{
		$nombre == "" ? $error='Nombre':$error='';
		$estado == "" ? $error="Estado":$error='';

		if(strlen($error)==0)
		{
			$datos = array(
				'NombreCategoria' => $nombre,
				'Estado' => $estado
			);
			$values=json_encode($datos);
			$val= Categoria::modificar($codigo,$values);
		}
	}

	function ValEliCat($codigo)
	{
		if($codigo!=null)
		{
			$val= Categoria::eliminar($codigo);
			header("location:categoria");
		}
	}
?>