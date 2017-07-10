<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<input type="hidden" name="form" value="2">
		<section class='left'>Empresa: SUB-PROGRAMAS</section>
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
								<td>Nombre</td>
								<td><input type='text' onkeypress="ValTexto(this)" name='nombre' maxlength="40"></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="3.6%">&nbsp;</th>
							<th width="15.9%">C&oacute;digo</th>
							<th width="36.6%">Nombre de Programa</th>
							<th width="">Descripci&oacute;n</th>
					</table>
				</section>


				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="3.6%"></th>
						<th width="16.2%"></th>
						<th width="37.2%"></th>
						<th width=""></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$nombre = $_POST['nombre'];

								if($codigo != NULL && $nombre == NULL)
								{
									$query = "select codspro,nomspro,pronom,rutaspr,codprofk from tsubpro inner join programa on codprofk=codpro where codspro=$codigo group by codspro";
								}
								else if($codigo == NULL && $nombre != NULL)
								{
									$query = "select codspro,nomspro,pronom,rutaspr,codprofk from tsubpro inner join programa on codprofk=codpro where (nomspro LIKE '%' '".$nombre."' '%') group by codspro";
								}
								else
								{
									$query = "select codspro,nomspro,pronom,rutaspr,codprofk from tsubpro inner join programa on codprofk=codpro group by codspro";
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
										else if($x==3 || $x==4)
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
								<td>Codigo Sub Programa</td>
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly="" maxlength="2"></td>								
								<td></td><td></td><td></td>
							</tr>
							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nompromod" onkeypress="ValTexto(this)" class='text1' maxlength="40"></td>
							</tr>

							<tr>
								<td>Ruta</td>
								<td class='td'><input type="text" name="rutapromod" onkeypress="ValTexto(this)" class='text3' maxlength="40"></td>
							</tr>

							<tr>
								<td>Programa</td>
								<td class='td'>
									<select name="programod" class='text4' >
										<?php
											$query2 = "select * from programa";
											$val2 = funciones::listadoReturn($c,$query2);
											while($reg2=mysql_fetch_array($val2))
											{
												echo "<option value='$reg2[0]'>".$reg2[1];
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
									$tabla = "tsubpro";
									$campo = "codspro";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo Sub Programa</td>
								<td class='td'><input type="text" name"codigo" id='text2' class="caja3" maxlength="2" readonly="" value=<?php echo $c; ?>>
												<input type="hidden" name="codigofin" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nomnew" onkeypress="ValTexto(this)"  maxlength="100"></td>
							</tr>

							<tr>
								<td>Ruta</td>
								<td class='td'><input type="text" name="rutnew" onkeypress="ValTexto(this)"  maxlength="100"></td>
							</tr>

							<tr>
								<td>Programa</td>
								<td class='td'>
									<select name="pronew" >
										<?php
											$query2 = "select * from programa";
											$val2 = funciones::listadoReturn($c,$query2);
											while($reg2=mysql_fetch_array($val2))
											{
												echo "<option value='$reg2[0]'>".$reg2[1];
											}
										?>
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
			$codnot= $_POST['codigofin'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModSubPro($codmod,$_POST['nompromod'],$_POST['rutapromod'],$_POST['programod']);
			}
			else
			{
			    $men=ValRegSubPro($codnot,$_POST['nomnew'],$_POST['rutnew'],$_POST['pronew']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliSubPro($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>