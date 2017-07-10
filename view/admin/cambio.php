<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: CAMBIO</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_cambio" name="boton" value='Excel' id='btn2'>
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
								<td>Fecha</td>
								<td><input type='date' name='fecha' onkeypress="ValTexto(this)" maxlength="10"></td>
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
						<th class='th'>&nbsp;</th><th>Codigo</th><th>Fecha</th><th>Compra</th><th>Venta</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$fecha = $_POST['fecha'];

								if($fecha != NULL)
								{
									$query = "select * from ttica where MONFEC=$fecha group by MONFEC";
								}
								else
								{
									$query = "select * from ttica";
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
											echo "<td><a href='#?cod=$reg[0]'>".date('d-m-Y', strtotime($reg[$x]))."</a></td>";
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
								<td>Tipo de Moneda</td>
								<td class='td'><input type="text" name="CodMos" class="caja4" readonly="" id="codMod" maxlength="1"><input type="text" name="nommda" class="caja2" value="DOLARES" readonly=""></td>
								<input type="hidden" name="codocul" id="cod">
								<td></td><td></td><td></td>
							</tr>

							<tr>
								<td>Fecha</td>
								<td class='td'><input type="text" name="fecmod" id='date2' class="text1 date2" onkeypress="ValTexto(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Precio Compra</td>
								<td class='td'><input type="text" name="copmod" class='text2' onblur="moneda(this)" maxlength="5"></td>
							</tr>

							<tr>
								<td>Precio Venta</td>
								<td class='td'><input type="text" name="venmod" class='text3' onblur="moneda(this)" maxlength="5"></td>
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
				
								<td>Codigo Cambio</td>
								<td class='td'><input type="text" name="codigofin" class="caja4" readonly="" id="codMod" value="1" maxlength="1"><input type="text" name="nommda" class="caja2" value="DOLARES" readonly=""></td>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Fecha</td>
								<td class='td'><input type="text" name="fecha" id='date'  class="date" onkeypress="ValTexto(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Precio Compra</td>
								<td class='td'><input type="text" name="compra" onblur="moneda(this)" maxlength="5"></td>
							</tr>

							<tr>
								<td>Precio Venta</td>
								<td class='td'><input type="text" name="venta"  onblur="moneda(this)" maxlength="5"></td>
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
				$men=validarModificacion($codmod,$_POST['fecmod'],$_POST['copmod'],$_POST['venmod']);
			}
			else
			{
			    $men=validarCambio($codnot,$_POST['fecha'],$_POST['compra'],$_POST['venta']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codcam = $_POST['codocul'];
			ValCamEli($codcam);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/cambio");
		}
	}
?>