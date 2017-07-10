<section class='content-general'>
	<section class='superior' >
	<form method="post" name="registrar">
		<section class='left' style='width:50%'>Empresa: PROGRAMAR VACACIONES</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='submit' name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Guardar' class="conceder programar envio_masivo" id='btn7'>
		</section>

	</section>

	<section class='inferior'>
		<section class='content'>
			<section class='deta'>Consulta</section><section class='deta2'>Mantenimiento</section>
			<section class='contenido'>
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
					<section class="form">
						<table>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" class="visualizar" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='listado-view' id='listado_rh'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th>
						<th style='text-align:center;'>Codigo</th>
						<th style='text-align:center;'>Trabajador</th>
						<th style='text-align:center;'>Fec. Inicio</th>
						<th style='text-align:center;'>Total Dias</th>
						<th style='text-align:center;'>Fec. Fin</th>
						<th style='text-align:center;'>Aceptar</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];
								

								$clase="";

								$area = "SELECT CODGRU,DESGRU FROM TUSER INNER JOIN TABGRU ON CODJEF=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
								$areas=funciones::listadoReturn($c,$area);
								while($ar=mysql_fetch_array($areas)){
									$_SESSION["grupo"]=$ar[0]; $_SESSION["subarea"]=$ar[1];
								}

								$clase="";

								$query=" SELECT PERCOD,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM))  FROM TPERS INNER JOIN DETGRU ON FKCODPER=PERCOD  
								WHERE PERFCS IS NULL AND FKCODGRU='".$_SESSION["grupo"]."' AND PEREST<>'A' GROUP BY 1 ";


								
								

								$val = funciones::listadoReturn($c,$query);
								$y=1;
								$w=25;
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr style='font-size:10px'><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else
										{
											echo "<td><a class='ajax' href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
									}
									echo 
									"<td>
									<input type='text' class='date$y calend_js fecini$reg[0]' id='date$y' style='width:100px !important; font-size:10px'>
									</td>

									<td>
									<input type='text' class='date$w calend_js calen_fin fecfin$reg[0]' id='date$w' style='width:100px !important; font-size:10px'>
									</td>
									
									<td>
										<input type='text' class='total$reg[0]' maxlength='10' readonly='true' style='background:#FFFACD;border:1px solid #A7A7A7; width:50px !important;'>
									</td>

									<td style='text-align:center;'><input type='radio' class='programar' name='programar$reg[0]' value='si'></td>";

									$query2="  SELECT SUM(TVACACU), SUM(TVACLAB), SUM(TVACNLA), COUNT(*)*22, COUNT(*)*8, COUNT(*)*22-SUM(TVACLAB), COUNT(*)*8-SUM(TVACNLA), SUM(TVACACU)-SUM(TVACLAB+TVACNLA) FROM TVACGEN INNER JOIN TPERS ON TVACPER=PERCOD WHERE PERCOD=$reg[0] ";
									$val2=funciones::listadoReturn($c,$query2);
									$totlab = mysql_result($val2, 0, 5);
									$totnla = mysql_result($val2, 0, 6);
									$totals = mysql_result($val2, 0, 7);
									
									echo "<input type='hidden' value='$totals' class='totals$reg[0]' >";
									echo "<input type='hidden' value='$totlab' class='si_lab$reg[0]' >";
									echo "<input type='hidden' value='$totnla' class='no_lab$reg[0]' >";

									echo "</tr>";
									$y++;
									$w++;
								}

							}
						}
						?>
					</table>
					</section>
				</section>
			</section>

			<style type="text/css">
				.clase_text{text-align:left;margin-left: 2%; background: rgba(233,191,89,0.3);}
			</style>

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
							<table cellspacing="0" cellpadding="0" style="width:85%; float:left;">
							</table>


							<section class="tabla">
							</section>

						</section>
					</form>
				</fieldset>
			</section>
			
		</section>
	</section>
</section>






