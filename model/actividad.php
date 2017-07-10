<?php

	function ValRegAct($codigo,$nombre,$descrip, $fecha,$imagenes)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$nombre == "" ? $error='Nombre':$error='';
		$fecha == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$fec_mod=date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));

			$datos = array(
				'actcod' => $codigo,
				'actnom' => $nombre,
				'actdes' => $descrip,
				'actfec' => $fec_mod,
				'actfot' => $imagenes[0]
			);

			foreach ($imagenes as $codfot => $imagen) {
				echo $imagen;
				$datos2 = array(
					'codact' => $codigo,
					'foto' => $imagen,
					'title' => $nombre
				);
				Actividad::insertardetalle($datos2);
			}

			$values=json_encode($datos);
			$val= Actividad::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModAct($codigo,$nombre,$descrip,$fecha)
	{
		$nombre == "" ? $error='Nombre':$error='';
		$fecha == "" ? $error = "Fecha" : $error ='';

		if(strlen($error)==0)
		{
			$fec_mod= date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));
			$datos = array(
				'actnom' => $nombre,
				'actdes' => $descrip,
				'actfec' => $fec_mod
			);

			$values=json_encode($datos);
			$val= Actividad::modificar($codigo,$values);
		}
	}

	function ValEliAct($codigo)
	{
		if($codigo!=null)
		{
			$val= Actividad::eliminar($codigo);
			header("location:actividad");
		}
	}

	function ValEliActDet($codigo)
	{
		if($codigo!=null)
		{
			$val= Actividad::eliminardetalle($codigo);
			header("location:actividad");
		}
	}
?>