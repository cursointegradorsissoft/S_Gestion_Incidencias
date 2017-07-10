<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<input type="hidden" name="form" value="2">
		<section class='left'>Empresa: USUARIO</section>
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
			<input type='submit' name="boton" value='Eliminar' name = "boton" id='btn6'>
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
								<td>Alias</td>
								<td><input type='text' onkeypress="ValTexto(this)" name='alias' maxlength="40"></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>



				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="2%">&nbsp;</th>
							<th width="10.7%">C&oacute;digo</th>
							<th width="39%">Usuario</th>
							<th width="19%">Clave</th>
							<th width="14.4%">Estado</th>
							<th width="">Opcion</th>
					</table>
				</section>


				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="2.6%"></th>
						<th width="11.4%"></th>
						<th width="41%"></th>
						<th width="20%"></th>
						<th width="15%"></th>
						<th width=""></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$alias = $_POST['alias'];

								if($codigo != NULL && $alias == NULL)
								{
									$query = "select * from tuser where usecod=$codigo group by usecod";
								}
								else if($codigo == NULL && $alias != NULL)
								{
									$query = "select * from tuser where (useali LIKE '%' '".$alias."' '%')  group by usecod";
								}
								else
								{
									$query = "select * from tuser group by usecod";
								}

								$val = funciones::listadoReturn($c,$query);
									
								while($reg=mysql_fetch_array($val))
								{	
									switch ($reg[3]) {
										case 1: $men="Desconectado"; 	$style="background:none;"; 					$estado="Deshabilitar"; break;
										case 2: $men="Conectado"; 		$style="background: #F5D0A9;"; 				$estado="Desactivar";	break;
										case 3: $men="DesHabilitado";	$style="background: rgba(0,51,102,0.3);"; 	$estado="Habilitar"; break;
									}

									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='$style' style='text-align:right;padding-right:0.5% !important;'>
											<a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else if($x==3)
										{ 
											echo "<td style='$style'><a href='#?cod=$reg[0]'>".$men."</a></td>";
											echo "<td style='text-align:center;'><input type='button' class='$estado' value='$estado'></td>";
										}
										else if ($x==4){
											echo "<td style='display:none'><a href='#?cod=$reg[0]'>".$men."</a></td>";	
										}
										else
										{
											echo "<td style='$style' ><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
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
								<td>Codigo Usuario</td>
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly="" maxlength="2"></td>								
								<td></td><td></td><td></td>
							</tr>
							<tr>
								<td>Correo (alias)</td>
								<td class='td'><input type="text" name="alimod" onblur="validarEmail(this)" class='text1' maxlength="100"></td>
							</tr>

							<tr>
								<td>Clave</td>
								<td class='td'><input type="password" name="clamod" class="cla1 text2" onkeypress="ValTexto(this)" maxlength="20"></td>
							</tr>

							<tr>
								<td>Confirmar Clave</td>
								<td class='td'><input type="password" name="clamod2" class="cla2 text4" onblur="valclave(this)" maxlength="20"></td>
							</tr>

							<tr>
								<td></td>
								<td><span class='span'></span></td>
							</tr>

							<tr>
								<td>Estado</td>
								<td class='td'>
									<select name="estmod" class='text3' >
										<option value='Conectado'>Habilitado</option>
										<option value='Conectado'>Habilitado</option>
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
									$tabla = "tuser";
									$campo = "usecod";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo Usuario</td>
								<td class='td'><input type="text" name"codigo" id='text2' class="caja3" maxlength="2" readonly="" value=<?php echo $c; ?>>
												<input type="hidden" name="codigofin" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Correo</td>
								<td class='td'><input type="text" name="alinew" onblur="validarEmail(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td>Clave</td>
								<td class='td'><input type="password" name="clanew" class="cla3" onkeypress="ValTexto(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td>Clave</td>
								<td class='td'><input type="password" name="clanew2" class="cla4" onblur="valclave2(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td></td>
								<td><span class='span'></span></td>
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
				$men=ValModUsu($codmod,$_POST['alimod'],$_POST['clamod'],$_POST['estmod']);
			}
			else
			{
			    $men=ValRegUsu($codnot,$_POST['alinew'],$_POST['clanew']);
			}

			if($men == "No Agrego" || $men == "No Modifico") { echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar" )
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['alimod'];
			ValModUsu3($codeli,"3");
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>
