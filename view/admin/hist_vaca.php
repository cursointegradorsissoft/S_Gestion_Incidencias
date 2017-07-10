<section class='content-general'>
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left'>Empresa: HISTORIAL DE VACACIONES</section>
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
								<td><label class="habilitar_ch">Habilitar Campos</label></td>
								<td>
									<input type="checkbox" name="vehicle" class="val_check">
								</td>

								<td>Fecha Inicio</td>
								<td><input type="text" name="fecini" maxlength="10" id="date" class="date fecini"></td>
								
								<td>Fecha Fin</td>
								<td><input type="text" name="fecfin" maxlength="10" id="date2" class="date2 fecfin"></td>
							</tr>

							<tr>
								<input type="hidden" name="form" value="1">
								<td>C&oacute;digo</td>
								<td><input type='text' name='codigo' class="codigo" onkeypress="ValNumero(this)" maxlength="5"></td>
								<td>Nombre</td>
								<td><input type='text' name='nombre' class="nombre" onkeypress="ValTexto(this)" maxlength="40"></td>
								<td>Apellido</td>
								<td><input type='text' name='apellido' class="apellido" onkeypress="ValTexto(this)" maxlength="40"></td>
								<td><input type='button' name='boton' id="boton" class="bus_history" value="Seleccionar"></td>
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
				<section class="form" id="list_history">
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
									<input type="text" name="fecinimod" class="text6" onkeypress="ValTexto(this)" maxlength="10">
								</td>
							</tr>

							<tr>
								<td>F. Fin</td>
								<td class='td'>
									<input type="text" name="fecfinmod" class="text7" onkeypress="ValTexto(this)" maxlength="10">
								</td>
							</tr>

							<tr>
								<td>Dias</td>
								<td class='td'>
									<input type="text" name="diasmod" class='caja4 seteo_caja text8' readonly="" onkeypress="ValTexto(this)" maxlength="3">
								</td>
							</tr>

						</table>
						</section>
				</fieldset>
			</section>

			<section class='contenido3'>
			</section>

		</section>
	</section>
</section>
