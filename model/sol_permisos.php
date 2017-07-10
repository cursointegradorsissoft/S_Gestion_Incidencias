<?php

	function ValSolPer($codigo,$codpers,$fecinie,$fecfine,$horinie,$horfine,$codtip,$codtipdet,$obsperm)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$codpers == "" ? $error='Nombre':$error='';
		if(strlen($error)==0)
		{	
			// OBTENER CORREO DE JEFE DE AREA
			$sql2="SELECT USEALI, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) AS NOM, CODJEF FROM TUSER INNER JOIN
			TABGRU ON CODUSEPER=CODJEF INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER WHERE FKCODPER=$codpers ";
			$val2=funciones::listadoReturn($c,$sql2);
			while($reg=mysql_fetch_array($val2)){
				$_SESSION["jefe"]=$reg[0];
				$_SESSION["tra"]=$reg[1];
				$_SESSION["cod_jef"]=$reg[2];
			}

			$sql3=" SELECT CODJEF FROM TABGRU WHERE CODGRU=6 ";
			$val3=funciones::listadoReturn($c,$sql3);
			while($regw=mysql_fetch_array($val3)){
				$_SESSION["cod_rrhh"]=$regw[0];
			}
			
			$codtip=="1"?$concepto="Comisi&oacute;n":$concepto="Asuntos Personales";

			if($fecinie=="" && $fecfine==""){
				$datos = array(
					'CODPERM'	=> $codigo,
					'CODPERS'	=> $codpers,
					'FECPERM'	=> date("Y-m-d"),
					'HORINIE'	=> $horinie,
					'HORFINE'	=> $horfine,
					'CODTIP'	=> $codtip,
					'CODTIPDET'	=> $codtipdet,
					'CODJEFP'	=> $_SESSION["cod_jef"],
					'CODRECP'	=> $_SESSION["cod_rrhh"],
					'OBSPERM'	=> $obsperm,
					'ESTPERM'	=> 'EP'
				);

				$tipo="Por Horas";
				$diferente=date("H:i:s",strtotime("00:00")+strtotime($horfine)-strtotime($horinie)) ." Hrs.";
				$inicio=date('h:i:s A', strtotime($horinie));
				$finali=date('h:i:s A', strtotime($horfine));
			}else{

				$fecha 	= date("Y-m-d", strtotime(str_replace('/', '-', $fecinie)));
				$fecha2 = date("Y-m-d", strtotime(str_replace('/', '-', $fecfine)));
				
				$datos = array(
					'CODPERM'	=> $codigo,
					'CODPERS'	=> $codpers,
					'FECPERM'	=> date("Y-m-d"),
					'FECINIE'	=> $fecha,
					'FECFINE'	=> $fecha2,
					'CODTIP'	=> $codtip,
					'CODTIPDET'	=> $codtipdet,
					'CODJEFP'	=> $_SESSION["cod_jef"],
					'CODRECP'	=> $_SESSION["cod_rrhh"],
					'OBSPERM'	=> $obsperm,
					'ESTPERM'	=> 'EP'
				);

				$tipo="Por Fechas";
				$diferente = floor((strtotime($fecfine) - strtotime($fecinie))/86400)+1 . " D&iacute;as";
				$inicio=$fecha;
				$finali=$fecha2;
			}
			

			$values=json_encode($datos);
			$val = Solicitud_Permisos::insertar($values);
						
			$jefe=$_SESSION["jefe"];
			$mensaje=funciones::enviar_correo_usuario($jefe, $_SESSION["tra"], $tipo, $concepto, $inicio, $finali, $diferente);
			$_SESSION["jefe"]=null;
			$_SESSION["tra"]=null;
			$_SESSION["cod_jef"]=null;
			$_SESSION["cod_rrhh"]=null;
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValModSolVigComi($cod,$ini,$fin,$opt)
	{
		$cod == "" ? $error='Codigo':$error='';
		if(strlen($error)==0)
		{
			if($opt=="1"){
				$datos = array(
					'FECINIR' => $ini,
					'FECFINR' => $fin,
					'ESTPERM' => 'AV'
				);
			}else{
				$datos = array(
					'HORINIR' => $ini,
					'HORFINR' => $fin,
					'ESTPERM' => 'AV'
				);
			}
			$values=json_encode($datos);
			$val= Solicitud_Permisos::modificar($cod,$values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}
	
	function ValModSolJefComi($codigo,$estado)
	{
		$codigo == "" ? $error='Codigo':$error='';
		if(strlen($error)==0)
		{	
			$sql1=" SELECT * FROM TPERM WHERE CODPERM='".$codigo."' ";
			$val1=funciones::listadoReturn($c,$sql1);
			$cod_per=mysql_result($val1,0,1);
			if(mysql_result($val1, 0,3)==NULL){
				$inicio="Hora Salida";
				$valini=mysql_result($val1,0,5);
				$finali="Hora Retorno";
				$valfin=mysql_result($val1,0,6);
				$totals=date("H:i:s",strtotime("00:00")+strtotime($valfin)-strtotime($valini)) ." Hrs.";
			}else{
				$inicio="Fecha Salida";
				$valini=date("d/m/Y",strtotime(mysql_result($val1,0,3)));
				$finali="Fecha Retorno";
				$valfin=date("d/m/Y",strtotime(mysql_result($val1,0,4)));
				$totals=floor((strtotime(mysql_result($val1,0,4)) - strtotime(mysql_result($val1,0,3)))/86400)+1 . " D&iacute;as";
			}
			
			$sql2="SELECT USEALI, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) AS NOM, CODJEF FROM TUSER INNER JOIN TABGRU ON
			CODUSEPER=CODJEF INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER WHERE FKCODPER='".$cod_per."' ";
			$val2=funciones::listadoReturn($c,$sql2);
			$jefe=mysql_result($val2,0, 0);
			$tra=mysql_result($val2,0, 1);
			$cod_jef=mysql_result($val2,0, 2);

			$sql3="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),DESGRU FROM TPERS INNER JOIN TABGRU ON CODJEF=PERCOD WHERE
			CODJEF='".$cod_jef."' ";
			$val3=funciones::listadoReturn($c,$sql3);
			$nom_jef=mysql_result($val3, 0,0);
			$nom_are=mysql_result($val3, 0,1);


			$sql4="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),DESGRU FROM TPERS INNER JOIN TABGRU ON CODJEF=PERCOD WHERE CODGRU=6 ";
			$val4=funciones::listadoReturn($c,$sql4);
			$nom_rec=mysql_result($val4, 0,0);
			$nom_are_rec=mysql_result($val4, 0,1);

			switch ($estado) {
				case 'AJ': $funcion="enviar_correo_jefatura";   $status="Aprobado";  break;
				case 'CJ': $funcion="enviar_correo_jefatura";	$status="Cancelado"; break;
				case 'AR': $funcion="enviar_correo_recursos";	$status="Aprobado";  break;
				case 'CR': $funcion="enviar_correo_recursos";	$status="Cancelado"; break;
			}

			$datos = array(
				'ESTPERM' => $estado
			);

			$values=json_encode($datos);
			$val= Solicitud_Permisos::modificar($codigo,$values);

			if($funcion=="enviar_correo_jefatura"){
				$mensaje=funciones::$funcion($jefe,$nom_jef,$nom_are,$tra,$status);
			}else{
				$mensaje=funciones::$funcion($jefe,$nom_jef,$nom_are,$tra,$status,$nom_rec,$nom_are_rec,$inicio,$valini,$finali,$valfin,$totals);
			}
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}
	
	
	function ValSolPerEli($codigo)
	{
		if($codigo!=null)
		{
			$val= Solicitud_Permisos::eliminar($codigo);
			header("location:solicitud");
		}
	}
	
?>