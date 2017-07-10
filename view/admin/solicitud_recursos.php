
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
			<input type='submit' name="boton" value='Guardar' class="conceder enviar_masivo" id='btn7'>
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

								<td>Area</td>
								<td>
									<select class="area_rh">
									<option value="">---Seleccione---</option>
									<?php
										$query="SELECT * FROM TABGRU ";
										//$query="SELECT * FROM TABGRU ";
										$listado=funciones::listadoReturn($c,$query);
										while($reg=mysql_fetch_array($listado)){
											echo "<option  value='".$reg[0]."'>".$reg[2]."</option>";
										}
									?>
									</select>
								</td>
								
								
								<td>Estado</td>
								<td>
									<select class="tipo_sv_RH">
										<option value="1">---Seleccione---</option>
										<option value="PR">Pendientes</option>
										<option value="AR">Aprobadoss</option>
										<option value="CR">Cancelados</option>
									</select>
								</td>

								
								<td></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" class="visualizar" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="0.3%">&nbsp;</th>
						<th style='text-align:center;' width="7%">Codigo</th>
						<th style='text-align:center;' width="20%">Trabajador</th>
						<th style='text-align:center;' width="12%">Area</th>
						<th style='text-align:center;' width="12%">Sub-Area</th>
						<th style='text-align:center;' width="10%">Fec. Inicio</th>
						<th style='text-align:center;' width="10%">Fec. Fin</th>
						<th style='text-align:center;' width="10%">Total Dias</th>
						<th style='text-align:center;' class="tit_jeft" width="10%">Aceptar</th>
						<th style='text-align:center;' class="tit_rrhh">Cancelar</th>
					</table>
				</section>

				<section class='listado-view' id='listado_rh'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">

						<th class='th' width="1%"></th>
						<th style='text-align:center;' width="7.1%"></th>
						<th style='text-align:center;' width="20.4%"></th>
						<th style='text-align:center;' width="12.4%"></th>
						<th style='text-align:center;' width="12.2%"></th>
						<th style='text-align:center;' width="10.2%"></th>
						<th style='text-align:center;' width="10.2%"></th>
						<th style='text-align:center;' width="10.2%"></th>
						<th style='text-align:center;' width="10.2%"></th>
						<th style='text-align:center;'></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];
								
								$clase="";

								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)), ARENOM,DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
							      DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TABGRU INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER 
							      INNER JOIN TSOLIC ON CODPER=PERCOD  INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON PERSRE=SARCOR 
							      WHERE STATUS='JA' AND PERFCS IS NULL AND PEREST<>'A' GROUP BY CODSOL ";

								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr style='background:rgba(255,255,0,0.2)'><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'>".$reg[$x]."</td>";
										}
										else if(6 == $x)
										{
											echo "<td style='text-align:right !important'>".$reg[$x]."</td>";
										}else{
											echo "<td>".$reg[$x]."</td>";
										}
										
									}
									echo "<td style='text-align:center;'><input type='radio' class='permiso_rh' name='permisos$reg[0]' value='si'></td>
									      <td style='text-align:center;'><input type='radio' class='permiso_rh' name='permisos$reg[0]' value='no'></td>";
									echo "</tr>";
								}


								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)), ARENOM,DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
							      DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TABGRU INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER 
							      INNER JOIN TSOLIC ON CODPER=PERCOD  INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON PERSRE=SARCOR
							       WHERE STATUS='RA' AND PERFCS IS NULL AND PEREST<>'A' GROUP BY CODSOL ";

								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'>".$reg[$x]."</td>";
										}
										else if(6 == $x)
										{
											echo "<td style='text-align:right !important'>".$reg[$x]."</td>";
										}
										else
										{
											echo "<td>".$reg[$x]."</td>";
										}
									}
									echo "<td style='text-align:center;'>
											<a herf='#' class='documento' title='Ver Documento'>Aprobado</a>
										  </td>
										  <td style='text-align:center;'>.:::::.</td>";
									echo "</tr>";
								}



								$query="SELECT CODSOL,CONCAT_WS(', ',PERNOM, CONCAT_WS(' ',PERAPP,PERAPM)), ARENOM,DESGRU, DATE_FORMAT(FECINI,'%d/%m/%Y'), 
							      DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TABGRU INNER JOIN DETGRU ON FKCODGRU=CODGRU INNER JOIN TPERS ON PERCOD=FKCODPER 
							      INNER JOIN TSOLIC ON CODPER=PERCOD  INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON PERSRE=SARCOR
							        WHERE STATUS='RC' AND PERFCS IS NULL AND PEREST<>'A' GROUP BY CODSOL ";

								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr style='background:rgba(255,0,0,0.2)'><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'>".$reg[$x]."</td>";
										}
										else if(6 == $x)
										{
											echo "<td style='text-align:right !important'>".$reg[$x]."</td>";
										}
										else
										{
											echo "<td>".$reg[$x]."</td>";
										}
									}
									echo "<td style='text-align:center;'>.:::::.</td>
										  <td style='text-align:center;'>Cancelado</td>";
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

							</section>



						</section>
					</form>
				</fieldset>
			</section>
			
		</section>
	</section>
</section>
