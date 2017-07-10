<section class='content-general'>
	<section class='superior'>
	<form method="post" name="registrar">
		<section class='left'>Empresa: CATEGORIA</section>
		<section class='right'>
		
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_cargo" name="boton" value='Excel' id='btn2'>
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
							<th class='th' width="4.2%">&nbsp;</th>
							<th width="18.2%">C&oacute;digo</th>
							<th>Descripci&oacute;n Cargo</th>
					</table>
				</section>


				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="4.3%"></th>
						<th width="18.6%"></th>
						<th></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];

								if($codigo != NULL && $area == NULL)
								{
									$query = "select IdCategoria, NombreCategoria from categoria where IdCategoria=$codigo group by IdCategoria";
								}
								else if($codigo == NULL && $area != NULL)
								{
									$query = "select IdCategoria, NombreCategoria from categoria where (NOMBRECATEGORIA LIKE '%' '".$area."' '%') group by IdCategoria";
								}
								else
								{
									$query = "select IdCategoria, NombreCategoria from categoria";
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
								<td>Codigo Cargo</td>
								<td class='td'><input type="text" name="CodMos" readonly="" id="cod" class="caja3" maxlength="3"></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="nomcar" class='text1' onkeypress="ValTexto(this)" maxlength="40"></td>
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
									$tabla = "categoria";
									$campo = "IdCategoria";
									$c = funciones::codigo($tabla,$campo);
								?>
								<td>Codigo Cargo</td>
								<td class='td'><input type="text" name="codigofin" class="caja3" readonly="" maxlength="3" value=<?php echo $c; ?> ></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="nombre" onkeypress="ValTexto(this)" maxlength="40"></td>
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
				$men=valModCat($codmod,$_POST['nomcar'],"A");
			}
			else
			{
			    $men=ValRegCat($codnot,$_POST['nombre'],"A");
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codcar =  $_POST['CodMos'];
			valEliCat($codcar);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/cargo");
		}
	}
?>