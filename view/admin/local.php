<section class='content-general'>
	
	<section class='superior'>
		<form method="POST" name="registrar">
		<section class='left'>Empresa: SEDE</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_local" name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' name="boton" value='A&ntilde;adir' id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" value='Modificar' id='btn5'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Eliminar' id='btn6'>
		</section>

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
					<section class="form">
					<legend>Criterio de Selecci&oacute;n</legend>
						<table>
							<tr>
								<td>C&oacute;digo</td>
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="3"></td>
								<td>Descripci&oacute;n</td>
								<td><input type='text' name='area' onkeypress="ValTexto(this)" maxlength="40"></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.5%">&nbsp;</th>
						<th width="5%">C&oacute;digo</th>
						<th width="13.5%">Nombre</th>
						<th width="34.6%">Direcci&oacute;n</th>
						<th width="9.8%">Telefono</th>
						<th width="5.9%">Anexo</th>
						<th width="7%">Departamento</th>
						<th>Distrito</th>
					</table>
				</section>


				<section class='listado-view'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.7%"></th>
						<th width="7.5%"></th>
						<th width="13.7%"></th>
						<th width="35.3%"></th>
						<th width="10%"></th>
						<th width="7.1%"></th>
						<th width="11.7%"></th>
						<th></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];
								$cadena = "SELECT SEDCOD, SEDNOM,SEDDIR,SEDTEL,SEDANE,DEPNOM,DISNOM,DEPCOD,DISCOD FROM SEDE INNER JOIN DISTRITO ON SEDDISFK=DISCOD INNER JOIN DEPARTAMENTO D ON RELACION=DEPCOD";
								if($codigo != NULL && $area == NULL)
								{
									$query = "$cadena where sedcod=$codigo group by 1";
								}
								else if($codigo == NULL && $area != NULL)
								{
									$query = "$cadena where (sednom LIKE '%' '".$area."' '%') group by 1";
								}
								else
								{
									$query = "$cadena GROUP BY 1";
								}

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
										else if( $x>6 && $x<9)
										{
											echo "<td style='display:none'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else
										{
											echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
									}
									echo "</tr>";
								}
							}
						}
						?>
					</table>
				</section>
			</section>


			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
					<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td>Codigo</td>
								<td class='td'><input type="text" name="CodMos"  id="cod" class="caja3" readonly="" maxlength="3"></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="desmod" class='text1' onblur="valtitulo(this)" maxlength="50"></td>
							</tr>

							<tr>
								<td>Direcci&oacute;n</td>
								<td class='td'><input type="text" name="dirmod" class='text2' onblur="valtitulo(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td>Telefono</td>
								<td class='td'><input type="text" name="dismod" class='text3' onkeypress="ValNumero(this)" maxlength="9"></td>
							</tr>

							<tr>
								<td>Anexo</td>
								<td class='td'><input type="text" name="promod" class='text4' onkeypress="ValNumero(this)" maxlength="4"></td>
							</tr>

							<tr>
								<td>Departamento</td>
								<td class='td'>
									<select name="depmod" id="departamento3" class="text7" onChange="cargaContenido(this.id)">
										<option value="0">--- Departamento ---</option>
										<?php
											$query = 'select * from departamento';
											$val = funciones::listadoReturn($c,$query);
											while($reg= mysql_fetch_array($val))
											{
												echo "<option value='".$reg[0]."'>".$reg[1];
											}
										?>
									</select>
								</td>
							</tr>

							<tr>
								<td>Distrito</td>
								<td class='td'>
									<select name="paimod" id="distrito3" class="text8" >
										<option value="0">--- Distrito ---</option>
										<?php
											$query = 'select * from distrito';
											$val = funciones::listadoReturn($c,$query);
											while($reg= mysql_fetch_array($val))
											{
												echo "<option value='".$reg[0]."'>".$reg[1];
											}
										?>
									</select>
								</td>
							</tr>

							
						</table>
					</section>
				</fieldset>
			</section>

			<section class='contenido3'>
				<fieldset>
					<legend>Datos del Registro</legend>
					<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<?php
									$tabla = "SEDE";
									$campo = "SEDCOD";
									$c = funciones::codigo($tabla,$campo);
								?>
								<td>Codigo</td>
								<td class='td'><input type="text" name="codnew" class="caja3" readonly="" maxlength="3" value=<?php echo $c; ?>></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nomnew" onblur="valtitulo(this)" maxlength="40"></td>
							</tr>

							<tr>
								<td>Direcci&oacute;n</td>
								<td class='td'><input type="text" name="dirnew" onblur="valtitulo(this)" maxlength="40"></td>
							</tr>

							<tr>
								<td>Telefono</td>
								<td class='td'><input type="text" name="telnew" onkeypress="ValNumero(this)" maxlength="9"></td>
							</tr>

							<tr>
								<td>Anexo</td>
								<td class='td'><input type="text" name="anenew" onkeypress="ValNumero(this)" maxlength="4"></td>
							</tr>

							<tr>
								<td>Departamento</td>
								<td>
									<select name="departamento2" id="departamento2" onChange="cargaContenido(this.id)">
										<option value="0">--- Departamento ---</option>
										<?php
											$query = 'select * from departamento';
											$val = funciones::listadoReturn($c,$query);
											while($reg= mysql_fetch_array($val))
											{
												echo "<option value='".$reg[0]."'>".$reg[1];
											}
										?>
									</select>
								</td>
							</tr>

							<tr>
								<td>Distrito</td>

								<td>
									<select name="distrito2" id="distrito2">
										<option value="0">------ Distrito ------</option>
									</select>
								</td>
							</tr>					

						</table>
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
			$codloc= $_POST['codnew'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModLoc($codmod,$_POST['desmod'],$_POST['dirmod'],$_POST['dismod'],$_POST['promod'],$_POST['depmod'],$_POST['paimod']);
			}
			else
			{
			    $men=ValRegLoc($codloc,$_POST['nomnew'],$_POST['dirnew'],$_POST['telnew'],$_POST['anenew'],$_POST['departamento2'],$_POST['distrito2']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliLoc($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/local");
		}
	}
?>