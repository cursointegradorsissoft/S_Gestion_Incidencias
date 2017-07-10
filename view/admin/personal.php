<script type="text/javascript">
	$(function(){
		$(".nombre").attr("disabled",false);
		$(".pernom").attr("disabled",false);
	})
</script>	

<section class='content-general'>

	<section class='superior'>
	<form method="post" name="registrar" class="form" enctype="multipart/form-data">
		<section class='left'>Empresa: PERSONAL</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_personal" name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' value='A&ntilde;adir' name="boton" id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' value='Modificar' name="boton" id='btn5'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' value='Eliminar' name="boton" id='btn6'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' value='Guardar' name="boton" id='btn7' class="guardar_cese">
		</section>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' value='Cancelar' name="boton" id='btn8'>
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
								<td>Cod. Persona</td>
								<td><input type='text' name='codigo' class="bus_cod" onkeypress="ValNumero(this)" maxlength="5"></td>
								<td>Nombre</td>
								<td><input type='text' name='nombre' class="bus_nom" onkeypress="ValTexto(this)" maxlength="40"></td>
								<td>Apellido</td>
								<td><input type='text' name='apellido' class="bus_ape" onkeypress="ValTexto(this)" maxlength="40"></td>
								<td><input type='submit' name='boton' class="pers_click" id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>

				<section class='listado-view2'>
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th>
						<th style='text-align:center;'>Codigo</th>
						<th style='text-align:center;'>Nombre</th>
						<th style='text-align:center;'>Ap. Paterno</th>
						<th style='text-align:center;'>Ap. Materno</th>
						<th style='text-align:center;'>E-Mail</th>
						<th style='text-align:center;'>Tel. Oficina</th>
						<th style='text-align:center;'>Anexo</th>
						<th style='text-align:center;'>Tel. Celular</th>
						<th style='text-align:center;'>RPM</th>
						<th style='text-align:center;'>Fecha Ingreso</th>
						<th style='text-align:center;'>Fecha Nacimiento</th>
						<th style='text-align:center;'>Imagen</th>
						<th style='text-align:center;'>Nombre Local</th>
						<th style='text-align:center;'>Nombre Area</th>
						<th style='text-align:center;'>Nombre Sub Area</th>
						<th style='text-align:center;'>Nombre Funcion</th>
						<th style='text-align:center;'>DNI</th>
						<th style='text-align:center;'>Clave</th>
						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo =  $_POST['codigo'];
								$nombre = strtoupper($_POST['nombre']);
								$apellido = strtoupper($_POST['apellido']);

								$cadena = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, PEREMA, PERTEL, PERANE, PERTE2, PERTE3, PERFIG, PERFNA, PERIMG, LOCNOM, ARENOM, SARNOM,FUNNOM, PERDNI, PERLOC, PERARE, PERFUN, PERSRE , PERCLA FROM tpers INNER JOIN tloca on PERLOC=LOCCOD INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TSARE ON SARCOR = PERSRE INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PEREST='' AND PERFCS IS NULL ";

								if( $codigo != "" ){
									$cadena = $cadena . " AND PERCOD=$codigo ";
								}
								
								if( $nombre != "" ){

									$cadena = $cadena . " AND PERNOM LIKE '%". $nombre."%'";
								}
								
								if( $apellido != ""){
									$cadena = $cadena . " AND (PERAPP LIKE '%' '".$apellido."' '%') ";
								}

								$query = $cadena . " group by tpers.percod ";
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
										else if($x>16 && $x<=20)
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

			<style type="text/css">
				
				.container-right .content-general .inferior .content .contenido2 fieldset .form
				{
					width: 100%;
					height: 45%;
					overflow: hidden;
					margin: 0px auto;
					margin-top: 2.5%;
					margin-left:1%;
					float:left;
				}

				
				.container-right .content-general .inferior .content .contenido2 fieldset #list1
				{
					width: 50%;
					height: 40%;
					margin: 0px auto;
					float:left;
					overflow:hidden;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list1 #imagen1
				{
					width:50%;
					height:80%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list1 #imagen1 img
				{
					width:100%;
					height:100%;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list4
				{
					width: 50%;
					height: 40%;
					margin: 0px auto;
					float:left;
					overflow:hidden;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list4 #imagen4
				{
					width:70%;
					height:50%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list1 .input_file
				{
					width:20%;
					height:10%;
					overflow: hidden;
					background: -webkit-linear-gradient(top, #447fb8,#134f8a);
					background: -moz-linear-gradient(top, #447fb8,#134f8a);
					background: -ms-linear-gradient(top, #447fb8,#134f8a);
					background: -o-linear-gradient(top, #447fb8,#134f8a);
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
					text-align: center;
					color:rgba(255,255,255,1);
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list1 .input_file .texto
				{
					width:100%;
					height:100%;
					text-align: center;
					color:rgba(255,255,255,1);
					margin-top: -20px !important;
					cursor: pointer;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list4 .input_file
				{
					width:20%;
					height:10%;
					overflow: hidden;
					background: -webkit-linear-gradient(top, #447fb8,#134f8a);
					background: -moz-linear-gradient(top, #447fb8,#134f8a);
					background: -ms-linear-gradient(top, #447fb8,#134f8a);
					background: -o-linear-gradient(top, #447fb8,#134f8a);
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
					text-align: center;
					color:rgba(255,255,255,1);
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list4 .input_file .texto
				{
					width:100%;
					height:100%;
					text-align: center;
					color:rgba(255,255,255,1);
					margin-top: -20px !important;
					cursor: pointer;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset .input_file input
				{
					background:red; border:red;  opacity: 0;
				}

				.container-right .content-general .inferior .content .contenido2 fieldset #list4 #imagen4 img
				{
					width:100%;
					height:100%;
				}





				.container-right .content-general .inferior .content .contenido3 fieldset .form
				{
					width: 100%;
					height: 45%;
					overflow: hidden;
					margin: 0px auto;
					margin-top: 2.5%;
					margin-left:1%;
					float:left;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2
				{
					width: 50%;
					height: 40%;
					margin: 0px auto;
					float:left;
					overflow:hidden;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen
				{
					width:50%;
					height:80%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen img
				{
					width:100%;
					height:100%;
				}



				.container-right .content-general .inferior .content .contenido3 fieldset #list3
				{
					width: 50%;
					height: 40%;
					margin: 0px auto;
					float:left;
					overflow:hidden;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list3 #imagen3
				{
					width:70%;
					height:50%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 .input_file
				{
					width:20%;
					height:10%;
					overflow: hidden;
					background: -webkit-linear-gradient(top, #447fb8,#134f8a);
					background: -moz-linear-gradient(top, #447fb8,#134f8a);
					background: -ms-linear-gradient(top, #447fb8,#134f8a);
					background: -o-linear-gradient(top, #447fb8,#134f8a);
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
					text-align: center;
					color:rgba(255,255,255,1);
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 .input_file .texto
				{
					width:100%;
					height:100%;
					text-align: center;
					color:rgba(255,255,255,1);
					margin-top: -20px !important;
					cursor: pointer;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list3 .input_file
				{
					width:20%;
					height:10%;
					overflow: hidden;
					background: -webkit-linear-gradient(top, #447fb8,#134f8a);
					background: -moz-linear-gradient(top, #447fb8,#134f8a);
					background: -ms-linear-gradient(top, #447fb8,#134f8a);
					background: -o-linear-gradient(top, #447fb8,#134f8a);
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
					text-align: center;
					color:rgba(255,255,255,1);
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list3 .input_file .texto
				{
					width:100%;
					height:100%;
					text-align: center;
					color:rgba(255,255,255,1);
					margin-top: -20px !important;
					cursor: pointer;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset .input_file input
				{
					background:red; border:red;  opacity: 0;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list3 #imagen3 img
				{
					width:100%;
					height:100%;
				}
			</style>

			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
					<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td>Codigo Persona</td>
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" maxlength="5" readonly="">
								<input type="hidden" name="CodMos" id="cod2" class="caja3" readonly=""></td>

								<td>Cod. Local</td>
								<td class='td'><input type="text" name="codlocmod" class='caja4 busqueda1 text17' title="Doble Click Aqui" readonly="" maxlength="3" onkeypress="ValNumero(this)"><input type="text" name="nomlocmod" class='caja2 text12' readonly=""></td>

								<td>Tel. Oficina</td>
								<td class='td'><input type="text" name="telmod" class="text5" onkeypress="ValNumero(this)" maxlength="10"></td>

							</tr>

							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nomod" class="text1" onkeypress="ValTexto(this)" maxlength="40" ></td>
								
								<td>Cod. Area</td>
								<td class='td'><input type="text" name="codaremod" class="caja4 busqueda3 text18" title="Doble Click Aqui"  readonly=""  maxlength="2" onkeypress="ValNumero(this)"><input type="text" name="nomaremod" class="caja2 text13" readonly=""></td>
								
								<td>Anexo</td>
								<td class='td'><input type="text" name="anemod" class="text6" onkeypress="ValNumero(this)" maxlength="11"></td>
							</tr>

							<tr>
								<td>Ap. Paterno</td>
								<td class='td'><input type="text" name="patmod" class="text2" onkeypress="ValTexto(this)"  maxlength="40"></td>
								
								<td>Cod. Sub Area</td>
								<td class='td'><input type="text" name="codsaremod" class="caja4 busqueda4 text20" title="Doble Click Aqui"  readonly=""  maxlength="2" onkeypress="ValNumero(this)"><input type="text" name="nomsaremod" class="caja2 text14" readonly=""></td>			
								
								<td>Tel. Celular</td>
								<td class='td'><input type="text" name="celmod" class="text7" onkeypress="ValNumero(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Ap. Materno</td>
								<td class='td'><input type="text" name="matmod" class="text3" onkeypress="ValTexto(this)" maxlength="40"></td>
								
								<td>Cod. Funcion</td>
								<td class='td'><input type="text" name="codcarmod" class='caja4 busqueda2 text19' title="Doble Click Aqui"  readonly=""  maxlength="2" onkeypress="ValNumero(this)"><input type="text" name="nomcarmod" class='caja2 text15' readonly=""></td>
							
								<td>RPC / RPM</td>
								<td class='td'><input type="text" name="celmod2" class="text8" onkeypress="ValNumero(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Fecha Ingreso</td>
								<td class='td'><input type="text" class="date5 text9" name="ingmod" id="date5" maxlength="10"></td>

								<td>E-Mail</td>
								<td class='td'><input type="text" name="emamod" class="text4" maxlength="45" onblur="validarEmail(this)"></td>
								
								<td>Fecha Nacimiento</td>
								<td class='td'><input type="text" class="date6 text10" name="nacmod" id="date6" maxlength="10"></td>
							</tr>

							<tr>
								<td>DNI</td>
								<td class='td'><input type="text" name="dnimod" class="text16" maxlength="9" onkeypress="ValNumero(this)"></td>

								<td>Fecha Cese</td>
								<td class='td'><input type="text" class="date text22 modificar_cese" name="finmod" id="date" maxlength="10"></td>

								<td>Clave</td>
								<td class='td'>
								<input type="text" name="clamod" maxlength="10" class="clanewadd text21">
								</td>

							</tr>

						</table>
					</section>

				
					<section id="list1">
						<section id='imagen1'></section>
						<section class="input_file">
							<input type="file" class="file1" name="files1" id="files1">
							<section class="texto">FOTO</section>
						</section>
					</section>

					<section id="list4">
						<section id='imagen4'></section>
						<section class="input_file">
							<input type="file" class="file4" name="files4" id="files4">
							<section class="texto">FIRMA</section>
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
								<td>Codigo Persona</td>
								<?php
									$tabla = "tpers";
									$campo = "PERCOD";
									$c= funciones::codigo($tabla,$campo);
								?>
								<td class='td'><input type="text" class="caja3" readonly="" maxlength="5" value=<?php echo $c; ?> ></td>
												<input type="hidden" class="codnew" name="codnew" value=<?php echo $c; ?> >

								<td>Cod. Local</td>
								<td class='td'><input type="text" name="codloc" tabindex="6"  class='caja4' readonly="" id="busqueda5" title="Doble Click Aqui" maxlength="3" onkeypress="ValNumero(this)"><input type="text" name="nomloc" id="text12" class='caja2' readonly=""></td>
								
								<td>Tel. Oficina</td>
								<td class='td'><input type="text" name="ofinew" tabindex="12"   onkeypress="ValNumero(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Nombre</td>
								<td class='td'><input type="text" name="nomnew" tabindex="1" class="nombre pernom" onkeypress="ValTexto(this)" maxlength="40"></td>

								<td>Cod. Area</td>
								<td class='td'><input type="text" name="codare" tabindex="7" class="caja4" readonly="" id="busqueda7" title="Doble Click Aqui" maxlength="2" onkeypress="ValNumero(this)"><input type="text" name="nomare" id="text13" class="caja2" readonly=""></td>
								
								<td>Anexo</td>
								<td class='td'><input type="text" name="anenew" tabindex="13"  onkeypress="ValNumero(this)" maxlength="11"></td>
							</tr>

							<tr>
								<td>Ap. Paterno</td>
								<td class='td'><input type="text" name="patnew" tabindex="2"  class="correo perapp" onkeypress="ValTexto(this)" maxlength="40"></td>
								
								<td>Cod. Sub Area</td>
								<td class='td'><input type="text" name="codsare"  tabindex="8" class="caja4" readonly="" maxlength="2" title="Doble Click Aqui" id="busqueda8" onkeypress="ValNumero(this)"><input type="text" name="nomsare" id="text14" class="caja2" readonly=""></td>			

								<td>Tel. Celular</td>
								<td class='td'><input type="text" name="telnew" tabindex="14"  onkeypress="ValNumero(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Ap. Materno</td>
								<td class='td'><input type="text" class="perapm" tabindex="3" name="matnew"  onkeypress="ValTexto(this)" maxlength="40"></td>

								<td>Cod. Funcion</td>
								<td class='td'><input type="text" name="codcar" tabindex="9"  class='caja4' readonly="" id="busqueda6" title="Doble Click Aqui" maxlength="2" onkeypress="ValNumero(this)"><input type="text" name="nomcar" id="text15" class='caja2' readonly=""></td>
							
								<td>RPC / RPM</td>
								<td class='td'><input type="text" name="tel2new" tabindex="15" onkeypress="ValNumero(this)" maxlength="10"></td>
							</tr>

							<tr>
								<td>Fecha Ingreso</td>
								<td class='td'><input type="text" tabindex="4" class="date2 perfin" id="date2" name="fecingnew" maxlength="10" onkeypress="ValTexto(this)"></td>
								
								<td>DNI</td>
								<td class='td'><input type="text" name="dninew" tabindex="10"  maxlength="9" class="dni_new" onkeypress="ValNumero(this)"></td>

								<td>Fecha Cese</td>
								<td class='td'><input type="text" tabindex="16" class="date3" id="date3" name="fechacese" class="calendario" maxlength="10" onkeypress="ValTexto(this)"></td>

								<input type="hidden" name="codigofin"><input type="hidden" name="nombrearea">

							</tr>

							<tr>
								<td>Fecha Nacimiento</td>
								<td class='td'><input type="text" class="date4 perfn" tabindex="5" id="date4" name="fecnacnew" maxlength="10" onkeypress="ValTexto(this)"></td>

								<td>E-Mail</td>
								<td class='td'><input type="text" name="emanew" tabindex="11"  class="mail" maxlength="45" onblur="validarEmail(this)"></td>
								
								<td>Clave</td>
								<td class='td'><input type="text" tabindex="17"  name="clanew" maxlength="10" class="clanewadd"></td>
							</tr>

						</table>
						</section>

						<section id='list2'>
							<section id='imagen'></section>
							<section class="input_file">
								<input type="file" class="file2" name="files2" id="files2">
								<section class="texto">FOTO</section>
							</section>
						</section>


						<section id='list3'>
							<section id='imagen3'></section>
							<section class="input_file">
								<input type="file" class="file3" name="files3" id="files3">
								<section class="texto">FIRMA</section>
							</section>
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
			$codemp= $_POST['codnew'];
			$codmod= $_POST['CodMos'];

			$directorio = RUTA.'themes/images/employ/';
			$directorio2 = RUTA.'themes/images/firmas/'; //AÑADIDO PARA FIRMAS

			if($codmod != NULL)
			{	
				$n = $_FILES['files1']['name'];
				$n2 = $_FILES['files4']['name'];

				if($n == "" && $_POST['finmod'] == "" && $n2=="")
				{
					$men=ValModPer($codmod,$_POST['nomod'],$_POST['patmod'],$_POST['matmod'],$_POST['codlocmod'],$_POST['codaremod'],$_POST['codsaremod'],$_POST['emamod'],$_POST['telmod'],$_POST['anemod'],$_POST['celmod'],$_POST['celmod2'],$_POST['codcarmod'],$_POST['ingmod'],$_POST['nacmod'],$_POST['dnimod'],$_POST['finmod'],$_POST["clamod"]);
				}
				else if($_POST['finmod'] != "" && $n == "" && $n2=="")
				{	

					$men=ValModPer4($codmod,$_POST['nomod'],$_POST['patmod'],$_POST['matmod'],$_POST['codlocmod'],$_POST['codaremod'],$_POST['codsaremod'],$_POST['emamod'],$_POST['telmod'],$_POST['anemod'],$_POST['celmod'],$_POST['celmod2'],$_POST['codcarmod'],$_POST['ingmod'],$_POST['nacmod'],$_POST['dnimod'],$_POST['finmod'],$_POST["clamod"]);
					
				}
				else if($_POST['finmod'] == "" && $n == "" && $n2!=""){
					$nombre=funciones::subirImagen($directorio2,'files4');
					$men=ValModPer5($codmod,$_POST['nomod'],$_POST['patmod'],$_POST['matmod'],$_POST['codlocmod'],$_POST['codaremod'],$_POST['codsaremod'],$_POST['emamod'],$_POST['telmod'],$_POST['anemod'],$_POST['celmod'],$_POST['celmod2'],$_POST['codcarmod'],$_POST['ingmod'],$_POST['nacmod'],$nombre,$_POST['dnimod'],$_POST['finmod'],$_POST["clamod"]);
				}else{
					$nombre=funciones::subirImagen($directorio,'files1');
					$men=ValModPer3($codmod,$_POST['nomod'],$_POST['patmod'],$_POST['matmod'],$_POST['codlocmod'],$_POST['codaremod'],$_POST['codsaremod'],$_POST['emamod'],$_POST['telmod'],$_POST['anemod'],$_POST['celmod'],$_POST['celmod2'],$_POST['codcarmod'],$_POST['ingmod'],$_POST['nacmod'],$nombre,$_POST['dnimod'],$_POST['finmod'],$_POST["clamod"]);
				}			
			}
			else
			{	
				$nombre=funciones::subirImagen($directorio,"files2");
				if($_FILES['files3']['tmp_name']==""){
					$men=ValRegPer($codemp,$_POST['nomnew'],$_POST['patnew'],$_POST['matnew'],$_POST['codloc'],$_POST['codare'],$_POST['codsare'],$_POST['emanew'],$_POST['ofinew'],$_POST['anenew'],$_POST['telnew'],$_POST['tel2new'],$_POST['codcar'],$_POST['fecingnew'],$_POST['fecnacnew'],$nombre,$_POST['dninew'],$_POST['fechacese'],"",$_POST["clanew"]);
				}
				else
				{
					$nombre2=funciones::subirImagen($directorio2,'files3');
					$men=ValRegPer($codemp,$_POST['nomnew'],$_POST['patnew'],$_POST['matnew'],$_POST['codloc'],$_POST['codare'],$_POST['codsare'],$_POST['emanew'],$_POST['ofinew'],$_POST['anenew'],$_POST['telnew'],$_POST['tel2new'],$_POST['codcar'],$_POST['fecingnew'],$_POST['fecnacnew'],$nombre,$_POST['dninew'],$_POST['fechacese'],$nombre2,$_POST["clanew"]);
				}
			}

			if($men == "No Agrego" || $men == "No Modifico") { echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			$codper= $_POST['CodMos'];
			ValModPer2($codper);
		}
		else if($_POST['boton'] == trim("Excel"))
		{

			header("location:../login");
		}
	}
?>