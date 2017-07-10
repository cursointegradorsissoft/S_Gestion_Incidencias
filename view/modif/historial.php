<?php
	$codigo = $_REQUEST["cod"];
	$query1 = " SELECT PERNOM, CONCAT_WS(' ',PERAPP,PERAPM), DATE_FORMAT(PERFIG,'%d/%m/%Y'), 
			   ARENOM, FUNNOM, PERIMG FROM TPERS INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TFUNC ON 
			   PERFUN=FUNCOD WHERE PERCOD=$codigo ";
	$consul1=funciones::listadoReturn($c,$query1);
	$nomb = mysql_result($consul1, 0, 0);
	$apel = mysql_result($consul1, 0, 1);
	$feci = mysql_result($consul1, 0, 2);
	$area = mysql_result($consul1, 0, 3);
	$carg = mysql_result($consul1, 0, 4);
	$foto = mysql_result($consul1, 0, 5);
		
	$query2 = " SELECT SUM(TVACACU), SUM(TVACLAB+TVACNLA), SUM(TVACACU)-SUM(TVACLAB+TVACNLA) 
	FROM TVACGEN WHERE TVACPER=$codigo GROUP BY TVACPER ";
	$consul2=funciones::listadoReturn($c,$query2);
	$pend = mysql_result($consul2, 0, 2);


	$query3 = "SELECT CODSOL, DATE_FORMAT(FECREG, '%d/%m/%Y' ), DATE_FORMAT(FECINI, '%d/%m/%Y' ) ,
				DATE_FORMAT(FECFIN, '%d/%m/%Y' ),TOTDAY,RANPER FROM TSOLIC WHERE CODPER=$codigo ";
	$consul3=funciones::listadoReturn($c,$query3);

?>
<section class="historial">
	<section class="content">
		<article class="descrip">
			<article class="descrip-content">
				<article Class="foto">
					<?php echo "<img src='../themes/images/employ/$foto'>"; ?>	
				</article>
				<article class="texto">
					<table>
						<tr>	<td>Nombres</td>			<td><?php echo "<span>$nomb</span>"; ?></td>	</tr>
						<tr>	<td>Apellidos</td>			<td><?php echo "<span>$apel</span>"; ?></td>	</tr>
						<tr>	<td>Cargo</td>				<td><?php echo "<span>$carg</span>"; ?></td>	</tr>
						<tr>	<td>Area</td>				<td><?php echo "<span>$area</span>"; ?></td>	</tr>
						<tr>	<td>Fecha Ingreso</td>		<td><?php echo "<span>$feci</span>"; ?></td>	</tr>
						<tr>	<td>Total Pendientes</td>	<td><?php echo "<span>$pend</span>"; ?></td>	</tr>
					</table>
				</article>
			</article>
		</article>
		<article class="detalle">
			<fieldset>
				<?php
					echo "<table cellspacing='0' celpadding='0'>";
						echo
							"<th style='width:17%' title='Codigo de Solicitud'>C&oacute;digo</th>
							 <th style='width:17%' itle='Fecha de Registro'>F. Registro</th>
							 <th style='width:17%' itle='Fecha de Inicio'>F. Inicio</th>
							 <th style='width:17%' itle='Fecha Retorno'>F. Fin</th>
							 <th style='width:15%' itle='Total Dias'>D&iacute;as</th>
							 <th style='width:17%' itle='Periodo'>Periodo</th>";

						while ($filw=mysql_fetch_array($consul3))
						{
							echo "<tr>";
							for($w=0;$w<mysql_num_fields($consul3);$w++){
								echo "<td>".$filw[$w]."</td>";
							}
							echo "</tr>";
						}
					echo "</table>";
				?>
			</fieldset>
			<input type="button" value="Retornar" class='cerrar_history'>
		</article>
	</section>
</section>