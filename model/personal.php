<?php

	function ValRegPer($codmod,$nomod,$patmod,$matmod,$codlocmod,$codaremod,$codsaremod,$emamod,$telmod,$anemod,$celmod,$celmod2,$codcarmod,$ingmod,$nacmod,$imagen,$dnimod,$finmod,$nombre2,$clave)
	{
		$codmod == "" ? $error = "Cod. Empleado" : $error ='';

		if(strlen($error)==0)
		{
			$mes = substr($nacmod,3,2);
			$dia = substr($nacmod,0,2);

			$nacimiento=date("Y-m-d",strtotime(str_replace('/', '-', $nacmod)));
			$ingreso=date("Y-m-d",strtotime(str_replace('/', '-', $ingmod)));

			$datos = array(
				'PERCOD' => $codmod,
				'PERNOM' => $nomod,
				'PERAPP' => $patmod,
				'PERAPM' => $matmod,
				'PERLOC' => $codlocmod,
				'PERARE' => $codaremod,
				'PERSRE' => $codsaremod,
				'PEREMA' => $emamod,
				'PERTEL' => $telmod,
				'PERANE' => $anemod,
				'PERTE2' => $celmod,
				'PERTE3' => $celmod2,
				'PERFUN' => $codcarmod,
				'PERFIG' => $ingreso,
				'PERFNA' => $nacimiento,
				'PERIMG' => $imagen,
				'PERDNI' => $dnimod,
				'PERMES' => $mes,
				'PERDCU' => $dia,
				'PERNIN' =>  date('m/Y',strtotime($ingmod)),
				'PERCOM' => $patmod." ".$nomod,
				'PERCUM' => $dia."/".$mes,
				'PERFIR' => $nombre2,
				'PERCLA' => $clave
			);

			$values=json_encode($datos);
			$val= Personal::insertar($values);

			$c = funciones::codigo("tuser","campo");
			$men=ValRegUsu2($c,$emamod, substr($nomod,0,1) .$patmod ,$codmod);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModPer($codmod,$nomod,$patmod,$matmod,$codlocmod,$codaremod,$codsaremod,$emamod,$telmod,$anemod,$celmod,$celmod2,$codcarmod,$ingmod,$nacmod,$dnimod,$finmod,$clave)
	{
		$nomod == "" ? $error='Nombre':$error='';
		$codmod == "" ? $error = "Fecha" : $error ='';

		
		if(strlen($error)==0)
		{
			$nacimiento=date("Y-m-d",strtotime(str_replace('/', '-', $nacmod)));
			$ingreso=date("Y-m-d",strtotime(str_replace('/', '-', $ingmod)));

			$datos = array(
				'PERNOM' => $nomod,
				'PERAPP' => $patmod,
				'PERAPM' => $matmod,
				'PERLOC' => $codlocmod,
				'PERARE' => $codaremod,
				'PERSRE' => $codsaremod,
				'PEREMA' => $emamod,
				'PERTEL' => $telmod,
				'PERANE' => $anemod,
				'PERTE2' => $celmod,
				'PERTE3' => $celmod2,
				'PERFUN' => $codcarmod,
				'PERFIG' => $ingreso,
				'PERFNA' => $nacimiento,
				'PERDNI' => $dnimod,
				'PERCLA' => $clave
			);

			$values=json_encode($datos);
			$val= Personal::modificar($codmod,$values);
		}
	}

	function ValModPer4($codmod,$nomod,$patmod,$matmod,$codlocmod,$codaremod,$codsaremod,$emamod,$telmod,$anemod,$celmod,$celmod2,$codcarmod,$ingmod,$nacmod,$dnimod,$finmod,$clave)
	{
		$nomod == "" ? $error='Nombre':$error='';
		$codmod == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$nacimiento=date("Y-m-d",strtotime(str_replace('/', '-', $nacmod)));
			$ingreso=date("Y-m-d",strtotime(str_replace('/', '-', $ingmod)));
			$fin=date("Y-m-d",strtotime(str_replace('/', '-', $finmod)));

			$datos = array(
				'PERNOM' => $nomod,
				'PERAPP' => $patmod,
				'PERAPM' => $matmod,
				'PERLOC' => $codlocmod,
				'PERARE' => $codaremod,
				'PERSRE' => $codsaremod,
				'PEREMA' => $emamod,
				'PERTEL' => $telmod,
				'PERANE' => $anemod,
				'PERTE2' => $celmod,
				'PERTE3' => $celmod2,
				'PERFUN' => $codcarmod,
				'PERFIG' => $ingreso,
				'PERFNA' => $nacimiento,
				'PERDNI' => $dnimod,
				'PERFCS' => $fin,
				'PERCLA' => $clave
			);

			if($fin != "" ){
				$query_per = "SELECT PERDNI, CONCAT_WS(' ',PERAPP,CONCAT_WS(' ,',PERAPM,PERNOM)),DESGRU, FUNNOM, PERFIG, YEAR(CURDATE())-YEAR(PERFIG) FROM TPERS  INNER JOIN TFUNC ON PERFUN=FUNCOD INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE PERCOD=$codmod";
				$val_per = funciones::listadoReturn($c,$query_per);
				$dni_per =	mysql_result($val_per,0,0);
				$dat_per =  mysql_result($val_per,0,1);
				$are_per =  mysql_result($val_per,0,2);
				$car_per =  mysql_result($val_per,0,3);
				$fec_per =  mysql_result($val_per,0,4);
				$tot_per =  mysql_result($val_per,0,5);

				$query_apt = "UPDATE TVACGEN SET TVACLAB=22, TVACNLA=8 WHERE TVACPER=$codmod ";
				$val_cese = funciones::listadoReturn($c,$query_apt);
				$mensaje=funciones::enviar_correo_cese($dni_per,$dat_per,$are_per,$car_per,$fec_per,$tot_per);
			}

			$values=json_encode($datos);
			$val= Personal::modificar($codmod,$values);
		}
	}

	function ValModPer5($codmod,$nomod,$patmod,$matmod,$codlocmod,$codaremod,$codsaremod,$emamod,$telmod,$anemod,$celmod,$celmod2,$codcarmod,$ingmod,$nacmod,$imagen,$dnimod,$finmod,$clave)
	{
		$nomod == "" ? $error='Nombre':$error='';
		$codmod == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$nacimiento=date("Y-m-d",strtotime(str_replace('/', '-', $nacmod)));
			$ingreso=date("Y-m-d",strtotime(str_replace('/', '-', $ingmod)));

			$datos = array(
				'PERNOM' => $nomod,
				'PERAPP' => $patmod,
				'PERAPM' => $matmod,
				'PERLOC' => $codlocmod,
				'PERARE' => $codaremod,
				'PERSRE' => $codsaremod,
				'PEREMA' => $emamod,
				'PERTEL' => $telmod,
				'PERANE' => $anemod,
				'PERTE2' => $celmod,
				'PERTE3' => $celmod2,
				'PERFUN' => $codcarmod,
				'PERFIG' => $ingreso,
				'PERFNA' => $nacimiento,
				'PERDNI' => $dnimod,
				'PERFIR' => $imagen,
				'PERCLA' => $clave
			);

			$values=json_encode($datos);
			$val= Personal::modificar($codmod,$values);
		}
	}

	function ValModPer3($codmod,$nomod,$patmod,$matmod,$codlocmod,$codaremod,$codsaremod,$emamod,$telmod,$anemod,$celmod,$celmod2,$codcarmod,$ingmod,$nacmod,$imagen,$dnimod,$finmod,$clave)
	{
		$nomod == "" ? $error='Nombre':$error='';
		$codmod == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$nacimiento=date("Y-m-d",strtotime(str_replace('/', '-', $nacmod)));
			$ingreso=date("Y-m-d",strtotime(str_replace('/', '-', $ingmod)));

			$datos = array(
				'PERNOM' => $nomod,
				'PERAPP' => $patmod,
				'PERAPM' => $matmod,
				'PERLOC' => $codlocmod,
				'PERARE' => $codaremod,
				'PERSRE' => $codsaremod,
				'PEREMA' => $emamod,
				'PERTEL' => $telmod,
				'PERANE' => $anemod,
				'PERTE2' => $celmod,
				'PERTE3' => $celmod2,
				'PERFUN' => $codcarmod,
				'PERFIG' => $ingreso,
				'PERFNA' => $nacimiento,
				'PERIMG' => $imagen,
				'PERDNI' => $dnimod,
				'PERCLA' => $clave
			);

			$values=json_encode($datos);
			$val= Personal::modificar($codmod,$values);
		}
	}

	function ValModPer2($codmod)
	{
		$codmod == "" ? $error='Nombre':$error='';

		if(strlen($error)==0)
		{
			$datos = array(
				'PEREST' => 'A'
			);

			$values=json_encode($datos);
			$val= Personal::modificar($codmod,$values);
		}
	}

	function ValEliPer($codigo)
	{
		if($codigo!=null)
		{
			$val= Personal::eliminar($codigo);
			header("location:personal");
		}
	}

?>