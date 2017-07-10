<section class='content-general'>
	
	<section class='superior'>
	<form method="post" name='registrar' enctype="multipart/form-data">
		<section class='left'>Empresa: NOTICIA</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name='boton' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_noticia" name='boton' value='Excel' id='btn2'>
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
						<th class='th' width="1.5%">&nbsp;</th>
						<th width="5%">C&oacute;digo</th>
						<th width="12%">T&iacute;tutlo</th>
						<th width="65%">Texto</th>
						<th>Imagen</th>
					</table>
				</section>


				<section class='listado-view'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.6%"></th>
						<th width="7.5%"></th>
						<th width="12.2%"></th>
						<th width="66.5%"></th>
						<th></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$des = $_POST['des'];

								if($codigo != NULL && $des == NULL)
								{
									$query = "select * from tnoti where notcod=$codigo group by notcod";
								}
								else if($codigo == NULL && $des != NULL )
								{
									$query = "select * from tnoti where (nottit LIKE '%' '".$des."' '%') group by notcod";
								}
								else
								{
									$query = "select * from tnoti";
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

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td rowspan="3" colspan="2"><img id="img list" class="imagen" style="border:2px solid rgba(239,239,239,1); overflow:hidden;" width="80%" height="90%"></td>
								<td>C&oacute;digo</td><td class='td'><input type="text" class="caja3" id="cod" readonly="" name="MosCod" maxlength="11"></td>
							</tr>
							<tr>
								<td>T&iacute;tulo</td><td class='td'><input type="text" class="text1" name="titmod" onkeypress="ValTexto(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td>Texto</td><td class='td'><textarea rows="10" cols="40" class="text2" name="desmod" onkeypress="ValTexto(this)" ></textarea></td>
							</tr>

							<tr>
								<td colspan="2" rowspan="2">
									<input type="file" name="files" id="files" class="text3" maxlength="70" >
									<input type="submit" name="boton" value="Guarda">
									<input type="submit" name="boton" value="Elimina"><section id="list" style="display:none;"></section>
								</td>
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
						<table cellspacing="0" cellpadding="0" style="float:left;">
							<tr>
								<?php
									$tabla = "tnoti";
									$campo = "notcod";
									$c = funciones::codigo($tabla,$campo);
								?>
								<td>C&oacute;digo</td><td class='td'><input type="text" class="caja3" readonly="" name="codnew" maxlength="11" value=<?php echo $c; ?>></td>
							</tr>
							<tr>
								<td>T&iacute;tulo</td><td class='td'><input type="text" name="titulo" onkeypress="ValTexto(this)" maxlength="100"></td>
							</tr>

							<tr>
								<td>Texto</td><td class='td'><textarea rows="10" name="descrip" cols="40" maxlenght="10000" onkeypress="ValTexto(this)"></textarea></td>
							</tr>

							<tr>
								<td colspan="2" rowspan="2">
									<input type="file" name="files2" id="files2" maxlength="70">
									<input type="submit" name="boton" value="Guardar">
									<input type="submit" name="boton" value="Eliminar">
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
			$codnot= $_POST['codnew'];
			$codmod= $_POST['MosCod'];

			$directorio = RUTA.'/themes/images/news/';

			if($codmod != NULL)
			{
				$nombre=funciones::subirImagen($directorio,'files');
				$newnombre =$nombre;
				$dat= str_replace($nombre, "Y:".$codmod.".jpg", $newnombre);

				$men=validarModificacionNoticia($codmod,($_POST['titmod']),($_POST['desmod']),$dat);
			}
			else
			{
				$nombre=funciones::subirImagen($directorio,'files2');
				$newnombre =$nombre;
				$dat= str_replace($nombre, "Y:".$codnot.".jpg", $newnombre);

			    $men=validarNoticia($codnot,($_POST['titulo']),($_POST['descrip']),$dat);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }

			echo "<script>visualizar();</script>";
		}
		else if( $_POST['boton']== "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codnot = $_POST['MosCod'];
			ValEliNot($codnot);
			
		}
	}
?>