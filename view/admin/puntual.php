<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<input type="hidden" name="form" value="2">
		<section class='left' style="width:400px !important">Empresa: EMPLEADO PUNTUAL</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_puntual" name="boton" value='Excel' id='btn2'>
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
			<section class='contenido'>
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
						<section class="form">
						<table>
							<tr>
								<td>C&oacute;digo</td>
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="5"></td>
								<td>Mes</td>
								<td><input type='text' name='mes' onkeypress="ValNumero(this)" maxlength="2"></td>
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
						<th class='th'>&nbsp;</th><th>Codigo</th><th>A&ntilde;o</th><th>Mes</th><th>Colaborador</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$mes = $_POST['mes'];
								$cadena = "select puncod,tepanual,tepmes,concat_ws(' ',pernom,perapp),percod from tepun inner join tpers on tepcod=percod ";
								if($codigo != NULL && $mes == NULL)
								{
									$query = "$cadena where puncod=$codigo group by puncod";
								}
								else if($codigo == NULL && $mes != NULL)
								{
									$query = "$cadena where tepmes='".$mes."' group by puncod";
								}
								else
								{
									
									$query = "$cadena group by puncod";

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
										else if ($x == 4)
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
								<td>Codigo</td>
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly="" maxlength="5" ></td>								
								<td></td><td></td><td></td>
							</tr>
							<tr>
								<td>A&ntilde;o</td>
								<td class='td'><input type="text" name="aniomod" id='text1' onkeypress="ValNumero(this)" onblur="ValNumeroAnio(this)" maxlength="4"></td>
							</tr>
							<tr>
								<td>Mes</td>
								<td class='td'><input type="text" name="mesmod" id='text2' onkeypress="ValNumero(this)" onblur="ValNumero2(this)" maxlength="2"></td>
							</tr>

							<tr>
								<td>Empleado</td>
								<td class='td'><input type="text" name="empmod" class='caja4' id="busqueda9" readonly="" onkeypress="ValNumero(this)" maxlength="5"><input type="text" name="nommod" id="text3" class='caja2' readonly=""></td>
							</tr>

							<tr>
								<td></td><td style='color:rgba(255,0,0,0.8)'>NOTA: (hacer doble click en el 1er. cuadro)</td>
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
									$tabla = "tepun";
									$campo = "puncod";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo</td>
								<td class='td'><input type="text" name"codigo" class="caja3" readonly="" maxlength="5" value=<?php echo $c; ?>>
												<input type="hidden" name="codigofin" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>A&ntilde;o</td>
								<td class='td'><input type="text" name="anionew" onkeypress="ValNumero(this)" onblur="ValNumeroAnio(this)" maxlength="4"></td>
							</tr>

							<tr>
								<td>Mes</td>
								<td class='td'><input type="text" name="mesnew" onkeypress="ValNumero(this)" onblur="ValNumero2(this)" maxlength="2"></td>
							</tr>

							<tr>
								<td>Empleado</td>
								<td class='td'><input type="text" name="codemp" class='caja4' readonly="" id="busqueda10" maxlength="5" onkeypress="ValNumero(this)"><input type="text" name="nomemp" class='caja2' readonly=""></td>
							</tr>

							<tr>
								<td></td><td style='color:rgba(255,0,0,0.8)'>NOTA: (hacer doble click en el 1er. cuadro)</td>
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
				$men=ValModPun($codmod,$_POST['aniomod'],$_POST['mesmod'],$_POST['empmod']);
			}
			else
			{
			    $men=ValRegPun($codnot,$_POST['anionew'],$_POST['mesnew'],$_POST['codemp']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliPun($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>