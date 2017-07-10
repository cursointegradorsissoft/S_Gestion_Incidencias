<section class='content-general'>
	
	<section class='superior'>
	<form method="POST" name="registrar">
		<section class='left'>Empresa: SUB-AREA</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_subarea" name="boton" value='Excel' id='btn2'>
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
					<legend>Criterio de Selecci&oacute;n</legend>
					<section class="form">
						<table>
							<tr>
								<input type="hidden" name="form" value="1">
								<td>Area</td>
								<td><input type='text' name='codigo' onkeypress="ValTexto(this)" maxlength="2"></td>
								<td>Sub Area</td>
								<td><input type='text' name='area' onkeypress="ValTexto(this)" maxlength="2"></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="3.55%">&nbsp;</th>
							<th width="31.5%">Nombre Area</th>
							<th width="64.9%">Sub Area</th>
					</table>
				</section>


				<section class='listado-view'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="3.59%"></th>
						<th width="32%"></th>
						<th width="64.9%"></th>

						<?php
						if($_POST && $_POST['form'] ==1)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];

								if($codigo != NULL && $area == NULL)
								{
									$query = "select ARECOD,arenom,sarnom,sarcor from tsare inner join tarea on arecod= sarcod where sarcod=$codigo group by sarcod";
								}
								else if($codigo == NULL && $area != NULL)
								{
									$query = "select arecod,arenom,sarnom,sarcor from tsare inner join tarea on arecod= sarcod where sarnom='".$area."' group by sarcod";
								}
								else
								{
									$query = "select arecod,arenom,sarnom,sarcor from tsare inner join tarea on arecod= sarcod";
								}

								$val = funciones::listadoReturn($c,$query);
									
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else if($x==3)
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


			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td>Codigo Area</td>
								<td class='td'><input type="text" name="CodMos" class="caja4" readonly="" id="cod" maxlength="2" onkeypress="ValNumero(this)">
											<input type="text" name="CodMosMod" class="caja2 text1" readonly=""></td>	
								
								<td></td><td></td><td></td>
							</tr>		

							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nommodsub" class='text2' onkeypress="ValTexto(this)" maxlength="40"></td>
							</tr>
								<input type="hidden" name="codsubare" class='text3' onkeypress="ValTexto(this)" </td>

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
								<td>Codigo Area</td>
								<td class='td'><input type="text" name="codigofin" class="caja4 busqueda13" readonly="" id="cod" maxlength="2" onkeypress="ValNumero(this)">
											<input type="text" name="nombrearea" id="text1" class="caja2" readonly=""></td>	
								
								<td></td><td></td><td></td>
							</tr>			

							<tr>
								<td></td><td style='color:rgba(255,0,0,0.8)'>NOTA: (hacer doble click en el 1er. cuadro)</td>
							</tr>
							
							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nombresubarea" id='text2' onkeypress="ValTexto(this)" maxlength="40"></td>
							</tr>

							<input type="hidden" name="codaremod"><input type="hidden" name="nomaremod"><input type="hidden" name="codare"><input type="hidden" name="nomare">

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
			$codarea= $_POST['codigofin'];
			$codare= $_POST['CodMos'];
			$codsub= $_POST['codsubare'];

			if($codare != NULL && $codsub != NULL)
			{
				$men=ValModActSubA($codare,$codsub,$_POST['nommodsub']);
			}
			else
			{
			    $men=ValRegSubA($codarea,$_POST['nombresubarea']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	
			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			ValEliActSubA( $_POST['CodMos'],$_POST['codsubare']);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>