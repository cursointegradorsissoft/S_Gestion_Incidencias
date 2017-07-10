<section class='content-general'>
	<section class='superior' >
	<form method="post" name="registrar">
		<section class='left' style='width:50%'>Empresa: PERMISO DE VACACIONES</section>
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
			<input type='submit' name="boton" value='Guardar' class="conceder" id='btn7'>
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

								<td>Estado</td>
								<td>
									<select class="tipo_sv">
										<option value="">---Seleccione---</option>
										<option value="P">Pendientes</option>
										<option value="A">Aprobadoss</option>
										<option value="C">Cancelados</option>
									</select>
								</td>

								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" class="visualizar" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='listado-view' id="listado">
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th>
						<th style='text-align:center;'>Codigo</th>
						<th style='text-align:center;'>Trabajador</th>
						<th style='text-align:center;'>Area</th>
						<th style='text-align:center;'>Sub-Area</th>
						<th style='text-align:center;'>Fec. Inicio</th>
						<th style='text-align:center;'>Fec. Fin</th>
						<th style='text-align:center;'>Total Dias</th>
						<th style='text-align:center;'>Aceptar</th>
						<th style='text-align:center;'>Cancelar</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$area = " SELECT PERARE,PERSRE FROM TUSER INNER JOIN TPERS ON PERCOD=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
								$areas=funciones::listadoReturn($c,$area);
								while($ar=mysql_fetch_array($areas)){
									$_SESSION["area"]=$ar[0]; $_SESSION["subarea"]=$ar[1];
								}

								$clase="";

								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)),ARENOM,SARNOM, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
										DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC 
										INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TUSER ON CODUSEPER=PERCOD INNER JOIN TAREA ON PERARE=ARECOD 
										INNER JOIN TSARE ON PERSRE=SARCOR  WHERE STATUS='E' AND PERARE='".$_SESSION["area"]."' AND PERSRE='".$_SESSION["subarea"]."' 
										AND PERFCS IS NULL AND PEREST='' GROUP BY 1 ";


								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr style='background:rgba(255,255,0,0.2)'><th class='th'></th>";
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
									echo "<td style='text-align:center;'><input type='radio' class='permiso' name='permisos$reg[0]' value='si'></td>
									      <td style='text-align:center;'><input type='radio' class='permiso' name='permisos$reg[0]' value='no'></td>";
									echo "</tr>";
								}

								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)),ARENOM,SARNOM,DATE_FORMAT(FECINI,'%d/%m/%Y'), 
										DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC  
										INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TUSER ON CODUSEPER=PERCOD INNER JOIN TAREA ON PERARE=ARECOD 
										INNER JOIN TSARE ON PERSRE=SARCOR  WHERE STATUS='JA' AND PERARE='".$_SESSION["area"]."' AND PERSRE='".$_SESSION["subarea"]."' 
										AND PERFCS IS NULL AND PEREST='' GROUP BY 1";

								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
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
									echo "<td style='text-align:center;'>Aprobado </td>
										  <td style='text-align:center;'>.:::::.</td>";
									echo "</tr>";
								}
								

								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)),ARENOM,SARNOM,DATE_FORMAT(FECINI,'%d/%m/%Y'), 
										DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC 
										INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TUSER ON CODUSEPER=PERCOD INNER JOIN TAREA ON PERARE=ARECOD 
										INNER JOIN TSARE ON PERSRE=SARCOR  WHERE STATUS='JC' AND PERARE='".$_SESSION["area"]."' AND PERSRE='".$_SESSION["subarea"]."' 
										AND PERFCS IS NULL AND PEREST='' GROUP BY 1";

								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr style='background:rgba(255,0,0,0.2)'><th class='th'></th>";
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
									echo "<td style='text-align:center;'>.:::::.</td>
										  <td style='text-align:center;'> Cancelado </td>";
									echo "</tr>";
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
								<tr>
									<td>Codigo Solicitud</td>
									<td class='td'><input type="text" name="codigo" style="width:40px; text-align:right" class="clase_text codigo" readonly="" maxlength="3"></td>
									
									<td>Fecha Inicio</td>
									<td class='td'><input type="text" class="calendario inicio" name="nombre" id='text5' style="width:150px"></td>
								</tr>


								<tr>
									<td>Codigo</td>
									<td class="td">
										<input type='text' class="clase_text codper" style="width:40px;text-align:right !important" readonly='true' class='codigo0' name='codigo0'>
										<input type='text' class="clase_text nomper" style="width:220px" readonly='true'>
									</td>
									<td>Total D&iacute;as</td>
									<td><input type='text' id='text5' class="totday"></td>
								</tr>


								<tr>
									<td>Cargo</td>
									<td><input type='text' class="clase_text cargo"></td>
									<td>Periodo</td>
									<td><input type="text" class="perio" ></td>
								</tr>


								<tr>
									<td>Area</td>
									<td><input type='text' class="clase_text area" readonly='true'></td>
									<td>Fecha Fin</td>
									<td><input type='text' name='nombre' class="fecfin" id='text5'></td>
								</tr>


								<tr>
									<td>Observaci&oacute;n</td>
									<td class='td'>
										<textarea rows="3" style="width:300px; margin-left:8px"></textarea>
									</td>
									<td>Dias Restantes</td>
									<td class='td'><input type='text' style="color:red; border:none;" class="totales"></td>
								</tr>

							</table>






							<section class="tabla">

							<!--
								<section class="autoriza" style="display:none">
									<section class="descrip">Empleado</section>
									<section class="arriba">
										<section class="img employ">
											<img src="../themes/images/historia/2.png" width="100%" height="100%" />
										</section>
									</section>
									
									<section class="abajo">
										<input type="radio" name="empleado" class="employ" value="A">Aprobar
										<input type="radio" name="empleado" class="employ" value="D">Desaprobar
									</section>
								</section>	


								<section class="autoriza">
									<section class="descrip">Jefe de &Aacute;rea</section>
									<section class="arriba">
										<section class="img jefe">
											<img src="../themes/images/historia/2.png" width="100%" height="100%" />
										</section>
									</section>
									
									<section class="abajo">
										<input type="radio" name="jefe" class="jefe" value="A">Aprobar
										<input type="radio" name="jefe" class="jefe" value="D">Desaprobar
									</section>
								</section>	


								<section class="autoriza" style="display:none">
									<section class="descrip">Recursos Humanos</section>
									<section class="arriba">
										<section class="img rrhh">
											<img src="../themes/images/historia/2.png" width="100%" height="100%" />
										</section>
									</section>
									
									<section class="abajo">
										<input type="radio" name="rrhh" class="rrhh" value="A">Aprobar
										<input type="radio" name="rrhh" class="rrhh" value="D">Desaprobar
									</section>
								</section>	
							-->
							</section>






						</section>
					</form>
				</fieldset>
			</section>
			
		</section>
	</section>
</section>
