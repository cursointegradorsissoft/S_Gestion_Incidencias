<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: ADMINISTRACION DE MENSAJES - ALERTAS </section>
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
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="7"></td>
								<td>Nombre</td>
								<td><input type='text' onkeypress="ValTexto(this)" name='area' maxlength="20"></td>
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
						<th class='th'>&nbsp;</th><th>Codigo</th><th>Nombre de Alerta</th><th>Descripci&oacute;n</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$nombre = $_POST['area'];
								$query=" SELECT * FROM TALC ";
								if($codigo != NULL && $nombre == NULL)
								{
									$query = $query . " WHERE TALCOD=$codigo GROUP BY TALCOD";
								}
								else if($codigo == NULL && $nombre != NULL)
								{
									$query = $query . " WHERE TALNOM LIKE '%' '".$nombre."' '%' GROUP BY TALCOD";
								}
								else
								{
									$query = $query ;
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
			</section>

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td>Codigo Alerta</td>
									<td class='td'><input type="text" name="talcodmod" id="cod" class="caja3" readonly="" maxlength="2"></td>								
									<td></td><td></td><td></td>
								</tr>
								<td>Nombre Alerta</td>
									<td class='td'>
										<input type="text" name="talnommod" class="buscar_jefe text1">
									</td>
								</tr>
								<tr>
									<td>Descripci&oacute;n</td>
									<td class='td'><input type="text" name="taldesmod" onkeypress="ValTexto(this)" class='text2' maxlength="100"></td>
								</tr>
								<tr>
									<td><input type="button" value="Visualizar" class="ver_correos"></td>
									<td><input type="button" value="Agregar" class="busqueda16"></td>
								</tr>
							</table>
							
							<section class="list_grupo list_correo" style="">
								<table cellpadding="0" cellspacing="0">
									<th class='th'>&nbsp;</th>
									<th>Secuencia</th>
									<th>Correo</th>
								</table>
							</section>
							
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
									$sql ="SELECT SUBSTRING(TALCOD,5,7)+1 FROM TALC ORDER BY 1 DESC LIMIT 1 ";
									$val=funciones::listadoReturn($c,$sql);
									if(mysql_num_rows($val)>0)
									{
										$codig="00".mysql_result($val,0,0);
										$c="ALRT".substr($codig,-3);
									}else{
										$codi="001";
										$c="ALRT".$codi;
									}
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo Alerta</td>
								<td class='td'>
									<input type="text" name"codigo" class="caja2" readonly="" value=<?php echo $c; ?>>
									<input type="hidden" name="talcod" value=<?php echo $c; ?>>
								</td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Nombre Alerta</td>
								<td class='td'>
									<input type="text" name="talnom" maxlength="10" onkeypress="ValTexto(this)" >
								</td>
							</tr>

							<tr>
								<td>Descripci&oacute;n de Grupo</td>
								<td class='td'>
									<input type="text" name="taldes" onkeypress="ValTexto(this)" maxlength="100">
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
			$codnot= $_POST['talcod'];
			$codmod= $_POST['talcodmod'];

			if($codmod != NULL)
			{
				$men=ValModAle($codmod,$_POST['talnommod'],$_POST['taldesmod']);
			}
			else
			{
			    $men=ValRegAle($codnot,$_POST['talnom'],$_POST['taldes']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['talcodmod'];
			ValEliAle($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>