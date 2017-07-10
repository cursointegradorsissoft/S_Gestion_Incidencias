<?php

	function ValRegSubPro($codigo,$nombre, $ruta, $fkpro)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$nombre == "" ? $error='Nombre':$error='';
		$ruta == "" ? $error = "Ruta" : $error ='';
		$fkpro == "" ? $error = "Descripcion" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'codspro' => $codigo,
				'nomspro' => $nombre,
				'rutaspr' => $ruta,
				'codprofk' => $fkpro
			);

			$values=json_encode($datos);
			$val= SubPrograma::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModSubPro($codigo,$nombre, $ruta, $fkpro)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$nombre == "" ? $error='Nombre':$error='';
		$ruta == "" ? $error = "Ruta" : $error ='';
		$fkpro == "" ? $error = "Descripcion" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'nomspro' => $nombre,
				'rutaspr' => $ruta,
				'codprofk' => $fkpro
			);

			$values=json_encode($datos);
			$val= SubPrograma::modificar($codigo,$values);
		}
	}

	function ValEliSubPro($codigo)
	{
		if($codigo!=null)
		{
			$val= SubPrograma::eliminar($codigo);
			header("location:subprograma");
		}
	}

?>