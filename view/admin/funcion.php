<?php
/* METODOS DE AJAX PARA RESPUESTAS AUTOMATICAS */
$dato=$_GET["opcion"];
$json=array();

if($dato == "periodo")
{
      $anio=$_GET["anio"];
      $codigo=$_GET["codigo"];

      $consulta="SELECT (TVACACU- (TVACLAB+TVACNLA)) FROM TVACGEN WHERE TVACPER='".$codigo."' AND TVACANI='".$anio."' ";
      $datos = funciones::listadoReturn($c,$consulta);
      while($reg=mysql_fetch_array($datos))
      {
        $_SESSION['dias']=$reg[0];
      }
      $json[]=array('dias'=> $_SESSION['dias']);
      echo json_encode($json);
}
else if($dato=="solicitud")
{
      $cod=$_GET["cod"];
      $consulta="SELECT CODSOL,CODPER, CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),FUNNOM,SARNOM,FECINI,FECFIN,TOTDAY,RANPER FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD INNER JOIN TSARE ON PERSRE=SARCOR INNER JOIN TFUNC ON PERFUN=FUNCOD WHERE CODSOL=$cod GROUP BY 1 ";
      $datos = funciones::listadoReturn($c,$consulta);
      while($reg=mysql_fetch_array($datos))
      {
        $_SESSION['datos'][]=array(
                  'CODSOL'=>$reg[0],  'CODPER'=>$reg[1],  'PERNOM'=>$reg[2].Trim(), 'FUNNOM'=>$reg[3],  'SARNOM'=>$reg[4],
                  'FECINI'=>$reg[5],  'FECFIN'=>$reg[6],  'TOTDAY'=>$reg[7],        'RANPER'=>$reg[8]
                  );
      }
      $json[]=$_SESSION['datos'];
      echo json_encode($json);
}
else if($dato=="conceder")
{
      $cod=$_GET["cod"];
      $consulta="UPDATE TSOLIC SET STATUS='JA' WHERE CODSOL='".$cod."' ";
      $datos = funciones::listadoReturn($c,$consulta);
      
      // OBTENER DATOS DE LA SOLICITUD
      $con_sol= "SELECT CODPER,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRE, FECINI, FECFIN, 
      TOTDAY, RANPER FROM TSOLIC  INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$cod ";
      $sol=funciones::listadoReturn($c,$con_sol);
      while($reg=mysql_fetch_array($sol)){
          $_SESSION["codigo"]=$reg[0];
          $_SESSION["trabaj"]=$reg[1];
          $_SESSION["inicio"]=$reg[2];
          $_SESSION["finali"]=$reg[3];
          $_SESSION["totale"]=$reg[4];
          $_SESSION["period"]=$reg[5];
      }

      // OBTENER DATOS DEL JEFE DE AREA
      $con_jef="SELECT USEALI FROM TUSER INNER JOIN TABGRU ON CODUSEPER=CODJEF INNER JOIN  
      DETGRU ON FKCODGRU=CODGRU WHERE FKCODPER='".$_SESSION["codigo"]."' ";
      $jef=funciones::listadoReturn($c,$con_jef);
      while($reg=mysql_fetch_array($jef)){
          $_SESSION["cod_jef"]=$reg[0];
      }

      $con_dat_jef="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRE, DESGRU FROM TUSER INNER JOIN 
      TPERS ON CODUSEPER=PERCOD INNER JOIN TABGRU ON PERCOD=CODJEF WHERE USEALI='".$_SESSION["cod_jef"]."' ";
      $datos_jef=funciones::listadoReturn($c,$con_dat_jef);
      while($reg=mysql_fetch_array($datos_jef))
      {
          $_SESSION["jefe"]=$reg[0];
          $_SESSION["area"]=$reg[1];
      }

      $mensaje=funciones::envio_correo_solicitud_jefe($_SESSION["jefe"],$_SESSION["area"],$_SESSION["trabaj"],$_SESSION["inicio"],$_SESSION["finali"],$_SESSION["totale"],$_SESSION["period"]);
      $_SESSION["codigo"]=null;
      $_SESSION["trabaj"]=null;
      $_SESSION["inicio"]=null;
      $_SESSION["finali"]=null;
      $_SESSION["totale"]=null;
      $_SESSION["period"]=null;
      $_SESSION["jefe"]=null;
      $_SESSION["area"]=null;
      $_SESSION["cod_jef"]=null;

      echo "{-}Concedido*";
}
else if($dato=="denegar")
{
      $cod=$_GET["cod"];
      $consulta="UPDATE TSOLIC SET STATUS='JC' WHERE CODSOL='".$cod."' ";
      $datos = funciones::listadoReturn($c,$consulta);
      echo "Ejecutado";
}
else if($dato=="conceder_rh")
{
      $cod=$_GET["cod"];
      $nombre=$_GET["n"];
      $inicio=$_GET["i"];
      $fin=$_GET["f"];
      $total=$_GET["t"];

      $consulta="UPDATE TSOLIC SET STATUS='RA' WHERE CODSOL='".$cod."' ";
      $datos = funciones::listadoReturn($c,$consulta);

      $sql2="SELECT USEALI FROM TUSER INNER JOIN TABGRU ON CODUSEPER=CODJEF INNER JOIN  
      DETGRU ON FKCODGRU=CODGRU WHERE FKCODPER=$cod ";
      $val2=funciones::listadoReturn($c,$sql2);
      while($reg=mysql_fetch_array($val2)){
        $_SESSION["jefe"]=$reg[0];
      }
      $jefe=$_SESSION["jefe"];
      $mensaje=funciones::enviar_correo($jefe,$nombre,"Aprobado",$inicio,$fin,$total);
      $_SESSION["jefe"]=null;

      $_SESSION["use_correo"]=null;

      $consulta2="SELECT PERCOD, PERARE, PERFUN, TOTDAY, TOTLAB, TOTNLA FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$cod";
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

      // FIN DE VACACIONES GENERADAS 
      echo "{Ejecutado".$mensaje."}";
}
else if($dato=="denegar_rh")
{
      $cod=$_GET["cod"];
      $nombre=$_GET["n"];
      $inicio=$_GET["i"];
      $fin=$_GET["f"];
      $total=$_GET["t"];
      $consulta="UPDATE TSOLIC SET STATUS='RC' WHERE CODSOL='".$cod."' ";
      $datos = funciones::listadoReturn($c,$consulta);

      $sql2="SELECT USEALI FROM TUSER INNER JOIN TABGRU ON CODUSEPER=CODJEF INNER JOIN  
      DETGRU ON FKCODGRU=CODGRU WHERE FKCODPER=$cod ";
      $val2=funciones::listadoReturn($c,$sql2);
      while($reg=mysql_fetch_array($val2)){
        $_SESSION["jefe"]=$reg[0];
      }
      $jefe=$_SESSION["jefe"];
      $mensaje=funciones::enviar_correo($jefe,$nombre,"Cancelado",$inicio,$fin,$total);
      $_SESSION["jefe"]=null;

      
      $_SESSION["use_correo"]=null;
      echo "{Ejecutado".$mensaje."}";
}
else if($dato=="conceder_rh_masivo")
{
      $cod=$_GET["sol"];

      $consulta="UPDATE TSOLIC SET STATUS='RA' WHERE CODSOL='".$cod."' ";
      $datos = funciones::listadoReturn($c,$consulta);

      $consulta2= " SELECT * FROM TSOLIC WHERE CODSOL=$cod ";
      $datos2=funciones::listadoReturn($c,$consulta2);
      while($fil=mysql_fetch_array($datos2)){
          $_SESSION["cod_per"]=$fil[1];
          $_SESSION["dias"]=$fil[5];
      }

      $consulta2="SELECT PERCOD, PERARE, PERFUN, TOTDAY, TOTLAB, TOTNLA FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$cod";
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
      // FIN DE VACACIONES GENERADAS 

      echo "{-}Concedido |";
}
else if($dato=="denegar_rh_masivo")
{
      $sol=$_GET["sol"];
      $consulta="UPDATE TSOLIC SET STATUS='RC' WHERE CODSOL=$sol ";
      $datos = funciones::listadoReturn($c,$consulta);
      echo "{-}Denegado |";
}
else if($dato == "listado")
{
      $tipo=$_GET["tipo"];
      $area = " SELECT PERARE,PERSRE FROM TUSER INNER JOIN TPERS ON PERCOD=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
      $areas=funciones::listadoReturn($c,$area);
      while($ar=mysql_fetch_array($areas)){
        $_SESSION["area"]=$ar[0]; $_SESSION["subarea"]=$ar[1];
      }

      $query="  SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)), ARENOM,DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
      DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY, STATUS FROM TABGRU INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER 
      INNER JOIN TSOLIC ON CODPER=PERCOD  INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON PERSRE=SARCOR WHERE PERFCS IS 
      NULL AND PEREST<>'A' AND PERARE='".$_SESSION["area"]."' AND PERSRE='".$_SESSION["subarea"]."' ";

      // VA A RETORNAR //
      echo "|<table cellpadding='0' cellspacing='0'>";
      echo "<th class='th'>&nbsp;</th>";
      echo "<th style='text-align:center;'>Codigo</th>";
      echo "<th style='text-align:center;'>Trabajador</th>";
      echo "<th style='text-align:center;'>Area</th>";
      echo "<th style='text-align:center;'>Sub-Area</th>";
      echo "<th style='text-align:center;'>Fec. Inicio</th>";
      echo "<th style='text-align:center;'>Fec. Fin</th>";
      echo "<th style='text-align:center;'>Total Dias</th>";

      if($tipo=="P"){
            $query= $query . "  AND STATUS='E'  GROUP BY 1 ";
            echo "<th style='text-align:center;'>Aceptar</th>";
            echo "<th style='text-align:center;'>Cancelar</th>";
      }
      else if($tipo=="A"){
            $query= $query . "  AND STATUS='RA' OR STATUS='JA' GROUP BY 1 ";
            echo "<th style='text-align:center;'>Jefatura</th>";
            echo "<th style='text-align:center;'>RR.HH.</th>";
      }
      else if($tipo=="C"){
            $query= $query . "  AND STATUS='JC' OR STATUS='RC' GROUP BY 1 ";
            echo "<th style='text-align:center;'>Jefatura</th>";
            echo "<th style='text-align:center;'>RR.HH.</th>";
      }else{
            $query = null;
      }
      $datos = funciones::listadoReturn($c,$query);
      
      while($reg=mysql_fetch_array($datos))
      {   
        echo "<tr><td></td>";
        for($y=0;$y<mysql_num_fields($datos)-1;$y++){
          echo "<td>".$reg[$y]."</td>";
        }

        switch($reg[7]){
          case "RA": $jefe="Aprobado";   $rrhh="Aprobado";   break;
          case "RC": $jefe="Aprobado";   $rrhh="Cancelado";  break;
          case "JA": $jefe="Aprobado";   $rrhh="Pendiente";  break;
          case "JC": $jefe="Cancelado";  $rrhh="Pendiente";  break;
        }

        if($tipo=="P"){
          echo "<td style='text-align:center;'><input type='radio' class='permiso' name='permisos$reg[0]' value='si'></td>
              <td style='text-align:center;'><input type='radio' class='permiso' name='permisos$reg[0]' value='no'></td>";
        }else{
          echo "<td style='text-align:center;'>$jefe</td><td style='text-align:center;'>$rrhh</td>";
        }
        echo "</tr>";
      }
      echo "</table>*";
      // HASTA AQUI ES EL RETORNO //
}
else if($dato=="listado_rh")
{
      $tipo=$_GET["tipo"];
      $area=$_GET["area"];

      $query="  SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)), ARENOM,DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
      DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY, STATUS FROM TABGRU INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER 
      INNER JOIN TSOLIC ON CODPER=PERCOD  INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON PERSRE=SARCOR WHERE PERFCS IS 
      NULL AND PEREST<>'A' AND DESGRU='$area' ";

      if($tipo  ==  "PR")   {   $query  = $query . "  AND STATUS='JA'  GROUP BY 1 ";  }
      else if($tipo =="AR") {   $query  = $query . "  AND STATUS='RA'  GROUP BY 1 ";  }
      else if($tipo =="CR") {   $query  = $query . "  AND STATUS='RC'  GROUP BY 1 ";  }
      else  { $query  = null; }

      $datos = funciones::listadoReturn($c,$query);

      // VA A RETORNAR //
      echo "|<table cellpadding='0' cellspacing='0'>";
      echo "<th class='th' width='1.6%'></th>";
      echo "<th style='text-align:center;' width='7.6%'></th>";
      echo "<th style='text-align:center;' width='20.1%'></th>";
      echo "<th style='text-align:center;' width='12%'></th>";
      echo "<th style='text-align:center;' width='12%'></th>";
      echo "<th style='text-align:center;' width='10.2%'></th>";
      echo "<th style='text-align:center;' width='10.2%'></th>";
      echo "<th style='text-align:center;' width='10.2%'></th>";
      echo "<th style='text-align:center;' width='10.2%'></th>";
      echo "<th style='text-align:center;'></th>";

      while($reg=mysql_fetch_array($datos))
      {   
        echo "<tr><td></td>";
        for($y=0;$y<mysql_num_fields($datos)-1;$y++){
          echo "<td>".$reg[$y]."</td>";
        }
        
        switch($reg[7]){
          case "RA": $jefe="Aprobado";   $rrhh="Aprobado";  $url="OnClick=documento('$reg[0]');"; break;
          case "RC": $jefe="Aprobado";   $rrhh="Cancelado"; $url=""; break;
          case "JA": $jefe="Aprobado";   $rrhh="Pendiente"; $url=""; break;
          case "JC": $jefe="Cancelado";  $rrhh="Pendiente"; $url=""; break;
        }

        if($tipo=="PR")
        {
          echo "<td style='text-align:center;'>
                    <input type='radio' class='permiso_rh' OnClick=conceder_permisos('$reg[0]','si') name='permisos$reg[0]' value='si'>
                </td>
                <td style='text-align:center;'>
                    <input type='radio' class='permiso_rh' OnClick=conceder_permisos('$reg[0]','no') name='permisos$reg[0]' value='no'>
                </td>";
        }else{
          echo "<td style='text-align:center;' $url >$jefe</td><td style='text-align:center;'  $url >$rrhh</td>";
        }
        echo "</tr>";
      }
      echo "</table>*";
      // HASTA AQUI ES EL RETORNO //
}
else if($dato=="reg_sol_jef")
{
      $codper = $_GET["cod"];
      $fecini = $_GET["ini"];
      $fecfin = $_GET["fin"];
      $totday = $_GET["tot"];
      $totlab = $_GET["lab"];
      $totnla = $_GET["nla"];

      // OBTENER CODIGO CORRELATIVO
      $param=date('y').date('m');
      $sql ="SELECT CODSOL+1 FROM TSOLIC WHERE SUBSTRING(CODSOL,1,4)=$param ORDER BY CODSOL DESC LIMIT 1 ";
      $val=funciones::listadoReturn($c,$sql);
      if(mysql_num_rows($val)>0)
      {
        $codigo=mysql_result($val, 0,0);
      }else{
        $codi="0001";
        $codigo=$param.$codi;
      }
      
      $men = ValRegSolJef($codigo,$codper,$fecini,$fecfin,$totday, date("Y"), $totlab, $totnla);
      echo "|".$men."*";
}
else if($dato=="programacion_masiva")
{
      $correo=$_GET["correo"];
      $sql="SELECT CODGRU,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU FROM TABGRU 
      INNER JOIN TUSER ON CODJEF=CODUSEPER INNER JOIN TPERS ON PERCOD=CODUSEPER WHERE USEALI='$correo' ";
      $datos=funciones::listadoReturn($c,$sql);
      while($reg=mysql_fetch_array($datos)){
        $_SESSION["grupo"]=$reg[0];
        $_SESSION["nombres"]=$reg[1];
        $_SESSION["area"]=$reg[2];
      }

      $nombre=$_SESSION["nombres"];
      $area=$_SESSION["area"];

      $sql2="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, FECINI,FECFIN,TOTDAY,RANPER 
      FROM DETGRU  INNER JOIN TPERS ON FKCODPER=PERCOD INNER JOIN TSOLIC ON CODPER=PERCOD WHERE FKCODGRU='". $_SESSION["grupo"]."'
       AND STATUS='JA' ";
      $consulta=funciones::listadoReturn($c,$sql2);
      $body="";
      while($reg=mysql_fetch_array($consulta)){
           $body=$body."<tr style='color:#0B2161; background:#FAFAFA; text-align:left;'>";
          for($x=0;$x<mysql_num_fields($consulta);$x++){
               $body=$body."<td>".$reg[$x]."</td>";
          }
          $body=$body."</tr>";
      }

      $mensaje=funciones::envio_correo_solicitud_masivo( $correo, $body, $nombre, $area );

      $_SESSION["grupo"]=null;
      $_SESSION["nombres"]=null;
      $_SESSION["area"]=null;

      echo "{-}$mensaje*";
}
else if($dato=="respuesta_masiva")
{
      $correo=$_GET["correo"];
      $sql="SELECT CODGRU,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU FROM TABGRU INNER JOIN TUSER ON CODJEF=CODUSEPER INNER JOIN TPERS ON PERCOD=CODUSEPER WHERE CODGRU='$correo' ";
      $datos=funciones::listadoReturn($c,$sql);
      while($reg=mysql_fetch_array($datos)){
        $_SESSION["grupo"]=$reg[0];
        $_SESSION["nombres"]=$reg[1];
        $_SESSION["area"]=$reg[2];
      }

      $nombre=$_SESSION["nombres"];
      $area=$_SESSION["area"];

      $sql2 = " SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, FECINI,FECFIN,TOTDAY,RANPER, STATUS FROM DETGRU INNER JOIN TPERS ON FKCODPER=PERCOD INNER JOIN TSOLIC ON CODPER=PERCOD WHERE FKCODGRU='". $_SESSION["grupo"]."' AND RANPER=YEAR(CURDATE()) AND STATUS='RA' AND MONTH(CURDATE())=MONTH(FECREG) OR FKCODGRU='". $_SESSION["grupo"]."' AND STATUS='RC' AND RANPER=YEAR(CURDATE()) AND MONTH(CURDATE())=MONTH(FECREG) ";

      $consulta=funciones::listadoReturn($c,$sql2);
      $body="";
      while($reg=mysql_fetch_array($consulta)){
           $body=$body."<tr style='color:#0B2161; background:#FAFAFA; text-align:left;'>";
          for($x=0;$x<mysql_num_fields($consulta);$x++){
              if($reg[5]=="RC"){ $estado="CANCELADO"; }else { $estado="ACEPTADO"; }

              if($x==5){
                $body=$body."<td>".$estado."</td>";
              }
              else
              {
                $body=$body."<td>".$reg[$x]."</td>";
              }
          }
          $body=$body."</tr>";
      }

      $mensaje=funciones::envio_correo_respuesta_masivo( $correo, $body, $nombre, $area );

      $_SESSION["grupo"]=null;
      $_SESSION["nombres"]=null;
      $_SESSION["area"]=null;

      echo "{-}$body*";
}
else if($dato=="list_employ")
{
      $nombre=$_GET["nom"];
      $cadena = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, PEREMA, PERTEL, PERANE, PERTE2, PERTE3, PERFIG,
                PERFNA, PERIMG, LOCNOM, ARENOM, SARNOM,FUNNOM, PERDNI,PERLOC,PERARE,PERFUN,PERSRE FROM 
                TPERS INNER JOIN tloca on PERLOC=LOCCOD INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
                TSARE ON SARCOR = PERSRE INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PEREST='' AND PERFCS 
                IS NULL AND (PERNOM LIKE '%' '".$nombre."' '%') GROUP BY TPERS.PERCOD ";

      $datos = funciones::listadoReturn($c,$cadena);
      // VA A RETORNAR //
      echo "|<table cellpadding='0' cellspacing='0'>";
      echo "<th class='th'>&nbsp;</th>";
      echo "<th style='text-align:center;'>Codigo</th>";
      echo "<th style='text-align:center;'>Nombre</th>";
      echo "<th style='text-align:center;'>Ap. Paterno</th>";
      echo "<th style='text-align:center;'>Ap. Materno</th>";
      echo "<th style='text-align:center;'>E-Mail</th>";
      echo "<th style='text-align:center;'>Tel. Oficina</th>";
      echo "<th style='text-align:center;'>Anexo</th>";
      echo "<th style='text-align:center;'>Tel. Celular</th>";
      echo "<th style='text-align:center;'>RPM</th>";
      echo "<th style='text-align:center;'>Fecha Ingreso</th>";
      echo "<th style='text-align:center;'>Fecha Nacimiento</th>";
      echo "<th style='text-align:center;'>Imagen</th>";
      echo "<th style='text-align:center;'>Nombre Local</th>";
      echo "<th style='text-align:center;'>Nombre Area</th>";
      echo "<th style='text-align:center;'>Nombre Sub Area</th>";
      echo "<th style='text-align:center;'>Nombre Funcion</th>";
      echo "<th style='text-align:center;'>DNI</th>";
      while($reg=mysql_fetch_array($datos))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($datos);$x++)
          {
              if($x==0)
              { 
                echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else if($x>16 && $x<=20)
              { 
                echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else
              {
                echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
          }
          echo "</tr>";
      }
      echo "</table>*";
      // HASTA AQUI ES EL RETORNO //
}
else if($dato=="list_employ_ape")
{
      $apellido=$_GET["ape"];
      $cadena = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, PEREMA, PERTEL, PERANE, PERTE2, PERTE3, PERFIG,
                PERFNA, PERIMG, LOCNOM, ARENOM, SARNOM,FUNNOM, PERDNI,PERLOC,PERARE,PERFUN,PERSRE FROM 
                TPERS INNER JOIN tloca on PERLOC=LOCCOD INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
                TSARE ON SARCOR = PERSRE INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PEREST='' AND PERFCS 
                IS NULL AND PERAPP LIKE '%".$apellido."%' GROUP BY TPERS.PERCOD ";

      $datos = funciones::listadoReturn($c,$cadena);
      // VA A RETORNAR //
      echo "|<table cellpadding='0' cellspacing='0'>";
      echo "<th class='th'>&nbsp;</th>";
      echo "<th style='text-align:center;'>Codigo</th>";
      echo "<th style='text-align:center;'>Nombre</th>";
      echo "<th style='text-align:center;'>Ap. Paterno</th>";
      echo "<th style='text-align:center;'>Ap. Materno</th>";
      echo "<th style='text-align:center;'>E-Mail</th>";
      echo "<th style='text-align:center;'>Tel. Oficina</th>";
      echo "<th style='text-align:center;'>Anexo</th>";
      echo "<th style='text-align:center;'>Tel. Celular</th>";
      echo "<th style='text-align:center;'>RPM</th>";
      echo "<th style='text-align:center;'>Fecha Ingreso</th>";
      echo "<th style='text-align:center;'>Fecha Nacimiento</th>";
      echo "<th style='text-align:center;'>Imagen</th>";
      echo "<th style='text-align:center;'>Nombre Local</th>";
      echo "<th style='text-align:center;'>Nombre Area</th>";
      echo "<th style='text-align:center;'>Nombre Sub Area</th>";
      echo "<th style='text-align:center;'>Nombre Funcion</th>";
      echo "<th style='text-align:center;'>DNI</th>";
      while($reg=mysql_fetch_array($datos))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($datos);$x++)
          {
              if($x==0)
              { 
                echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else if($x>16 && $x<=20)
              { 
                echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else
              {
                echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
          }
          echo "</tr>";
      }
      echo "</table>{-}";
      // HASTA AQUI ES EL RETORNO //
}
else if($dato=="list_employ_cod")
{
      $codigo=$_GET["cod"];
      $cadena = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, PEREMA, PERTEL, PERANE, PERTE2, PERTE3, PERFIG,
                PERFNA, PERIMG, LOCNOM, ARENOM, SARNOM,FUNNOM, PERDNI,PERLOC,PERARE,PERFUN,PERSRE FROM 
                TPERS INNER JOIN tloca on PERLOC=LOCCOD INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
                TSARE ON SARCOR = PERSRE INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PEREST='' AND PERFCS 
                IS NULL AND PERCOD LIKE '%".$codigo."%' GROUP BY TPERS.PERCOD ";

      $datos = funciones::listadoReturn($c,$cadena);
      // VA A RETORNAR //
      echo "{/}<table cellpadding='0' cellspacing='0'>";
      echo "<th class='th'>&nbsp;</th>";
      echo "<th style='text-align:center;'>Codigo</th>";
      echo "<th style='text-align:center;'>Nombre</th>";
      echo "<th style='text-align:center;'>Ap. Paterno</th>";
      echo "<th style='text-align:center;'>Ap. Materno</th>";
      echo "<th style='text-align:center;'>E-Mail</th>";
      echo "<th style='text-align:center;'>Tel. Oficina</th>";
      echo "<th style='text-align:center;'>Anexo</th>";
      echo "<th style='text-align:center;'>Tel. Celular</th>";
      echo "<th style='text-align:center;'>RPM</th>";
      echo "<th style='text-align:center;'>Fecha Ingreso</th>";
      echo "<th style='text-align:center;'>Fecha Nacimiento</th>";
      echo "<th style='text-align:center;'>Imagen</th>";
      echo "<th style='text-align:center;'>Nombre Local</th>";
      echo "<th style='text-align:center;'>Nombre Area</th>";
      echo "<th style='text-align:center;'>Nombre Sub Area</th>";
      echo "<th style='text-align:center;'>Nombre Funcion</th>";
      echo "<th style='text-align:center;'>DNI</th>";
      while($reg=mysql_fetch_array($datos))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($datos);$x++)
          {
              if($x==0)
              { 
                echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else if($x>16 && $x<=20)
              { 
                echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
              else
              {
                echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
              }
          }
          echo "</tr>";
      }
      echo "</table>{-}";
      // HASTA AQUI ES EL RETORNO //
}
else if($dato=="lista_subarea")
{
      $cod=$_GET["cod"];
      echo "+<form method='post' style='overflow:scroll'>";
      echo "<table cellpadding='0' cellspacing='0'>";
      echo "<th>Codigo</th><th>Nombre</th>";
      $consulta = "SELECT SARCOR,SARNOM FROM TSARE INNER JOIN TAREA ON ARECOD=SARCOD WHERE SARCOD=$cod";
      $val3=funciones::listadoReturn($c,$consulta);
      while ($reg = mysql_fetch_array($val3)) 
      {
        $codigo=$reg[0];
        $nombre=$reg[1];
        $codigo=str_replace(" ", "&nbsp;", $codigo);
        $nombre=str_replace(" ", "&nbsp;", $nombre);
        echo "<tr OnClick=datos('$codigo','$nombre') >";
        for($x=0;$x<mysql_num_fields($val3);$x++)
        {
          if($x==0){echo "<td>$reg[$x]</td>";}else
          {echo "<td style='text-align:left; padding-left:2%;'>$reg[$x]</td>";}
        }
        echo "</tr>";
      }
      echo "</table>";
      echo "</form>*"; 
}
else if($dato=="obtener_totacu")
{
      $cod=$_GET["cod"];
      echo "+";
      $consulta = "SELECT SUM(TVACACU)-SUM(TVACLAB+TVACNLA) AS TOTAL, SUM(TVACACU), SUM(TVACLAB+TVACNLA), COUNT(*)*22-SUM(TVACLAB), COUNT(*)*8-SUM(TVACNLA) FROM TVACGEN WHERE TVACPER=$cod";
      $val1=funciones::listadoReturn($c,$consulta);
      while ($reg = mysql_fetch_array($val1)) 
      {
        echo $reg[0].",".$reg[3].",".$reg[4];
      }
      echo "*";
}
else if($dato=="obtener_permisos")
{
      $cod=$_GET["subp"];
      $usu=$_GET["usu"];

      $query="SELECT CODSPRO,NOMSPRO FROM TSUBPRO WHERE CODSPRO NOT IN (SELECT FKSUBPRO FROM PERMISOS 
              INNER JOIN TSUBPRO ON CODSPRO=FKSUBPRO WHERE FKUSECOD=$usu ) AND CODPROFK=$cod ";

      $val = funciones::listadoReturn($c,$query);

      $query2= "SELECT CODSPRO,NOMSPRO FROM PERMISOS INNER JOIN TSUBPRO ON CODSPRO=FKSUBPRO 
      INNER JOIN PROGRAMA ON CODPRO=CODPROFK WHERE FKUSECOD=$usu AND CODPRO=$cod ";
      
      $val2=funciones::listadoReturn($c,$query2);
      echo "|<form method='post' style='width: 100%; height:100%; overflow:scroll;overflow-x:auto; ' action=''><table cellpadding='0' cellspacing='0'>";
      echo "<th>Codigo</th><th>Programa</th><th>Acceso</th><th>Denegar</th>";
      
      while($reg=mysql_fetch_array($val2)){
        echo "<tr style='background:rgba(255,0,0,0.2); border:1px solid rgba(0,0,0,1) !important;' >";
        echo "<td>$reg[0]</td>";
        echo "<td style='text-align:left !important'>$reg[1]</td>";
        echo "<td>Permitido</td>";
        echo "<td><input type='radio' name='denegar$reg[0]'  OnClick=denegar('$reg[0]','$usu') value='$reg[0]'></td>";
        echo "</tr>";
      }

      while ($reg = mysql_fetch_array($val)) {
        echo "<tr>";
        echo "<td>$reg[0]</td>";
        echo "<td style='text-align:left !important'>$reg[1]</td>";
        echo "<td><input type='radio' name='denegar$reg[0]' OnClick=permitir('$reg[0]','$usu') value='$reg[0]'></td>";
        echo "<td>Denegado</td>";
        //echo "<td><input type='radio' name='denegar$reg[0]'  OnClick=denegar('$reg[0]','$usu') value='$reg[0]'></td>";
        echo "</tr>";
      }

      echo "</table></form>*";
}
else if($dato=="dar_permiso")
{
      $cod=$_GET["subp"];
      $usu=$_GET["usu"];
      $cadena =  "INSERT INTO permisos VALUES('$cod','$usu','1') ";
      funciones::listadoReturn($c,$cadena);
}
else if($dato=="denegar_permiso")
{
      $cod=$_GET["subp"];
      $usu=$_GET["usu"];
      $cadena =  "DELETE FROM permisos WHERE fksubpro='$cod' AND fkusecod='$usu' ";
      funciones::listadoReturn($c,$cadena);
}
else if($dato=="add_usuario")
{
      $gru=$_GET["gru"];
      $cod=$_GET["cod"];
      $cadena =  "INSERT INTO DETGRU VALUES('$gru','$cod','1') ";
      funciones::listadoReturn($c,$cadena);

      $query="SELECT PERCOD, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM),PEREMA,PERTE3 FROM 
              DETGRU INNER JOIN TPERS ON FKCODPER=PERCOD WHERE FKCODGRU=$gru ORDER BY PERCOD ";
      $val=funciones::listadoReturn($c,$query);
      
      echo "|<table cellpadding='0' cellspacing='0'>
              <th>Codigo</th><th>Nombres</th><th>Correo</th><th>Telef&oacute;no</th>";
      while($reg=mysql_fetch_array($val))
      {   
          echo "<tr>";
          for($x=0;$x<mysql_num_fields($val);$x++){
            if($x==0 || $x==3){ $clase='text-align:left; padding-left:5px;'; }else{ $clase='text-align:left'; }
            echo "<td style='$clase'>$reg[$x]</td>";
          }
          echo "</tr>";
      }
      echo "</table>+";
}
else if($dato=="del_usuario")
{
      $gru=$_GET["gru"];
      $cod=$_GET["cod"];
      $cadena =  "DELETE FROM DETGRU WHERE fkcodgru='$gru' AND fkcodper='$cod' ";
      funciones::listadoReturn($c,$cadena);

      $query="SELECT PERCOD, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM),PEREMA,PERTE3 FROM 
              DETGRU INNER JOIN TPERS ON FKCODPER=PERCOD WHERE FKCODGRU=$gru ORDER BY PERCOD ";
      $val=funciones::listadoReturn($c,$query);
      
      echo "|<table cellpadding='0' cellspacing='0'>
              <th>Codigo</th><th>Nombres</th><th>Correo</th><th>Telef&oacute;no</th>";
      while($reg=mysql_fetch_array($val))
      {   
          echo "<tr>";
          for($x=0;$x<mysql_num_fields($val);$x++){
            if($x==0 || $x==3){ $clase='text-align:left; padding-left:5px;'; }else{ $clase='text-align:left'; }
            echo "<td style='$clase'>$reg[$x]</td>";
          }
          echo "</tr>";
      }
      echo "</table>+";
}
else if($dato=="ver_grupo")
{
      $gru=$_GET["gru"];
      $query="SELECT PERCOD, CONCAT_WS(' ',CONCAT_WS(', ',PERNOM,PERAPP),PERAPM),PEREMA,PERTE3 FROM 
              DETGRU INNER JOIN TPERS ON FKCODPER=PERCOD WHERE FKCODGRU=$gru ORDER BY PERCOD";
      $val=funciones::listadoReturn($c,$query);
      echo "|<table cellpadding='0' cellspacing='0'>
              <th>Codigo</th><th>Nombres</th><th>Correo</th><th>Telef&oacute;no</th>";
      while($reg=mysql_fetch_array($val))
      {   
          echo "<tr>";
          for($x=0;$x<mysql_num_fields($val);$x++){
            if($x==0 || $x==3){ $clase='text-align:left; padding-left:5px;'; }else{ $clase='text-align:left'; }
            echo "<td style='$clase'>$reg[$x]</td>";
          }
          echo "</tr>";
      }
      echo "</table>+";
}
else if($dato=="list_vac_per")
{
      $periodo=$_GET["valor"];
      $query = "SELECT CODSOL,FECINI,FECFIN,TOTDAY FROM TSOLIC INNER JOIN TUSER ON CODPER=CODUSEPER 
        WHERE USEALI='".$values['usuario']."'  AND RANPER=$periodo ";
      $val = funciones::listadoReturn($c,$query);

      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th><th>Codigo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Total D&iacute;as</th>";
              
      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else if($x==1 || $x==2){
              echo "<td style='text-align:center;''><a href='#?cod=$reg[0]'>".str_replace('-', '/', date(' d-m-Y', strtotime($reg[$x])) )."</a></td>";              
            }else{
              echo "<td style='text-align:center;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      
      echo "</table></section>*";
}
else if($dato=="bus_tra")
{
      $codbus=$_GET["codbus"];
      $nombus=$_GET["nombus"];
      $apebus=$_GET["apebus"];

      
      $query="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
      DATE_FORMAT(FECFIN,'%d/%m/%Y'), RANPER, TOTDAY FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD INNER JOIN 
      DETGRU ON FKCODPER=CODPER INNER JOIN TABGRU ON CODGRU=FKCODGRU  ";

      if($codbus!="" && $nombus=="" && $apebus==""){
          $query = $query . " WHERE PERCOD LIKE '%$codbus%' AND PEREST<>'A' AND PERFCS IS NULL GROUP BY CODSOL ";
      }
      else if($codbus=="" && $nombus!="" && $apebus==""){
          $query = $query . " WHERE PERNOM LIKE '%$nombus%' AND PEREST<>'A' AND PERFCS IS NULL GROUP BY CODSOL ";
      }
      else if($codbus=="" && $nombus=="" && $apebus!=""){
          $query = $query . " WHERE CONCAT_WS(' ',PERAPP,PERAPM) LIKE '%$apebus%' AND PEREST<>'A' AND PERFCS IS NULL GROUP BY CODSOL ";
      } 
      else{
          $query = $query . " GROUP BY CODSOL ";
      }

      $val = funciones::listadoReturn($c,$query);
      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th><th>Trabajador</th><th>Area</th>
        <th>Fecha Inicio</th><th>Fecha Fin</th>
        <th>Periodo</th><th>Total D&iacute;as</th>";

      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else{
              echo "<td style='text-align:left;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      echo "</table></section>*";
}
else if($dato=="bus_cum")
{ 
      $_GET["busare"]=="NaN"?$codare="":$codare=$_GET["busare"];
      $_GET["busmes"]=="NaN"?$busmes="":$busmes=$_GET["busmes"];

      $cadena="SELECT PERCOD, CONCAT_WS(', ',PERNOM,CONCAT(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU,
      DATE_FORMAT(PERFIG,'%d/%m/%Y') AS INGRESO, DATE_FORMAT(DATE_ADD(PERFIG, INTERVAL 1 * (YEAR(CURDATE())-YEAR(PERFIG)) YEAR), '%d/%m/%Y') AS anio,
       (YEAR(CURDATE())-YEAR(PERFIG)) FROM TPERS INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON 
       CODGRU=FKCODGRU WHERE PEREST='' AND PERFCS IS NULL  ";

      if($codare!="" && $busmes==""){
          $consulta=$cadena. " AND FKCODGRU=$codare ";
      }else if($codare == "" && $busmes!=""){
          $consulta = $cadena . " AND MONTH(PERFIG)=$busmes ";
      }else if($busmes!="" && $codare!=""){
          $consulta=$cadena. " AND FKCODGRU=$codare AND MONTH(PERFIG)=$busmes ";
      }

      $val = funciones::listadoReturn($c,$consulta);
      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th>
        <th>Codigo</th>
        <th>Nombres y Apellidos</th>
        <th>Area</th>
        <th>Ingreso</th>
        <th>Nuevo A&ntilde;o</th>
        <th>Total A&ntilde;os</th>";
      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else{
              echo "<td style='text-align:left;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      echo "</table></section>*";
}
else if($dato=="bus_acu")
{
      $query=null;
      $busarea=$_GET["busarea"];

      $query ="SELECT PERCOD,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)), DESGRU, DATE_FORMAT(PERFIG,'%d/%m/%Y'),
      SUM(TVACLAB+TVACNLA), SUM(TVACACU)-SUM(TVACLAB+TVACNLA), SUM(TVACACU) FROM TVACGEN INNER JOIN TPERS ON PERCOD=TVACPER INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON CODGRU=FKCODGRU WHERE ";

      if( $busarea!="")
      {
          $query = $query . " FKCODGRU=$busarea GROUP BY PERCOD ";
      }
      else
      {
          $query = $query . " GROUP BY PERCOD ";
      }

      $val = funciones::listadoReturn($c,$query);
      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th>
        <th>Trabajador</th>
        <th>Area</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Emitidas</th>
        <th>Pendientes</th>
        <th>Acumuladas</th>";

      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else{
              echo "<td style='text-align:left;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      echo "</table></section>*";
}
else if($dato=="bus_pro")
{
      $_GET["busare"]=="NaN"?$codare="":$codare=$_GET["busare"];
      $_GET["busmes"]=="NaN"?$busmes="":$busmes=$_GET["busmes"];

      $cadena="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y') AS INICIO, 
      DATE_FORMAT(FECFIN,'%d/%m/%Y') AS FIN, RANPER, TOTDAY FROM TSOLIC INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN DETGRU ON  
      FKCODPER=PERCOD INNER JOIN TABGRU ON CODGRU=FKCODGRU WHERE PEREST='' AND PERFCS IS NULL AND YEAR(CURDATE())=YEAR(FECREG)  ";


      if($codare!="" && $busmes==""){
          $consulta=$cadena. " AND CODGRU=$codare ";
      }else if($codare == "" && $busmes!=""){
          $consulta = $cadena . " AND MONTH(FECREG)=$busmes ";
      }else if($busmes!="" && $codare!=""){
          $consulta=$cadena. " AND CODGRU=$codare AND MONTH(FECREG)=$busmes ";
      }

      $val = funciones::listadoReturn($c,$consulta);
      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th><th>Trabajador</th><th>Area</th>
        <th>Fecha Inicio</th><th>Fecha Fin</th>
        <th>Periodo</th><th>Total D&iacute;as</th>";

      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else{
              echo "<td style='text-align:left;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      echo "</table></section>*";
}
else if($dato=="listado_general")
{
      $query="SELECT CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
      DATE_FORMAT(FECFIN,'%d/%m/%Y'), RANPER, TOTDAY FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD INNER JOIN 
      DETGRU ON FKCODPER=CODPER INNER JOIN TABGRU ON CODGRU=FKCODGRU GROUP BY CODSOL ";
      $val = funciones::listadoReturn($c,$query);
      echo "|<section class='form'>
        <table cellpadding='0' cellspacing='0'>
        <th class='th'>&nbsp;</th><th>Trabajador</th><th>Area</th>
        <th>Fecha Inicio</th><th>Fecha Fin</th>
        <th>Periodo</th><th>Total D&iacute;as</th>";
      while($reg=mysql_fetch_array($val))
      { 
          echo "<tr><th class='th'></th>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            if($x==0){ 
              echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }else{
              echo "<td style='text-align:left;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
            }
          }
          echo "</tr>";
      }
      echo "</table></section>*";
}
else if($dato=="Deshabilitar")
{
      $cod=$_GET["cod"];
      $query=" UPDATE TUSER SET USEEST='3' WHERE USECOD=$cod ";
      $val = funciones::listadoReturn($c,$query);
      echo "|Deshabilitado*";
}
else if($dato=="Desactivar")
{
      $cod=$_GET["cod"];
      $query=" UPDATE TUSER SET USEEST='1' WHERE USECOD=$cod ";
      $val = funciones::listadoReturn($c,$query);
      echo "|Desactivado*";
}
else if($dato=="Habilitar")
{
      $cod=$_GET["cod"];
      $query=" UPDATE TUSER SET USEEST='1' WHERE USECOD=$cod ";
      $val = funciones::listadoReturn($c,$query);
      echo "|Habilitado*";
}
else if($dato=="opt_firma_traba"){
      $cod=$_GET["cod"];
      $query=" SELECT PERFIR FROM TPERS WHERE PERCOD=$cod ";
      $val = funciones::listadoReturn($c,$query);
      $rpta=mysql_fetch_row($val);
      echo "|".$rpta[0]."*";
}
else if( $dato=="del_vaca" ){
      $cod=$_GET["cod"];

      $sql3="SELECT CODPER,CONCAT_WS(' ,',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)),FECINI, FECFIN,TOTDAY 
      FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$cod ";
      $val3=funciones::listadoReturn($c,$sql3);
      $codper=mysql_result($val3, 0,0);
      $nombre=mysql_result($val3, 0,1);
      $fecini=mysql_result($val3, 0,2);
      $fecfin=mysql_result($val3, 0,3);
      $total=mysql_result($val3, 0,4);

      $sql2="SELECT USEALI FROM TUSER INNER JOIN TABGRU ON CODUSEPER=CODJEF INNER JOIN  
      DETGRU ON FKCODGRU=CODGRU WHERE FKCODPER=$codper ";
      $val2=funciones::listadoReturn($c,$sql2);
      $jefe=mysql_result($val2, 0,0);

      $mensaje=funciones::enviar_correo($jefe,$nombre,"ELIMINADO",$fecini,$fecfin,$total);

      $query=" DELETE FROM TSOLIC WHERE CODSOL=$cod ";
      $val = funciones::listadoReturn($c,$query);
      echo "{+} Eliminado Correctamente.{-}";
}
else if( $dato=="mod_vaca"){
      $cod=$_GET["cod"];
      $ini=$_GET["ini"];
      $fin=$_GET["fin"];
      $total=$_GET["tot"];
      $lab=$_GET["lab"];
      $nla=$_GET["nla"];

      $fecini=date('Y-m-d',strtotime( str_replace('/','-',$ini)));
      $fecfin=date('Y-m-d',strtotime( str_replace('/','-',$fin)));


      $sql3="SELECT CODPER,CONCAT_WS(' ,',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE CODSOL=$cod ";
      $val3=funciones::listadoReturn($c,$sql3);
      $codper=mysql_result($val3, 0,0);
      $nombre=mysql_result($val3, 0,1);


      $sql2="SELECT USEALI FROM TUSER INNER JOIN TABGRU ON CODUSEPER=CODJEF INNER JOIN  
      DETGRU ON FKCODGRU=CODGRU WHERE FKCODPER=$codper ";
      $val2=funciones::listadoReturn($c,$sql2);
      $jefe=mysql_result($val2, 0,0);
      $mensaje=funciones::enviar_correo($jefe,$nombre,"MODIFICADO",$fecini,$fecfin,$total);


      $query=" UPDATE TSOLIC SET FECINI='$fecini', FECFIN='$fecfin',TOTDAY=$total,  TOTLAB=$lab, TOTNLA=$nla WHERE CODSOL=$cod ";
      $val = funciones::listadoReturn($c,$query);

      echo "{+} Modificado Correctamente.{-}";
}
else if( $dato=="reg_vaca" )
{
      $perco=$_GET["per"];
      $inici=$_GET["ini"];
      $final=$_GET["fin"];
      $total=$_GET["tot"];
      $lab=$_GET["lab"];
      $nla=$_GET["nla"];


      // OBTENER CODIGO CORRELATIVO
      $param=date('y').date('m');
      $sql ="SELECT CODSOL+1 FROM TSOLIC WHERE SUBSTRING(CODSOL,1,4)=$param ORDER BY CODSOL DESC LIMIT 1 ";
      $val=funciones::listadoReturn($c,$sql);
      if(mysql_num_rows($val)>0)
      {
        $codigo=mysql_result($val, 0,0);
      }else{
        $codi="0001";
        $codigo=$param.$codi;
      }
      ValRegSolJef2($codigo,$perco,$inici,$final,$total, date("Y"),$lab, $nla);
      echo "{+} Documento Registrado Correctamente. {-}";
}
else if ( $dato == "buscar_history" )
{
      $ini=$_GET["ini"];
      $fin=$_GET["fin"];

      $fecini   = date("Y-m-d", strtotime(str_replace("/", "-", $ini )));
      $fecfin   = date("Y-m-d", strtotime(str_replace("/", "-", $fin )));

      $codigo   = $_GET["cod"];
      $nombre   = $_GET["nom"];
      $apellido = $_GET["ape"];

      $cadena = "SELECT PERCOD, PERNOM, PERAPP, 'BRAILLARD', ARENOM, FUNNOM, FECINI, FECFIN, TOTDAY, ARECOD, FUNCOD,CODSOL FROM TPERS INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TFUNC ON FUNCOD=PERFUN INNER JOIN TSOLIC on CODPER=PERCOD WHERE STATUS='RA' AND PEREST<>'A' AND PERFCS IS NULL ";
                
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
      }
      else 
      {
        $query = "$cadena ";
      }
      
      $query= $query. " GROUP BY CODSOL ORDER BY CODSOL ASC ";
      $val = funciones::listadoReturn($c,$query);

      echo "{-}";
      echo "<section class='form' id='list_history'>";
      echo "<table cellpadding='0' cellspacing='0'>
              <th class='th' width='1.2%'></th>
              <th width='6%'></th>
              <th width='11%'></th>
              <th width='12%'></th>
              <th width='10.3%'></th>
              <th width='11.5%'></th>
              <th width='20%'></th>
              <th width='9%'></th>
              <th width='8%'></th>
              <th width='5%'></th>";

      while($reg=mysql_fetch_array($val))
      { 
        echo "<tr><th class='th'></th>";
        for($x=0;$x<mysql_num_fields($val);$x++)
        {
          if($x==0){ 
            echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
          }else if($x==9 || $x == 10){
            echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
          }else if($x==6 || $x==7){
            echo "<td><a href='#?cod=$reg[0]'>".date('d-m-Y',strtotime($reg[$x]))."</a></td>";
          }else if($x==11){
            echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
          }else{
            echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
          }
          echo "<input class='$reg[0]' type='hidden' value='$reg[11]' >";
        }
        echo "</tr>";
      }
      echo "</table>";
      echo "</section>";
      echo "{+}";
}
else if($dato=="buscar_comisiones")
{
    $tipo=trim($_GET["tipo"]);
    $esta=trim($_GET["est"]);
    $nom=$_GET["nom"];

    $sql="";
    $sql1="SELECT CODPERM, CONCAT_WS(' ',PERNOM,PERAPP) AS NOMBRES, DESGRU, DATE_FORMAT(HORINIE,'%r') AS INICIO,
    DATE_FORMAT(HORFINE,'%r') AS FIN FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE FECINIE IS NULL AND FECFINE 
    IS NULL AND CODTIP=1 AND ESTPERM='$esta' ";

    $sql2="SELECT CODPERM, CONCAT_WS(' ',PERNOM,PERAPP) AS NOMBRES, DESGRU, DATE_FORMAT(FECINIE,'%d/%m/%Y') AS INICIO,
    DATE_FORMAT(FECFINE,'%d/%m/%Y') AS FIN FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE HORINIE IS NULL AND HORFINE 
    IS NULL AND CODTIP=1 AND ESTPERM='$esta' ";

    // H.NOMTIPDET CAMPO QUITADO EN AMBAS CONSULTAS
    switch ($tipo) {
      case 'fecha':   $header="<tbody>   <th class='th'>&nbsp;</th>               <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Aplicar</th>             </tbody>";    
                       $sql=$sql2;        break;

      case 'horas':   $header="<tbody>   <th class='th'>&nbsp;</th>               <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Ejecutar</th>            </tbody>";   
                      $sql=$sql1;        break;

      case 'undefined': $header="<tbody>  <th class='th'>&nbsp;</th>              <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Ejecutar</th>             </tbody>"; 
                      $sql=$sql;        break;
    }

    if($tipo=="undefined" && $nom=="")
    {
        $sql=$sql1. " GROUP BY CODPERM  UNION ALL " . $sql2 ."  GROUP BY CODPERM ";
    }
    else if($tipo=="undefined" && $nom!="")
    {
        $sql=$sql1. " AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM  UNION ALL " . $sql2 ." AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM ";
    }
    else if($tipo!="undefined" && $nom=="")
    {
        $sql=$sql. " GROUP BY CODPERM ";
    }
    else if($tipo!="undefined" && $nom!="")
    {
        $sql=$sql. " AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM ";
    }

    $val=funciones::listadoReturn($c,$sql);
    echo "|";
    echo "<table cellspacing='0' cellpadding='0'>";
    echo $header;
    while($reg=mysql_fetch_array($val)){
        echo "<tr>";
        echo "<td></td>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            echo "<td>".$reg[$x]."</td>";
          }

          if(strlen($reg[4])==10)
          {
            echo "<td><input type='date' class='sal$reg[0]' style='width:130px'></td>";
            echo "<td><input type='date' class='ret$reg[0]' style='width:130px'></td>";
          }else{
            echo "<td><input type='text' class='inicio_time sal$reg[0]' style='width:100px'></td>";
            echo "<td><input type='text' class='fin_time ret$reg[0]' style='width:100px'></td>";
          }
          echo "<td><input type='button'  value='Aplicar' OnClick=boton_comision('$reg[0]','comision','$tipo') ></td>";
        echo "</tr>";
    }
    echo "</table>
        <script type='text/javascript'>
          $(function(){
            $('.inicio_time').ptTimeSelect();
            $('.fin_time').ptTimeSelect();
          });
        </script>
      ";
    echo "{+}";
}
else if($dato=="buscar_personal")
{
    $tipo=trim($_GET["tipo"]);
    $esta=trim($_GET["est"]);
    $nom=$_GET["nom"];

    $sql="";
    $sql1="SELECT CODPERM, CONCAT_WS(' ',PERNOM,PERAPP) AS NOMBRES, DESGRU, DATE_FORMAT(HORINIE,'%r') AS INICIO,
    DATE_FORMAT(HORFINE,'%r') AS FIN FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE FECINIE IS NULL AND FECFINE 
    IS NULL AND CODTIP=2 AND ESTPERM='$esta' ";

    $sql2="SELECT CODPERM, CONCAT_WS(' ',PERNOM,PERAPP) AS NOMBRES, DESGRU, DATE_FORMAT(FECINIE,'%d/%m/%Y') AS INICIO,
    DATE_FORMAT(FECFINE,'%d/%m/%Y') AS FIN FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU WHERE HORINIE IS NULL AND HORFINE 
    IS NULL AND CODTIP=2 AND ESTPERM='$esta' ";

    switch ($tipo) {
      case 'fecha':   $header="<tbody>   <th class='th'>&nbsp;</th>               <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Aplicar</th>             </tbody>";    
                       $sql=$sql2;        break;

      case 'horas':   $header="<tbody>   <th class='th'>&nbsp;</th>               <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Ejecutar</th>            </tbody>";   
                      $sql=$sql1;        break;

      case 'undefined': $header="<tbody>  <th class='th'>&nbsp;</th>              <th style='width:5%'>Codigo</th>        <th style='width:20%'>Nombres y Apellidos</th>  
                                          <th style='width:10%'>Area</th>         <th style='width:11%'>Salida</th>       <th style='width:11%'>Retorno</th>  
                                          <th style='width:15%'>Salida Real</th>  <th style='width:15%'>Retorno Real</th> <th>Ejecutar</th>             </tbody>"; 
                      $sql=$sql;        break;
    }

    if($tipo=="undefined" && $nom=="")
    {
        $sql=$sql1. " GROUP BY CODPERM  UNION ALL " . $sql2 ."  GROUP BY CODPERM ";
    }
    else if($tipo=="undefined" && $nom!="")
    {
        $sql=$sql1. " AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM  UNION ALL " . $sql2 ." AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM ";
    }
    else if($tipo!="undefined" && $nom=="")
    {
        $sql=$sql. " GROUP BY CODPERM ";
    }
    else if($tipo!="undefined" && $nom!="")
    {
        $sql=$sql. " AND CONCAT_WS(' ',PERNOM,PERAPP) LIKE '%$nom%' GROUP BY CODPERM ";
    }

    $val=funciones::listadoReturn($c,$sql);
    echo "|";
    echo "<table cellspacing='0' cellpadding='0'>";
    echo $header;
    while($reg=mysql_fetch_array($val)){
        echo "<tr>";
        echo "<td>";
          for($x=0;$x<mysql_num_fields($val);$x++)
          {
            echo "<td>".$reg[$x]."</td>";
          }

          if(strlen($reg[4])==10)
          {
            echo "<td><input type='date' class='sal$reg[0]' style='width:130px'></td>";
            echo "<td><input type='date' class='ret$reg[0]' style='width:130px'></td>";
          }else{
            echo "<td><input type='text' class='inicio_time sal$reg[0]' style='width:100px'></td>";
            echo "<td><input type='text' class='fin_time ret$reg[0]' style='width:100px'></td>";
          }          
          echo "<td><input type='button'  value='Aplicar' OnClick=boton_comision('$reg[0]','personal','$tipo') ></td>";
        echo "</tr>";
    }
    echo "</table>
        <script type='text/javascript'>
          $(function(){
            $('.inicio_time').ptTimeSelect();
            $('.fin_time').ptTimeSelect();
          });
        </script>
      ";
    echo "{+}";
}
else if($dato=="actualizar_vigilante")
{
    $ini=$_GET["ini"];
    $cod=$_GET["cod"];
    $fin=$_GET["fin"];
    $tipo=$_GET["tipo"];

    if ($tipo=="fecha"){
        $opt="1";
        $horinie=date("Y-m-d",strtotime($ini));
        $horfine=date("Y-m-d",strtotime($fin));
    }else{
        $opt="2";
        $horinie=funciones::Seteo_tiempo($ini);
        $horfine=funciones::Seteo_tiempo($fin);
    }
    $men=ValModSolVigComi($cod,$horinie,$horfine,$opt);
    echo "| $men {+}";
}
else if($dato=="filtrar_jefatura")
{
    $tipo=trim($_GET["tipo"]);
    $concep=trim($_GET["concep"]);
    $estado=trim($_GET["estado"]);

    $area = " SELECT FKCODGRU FROM TUSER INNER JOIN DETGRU ON FKCODPER=CODUSEPER WHERE  USEALI='".$values['usuario']."' ";
    $areas=funciones::listadoReturn($c,$area);
    while($ar=mysql_fetch_array($areas)){
      $_SESSION["area"]=$ar[0];
    }

    switch ($concep) {
      case 'comision': $opt="1"; break;
      case 'personal': $opt="2"; break;
    }

    switch ($estado) {
      case '0'        :   $est="0";  $header1="Aprobar";    $header2="Cancelar";    break;
      case 'aprobado' :   $est="AR"; $header1="Jefatura";   $header2="RR.HH.";      break;
      case 'cancelado':   $est="CR"; $header1="Jefatura";   $header2="RR.HH.";      break;
      case 'pendiente':   $est="EP"; $header1="Aprobar";    $header2="Cancelar";    break;
    }

    $sql1=" SELECT CODPERM,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES,DESGRU AS AREA, 
    DATE_FORMAT(HORINIE,'%r') AS INICIO, DATE_FORMAT(HORFINE,'%r') AS FIN, H.NOMTIPDET, NOMPERTIP, ESTPERM 
    FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET 
    INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON 
    CODPERTIP=CODTIP WHERE FECINIE IS NULL AND FECFINE IS NULL AND FKCODGRU='".$_SESSION["area"]."' ";

    $sql2=" SELECT CODPERM,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU AS AREA, 
    DATE_FORMAT(FECINIE,'%d/%m/%Y') AS INICIO, DATE_FORMAT(FECFINE,'%d/%m/%Y') AS FIN, H.NOMTIPDET, 
    NOMPERTIP, ESTPERM FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU 
    INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE HORINIE IS NULL AND HORFINE IS NULL AND FKCODGRU='".$_SESSION["area"]."' ";

    if($tipo=="0" && $concep=="0" && $estado=="0")
    {
        $sql= $sql1 . " AND ESTPERM='EP' GROUP BY CODPERM UNION ALL " . $sql2 . " AND ESTPERM='EP' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep=="0" && $estado == "0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . "GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . "GROUP BY CODPERM ";
        }
    }
    else if($tipo== "0" && $concep!="0" && $estado == "0")
    {
        $sql= $sql1 . " AND ESTPERM='EP' AND CODTIP='$opt' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='EP' AND CODTIP='$opt' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep=="0" && $estado != "0")
    {
        $sql= $sql1 . " AND ESTPERM='$est' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='$est' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep!="0" && $estado == "0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND ESTPERM='EP' AND CODTIP='$opt' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND ESTPERM='EP' AND CODTIP='$opt' GROUP BY CODPERM ";
        }
    }
    else if($tipo!= "0" && $concep=="0" && $estado != "0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND ESTPERM='$est' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND ESTPERM='$est' GROUP BY CODPERM ";
        }
    }
    else if($tipo== "0" && $concep!="0" && $estado != "0")
    {
        $sql= $sql1 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep!="0" && $estado != "0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM ";
        }
    }

    $val=funciones::listadoReturn($c,$sql);

    echo "|";

    echo "<table cellpadding='0' cellspacing='0'>";
    echo "<tbody >
            <th class='th'>&nbsp;</th>
            <th>Codigo</th>     <th>Nombres y Apellidos</th>  <th>Area</th>
            <th>Salida</th>     <th>Retorno</th>              <th>Asunto</th>
            <th>Salida</th>     <th>$header1</th>              <th>$header2</th>
            <th>Aplicar</th>
          </tbody>";

    while($reg=mysql_fetch_array($val)){
        
        switch ($reg[7]) {
          case 'AJ':  $jefatura="Aprobado";       $rrhh="Pendiente";    break;
          case 'CJ':  $jefatura="Cancelado";      $rrhh="Pendiente";    break;
          case 'AR':  $jefatura="Aprobado";       $rrhh="Aprobado";     break;
          case 'CR':  $jefatura="Aprobado";       $rrhh="Cancelado";    break;
          case 'EP':  $jefatura="Pendiente";      $rrhh="Pendiente";    break;
        }

        echo "<tr>";
        echo "<td></td>";
        for($x=0;$x<mysql_num_fields($val)-1;$x++)
        {
            echo "<td>$reg[$x]</td>";
        }

        if($reg[7]!="EP"){
            echo "<td>$jefatura</td>";
            echo "<td>$rrhh</td>";
        }else{
            echo "<td><input type='radio' name='opt$reg[0]' value='si' class='accion$reg[0]' ></td>";
            echo "<td><input type='radio' name='opt$reg[0]' value='no' class='accion$reg[0]' ></td>";
        }

        if($reg[7]=="EP"){
            echo "<td><input type='button' value='Guardar' style='width:60px !important' OnClick=accionJef('$reg[0]')></td>";
        }else if($reg[7]=="AR"){
            echo "<td><input type='button' value='Archivo' OnClick=documento_permiso('$reg[0]') style='width:60px !important'></td>";
        }else{
            echo "<td><input type='button' value='Cancel' style='width:60px !important' disabled='disabled'></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
    echo "{+}";
}
else if($dato=="permisos_jefatura_solicitud")
{
    $codigo=$_GET["cod"];
    $opt=$_GET["opt"];

    switch ($opt) {
      case 'si':    $estado="AJ";   break;
      case 'no':    $estado="CJ";   break;
    }

    $men=ValModSolJefComi($codigo,$estado);
    echo "| $men $estado {+}";
}
else if($dato=="filtrar_recursos")
{
    $tipo=trim($_GET["tipo"]);
    $concep=trim($_GET["concep"]);
    $estado=trim($_GET["estado"]);
    $area=trim($_GET["area"]);

    switch ($concep) {
      case 'comision': $opt="1"; break;
      case 'personal': $opt="2"; break;
    }
    
    switch ($estado) {
      case '0'        :   $est="0";  $header1="Aprobar";   $header2="Cancelar";    break;
      case 'aprobado' :   $est="AR"; $header1="Jefatura";   $header2="RR.HH.";    break;
      case 'cancelado':   $est="CR"; $header1="Jefatura";   $header2="RR.HH.";    break;
      case 'pendiente':   $est="AJ"; $header1="Aprobar";    $header2="Cancelar";  break;
    }

    $sql1=" SELECT CODPERM,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES,DESGRU AS AREA, 
    DATE_FORMAT(HORINIE,'%r') AS INICIO, DATE_FORMAT(HORFINE,'%r') AS FIN, H.NOMTIPDET, NOMPERTIP, ESTPERM 
    FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON K.CODTIPDET=H.CODTIPDET 
    INNER JOIN DETGRU ON PERCOD=FKCODPER INNER JOIN TABGRU ON FKCODGRU=CODGRU INNER JOIN TABPERTIP ON 
    CODPERTIP=CODTIP WHERE FECINIE IS NULL AND FECFINE IS NULL ";

    $sql2=" SELECT CODPERM,CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRES, DESGRU AS AREA, 
    DATE_FORMAT(FECINIE,'%d/%m/%Y') AS INICIO, DATE_FORMAT(FECFINE,'%d/%m/%Y') AS FIN, H.NOMTIPDET, 
    NOMPERTIP, ESTPERM FROM TPERS INNER JOIN TPERM K ON PERCOD=CODPERS INNER JOIN DETPERTIP H ON 
    K.CODTIPDET=H.CODTIPDET INNER JOIN DETGRU ON FKCODPER=PERCOD INNER JOIN TABGRU ON FKCODGRU=CODGRU 
    INNER JOIN TABPERTIP ON CODPERTIP=CODTIP WHERE HORINIE IS NULL AND HORFINE IS NULL ";

    if($tipo=="0" && $concep=="0" && $estado=="0" && $area=="0")
    {
        $sql= $sql1 . " AND ESTPERM='AJ' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='AJ' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep=="0" && $estado == "0" && $area=="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . "GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . "GROUP BY CODPERM ";
        }
    }
    else if($tipo== "0" && $concep!="0" && $estado == "0" && $area=="0")
    {
        $sql= $sql1 . " AND CODTIP='$opt' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND CODTIP='$opt' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep=="0" && $estado != "0" && $area=="0")
    {
        $sql= $sql1 . " AND ESTPERM='$est' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='$est' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep=="0" && $estado == "0" && $area!="0")
    {
        $sql= $sql1 . " AND FKCODGRU='$area' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND FKCODGRU='$area' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep!="0" && $estado == "0" && $area=="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND CODTIP='$opt' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND CODTIP='$opt' GROUP BY CODPERM ";
        }
    }
    else if($tipo!= "0" && $concep=="0" && $estado != "0" && $area=="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND ESTPERM='$est' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND ESTPERM='$est' GROUP BY CODPERM ";
        }
    }
    else if($tipo!= "0" && $concep=="0" && $estado == "0" && $area!="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND FKCODGRU='$area' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND FKCODGRU='$area' GROUP BY CODPERM ";
        }
    }
    else if($tipo== "0" && $concep!="0" && $estado != "0" && $area=="0")
    {
        $sql= $sql1 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND ESTPERM='$est' AND CODTIP='$opt' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep!="0" && $estado == "0" && $area!="0")
    {
        $sql= $sql1 . " AND FKCODGRU='$area' AND CODTIP='$opt' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND FKCODGRU='$area' AND CODTIP='$opt' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep=="0" && $estado != "0" && $area!="0")
    {
        $sql= $sql1 . " AND FKCODGRU='$area' AND ESTPERM='$est' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND FKCODGRU='$area' AND ESTPERM='$est' GROUP BY CODPERM ";
    }
    else if($tipo== "0" && $concep!="0" && $estado != "0" && $area!="0")
    {
        $sql= $sql1 . " AND FKCODGRU='$area' AND CODTIP='$opt' AND ESTPERM='$est' GROUP BY CODPERM 
        UNION ALL " . $sql2 . " AND FKCODGRU='$area' AND CODTIP='$opt' AND ESTPERM='$est' GROUP BY CODPERM ";
    }
    else if($tipo!= "0" && $concep=="0" && $estado != "0" && $area!="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND FKCODGRU='$area'AND ESTPERM='$est' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND FKCODGRU='$area' AND ESTPERM='$est' GROUP BY CODPERM ";
        }
    }
    else if($tipo!= "0" && $concep!="0" && $estado != "0" && $area!="0")
    {
        if($tipo=="hora"){
            $sql=$sql1 . " AND ESTPERM='$est' AND CODTIP='$opt' AND FKCODGRU='$area' GROUP BY CODPERM ";
        }else{
            $sql=$sql2 . " AND ESTPERM='$est' AND CODTIP='$opt' AND FKCODGRU='$area' GROUP BY CODPERM ";
        }
    }

    $val=funciones::listadoReturn($c,$sql);

    echo "|";

    echo "<table cellpadding='0' cellspacing='0'>";
    echo "<tbody >
            <th class='th'>&nbsp;</th>
            <th>Codigo</th>     <th>Nombres y Apellidos</th>  <th>Area</th>
            <th>Salida</th>     <th>Retorno</th>              <th>Asunto</th>
            <th>Salida</th>     <th>$header1</th>             <th>$header2</th>
            <th>Aplicar</th>
          </tbody>";

    while($reg=mysql_fetch_array($val)){

        switch ($reg[7]) {
          case 'AJ':  $jefatura="Aprobado";       $rrhh="Pendiente";    break;
          case 'CJ':  $jefatura="Cancelado";      $rrhh="Pendiente";    break;
          case 'AR':  $jefatura="Aprobado";       $rrhh="Aprobado";     break;
          case 'CR':  $jefatura="Aprobado";       $rrhh="Cancelado";    break;
          case 'EP':  $jefatura="Pendiente";      $rrhh="Pendiente";    break;
        }

        echo "<tr>";
        echo "<td></td>";
        for($x=0;$x<mysql_num_fields($val)-1;$x++)
        {
            echo "<td>$reg[$x]</td>";
        }
        if($reg[7]!="AJ"){
            echo "<td>$jefatura</td>";
            echo "<td>$rrhh</td>";
        }else{
            echo "<td><input type='radio' name='opt$reg[0]' value='si' class='accion$reg[0]' ></td>";
            echo "<td><input type='radio' name='opt$reg[0]' value='no' class='accion$reg[0]' ></td>";
        }
        if($reg[7]=="AJ"){
            echo "<td><input type='button'  value='Guardar' style='width:60px !important' OnClick=accionRec('$reg[0]')></td>";
        }else if($reg[7]=="CJ" || $reg[7]=="CR"){
            echo "<td><input type='button'  value='Cancel' style='width:60px !important' disabled='disabled'></td>";
        }else if($reg[7]=="AR"){
            echo "<td><input type='button'  value='Archivo' OnClick=documento_permiso('$reg[0]')  style='width:60px !important'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "{+}";
}
else if($dato=="permisos_recursos_solicitud")
{
    $codigo=$_GET["cod"];
    $opt=$_GET["opt"];

    switch ($opt) {
      case 'si':    $estado="AR";   break;
      case 'no':    $estado="CR";   break;
    }

    $men=ValModSolJefComi($codigo,$estado);
    echo "| $men $estado {+}";
}
else if($dato=="del_correo")
{
      $cod=$_GET["cod"];
      $seq=$_GET["seq"];
      $cadena =  "DELETE FROM TALD WHERE TACODF='$cod' AND TALSEQ='$seq' ";
      funciones::listadoReturn($c,$cadena);

      $query="SELECT TALSEQ, TALCOR FROM TALD WHERE TACODF='$cod' ";
      $val=funciones::listadoReturn($c,$query);
      echo "|<table cellpadding='0' cellspacing='0'>
              <th>Secuencia</th><th>Correo</th>";
      while($reg=mysql_fetch_array($val))
      {   
          echo "<tr>";
          for($x=0;$x<mysql_num_fields($val);$x++){
            if($x==0){ $clase='text-align:left; padding-left:5px;'; }else{ $clase='text-align:left'; }
            echo "<td style='$clase'>$reg[$x]</td>";
          }
          echo "</tr>";
      }
      echo "</table>+";
}
else if($dato=="ver_correo")
{
      $cod=$_GET["gru"];
      $query="SELECT TALSEQ, TALCOR FROM TALD WHERE TACODF='$cod' ";
      $val=funciones::listadoReturn($c,$query);
      echo "|<table cellpadding='0' cellspacing='0'>
              <th>Secuencia</th><th>Correo</th>";
      while($reg=mysql_fetch_array($val))
      {   
          echo "<tr>";
          for($x=0;$x<mysql_num_fields($val);$x++){
            if($x==0){ $clase='text-align:left; padding-left:5px;'; }else{ $clase='text-align:left'; }
            echo "<td style='$clase'>$reg[$x]</td>";
          }
          echo "</tr>";
      }
      echo "</table>+";
}
else if( $dato == "obtener_vacaciones" )
{
    $order = $_GET["orden"];
    $are = $_GET["area"];
    
    $query1 = "SELECT TVACPER, 
                      CONCAT_WS(' ',PERNOM,PERAPP,PERAPM) AS 'NOMBRES', 
                      SUM(TVACACU) AS 'TOTALES', 
                      SUM(TVACLAB+TVACNLA) AS 'TOMADAS', 
                      SUM(TVACACU)-SUM(TVACLAB+TVACNLA) AS 'PENDIENTES' 
                      FROM TVACGEN INNER JOIN TPERS ON TVACPER=PERCOD INNER JOIN DETGRU ON 
                      FKCODPER=PERCOD WHERE PEREST='' AND PERFCS IS NULL  ";
    
    $query2 = "SELECT CODPER, 
              CONCAT_WS(' ',PERNOM, PERAPP) AS NOMBRES, 
              DATE_FORMAT(FECINI,'%m/%d/%Y') AS INICIO, 
                  DATE_FORMAT(FECFIN,'%m/%d/%Y') AS FIN, 
                  1 AS TIPO,
                  TOTDAY
           FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD 
           INNER JOIN DETGRU ON FKCODPER=PERCOD WHERE PEREST='' AND PERFCS IS NULL AND YEAR(FECINI)=YEAR(CURDATE()) 
           AND STATUS='RA' ";

    if ( $are!= "0"){
      $query1 = $query1 . " AND FKCODGRU=$are ";
      $query2 = $query2 . " AND FKCODGRU=$are ";
    }

    $query1 = $query1 . "  GROUP BY TVACPER ORDER BY TVACPER ";
    $query2 = $query2 . "  GROUP BY CODSOL ORDER BY $order ";

    $sql1= funciones::listadoReturn($c,$query1);
    $sql2= funciones::listadoReturn($c,$query2);

    echo "{-}";
    while($fec=mysql_fetch_array($sql1))
    { 
      for($x=0;$x<mysql_num_fields($sql1);$x++)
      {
        echo $fec[$x]."-";
      }
      echo ",";
    }

    echo "{/}";
    while($fec=mysql_fetch_array($sql2))
    { 
      for($x=0;$x<mysql_num_fields($sql2);$x++)
      {
        echo $fec[$x]."-";
      }
      echo ",";
    }
    echo "{*}";

    /*$query = "SELECT 'VACACIONES' AS TITULO, CONCAT_WS(' ',PERNOM, PERAPP) AS NOMBRES, 
    DATE_FORMAT(FECINI,'%m/%d/%Y') AS INICIO, DATE_FORMAT(FECFIN,'%m/%d/%Y') AS FIN, 1 AS 
    TIPO FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD WHERE MONTH(FECREG) BETWEEN 1 AND 5 
    AND YEAR(FECREG)=YEAR(CURDATE())  GROUP BY CODSOL
    UNION ALL 
    SELECT 'ACTIVIDAD' AS TITULO, ACTNOM AS NOMBRES, DATE_FORMAT(ACTFEC,'%m/%d/%Y') AS ININI,
    DATE_FORMAT(ACTFEC,'%m/%d/%Y') AS FIN, 2 AS TIPO FROM TACTI WHERE MONTH(ACTFEC) BETWEEN 1 
    AND 5 AND YEAR(ACTFEC)=YEAR(CURDATE()) ORDER BY 3 ";*/

    
} else if( $dato == "obtener_vacaciones2" ) {
    $order = $_GET["orden"];
    $are = $_GET["area"];
    $fecha = $_GET["fecha"];
    $fecsis = date("Y-m-d");

    $query = "SELECT CODPER, 
                     CONCAT_WS(' ',PERNOM, PERAPP) AS NOMBRES, 
                     DATE_FORMAT(FECINI,'%m/%d/%Y') AS INICIO, 
                     DATE_FORMAT(FECFIN,'%m/%d/%Y') AS FIN, 
                     1 AS TIPO, 
                     TOTDAY,
                     SUM(TVACACU), 
                     SUM(TVACLAB+TVACNLA) 
                     FROM TSOLIC INNER JOIN TPERS ON CODPER=PERCOD 
                     INNER JOIN DETGRU ON FKCODPER=PERCOD 
                     INNER JOIN TVACGEN ON TVACPER=PERCOD 
                     WHERE PEREST='' AND PERFCS IS NULL AND YEAR(FECINI)=YEAR(CURDATE()) 
                     AND FECFIN>='$fecsis' AND STATUS='RA' ";

    if ($are!= "0"){
      $query = $query . " AND FKCODGRU=$are ";
    }

    /*
    if (trim($fecha)<>"")
    {
       $query = $query . " AND FECFIN>=$fecha ";      
    }
    */

    $query = $query . "  GROUP BY TVACPER ORDER BY $order ";
    $sql= funciones::listadoReturn($c,$query);
    echo "{/}";
    while($fec=mysql_fetch_array($sql))
    { 
      for($x=0;$x<mysql_num_fields($sql);$x++)
      {
        echo $fec[$x]."-";
      }
      echo ",";
    }
    echo "{*}";
}

?>
   