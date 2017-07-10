<section class='content-general'>
	
	<section class='superior'>
	<form method="post" name='registrar' enctype="multipart/form-data">
		<section class='left'>Empresa: SEDE - MARCA</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name='boton' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_sedemar" name='boton' value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name='boton' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' name='boton' value='A&ntilde;adir' id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name='boton' value='Modificar' id='btn5'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' name='boton' value='Eliminar' id='btn6'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' name='boton' value='Guardar' id='btn7'>
		</section>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' name='boton' value='Cancelar' id='btn8'>
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
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="11"></td>
								<td>Descripci&oacute;n</td>
								<td><input type='text' name='des' onkeypress="ValTexto(this)" maxlength="100"></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="4%">&nbsp;</th>
							<th width="30%">Marca</th>
							<th width="50%">Sede</th>
							<th width="15%">Imagen</th>
					</table>
				</section>

				<section class='listado-view'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="4.2%"></th>
						<th width="30.5%"></th>
						<th width="51.7%"></th>
						<th width="15%"></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$des = $_POST['des'];
								$estructura = "SELECT MARNOM,SEDNOM,IMAGEN,SEDCODFK,MARCODFK FROM SEDE INNER JOIN DETSEDE ON SEDCOD=SEDCODFK INNER JOIN MARCA ON MARCOD=MARCODFK WHERE ESTDET='1'";
								if($codigo != NULL && $des == NULL)
								{
									$query = "$estructura and marcodfk=$codigo  GROUP BY SEDCODFK,MARCODFK ORDER BY 1";
								}
								else if($codigo == NULL && $des != NULL )
								{
									$query = "$estructura and (marnom LIKE '%' '".$des."' '%')  GROUP BY SEDCODFK,MARCODFK ORDER BY 1";
								}
								else
								{
									$query = "$estructura  GROUP BY SEDCODFK,MARCODFK ORDER BY 1";
								}

								$val = funciones::listadoReturn($c,$query);
									
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==3 || $x==4)
										{ 
											echo "<td style='display:none'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else
										{
											echo "<td><a href='#?cod=$reg[0]'>".utf8_decode($reg[$x])."</a></td>";
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

			<style type="text/css">
				.container-right .content-general .inferior .content .contenido2 fieldset #list2
				{
					width: 36%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
					margin-left: 7%;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list2 #imagen2
				{
					width:90%;
					height:80%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list2 #imagen2 img
				{
					width:100%;
					height:100%;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset .form
				{
					width: 50%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset .form select
				{
					border-radius:10px;
					color:rgba(0,0,0,0.8);
					padding: 0.5%;
				}

				/* OTHER CONTENIDO  */
				.container-right .content-general .inferior .content .contenido3 fieldset #list2
				{
					width: 36%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
					margin-left: 7%;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen
				{
					width:90%;
					height:80%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen img
				{
					width:100%;
					height:100%;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset .form
				{
					width: 50%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset .form select
				{
					border-radius:10px;
					color:rgba(0,0,0,0.8);
					padding: 0.5%;
				}
			</style>

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>

						<section id='list2'>
							<section id='imagen2'></section>
							<input type="file" name="files" id="files" maxlength="70">
						</section>

						<section class="form">
							<table cellspacing="0" cellpadding="0" style="float:left;">
								<tr><td>Sede</td></tr>
								<tr>
									<td>
										<select name='sedemod' class='text3'>
											<?php
												$cadena =  "select * from sede";
												$query = funciones::listadoReturn($c,$cadena);
												while($reg=mysql_fetch_array($query))
												{
													echo "<option value='".$reg[0]."'/>".$reg[1];
												}
											?>
										</select>
									</td>
								</tr>
								<tr><td>Marca</td></tr>
								<tr>
									<td><select name='marcamod' class='text4'>
											<?php
												$cadena =  "select * from marca";
												$query = funciones::listadoReturn($c,$cadena);
												while($reg=mysql_fetch_array($query))
												{
													echo "<option value='".$reg[0]."'/>".$reg[1];
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

					<section id='list2'>
						<section id='imagen'></section>
						<input type="file" name="files2" id="files2" maxlength="70">
					</section>

					<section class="form">
						<table cellspacing="0" cellpadding="0" style="float:left;">
							<tr><td>Sede</td></tr>
							<tr>
								<td>
									<select name='sede'>
										<?php
											$cadena =  "select * from sede";
											$query = funciones::listadoReturn($c,$cadena);
											while($reg=mysql_fetch_array($query))
											{
												echo "<option value='".$reg[0]."'/>".$reg[1];
											}
										?>
									</select>
								</td>
							</tr>
							<tr><td>Marca</td></tr>
							<tr>
								<td><select name='marca'>
										<?php
											$cadena =  "select * from marca";
											$query = funciones::listadoReturn($c,$cadena);
											while($reg=mysql_fetch_array($query))
											{
												echo "<option value='".$reg[0]."'/>".$reg[1];
											}
										?>
									</select>
								</td>
							</tr>
						</table>
					</section>


				</fieldset>
			</section>
			</form>
		</section>
	</section>
</section>

<?php
	if($_POST)
	{
		if($_POST['boton'] == "Guardar")
		{
			$codmod = $_POST['sedemod'];
			if($codmod != NULL)
			{
				switch ($_POST['marcamod']) {
					case '1': $directorio = RUTA.'/themes/images/sedes/peugeot/'; break;
					case '2': $directorio = RUTA.'/themes/images/sedes/baic/'; break;
					case '3': $directorio = RUTA.'/themes/images/sedes/amalie/'; break;
					case '4': $directorio = RUTA.'/themes/images/sedes/industrial/'; break;
				}

				$nombre=funciones::subirImagen($directorio,'files');
				$men=validarModificacionSM($_POST['sedemod'],$_POST['marcamod'],$nombre);
			}
			else
			{
				switch ($_POST['marca']) {
					case '1': $directorio = RUTA.'/themes/images/sedes/peugeot/'; break;
					case '2': $directorio = RUTA.'/themes/images/sedes/baic/'; break;
					case '3': $directorio = RUTA.'/themes/images/sedes/amalie/'; break;
					case '4': $directorio = RUTA.'/themes/images/sedes/industrial/'; break;
				}

				$nombre=funciones::subirImagen($directorio,'files2');
			    $men=validarCambioSM($_POST['sede'],$_POST['marca'],$nombre);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }

			echo "<script>visualizar();</script>";
		}
		else if( $_POST['boton']== "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			ValCamEliSM($_POST['sedemod'],$_POST['marcamod']);
			
		}
	}
?>