<section class='content-general'>
	<section class='superior' >
	<form method="post" name="registrar">
		<section class='left' style='width:50%'>Empresa: SOLICITUD DE VACACIONES</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_solicitud" name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' name="boton" value='A&ntilde;adir' class="btn4val" id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" value='Modificar' id='btn5'>
		</section>

		<!--
		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Eliminar' id='btn6'>
		</section>
		-->

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Guardar' id='btn7'>
		</section>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Cancelar' id='btn8'>
		</section>
		</a>
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
								<td></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>



				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0" class="tbody">
						<tbody>
							<th class='th'>&nbsp;</th>
							<th>Codigo</th>
							<th>Fec. Inicio</th>
							<th>Fec. Fin</th>
							<th>Total D&iacute;as</th>
							<th>Periodo</th>
							<?php
							if($_POST)
							{
								if($_POST['boton'] == "Seleccionar")
								{
									$codigo = $_POST['codigo'];
									$area = $_POST['area'];
									$query="SELECT CONCAT_WS(', ',PERNOM,PERAPP),FECINI,FECFIN,TOTDAY,RANPER FROM TSOLIC INNER JOIN TPERS ON PERCOD=CODPER INNER JOIN TUSER ON CODUSEPER=PERCOD WHERE USEALI='".$values['usuario']."' ";
									$val = funciones::listadoReturn($c,$query);
									while($reg=mysql_fetch_array($val))
									{	
										echo "<tr><th class='th'></th>";
										for($x=0;$x<mysql_num_fields($val);$x++)
										{
											if($x==0)
											{ 
												echo "<td style='text-align:left; padding-right:0.5% !important;'>".$reg[$x]."</td>";
											}
											else if($x==3){
												echo "<td style='text-align:right; padding-right:0.5% !important;'>".$reg[$x]."</td>";	
											}
											else
											{
												echo "<td style='text-align:center;'>".$reg[$x]."</td>";
											}
										}
											  //echo "<td><input type='button' value='Duplicar' class='clonar' name='boton'></td>";
										echo "</tr>";
									}
								}
							}
							?>
						</tbody>
					</table>
					</section>
				</section>
			</section>



			<section class='contenido3'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
							<table cellspacing="0" cellpadding="0" style="width:85%; float:left;">
								<tr>
								<?php
									// OBTENER CODIGO CORRELATIVO
									$param=date('y').date('m');
									$sql ="SELECT CODSOL+1 FROM TSOLIC WHERE SUBSTRING(CODSOL,1,4)=$param ORDER BY CODSOL DESC LIMIT 1 ";
									$val=funciones::listadoReturn($c,$sql);
									if(mysql_num_rows($val)>0)
									{
										$c=mysql_result($val, 0,0);
									}else{
										$codi="0001";
										$c=$param.$codi;
									}
								?>
									<td>Codigo Solicitud</td>
									<td class='td'><input type="text" name="codsol" style="width:60px; text-align:right" class="caja3" readonly="" maxlength="3" value=<?php echo $c; ?> ></td>
									
									<td>Fecha Inicio</td>
									<td class='td'><input type="text" class="date inicio" id="date" name="fecini"  style="width:150px"></td>

								</tr>
								

								<?php
									$consultanio="SELECT YEAR(PERFIG) FROM TPERS INNER JOIN TUSER ON PERCOD=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
									$datos = funciones::listadoReturn($c,$consultanio);
									while($reg=mysql_fetch_array($datos))
									{
										$_SESSION['anio']=$reg[0];
									}


									$consulta="SELECT PERCOD AS Codigo, CONCAT_WS(', ',PERNOM,CONCAT_WS(' ',PERAPP,PERAPM)) AS NOMBRE,FUNNOM as Cargo, SARNOM as Area, DATEDIFF(curdate(),perfig) AS Dias FROM TPERS INNER JOIN TFUNC ON FUNCOD=PERFUN INNER JOIN TSARE ON SARCOR=PERSRE INNER JOIN TUSER ON PERCOD=CODUSEPER WHERE USEALI='".$values['usuario']."' GROUP BY 1  ";
									$data=funciones::listadoReturn($c,$consulta);
									while($fil=mysql_fetch_array($data))
									{
										for($x=0;$x<mysql_num_fields($data);$x++)
										{
											$class="text-align:right;margin-left: 2%; background: rgba(233,191,89,0.3);";
											if($x==0)
											{
												echo "<tr>";
												echo "<td>".mysql_field_name($data, $x)."</td>";
												echo "<td><input type='text' style='$class;width:40px;' readonly='true' class='codigo$x' name='codigo$x' value='".$fil[0]."' >";
												echo "<input type='text' style='$class; width:200px;text-align:left !important;' readonly='true' value='".$fil[1]."' ></td>";
												
												echo "<td>Total D&iacute;as</td>";
												echo "<td class='td'>";
													echo "<input type='text' name='cajadia'  class='cajadia' style='width:30px;' maxlength='40'>";
													echo "<input type='radio' name='dias' class='radio' value='7' text='15'>7";
													echo "<input type='radio' name='dias' class='radio' value='15' text='15'>15";
													echo "<input type='radio' name='dias' class='radio' value='30' text='15'>30";
												echo "</td>"; 
												echo "</tr>";
											}
											else if($x==2)
											{
												echo "<tr>";
												echo "<td>".mysql_field_name($data, $x)."</td>";
												echo "<td><input type='text' style='$class; width:250px;  text-align:left;' readonly='true' value='".$fil[$x]."' ></td>";
												echo "<td>Periodo</td>";
												echo "<td class='td'>";
												echo "<select class='periodo' name='periodo'>";
												for($y=$_SESSION['anio']+1;$y<=date("Y");$y++)
												{
													if($fil[4]>365)
													{
														echo "<option value='$y'>".$y;
													}
												}
												echo "</select>";
												echo "</td>";
												echo "</tr>";
											}
											else if($x==4)
											{
												echo "<tr>";
												echo "<td></td>"; //echo "<td>".mysql_field_name($data, $x)."AA</td>";
												echo "<td></td>"; //echo "<td><input type='text' style='$class; width:250px;  text-align:left;' readonly='true' value='".$fil[$x]."' ></td>";
												echo "<td>Fecha Fin</td>";
												echo "<td class='td'>";
												echo "<input type='text' name='fecfin' class='fechafin date3' id='date3' style='width:150px' onkeypress='ValTexto(this)'' maxlength='40'></td>";
												echo "</td>";
												echo "</tr>";
											}
											
										}
									}

									$consultatotal="SELECT TVACPER,SUM(TVACACU) AS TOTALES, SUM(TVACLAB+TVACNLA) TOMADAS, (SUM(TVACACU)-SUM(TVACLAB+TVACNLA)) AS RESTANTES FROM TVACGEN  INNER JOIN TUSER ON TVACPER=CODUSEPER WHERE USEALI='".$values['usuario']."' GROUP BY 1 ";
									$total = funciones::listadoReturn($c,$consultatotal);
									while($reg=mysql_fetch_array($total))
									{
										$_SESSION["totales"]=$reg[3];
									}
								?>

								<tr>
									<td>Observaci&oacute;n</td>
									<td class='td'>
										<textarea rows="3" style="width:300px; margin-left:8px"></textarea>
									</td>
									<td>Dias Totales</td>
									<td class='td'><input type='text' name="totales" style="color:red; border:none;" class="totales" readonly='false' value=<?php echo $_SESSION["totales"]; ?> ></td>
								</tr>
							</table>



							<section class="tabla">
								<!--
								<section class="autoriza">
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


								<section class="autoriza">
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
<?php
	if($_POST)
	{
		if($_POST['boton'] == "Guardar")
		{	
			$dias=0;
			$_POST['cajadia']!=0?$dias=$_POST['cajadia']:$dias=$_POST['dias'];
			
			$men=ValRegSol($_POST['codsol'], $_POST['codigo0'], $_POST['fecini'], $_POST['fecfin'], $dias, $_POST['periodo']);

			
			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }

			echo "<script>visualizar();</script>";	
		}
	}
?>
