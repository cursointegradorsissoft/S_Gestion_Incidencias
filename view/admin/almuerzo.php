<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<input type="hidden" name="form" value="2">
		<section class='left'>Empresa: ALMUERZO</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_almuerzo" name="boton" value='Excel' id='btn2'>
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
								<input type="hidden" name="form" value="1">
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

				<section class='listado-view'>
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th><th>Descripci&oacute;n</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$area = $_POST['area'];
								$sentencia= "select ticodesc, lunes, martes, miercoles, jueves, viernes from talmu  inner join ttico on almucod=ticocod";
								if($codigo != NULL && $area == NULL)
								{
									$query = "$sentencia where ARECOD=$codigo group by arecod";
								}
								else if($codigo == NULL && $area != NULL)
								{
									$query = "$sentencia where (ARENOM LIKE '%' '".$area."' '%') group by arecod";
								}
								else
								{
									$query = "$sentencia";
								}

								$val = funciones::listadoReturn($c,$query);
									
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
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
								<td>Tipo de Comida (Lun. Vie.)</td>
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly=""></td>								
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Lunes</td>
								<td class='td'><input type="text" name="lunes" class='text1' maxlength="45"></td>
							</tr>
							
							<tr>
								<td>Martes</td>
								<td class='td'><input type="text" name="martes" class='text2' maxlength="45"></td>
							</tr>

							<tr>
								<td>Miercoles</td>
								<td class='td'><input type="text" name="miercoles" class='text3' maxlength="45"></td>
							</tr>

							<tr>
								<td>Jueves</td>
								<td class='td'><input type="text" name="jueves" class='text4' maxlength="45"></td>
							</tr>

							<tr>
								<td>Viernes</td>
								<td class='td'><input type="text" name="viernes" class='text5' maxlength="45"></td>
							</tr>

							<tr><td colspan="2"> </br></br></br>Nota: El llenado de datos es por tipo de comida</td></tr>
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
								<td>Tipo de Comida (Lun. Vie.)</td>
								<td class='td'><input type="text" name="codigofin" id="cod2" class="caja3" readonly=""></td>								
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Lunes</td>
								<td class='td'><input type="text" name="lunesnew" class='text6' onkeypress="ValTexto(this)" maxlength="45"></td>
							</tr>
							
							<tr>
								<td>Martes</td>
								<td class='td'><input type="text" name="martesnew" class='text7' onkeypress="ValTexto(this)" maxlength="45"></td>
							</tr>

							<tr>
								<td>Miercoles</td>
								<td class='td'><input type="text" name="miercolesnew" class='text8' onkeypress="ValTexto(this)" maxlength="45"></td>
							</tr>

							<tr>
								<td>Jueves</td>
								<td class='td'><input type="text" name="juevesnew" class='text9' onkeypress="ValTexto(this)" maxlength="45"></td>
							</tr>

							<tr>
								<td>Viernes</td>
								<td class='td'><input type="text" name="viernesnew" class='text10' onkeypress="ValTexto(this)" maxlength="45"></td>
							</tr>

							<tr><td colspan="2"> </br></br></br>Nota: El llenado de datos es por tipo de comida</td></tr>
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
			$codalm= $_POST['codigofin'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModAlm($codmod,$_POST['lunes'],$_POST['martes'],$_POST['miercoles'],$_POST['jueves'],$_POST['viernes']);
			}
			else
			{
			    $men=ValRegAlm($codalm,$_POST['lunesnew'],$_POST['martesnew'],$_POST['miercolesnew'],$_POST['juevesnew'],$_POST['viernesnew']);
			}
			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codcar =  $_POST['CodMos'];
			//valEliAlm($codcar);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/Almuerzo");
		}
	}
?>