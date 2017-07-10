<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar" enctype='multipart/form-data'>
		<section class='left'>Empresa: NACIMIENTO</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_nacimiento" name="boton" value='Excel' id='btn2'>
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
								<td><input type='text' onkeypress="ValTexto(this)" name='nombre' maxlength="100"></td>
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
						<th class='th'>&nbsp;</th><th>Codigo</th><th>Nombres y Apellido</th><th>Fecha Nacimiento</th><th>Sexo</th><th>Empleado</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$nombre = $_POST['nombre'];

								if($codigo != NULL && $nombre == NULL)
								{
									$query = "select * from tnaci where codnac=$codigo group by 1";
								}
								else if($codigo == NULL && $nombre != NULL)
								{
									$query = "select * from tnaci where (nomnac LIKE '%' '".$nombre."' '%') group by 1";
								}
								else
								{
									$query = "select * from tnaci";
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
										else if($x==3 || $x==2 || $x==5 || $x==8 )
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
								<td>Codigo Nacimiento</td>
								<td class='td'>
									<input type="text" name="CodMos" id='cod' class="caja3" maxlength="2" readonly="">
								</td><td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombres</td>
								<td class='td'>
									<input type="text" name="nomnacmod" onkeypress="ValTexto(this)" class='text1' maxlength="40">
								</td>
							</tr>

							<tr>
								<td>Fecha Nacimiento</td>
								<td class='td'><input type="text" name="fecnacmod" id='date' class="date text4" maxlength="40"></td>
							</tr>

							<tr>
								<td>Sexo</td>
								<td class='td'>
									<select name="sexmod" class="text6">
										<option value="0">Seleccione</option>
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>	
									</select>
								</td>
							</tr>

							<tr>
								<td>Empleado</td>
								<td class='td'>
								<input type="text" name="empmod" class='caja4 text7' id="busqueda9" readonly="" maxlength="5" onkeypress="ValNumero(this)">
								<input type="text" name="nommod" class='caja2' readonly=""></td>
							</tr>

							<tr>
								<td></td><td style='color:rgba(255,0,0,0.8)'>NOTA: (hacer doble click en el 1er. cuadro)</td>
							</tr>

						</table>
						</section>
				</fieldset>
			</section>

				<style type="text/css">
				.container-right .content-general .inferior .content .contenido3 fieldset #list2
				{
					width: 36%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
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
					width: 60%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
				}
				</style>

				<section class='contenido3'>
					<fieldset>
						<legend>Datos del Registro</legend>

						<section id='list2'>
							<section id='imagen'></section>
						</section>

						<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<?php
									$tabla = "tnaci";
									$campo = "codnac";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo Nacimiento</td>
								<td class='td'><input type="text" name"codigo" class="caja3 text2" maxlength="2" readonly="" value=<?php echo $c; ?>>
												<input type="hidden" name="codigofin" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombres</td>
								<td class='td'><input type="text" name="nomnew" onkeypress="ValTexto(this)"  maxlength="40"></td>
							</tr>

							<tr>
								<td>Fecha Nacimiento</td>
								<td class='td'>
								<input type="text" name="fennac" class="date2" id="date2" onkeypress="ValTexto(this)" maxlength="10">
								</td>
							</tr>

							<tr>
								<td>Sexo</td>
								<td class='td'>
									<select name='sexo'>
										<option value="0">Seleccione</option>
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>	
									</select>
								</td>
							</tr>

							<tr>
								<td>Colaborador</td>
								<td class='td'><input type="text" name="codemp" class='caja4' readonly="" id="busqueda10" maxlength="5" onkeypress="ValNumero(this)"><input type="text" name="nomemp" class='caja2' readonly=""></td>
							</tr>

							<tr>
								<td></td><td style='color:rgba(255,0,0,0.8)'>NOTA: (hacer doble click en el 1er. cuadro)</td>
							</tr>
							
							<tr>
								<td colspan="2" rowspan="2">
									<input type="file" name="files2" id="files2" maxlength="70">
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
			$codnac= $_POST['codigofin'];
			$codmod= $_POST['CodMos'];
			$directorio = RUTA.'/themes/images/bebe/fotos/';

			if($codmod != NULL)
			{
				$men=ValModNac($codmod,$_POST['nomnacmod'],$_POST['fecnacmod'],$_POST['sexmod'],$_POST['empmod']);
			}
			else
			{
				mkdir($directorio.$codnac,0777,true);
            	chmod($directorio.$codnac,0777);

				$nombre=funciones::subirImagen($directorio.$codnac."/",'files2');
			    $men=ValRegNac($codnac,$_POST['nomnew'],$_POST['fennac'],$_POST['sexo'],$_POST['codemp'],$nombre);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			$directorio = RUTA.'/themes/images/bebe/fotos/'.$_POST['CodMos']."/";
			foreach(glob($directorio."/*.*") as $archivos_carpeta)  
			{  
			 	unlink($archivos_carpeta); 
			}  
			rmdir($directorio);
			
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliNac($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>