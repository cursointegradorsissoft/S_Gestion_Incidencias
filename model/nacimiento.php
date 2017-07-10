<?php
	function ValRegNac($codigo, $name,$fecha,$sexo,$emp,$foto)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$name == "" ? $error='Nombre':$error='';
		$fecha == "" ? $error='Fecha':$error='';
		$sexo == "" ? $error='Sexo':$error='';
		$emp == "" ? $error='Empleado':$error='';
		if(strlen($error)==0)
		{
			$naci=date("Y-m-d",strtotime(str_replace('/', '-', $fecha)));

			$datos = array(
				'CODNAC' => $codigo,
				'NOMNAC' => utf8_encode($name),
				'FECNAC' => $naci,
				'FECREG' => date('Y-m-d'),
				'SEXNAC' => $sexo,
				'CODEMP' => $emp,
				'FOTO' 	 => $foto
			);

			$values=json_encode($datos);
			$val= Nacimiento::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."---".$nombre. ".--" .$codigo;
		}
		return $val;
	}

	function ValModNac($codigo, $name,$fecha,$sexo,$emp)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$name == "" ? $error='Nombre':$error='';
		$fecha == "" ? $error='Fecha':$error='';
		$sexo == "" ? $error='Sexo':$error='';
		$emp == "" ? $error='Empleado':$error='';
		if(strlen($error)==0)
		{
			$naci=date("Y-m-d",strtotime(str_replace('/', '-', $fecha)));

			$datos = array(
				'NOMNAC' => utf8_encode($name),
				'FECNAC' => $naci,
				'FECREG' => date('Y-m-d'),
				'SEXNAC' => $sexo,
				'CODEMP' => $emp
			);

			$values=json_encode($datos);
			$val= Nacimiento::modificar($codigo,$values);
		}
	}

	function ValEliNac($codigo)
	{
		if($codigo!=null)
		{
			$val= Nacimiento::eliminar($codigo);
			header("location:nacimiento");
		}
	}

?>