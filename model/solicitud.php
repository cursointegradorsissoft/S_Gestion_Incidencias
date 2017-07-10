<?php

	function ValRegSol($codsol,$codper,$fecini,$fecfin, $totday, $ranper, $lab, $nla  )
	{
		$codsol == "" ? $error='Codigo':$error='';
		$codper == "" ? $error='Nombre':$error='';
		if(strlen($error)==0)
		{	
			// OBTENER CORREO DE JEFE DE AREA
			$sql2="SELECT USEALI, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) AS NOM, CODJEF FROM TUSER INNER JOIN
			TABGRU ON CODUSEPER=CODJEF INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER WHERE FKCODPER=$codper ";
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

			// ENVIO DE SOLICITUD
			$fecha=substr($fecini, 6,4)."-".substr($fecini, 3,2)."-".substr($fecini, 0,2);
			$fecha2=substr($fecfin, 6,4)."-".substr($fecfin, 3,2)."-".substr($fecfin, 0,2);
			$datos = array(
				'codsol' => $codsol,
				'codper' => $codper,
				'fecreg' => date("Y-m-d"),
				'fecini' => $fecha,
				'fecfin' => $fecha2,
				'totday' => $totday,
				'totlab' => $lab,
				'totnla' => $nla,
				'ranper' => $ranper,
				'observ' => 'SOLICITUD DE VACACIONES',
				'status' => 'E',
				'soljef' => $_SESSION["cod_jef"],
				'solrec' => $_SESSION["cod_rrhh"]
			);
			$values=json_encode($datos);
			$val = Solicitud::insertar($values);

						
			$jefe=$_SESSION["jefe"];
			$mensaje=funciones::envio_correo_solicitud($jefe,$_SESSION["tra"],$fecha,$fecha2,$totday,$ranper);
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
	

	function ValModSolEmi($codsol,$fecini,$fecfin, $totday, $lab, $nla )
	{
		$codsol == "" ? $error='Codigo':$error='';
		if(strlen($error)==0)
		{
			$fecha=substr($fecini, 6,4)."-".substr($fecini, 3,2)."-".substr($fecini, 0,2);
			$fecha2=substr($fecfin, 6,4)."-".substr($fecfin, 3,2)."-".substr($fecfin, 0,2);
			$datos = array(
				'fecini' => $fecha,
				'fecfin' => $fecha2,
				'totday' => $totday,
				'totlab' => $lab,
				'totnla' => $nla,
			);
			$values=json_encode($datos);
			$val= Solicitud::modificar($codsol,$values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}
	
	
	function ValModSol($codigo)
	{
		$nombre == "" ? $error='Nombre':$error='';
		if(strlen($error)==0)
		{
			$datos = array(
				'status' => "B",
			);
			$values=json_encode($datos);
			$val= Solicitud::modificar($codigo,$values);
		}
	}
	
	
	function ValEliSol($codigo)
	{
		if($codigo!=null)
		{
			$val= Solicitud::eliminar($codigo);
			header("location:solicitud");
		}
	}
	
	// EMITIDAS POR LA JEFATURA
	function ValRegSolJef($codsol,$codper,$fecini,$fecfin, $totday, $ranper, $totlab, $totnla)
	{
		$codsol == "" ? $error='Codigo':$error='';
		$codper == "" ? $error='Nombre':$error='';
		if(strlen($error)==0)
		{
			// OBTENER CORREO DE JEFE DE AREA
			$sql2="SELECT USEALI, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) AS NOM, CODJEF FROM TUSER INNER JOIN
			TABGRU ON CODUSEPER=CODJEF INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER WHERE FKCODPER=$codper ";
			$val2=funciones::listadoReturn($c,$sql2);
			$codjef=mysql_result($val2, 0, 2);

			$sql3=" SELECT CODJEF FROM TABGRU WHERE CODGRU=6 ";
			$val3=funciones::listadoReturn($c,$sql3);
			$codrrhh= mysql_result($val3, 0, 0);

			$fecha=substr($fecini, 6,4)."-".substr($fecini, 3,2)."-".substr($fecini, 0,2);
			$fecha2=substr($fecfin, 6,4)."-".substr($fecfin, 3,2)."-".substr($fecfin, 0,2);
			$datos = array(
				'codsol' => $codsol,
				'codper' => $codper,
				'fecreg' => date("Y-m-d"),
				'fecini' => $fecha,
				'fecfin' => $fecha2,
				'totday' => $totday,
				'totlab' => $totlab,
				'totnla' => $totnla,
				'ranper' => $ranper,
				'observ' => 'SOLICITUD DE VACACIONES',
				'status' => 'JA',
				'soljef' => $codjef,
				'solrec' => $codrrhh
			);
			$values=json_encode($datos);
			$val= Solicitud::insertar($values);		
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function ValRegSolJef2($codsol,$codper,$fecini,$fecfin, $totday,$ranper,$totlab, $totnla)
	{
		$codsol == "" ? $error='Codigo':$error='';
		$codper == "" ? $error='Nombre':$error='';
		if( strlen($error)==0 )
		{
			// OBTENER CORREO DE JEFE DE AREA
			$sql2="SELECT USEALI, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM) AS NOM, CODJEF FROM TUSER INNER JOIN
			TABGRU ON CODUSEPER=CODJEF INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER WHERE FKCODPER=$codper ";
			$val2=funciones::listadoReturn($c,$sql2);
			while($reg=mysql_fetch_array($val2)){
				$_SESSION["cod_jef"]=$reg[2];
			}

			$sql3=" SELECT CODJEF FROM TABGRU WHERE CODGRU=6 ";
			$val3=funciones::listadoReturn($c,$sql3);
			while($regw=mysql_fetch_array($val3)){
				$_SESSION["cod_rrhh"]=$regw[0];
			}

			$fecha=substr($fecini, 6,4)."-".substr($fecini, 3,2)."-".substr($fecini, 0,2);
			$fecha2=substr($fecfin, 6,4)."-".substr($fecfin, 3,2)."-".substr($fecfin, 0,2);
			$datos = array(
				'codsol' => $codsol,
				'codper' => $codper,
				'fecreg' => date("Y-m-d"),
				'fecini' => $fecha,
				'fecfin' => $fecha2,
				'totday' => $totday,
				'totlab' => $totlab,
				'totnla' => $totnla,
				'ranper' => $ranper,
				'observ' => 'SOLICITUD DE VACACIONES',
				'status' => 'RA',
				'soljef' => $_SESSION["cod_jef"],
				'solrec' => $_SESSION["cod_rrhh"]
			);
			$values=json_encode($datos);
			$val= Solicitud::insertar($values);
			$_SESSION["cod_jef"]=NULL;
			$_SESSION["cod_rrhh"]=NULL;

			$consulta2="SELECT PERCOD, PERARE, PERFUN, TOTDAY, TOTLAB, TOTNLA FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$codsol";
			$datos2 = funciones::listadoReturn($c,$consulta2);
			$cod_per = mysql_result($datos2, 0, 0);
			$cod_are = mysql_result($datos2, 0, 1);
			$cod_car = mysql_result($datos2, 0, 2);
			$tot_day = mysql_result($datos2, 0, 3);
			$tot_lab = mysql_result($datos2, 0, 4);
			$tot_nla = mysql_result($datos2, 0, 5);

			//CODIGO PARA ACTUALIZAR VACACIONES GENERADAS 
			$query="SELECT * FROM TVACGEN WHERE TVACPER=".$cod_per." AND TVACLAB<>22 AND TVACNLA<>8 ";
			$cant_dias=$tot_lab;
			$cant_dias2=$tot_nla;
			$registros = funciones::listadoReturn($c,$query);
			
      while ($reg=mysql_fetch_array($registros)) 
      {
          $valor=22;
          $aux=$cant_dias+$reg[3];
          if($cant_dias>21)
          {
            $aux==0?$cant_dias=$cant_dias-22:$cant_dias=$aux-22;
            funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACLAB=$valor WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
          }
          else if($cant_dias>0)
          {
            if($aux>22)
            {
              $cant_dias=$cant_dias+$reg[3];
              $cant_dias=$aux-22;
              funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACLAB=$valor WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
            }
            else
            {
              $valor=$aux;
              funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACLAB=$valor WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
              $cant_dias=$cant_dias-$valor;
            }
          }


          $valor2=8;
          $aux2=$cant_dias2+$reg[4];
          if($cant_dias2>7)
          {
            $aux2==0?$cant_dias2=$cant_dias2-8:$cant_dias2=$aux2-8;
            funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACNLA=$valor2 WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
          }
          else if($cant_dias2>0)
          {
            if($aux2>8)
            {
              $cant_dias2=$cant_dias2+$reg[4];
              $cant_dias2=$aux2-8;
              funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACNLA=$valor2 WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
            }
            else
            {
              $valor2=$aux2;
              funciones::listadoReturn($c,"UPDATE TVACGEN SET TVACNLA=$valor2 WHERE TVACPER=$reg[0] AND TVACANI=$reg[1] ");
              $cant_dias2=$cant_dias2-$valor2;
            }
          }
      }


			
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

?>