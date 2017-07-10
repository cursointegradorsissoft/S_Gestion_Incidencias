<?php

class calendario{
	var $nombre_dias = array('DOMINGO','LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO');
	function calendario(){
		
	}
	
	function mostrarBarra(){
		$fecha = funciones::fecha();
		echo "<div id='barcal'>";
			echo $fecha['mes'] . " " . $fecha['año'];
		echo "</div>";
	}
	
	function mostrar(){
		$mes=date('m',time());
		$anio=date('Y',time());

		if($mes==1){ $mes_anterior=12; $anio_anterior = $anio-1; }
		else{ $mes_anterior = $mes-1; $anio_anterior = $anio; }
		
		$ultimo_dia_mes_anterior = date('t',mktime(0,0,0,$mes_anterior,1,$anio_anterior));
		
		$dia=1;
		if(strlen($mes)==1) $mes='0'.$mes;
		?>
		<table id="minical" class='inicio'>
        <thead>
		  <th><?php echo $this->nombre_dias[0]?></th>
		  <th><?php echo $this->nombre_dias[1]?></th>
		  <th><?php echo $this->nombre_dias[2]?></th>
		  <th><?php echo $this->nombre_dias[3]?></th>
		  <th><?php echo $this->nombre_dias[4]?></th>
		  <th><?php echo $this->nombre_dias[5]?></th>
		  <th><?php echo $this->nombre_dias[6]?></th>
        </thead>
        <tbody>
		<?php
	
		
		$numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio));
		
		$ultimo_dia = date('t', mktime(0,0,0,$mes,$dia,$anio));
		
		$diferencia_mes_anterior = $ultimo_dia_mes_anterior - ($numero_primer_dia-1);
		
		$total_dias=$numero_primer_dia+$ultimo_dia;
		$diames=1;
		
		$cumple = array();
		$nacim = array();
		$activ = array();
		
		$query =mysql_query( "SELECT DAY(PERFNA) dia,MONTH(PERFNA),YEAR(CURDATE())-YEAR(PERFNA) FROM tpers WHERE MONTH(PERFNA)=MONTH(CURDATE()) GROUP BY 1 order by 1 ASC ");
		$query2 =mysql_query( "SELECT DAY(FECNAC) dia,MONTH(FECNAC) mes FROM tnaci WHERE MONTH(FECNAC)=MONTH(CURDATE()) GROUP BY 1 order by 1 ASC ");
		$query3 =mysql_query( "SELECT DAY(ACTFEC) dia,MONTH(ACTFEC) mes FROM tacti WHERE MONTH(ACTFEC)=MONTH(CURDATE()) GROUP BY 1 order by 1 ASC ");

		$j=1;
		while($j<=$total_dias){
			echo "<tr> \n";
			$i=0;
			$k=1;
			while($i<7){
				if($j<=$numero_primer_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $diferencia_mes_anterior;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";
					echo "</td> \n";
					$diferencia_mes_anterior++;
				}elseif($diames>$ultimo_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $k;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";
					echo"</td> \n";
					$k++;
				}else{
					if($diames<10) $diames_con_cero='0'.$diames;
					else $diames_con_cero=$diames;
					echo "<td>";
					echo "<div class=\"headbox\"> \n";
					echo $diames;

					while($reg=mysql_fetch_array($query)){ $cumple[] = $reg['dia']; }
					while($reg=mysql_fetch_array($query2)){ $nacim[] = $reg['dia']; }
					while($reg=mysql_fetch_array($query3)){ $activ[] = $reg['dia']; }

					if( (pos($cumple)==$diames) && (pos($nacim)==$diames) && (pos($activ)==$diames) )
					{
						echo "</br><img src='themes/images/completo4.png'></br>N - C - N"; next($cumple); next($nacim); next($activ);
					}
					else if( (pos($cumple)==$diames) && (pos($nacim)==$diames) && (pos($activ)!=$diames) )
					{
						echo "</br><img src='themes/images/completo3.png'></br>Nac. & Cum."; next($cumple); next($nacim);
					}
					else if( (pos($cumple)==$diames) && (pos($nacim)!=$diames) && (pos($activ)==$diames) )
					{
						echo "</br><img src='themes/images/completo2.png'></br>Nov. & Cum."; next($cumple); next($activ);
					}
					else if( (pos($cumple)!=$diames) && (pos($nacim)==$diames) && (pos($activ)==$diames) )
					{
						echo "</br><img src='themes/images/completo1.png'></br>Nov. & Nac."; next($nacim); next($activ);
					}
					else if( (pos($cumple)==$diames) && (pos($nacim)!=$diames) && (pos($activ)!=$diames) )
					{
						echo "</br><img src='themes/images/birthday.png'>Cumplea&ntilde;os"; next($cumple);
					}
					else if( (pos($cumple)!=$diames) && (pos($nacim)==$diames) && (pos($activ)!=$diames) )
					{
						echo "</br><img src='themes/images/nacimiento.png'>Nacimiento"; next($nacim);
					}
					else if( (pos($cumple)!=$diames) && (pos($nacim)!=$diames) && (pos($activ)==$diames) )
					{
						echo "</br><img src='themes/images/novedad.png'></br>Novedades"; next($activ);
					}

					echo "</div> \n";
					echo "<div class=\"bodybox\"></div> \n";
					echo "</td> \n";
					$diames++;
				}
				$i++;
				$j++;
			}
			echo "</tr> \n";
		}
		?>
         </tbody>
		</table>
		<?php
	}
}

?>
