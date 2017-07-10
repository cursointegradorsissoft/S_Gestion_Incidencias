<section class='content-general'>
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: VACACIONES</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_vacaciones" name="boton" value='Excel' id='btn2'>
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
			<input type='button' name="boton" class="modificar_vacaciones" value='Modificar' id="btn5">
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" value='Eliminar' class="eliminar_vacaciones">
		</section>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" class="save_mod" value='Guardar'  name = "boton" id='btn7'>
		</section>
		<!-- CALSE VALIDAR SE HA QUITADO -->

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
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="5"></td>
								<td>Nombre</td>
								<td><input type='text' name='nombre' onkeypress="ValTexto(this)" maxlength="40"></td>
								<td>Apellido</td>
								<td><input type='text' name='apellido' onkeypress="ValTexto(this)" maxlength="40"></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='header'>
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.2%">&nbsp;</th>
						<th width="6%">C&oacute;digo</th>
						<th width="11%">Nombre</th>
						<th width="12%">Apellido</th>
						<th width="10.3%">Planilla</th>
						<th width="11.5%">Area</th>
						<th width="20%">Cargo</th>
						<th width="9%">F. Inicio</th>
						<th width="8%">F. FIn</th>
						<th width="7.9%">D&iacute;as</th>
					</table>
				</section>
				
				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.2%"></th>
						<th width="6%"></th>
						<th width="11%"></th>
						<th width="12%"></th>
						<th width="10.3%"></th>
						<th width="11.5%"></th>
						<th width="20%"></th>
						<th width="9%"></th>
						<th width="8%"></th>
						<th width="5%"></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$nombre = $_POST['nombre'];
								$apellido = $_POST['apellido'];
								$fecha=date("Y-m-d");
								$cadena = "SELECT PERCOD,PERNOM, PERAPP, 'BRAILLARD', ARENOM, FUNNOM, FECINI, FECFIN, TOTDAY, ARECOD, FUNCOD,CODSOL FROM TPERS INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN TFUNC ON FUNCOD=PERFUN INNER JOIN TSOLIC on CODPER=PERCOD WHERE STATUS='RA' AND PEREST<>'A' AND PERFCS IS NULL AND FECINI>='$fecha' ";
								
								if($codigo != NULL && $nombre == NULL && $apellido == NULL)
								{
									$query = " $cadena AND CODSOL=$codigo   ";
								}
								else if($codigo == NULL && $nombre != NULL && $apellido == NULL)
								{
									$query = "$cadena AND (PERNOM LIKE '%' '".$nombre."' '%') ";
								}
								else if($codigo == NULL && $nombre == NULL && $apellido != NULL)
								{
									$query = "$cadena AND (PERAPP LIKE '%' '".$apellido."' '%') ";
								}
								else 
								{
									$query = "$cadena GROUP BY CODSOL ORDER BY CODSOL ASC ";
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
										else if($x==9 || $x == 10)
										{
											echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else if($x==6 || $x==7)
										{
											echo "<td><a href='#?cod=$reg[0]'>".date('d-m-Y',strtotime($reg[$x]))."</a></td>";
										}
										else if($x==11)
										{
											echo "<td style='display:none;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else
										{
											echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										echo "<input class='$reg[0]' type='hidden' value='$reg[11]' >";
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
								<td class='td'>
									<input type="text" name="codempmod" class='caja4 seteo_caja' readonly="" id="cod" onkeypress="ValNumero(this)" maxlength="5">
									<input type="text" name="nomempmod"  class='caja2 text1' readonly="" style="width:70%" maxlength="40"></td>
								<td class='td'><input type="text" name="apeempmod"  class='caja2 text2' readonly="" style="width:100%" maxlength="40"></td>
								<td></td><td></td>
							</tr>

							<tr>
								<td>Planilla</td>
								<td class='td'>
									<select id="text3">
										<option value=""></option>
										<option value="BRAILLARD">BRAILLARD</option>
										<option value="GPAE">GPAE</option>
									</select>
								</td>
							</tr>

							<tr>
								<td>Area</td>
								<td class='td'>
									<input type="text" name="codaremod" class='caja4 seteo_caja text9' readonly="" onkeypress="ValNumero(this)" maxlength="2">
									<input type="text" name="nomaremod" class='caja2 text4' readonly="" style="width:70%" maxlength="40">
								</td>
							</tr>

							<tr>
								<td>Cargo</td>
								<td class='td'>
									<input type="text" name="codcarmod" class='caja4 seteo_caja text10' readonly="" onkeypress="ValNumero(this)" maxlength="3">
									<input type="text" name="nomcarmod" class='caja2 text5' readonly="" style="width:70%" maxlength="40">
								</td>
							</tr>

							<tr>
								<td>F. Inicio</td>
								<td class='td'>
									<input type="text" name="fecinimod" class="date text6 fecini" id="date" onkeypress="ValTexto(this)" maxlength="10">
								</td>
							</tr>

							<tr>
								<td>F. Fin</td>
								<td class='td'>
									<input type="text" name="fecfinmod" class="date2 text7 fecfin " id="date2" onkeypress="ValTexto(this)" maxlength="10">
								</td>
							</tr>

							<tr>
								<td>Dias</td>
								<td class='td'>
									<input type="text" name="diasmod" class='caja4 seteo_caja text8 totday totamod' readonly="" onkeypress="ValTexto(this)" maxlength="3">
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

							<!--
							<tr>
								<td>Buscar Solicitud Vacaciones</td>
								<td><input type='button' name='buscar' value='Buscar Solicitud' class='sol_vac'> </td>
							</tr>
							-->

							<tr>
								<td>Cod. Personal</td>
								<td class='td'>
									<input type="text" name="codemp" class='caja4 seteo_caja percod' readonly="" id="busqueda11" onkeypress="ValNumero(this)" maxlength="5">
									<input type="text" name="nomemp" id="text12" class='caja2' readonly="" style="width:72%" maxlength="40"></td>
								<td class='td'><input type="text" name="apeemp" id="text13" class='caja2' readonly="" style="width:100%" maxlength="40"></td>
								<td></td><td></td>
							</tr>
							<tr>
								<td>Planilla</td>
								<td class='td'><select  name="planilla">
												<option value=""></option>
												<option value="BRAILLARD">BRAILLARD</option>
												<option value="GEPAE">GEPAE</option>
												</select>
								</td>
							</tr>

							<tr>
								<td>Area</td>
								<td class='td'>
									<input type="text" name="codare" class='caja4 seteo_caja' id="text15" readonly="" onkeypress="ValNumero(this)" maxlength="2">
									<input type="text" name="nomare" id="text16" class='caja2' readonly="" style="width:72%" maxlength="40">
								</td>
							</tr>

							<tr>
								<td>Cargo</td>
								<td class='td'>
									<input type="text" name="codcar" class='caja4 seteo_caja' id="text17" readonly="" onkeypress="ValNumero(this)" maxlength="3">
									<input type="text" name="nomcar" id="text18" class='caja2' readonly="" style="width:72%" maxlength="40">
								</td>
							</tr>

							<tr>
								<td>F. Inicio</td>
								<td class='td'>
									<input type="text" name="fecini" class="date3 inifec"  id="date3" maxlength="10">
								</td>
							</tr>
							
							<tr>
								<td>F. Fin</td>
								<td class='td'>
									<input type="text" name="fecfin" class="date4 finfec" id="date4"  maxlength="10">
								</td>
							</tr>

							<tr>
								<td>Dias</td>
								<td class='td'>
									<input type="text" name="dias" id="totdias" class='caja4 seteo_caja totday totdias2' readonly="" onblur="rangodias()" maxlength="2">
								</td>
							</tr>

							<tr>
								<td>Total Acumulados</td>
								<td class='td'>
									<input type="text" class='caja4 seteo_caja totacu' readonly="" maxlength="2">
									<input type="hidden" class='totlab'>
									<input type="hidden" class='totnla' >
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
			// OBTENER CODIGO CORRELATIVO
			$param=date('y').date('m');
			$sql ="SELECT CODSOL+1 FROM TSOLIC WHERE SUBSTRING(CODSOL,1,4)=$param ORDER BY CODSOL DESC LIMIT 1 ";
			$val=funciones::listadoReturn($c,$sql);
			if(mysql_num_rows($val)>0)
			{
				$codigo=mysql_result($val, 0,0);
			}else{
				$codi="0001";
				$codigo=$param.$codi;
			}
			$men  = ValRegSolJef2($codigo,$_POST['codemp'],$_POST['fecini'],$_POST['fecfin'],$_POST['dias'], date("Y"));

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }

			echo "<script>visualizar();</script>";	
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['codempmod'];
			ValEliVac($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>