<?php
	function ValRegVac($codper, $codpla, $codare, $codcar, $fecini, $fecfin, $totday)
	{
		$codper == "" ? $error='Codigo Personal':$error='';
		$codpla == "" ? $error='Cod Placa':$error='';
		if(strlen($error)==0)
		{
			/*
			$agregar=funciones::dameFecha(str_replace("/", "-", date("d-m-Y",strtotime($fecfin))),1);
			$fin=date("Y-m-d",strtotime($agregar));
			*/
			
			$inicio=date("Y-m-d",strtotime($fecini));
			$fin=date("Y-m-d",strtotime($fecfin));
			
			$inicio2=date("m-Y-d",strtotime($fecini));
			$fin2=date("m-Y-d",strtotime($fecfin));

			$fecha1 = substr(str_replace("-", "/", $inicio2),0,7);
			$fecha2 = substr(str_replace("-", "/", $inicio2),5,strlen($_POST['fecini']));
			$fecha3 = substr(str_replace("-", "/", $fin2),5,strlen($_POST['fecini']));

			$datos = array(
				'vaccop' => $codper,
				'vacpla' => $codpla,
				'vacare' => $codare,
				'vacfun' => $codcar,
				'vacini' => $inicio,
				'vacffi' => $fin,
				'vacdif' => $totday,
				'vacper' => $fecha1,
				'vacinr' => $fecha2,
				'vacffr' => $fecha3,
				'vacfsi' => date('d/m/Y')
			);

			$values=json_encode($datos);
			$val= Vacaciones::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."---".$codper. ".--" .$codpla;
		}
		return $val;
	}

	function ValModVac($codigo,$nombre)
	{
		$nombre == "" ? $error='Nombre':$error='';

		if(strlen($error)==0)
		{
			$datos = array(
				'ARENOM' => $nombre
			);

			$values=json_encode($datos);
			$val= Vacaciones::modificar($codigo,$values);
		}
	}

	function ValEliVac($codigo)
	{
		if($codigo!=null)
		{
			$val= Vacaciones::eliminar($codigo);
			header("location:vacaciones");
		}
	}

?>