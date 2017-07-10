<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: MONEDA</section>
		<section class='right'>
		
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_moneda" name="boton" value='Excel' id='btn2'>
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
								<td>C&oacute;digo</td>
								<td><input type='text' name='cod' onkeypress="ValNumero(this)" maxlength="2"></td>
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
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th><th>Codigo</th><th>Nombre</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['cod'];

								if($codigo != NULL)
								{
									$query = "select * from tmone where moncod=$codigo group by moncod";
								}
								else
								{
									$query = "select * from tmone";
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
								<td>Codigo Moneda</td>
								<td class='td'><input type="text" name="CodMos" id='cod' class="caja3" readonly="" maxlength="2"></td>
												<input type="hidden" name="CodCap"></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="nommod" class='text1' onkeypress="ValTexto(this)" maxlength="10"></td>
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
									$tabla = "tmone";
									$campo = "MONCOD";
									$c = funciones::codigo($tabla,$campo);
								?>
								<td>Codigo Moneda</td>
								<td class='td'><input type="text" name="codmon" class="caja3" readonly="" maxlength="2" value=<?php echo $c; ?>> </td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="nombre" maxlength="10" onkeypress="ValTexto(this)"></td>
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
			$codnot= $_POST['codmon'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModMone($codmod,$_POST['nommod']);
			}
			else
			{
			    $men=ValRegMone($codnot,$_POST['nombre']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codmon= $_POST['CodMos'];
			ValEliMone($codmon);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/moneda");
		}
	}
?>