<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: PERSONAL GRUPO</section>
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
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' name="boton" value='A&ntilde;adir' id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" value='Modificar' id="btn5">
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Eliminar' id='btn6'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Guardar' name = "boton" id='btn7'>
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
			<section class='contenido' id="contenido">
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
						<section class="form">
						<table>
							<tr>
								<input type="hidden" name="form" value="1">
								<td>C&oacute;digo</td>
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="2"></td>
								<td>Area</td>
								<td><input type='text' onkeypress="ValTexto(this)" name='area' maxlength="40"></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th><th>Codigo</th><th>Jefe de Area</th><th>Nombre de &Aacute;rea</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];
								$query=" SELECT CODGRU,PERCOD, CONCAT_WS(' ',CONCAT_WS(',',PERNOM,PERAPP),PERAPM) ,DESGRU FROM TABGRU INNER JOIN TPERS ON CODJEF=PERCOD ";
								if($codigo != NULL && $area == NULL)
								{
									$query = $query . " WHERE CODGRU=$codigo GROUP BY CODGRU";
								}
								else if($codigo == NULL && $area != NULL)
								{
									$query = $query . " WHERE (DESGRU LIKE '%' '".$area."' '%') GROUP BY CODGRU";
								}
								else
								{
									$query = $query ;
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
										else if($x==1)
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
			</section>

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td>Codigo Area</td>
									<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly="" maxlength="2"></td>								
									<td></td><td></td><td></td>
								</tr>
								<td>Nombre Jefe</td>
									<td class='td'>
										<input type="text" name="empmod" class="caja4 seteo_caja buscar_jefe text1" readonly="">
										<input type="text" name="nommod" class="caja2 text2" readonly="">
									</td>
								</tr>
								<tr>
									<td>Descripci&oacute;n</td>
									<td class='td'><input type="text" name="desmod" onkeypress="ValTexto(this)" class='text3' maxlength="40"></td>
								</tr>
								<tr>
									<td><input type="button" value="Visualizar" class="ver_grupo"></td>
									<td><input type="button" value="Agregar" class="busqueda15"></td>
								</tr>
							</table>


							<section class="list_grupo" style="">
								<table cellpadding="0" cellspacing="0">
									<th class='th'>&nbsp;</th>
									<th>Codigo</th>
									<th>Nombres</th>
									<th>Correo</th>
									<th>Telef&oacute;no</th>
								</table>
							</section>


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
									$tabla = "TABGRU";
									$campo = "CODGRU";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo Grupo</td>
								<td class='td'><input type="text" name"codigo" class='text3' class="caja3" maxlength="2" readonly="" value=<?php echo $c; ?>>
												<input type="hidden" name="codigofin" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombre Jefe</td>
								<td class='td'>
									<input type="text" name="codemp" class="caja4 seteo_caja" readonly="" id="busqueda10" maxlength="5" onkeypress="ValNumero(this)">
									<input type="text" name="nomemp" class="caja2" readonly="">
								</td>
							</tr>

							<tr>
								<td>Descripci&oacute;n de Grupo</td>
								<td class='td'><input type="text" name="descrip" onkeypress="ValTexto(this)" maxlength="40"></td>
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
			$codnot= $_POST['codigofin'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModGru($codmod,$_POST['empmod'],$_POST['desmod']);
			}
			else
			{
			    $men=ValRegGru($codnot,$_POST['codemp'],$_POST['descrip']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliGru($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>