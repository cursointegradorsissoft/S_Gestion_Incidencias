<?php

	function ValRegPro($codigo,$nombre, $descripcion)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$nombre == "" ? $error='Nombre':$error='';
		$descripcion == "" ? $error = "Descripcion" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'codpro' => $codigo,
				'pronom' => $nombre,
				'prodes' => $descripcion,
			);

			$values=json_encode($datos);
			$val= Programas::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModPro($codigo,$nombre,$descripcion)
	{
		$nombre == "" ? $error='Nombre':$error='';
		$descripcion == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'pronom' => $nombre,
				'prodes' => $descripcion,
			);

			$values=json_encode($datos);
			$val= Programas::modificar($codigo,$values);
		}
	}

	function ValEliPro($codigo)
	{
		if($codigo!=null)
		{
			$val= Programas::eliminar($codigo);
			header("location:programas");
		}
	}

?>