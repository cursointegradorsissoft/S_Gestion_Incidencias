<?php
  
  ob_clean();
  ob_start();

  $dato=trim($_REQUEST["opt"]);
  header ('Content-type: aplication/vnd.ms-excel');
  header ('Content-Disposition: attachment; filename='.$dato.'.xls');
  
  $cabecera="color:#0B0B61; text-align:center;font-size:35px;";
  $header="background:#0B0B61; color:#FAFAFA; text-align:center; font-size:15px;";
  $items="color:#2E2E2E; text-align:left;font-size:15px;padding-top:15px;";
  $sql=""; $val=""; $num=""; $sql2=""; $val2=""; $num2="";

  if($dato=="Trabajador")
  {
      $sql=" SELECT PERCOD AS CODIGO,
            PERAPP AS 'APELLIDO PATERNO',
            PERAPM AS 'APELLIDO MATERNO',
            PERNOM AS NOMBRES,
            PERFNA AS FECHA_NACIMIENTO,
            PEREMA AS EMAIL,
            PERTEL AS TELEFONO,
            PERANE AS ANEXO,
            PERTE2 AS CELULAR,
            ARENOM AS AREA,
            DESGRU AS SUBAREA
            FROM TPERS INNER JOIN TFUNC ON PERFUN=FUNCOD INNER JOIN TAREA ON PERARE=ARECOD 
            INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE 
            PEREST='' AND PERFCS IS NULL GROUP BY PERCOD ORDER BY PERAPP ASC ";

      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Almuerzo")
  {
      $sql=" SELECT TICODESC AS OPCION,LUNES,MARTES,MIERCOLES,JUEVES,VIERNES FROM TALMU INNER JOIN TTICO ON TICOCOD=ALMUCOD ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Actividad")
  {
      $sql=" SELECT ACTCOD AS CODIGO,ACTNOM AS TITULO,ACTDES AS DESCRIPCION,ACTFEC AS FECHA FROM TACTI ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Area")
  {
      $sql=" SELECT ARECOD AS CODIGO,ARENOM AS NOMBRES,AREDES AS DESCRIPCION FROM TAREA ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Cambio")
  {
      $sql=" SELECT MONCVE AS MONEDA,MONFEC AS FECHA,MONTC1 AS COMPRA, MONTV1 AS VENTA FROM TTICA ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Cargo")
  {
      $sql=" SELECT FUNCOD AS CODIGO, FUNNOM AS NOMBRE FROM TFUNC ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="SubArea")
  {
      $sql=" SELECT ARENOM AS AREA,SARNOM AS SUBAREA FROM TSARE INNER JOIN TAREA ON ARECOD=SARCOD ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Mensual")
  {
      $sql=" SELECT TECOD AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM  AS NOMBRES,
      ARENOM AS AREA, FUNNOM AS CARGO, TEMANUAL AS ANIO, TEMMES AS MES FROM TEMES INNER JOIN TPERS 
      ON TEMPER=PERCOD INNER JOIN TAREA ON ARECOD=PERARE INNER JOIN TFUNC ON FUNCOD=PERFUN ORDER BY PERAPP ASC";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Puntual")
  {
      $sql=" SELECT PUNCOD AS CODIGO,PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES,
      ARENOM AS AREA, FUNNOM AS CARGO, TEPANUAL AS ANIO, TEPMES AS MES FROM TEPUN INNER JOIN TPERS 
      ON TEPCOD=PERCOD INNER JOIN TAREA ON ARECOD=PERARE INNER JOIN TFUNC ON FUNCOD=PERFUN ORDER BY PERAPP ASC ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Local")
  {
      $sql=" SELECT LOCCOD AS CODIGO, LOCNOM AS NOMBRE, LOCDIR AS DIRECCION, LOCDIS AS DISTRITO, LOCDPT AS DEPARTAMENTO FROM TLOCA";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Local")
  {
      $sql=" SELECT LOCCOD AS CODIGO, LOCNOM AS NOMBRE, LOCDIR AS DIRECCION, LOCDIS AS DISTRITO, LOCDPT AS DEPARTAMENTO FROM TLOCA";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Moneda")
  {
      $sql=" SELECT MONCOD AS CODIGO, MONDES AS NOMBRE FROM TMONE ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Nacimiento")
  {
      $sql=" SELECT CODNAC AS CODIGO, PERAPP AS 'A.P. PADRE', PERAPM AS 'A.M. PADRE', PERNOM AS NOMBRES, NOMNAC AS BEBE, FECNAC AS FECHA_NACIMIENTO,SEXNAC AS SEXO FROM TNACI INNER JOIN TPERS ON CODEMP=PERCOD ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Noticia")
  {
      $sql=" SELECT NOTCOD AS CODIGO, NOTTIT AS TITULO, NOTTXT AS DESCRIPCION FROM TNOTI ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Marca")
  {
      $sql=" SELECT MARNOM AS MARCA,SEDNOM AS SEDE, SEDDIR AS DIRECCION, SEDTEL AS TELEFONO, SEDANE AS ANEXO 
      FROM DETSEDE INNER JOIN SEDE ON SEDCODFK=SEDCOD INNER JOIN MARCA ON MARCOD=MARCODFK ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Solicitud")
  {
      $sql=" SELECT CODSOL AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, 
      FECINI AS INICIO, FECFIN AS FIN, TOTDAY AS TOTAL, RANPER AS PERIODO  FROM TSOLIC INNER JOIN 
      TUSER ON CODPER=CODUSEPER INNER JOIN TPERS ON PERCOD=CODPER ORDER BY PERAPP ASC";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Vacaciones")
  {
      $ini=$_REQUEST["ini"];
      $fin=$_REQUEST["fin"];

      $fecini   = date("Y-m-d", strtotime(str_replace("/", "-", $ini )));
      $fecfin   = date("Y-m-d", strtotime(str_replace("/", "-", $fin )));

      $codigo   = $_REQUEST["cod"];
      $nombre   = $_REQUEST["nom"];
      $apellido = $_REQUEST["ape"];

      $cadena=" SELECT CODSOL AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, ARENOM AS AREA, FUNNOM AS CARGO, RANPER AS PERIODO,  DATE_FORMAT(FECINI,'%d/%m/%Y') AS FECHA_INICIO, 
      DATE_FORMAT(FECFIN,'%d/%m/%Y') AS FECHA_FIN, TOTDAY AS TOTAL, DATE_FORMAT(DATE_ADD(FECFIN, INTERVAL 1 DAY),'%d/%m/%Y') AS FECHA_RETORNO FROM TSOLIC INNER JOIN TUSER ON CODPER=CODUSEPER INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TAREA ON ARECOD=PERARE INNER JOIN TFUNC ON PERFUN=FUNCOD ";

      if($ini!= NULL && $fin!= NULL)
      {
        $cadena = $cadena . " AND FECINI>='$fecini' AND FECFIN<='$fecfin' ";  
      }
      
      if($codigo != NULL && $nombre == NULL && $apellido == NULL)
      {
        $query = " $cadena AND CODSOL LIKE '%$codigo%' ";
      }
      else if($codigo == NULL && $nombre != NULL && $apellido == NULL)
      {
        $query = "$cadena AND (PERNOM LIKE '%' '".$nombre."' '%') ";
      }
      else if($codigo == NULL && $nombre == NULL && $apellido != NULL)
      {
        $query = "$cadena AND (PERAPP LIKE '%' '".$apellido."' '%') ";
      }else{
        $query = "$cadena";
      }
      
      $query= $query .  " GROUP BY CODSOL ORDER BY PERAPP ASC ";
      $val=funciones::listadoReturn($c,$query);
      $num=mysql_num_fields($val);
  }
  else if($dato=="TipoComida")
  {
      $sql=" SELECT * FROM TTICO ";
      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Historial_Vacaciones")
  {
      $optra = $_GET["optra"];
      $cod = $_GET["cod"];
      $ape = $_GET["ape"];
      $nom = $_GET["nom"];
      $mes = $_GET["mes"];
      $are = $_GET["are"];
      $are2= $_GET["are2"];

      $default1 = "SELECT TVACPER AS CODIGO, PERDNI AS DNI, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERAPM AS NOMBRES, DATE_FORMAT(PERFIG,'%d/%m/%Y') AS 'FECHA DE INGRESO', YEAR(CURDATE())-YEAR(PERFIG) AS 'AÑOS', SUM(TVACACU) AS 'TOTAL VACACIONES', SUM(tvaclab+tvacnla) AS 'TOTAL TOMADOS', SUM(TVACACU)-SUM(TVACLAB+TVACNLA) AS 'TOTAL PENDIENTES' FROM TPERS INNER JOIN TVACGEN ON PERCOD=TVACPER INNER JOIN DETGRU ON FKCODPER=TVACPER WHERE PERFCS IS NULL AND PEREST=''";

      $default2 = "SELECT PERCOD AS CODIGO, PERDNI AS DNI, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERAPM AS NOMBRES, DATE_FORMAT(PERFIG,'%d/%m/%Y') AS 'FECHA DE INGRESO', YEAR(CURDATE())-YEAR(PERFIG) AS 'AÑOS',
      30 AS 'TOTAL VACACIONES', 0 AS 'TOTAL TOMADOS', 0 AS 'TOTAL PENDIENTES' FROM TPERS INNER JOIN DETGRU ON FKCODPER=PERCOD WHERE PERFCS IS NULL AND PEREST='' AND PERCOD NOT IN ( SELECT TVACPER FROM TVACGEN ) AND YEAR(PERFIG) BETWEEN YEAR(CURDATE())-1 AND YEAR(CURDATE()) ";

      $default3 = "SELECT TVACPER AS CODIGO, PERDNI AS DNI, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, DATE_FORMAT(PERFIG,'%d/%m/%Y') AS 'FECHA DE INGRESO', YEAR(CURDATE())-YEAR(PERFIG) AS 'AÑOS', SUM(TVACACU) AS 'TOTAL VACACIONES', SUM(tvaclab+tvacnla) AS 'TOTAL TOMADOS', SUM(TVACACU)-SUM(TVACLAB+TVACNLA) AS 'TOTAL PENDIENTES' FROM TPERS INNER JOIN TVACGEN ON PERCOD=TVACPER WHERE PERFCS IS NULL AND PEREST=''";

      $default4 = "SELECT PERCOD AS CODIGO, PERDNI AS DNI, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, DATE_FORMAT(PERFIG,'%d/%m/%Y') AS 'FECHA DE INGRESO', YEAR(CURDATE())-YEAR(PERFIG) AS 'AÑOS',
      30 AS 'TOTAL VACACIONES', 0 AS 'TOTAL TOMADOS', 0 AS 'TOTAL PENDIENTES' FROM TPERS WHERE PERFCS IS NULL 
      AND PEREST='' AND PERCOD NOT IN ( SELECT TVACPER FROM TVACGEN ) AND YEAR(PERFIG) BETWEEN 2014 AND 2015";

      if( $optra == "bus_trabajador" )
      {
          if ($cod !=""){
              $default3 = " $default3 AND PERCOD LIKE '%$cod%' ";
              $default4 = " $default4 AND PERCOD LIKE '%$cod%' ";
          }
          if( $ape != "" )
          {
              $default3 = " $default3 AND PERAPP LIKE '%$ape%' ";
              $default4 = " $default4 AND PERAPP LIKE '%$ape%' ";
          }
          if( $nom != "" )
          {
              $default3 = " $default3 AND PERNOM LIKE '%$nom%' ";
              $default4 = " $default4 AND PERNOM LIKE '%$nom%' ";
          }
          $sql = " $default3 GROUP BY CODIGO UNION ALL  $default4 GROUP BY CODIGO ORDER BY 3 ASC ";
      }
      else if( $optra == "bus_programado" )
      {
          $sql="SELECT CODSOL AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, ARENOM AS AREA, FUNNOM AS CARGO, RANPER AS PERIODO,  DATE_FORMAT(FECINI,'%d/%m/%Y') AS FECHA_INICIO, DATE_FORMAT(FECFIN,'%d/%m/%Y') AS FECHA_FIN, TOTDAY AS TOTAL, DATE_FORMAT(DATE_ADD(FECFIN, INTERVAL 1 DAY),'%d/%m/%Y') AS FECHA_RETORNO FROM TSOLIC INNER JOIN TUSER ON CODPER=CODUSEPER INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TAREA ON ARECOD=PERARE INNER JOIN TFUNC ON PERFUN=FUNCOD WHERE FECINI>CURDATE()";
      }
      else if( $optra == "bus_acumulados" )
      {
          if($are2 != "" ){
              $cond= " AND FKCODGRU=$are2 GROUP BY CODIGO ";
              $sql = " $default1 $cond  UNION ALL  $default2 $cond ORDER BY 3 ASC ";
          }
          else
          {
              $sql = " $default1 GROUP BY CODIGO UNION ALL $default2  GROUP BY CODIGO ORDER BY 3 ASC ";
          }
      }
      else if( $optra == "bus_cumpliran" )
      {
          $sql = " $default3 GROUP BY CODIGO UNION ALL  $default4 GROUP BY CODIGO ORDER BY 3 ASC ";
      }

      $val=funciones::listadoReturn($c,$sql);
      $num=mysql_num_fields($val);
  }
  else if($dato=="Permisos_Vigilancia")
  {
      $sql="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS ANOMBRES,
      DATE_FORMAT(FECPERM,'%d/%m/%Y') AS 'FECHA REGISTRO', DATE_FORMAT(HORINIE,'%r') AS 'HORA SALIDA', 
      DATE_FORMAT(HORFINE,'%r') AS 'HORA RETORNO', SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIE, HORFINE ))*60) AS 'TIEMPO TOTAL', DATE_FORMAT(HORINIR,'%r') AS 'H. SALIDA REAL', DATE_FORMAT(HORFINR,'%r') AS 'H. RETORNO REAL',
      SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIR, HORFINR ))*60) AS 'TIEMPO REAL', H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE FECINIE IS NULL AND FECFINE IS NULL AND ESTPERM='AV' GROUP BY CODPERM ORDER BY 2 ASC";
      
      $sql2="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, 
      DATE_FORMAT(FECPERM,'%d/%m/%Y') AS 'FECHA REGISTRO', DATE_FORMAT(FECINIE,'%d/%m/%Y') AS 'FECHA SALIDA', 
      DATE_FORMAT(FECFINE,'%d/%m/%Y') AS 'FECHA FIN', DATEDIFF(FECFINE,FECINIE) AS 'TOTAL DIAS',
      DATE_FORMAT(FECINIR,'%d/%m/%Y') AS 'F. SALIDA REAL', DATE_FORMAT(FECFINR,'%d/%m/%Y') AS 'F. RETORNO REAL', 
      DATEDIFF(FECFINR,FECINIR) AS 'TOTAL DIAS REAL', H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE HORINIE IS NULL AND HORFINE IS NULL AND ESTPERM='AV' GROUP BY CODPERM ORDER BY 2 ASC";

      $val=funciones::listadoReturn($c,$sql);
      $val2=funciones::listadoReturn($c,$sql2);
      $num=mysql_num_fields($val);
      $num2=mysql_num_fields($val2);
  }
  else if($dato=="Registro_de_Permisos")
  {
      $sql="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, 
      DATE_FORMAT(FECPERM,'%d/%m/%Y') AS 'FECHA REGISTRO', DATE_FORMAT(HORINIE,'%r') AS 'HORA SALIDA', 
      DATE_FORMAT(HORFINE,'%r') AS 'HORA RETORNO', SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIE, HORFINE ))*60)   AS 'TIEMPO TOTAL', DATE_FORMAT(HORINIR,'%r') AS 'H. SALIDA REAL', DATE_FORMAT(HORFINR,'%r') AS 'H. RETORNO REAL',SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIR, HORFINR ))*60) AS 'TIEMPO TOTAL', H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE FECINIE IS NULL AND FECFINE IS NULL AND ESTPERM='AV' GROUP BY CODPERM ORDER BY 2 ASC ";

      $sql2="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES,
      DATE_FORMAT(FECPERM,'%d/%m/%Y') AS 'FECHA REGISTRO', DATE_FORMAT(FECINIE,'%d/%m/%Y') AS 'FECHA SALIDA', 
      DATE_FORMAT(FECFINE,'%d/%m/%Y') AS 'FECHA RETORNO', DATEDIFF(FECFINE,FECINIE) AS 'TOTAL DIAS', 
      DATE_FORMAT(FECINIR,'%d/%m/%Y') AS 'F. SALIDA REAL', DATE_FORMAT(FECFINR,'%d/%m/%Y') AS 'F. SALIDA REAL', DATEDIFF(FECFINR,FECINIR) AS 'TOTAL DIAS REAL', H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS  INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE HORINIE IS NULL AND HORFINE IS NULL AND ESTPERM='AV' GROUP BY CODPERM ORDER BY 2 ASC ";

      $val=funciones::listadoReturn($c,$sql);
      $val2=funciones::listadoReturn($c,$sql2);
      $num=mysql_num_fields($val);
      $num2=mysql_num_fields($val2);
  }
  else if($dato=="Permisos_Jefatura")
  {
      $usu=$_GET["usu"];
      $area = " SELECT FKCODGRU FROM TUSER INNER JOIN DETGRU ON FKCODPER=CODUSEPER WHERE  USEALI='$usu' ";
      $areas=funciones::listadoReturn($c,$area);
      $cod_gru=mysql_result($areas, 0,0);

      $sql="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRE, DATE_FORMAT(FECPERM,'%d/%m/%Y') AS FECHA_REGISTRO, DATE_FORMAT(HORINIE,'%r') AS INICIO, DATE_FORMAT(HORFINE,'%r') AS FIN, SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIE, HORFINE ))*60) AS TOTAL, DATE_FORMAT(HORINIR,'%r') AS INICIO_REAL, DATE_FORMAT(HORFINR,'%r') AS FIN_REAL,SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , HORINIR, HORFINR ))*60) AS TOTAL_REAL, H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN 
      TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE FECINIE IS NULL AND FECFINE IS NULL AND ESTPERM='AV' AND FKCODGRU='$cod_gru' GROUP BY CODPERM ORDER BY 2 ASC";
      
      $sql2="SELECT CODPERM AS CODIGO, PERAPP AS 'APELLIDO PATERNO', PERAPM AS 'APELLIDO MATERNO', PERNOM AS NOMBRES, DATE_FORMAT(FECPERM,'%d/%m/%Y') AS FECHA_REGISTRO, DATE_FORMAT(FECINIE,'%d/%m/%Y') AS INICIO, DATE_FORMAT(FECFINE,'%d/%m/%Y') AS FIN, DATEDIFF(FECFINE,FECINIE) AS TOTAL, DATE_FORMAT(FECINIR,'%d/%m/%Y') AS INICIO_REAL, DATE_FORMAT(FECFINR,'%d/%m/%Y') AS FIN_REAL, DATEDIFF(FECFINR,FECINIR) AS TOTAL_REAL, H.NOMTIPDET AS ASUNTO, NOMPERTIP AS CONCEPTO, OBSPERM AS DESCRIPCION FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE HORINIE IS NULL AND HORFINE IS NULL AND ESTPERM='AV' AND FKCODGRU='$cod_gru' GROUP BY CODPERM ORDER BY 2 ASC ";

      $val=funciones::listadoReturn($c,$sql);
      $val2=funciones::listadoReturn($c,$sql2);
      $num=mysql_num_fields($val);
      $num2=mysql_num_fields($val2);
  }
  


  if( $dato=="Permisos_Jefatura" || $dato=="Registro_de_Permisos" || $dato=="Permisos_Vigilancia" ){
      echo "<table>";
        echo "<tr><td></td><td></td></tr>";
        echo "<tr><td colspan='$num' style='$cabecera' >Listado de $dato </td></tr>";
        echo "<tr><td>Fecha:</td><td>".funciones::fecha_solicitud(date('m/d/Y'))."</td></tr>";
        echo "<tr><td></td><td></td></tr>";
      echo "</table>";

      echo "<table>";
        echo "<tr><td></td><td></td></tr>";
        echo "<tr><td>Listado por Horas:</td><td></td></tr>";
      echo "</table>";
      echo "<table border='1'>";
      for($x=0; $x<mysql_num_fields($val);$x++)
      {
          echo "<th style='$header'>".mb_strtoupper(mysql_field_name($val, $x))."</th>";
      }

      while($fil=mysql_fetch_array($val))
      {
        echo "<tr>";
        for($x=0;$x<mysql_num_fields($val);$x++){
          echo "<td style='$items'>$fil[$x]</td>";
        }
        echo "</tr>";
      }
      echo "</table>";

      echo "<table>";
        echo "<tr><td></td><td></td></tr>";
        echo "<tr><td>Listado por Fechas:</td><td></td></tr>";
      echo "</table>";
      echo "<table border='1'>";
      for($x=0; $x<mysql_num_fields($val2);$x++)
      {
          echo "<th style='$header'>".mb_strtoupper(mysql_field_name($val2, $x))."</th>";
      }

      while($fil=mysql_fetch_array($val2))
      {
        echo "<tr>";
        for($x=0;$x<mysql_num_fields($val2);$x++){
          echo "<td style='$items'>$fil[$x]</td>";
        }
        echo "</tr>";
      }
      echo "</table>";

  }
  else
  {
      echo "<table>";
        echo "<tr><td></td><td></td></tr>";
        echo "<tr><td colspan='$num' style='$cabecera' >Listado de $dato </td></tr>";
        echo "<tr><td>Fecha:</td><td>".funciones::fecha_solicitud(date('m/d/Y'))."</td></tr>";
        echo "<tr><td></td><td></td></tr>";
      echo "</table>";

      echo "<table border='1'>";
      for($x=0; $x<mysql_num_fields($val);$x++)
      {
          echo "<th style='$header'>".mb_strtoupper(mysql_field_name($val, $x))."</th>";
      }

      while($fil=mysql_fetch_array($val))
      {
        echo "<tr>";
        for($x=0;$x<mysql_num_fields($val);$x++){
          echo "<td style='$items'>$fil[$x]</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
  }

  $val=null;
  $num=null;
  $sql=null;
  $val2=null;
  $num2=null;
  $sql2=null;
  
?>