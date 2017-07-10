<script type="text/javascript">
	$(function(){
		$("#btn7").unbind("click");
		$("#btn8").unbind("click");	
		$("a").unbind("click");
		$("td a").unbind("click");
	});
</script>

<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left' style="width: 55%;">Empresa: CONSULTA VACACIONES</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' name="boton" value='Excel' class="exporta_data_cons" id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>


		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" disabled="disabled" value='Cancelar' id='btn8'>
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
								<td width="10%"><input type="radio" name="opcion" text="bus_tra" class="opt_fil" value="1">Trabajador</td>
								<td width="10%"><input type="radio" name="opcion" text="bus_pro" class="opt_fil" value="2">Programado</td>
								<td width="10%"><input type="radio" name="opcion" text="bus_acu" class="opt_fil" value="3">Acumulados</td>
								<td width="10%"><input type="radio" name="opcion" text="bus_cum" class="opt_fil" value="4">Cumplir&aacute;n</td>
								<td></td>
								<td><input type='button' name='boton' id="boton" class="boton_mult" value="Seleccionar"></td>
							</tr>
						</table>

						<table>
							<tr class="opt1 optt1">
								<td width="10%">Codigo</td>
								<td><input type='text' name='codigo' class="codbus" onkeypress="ValNumero(this)" maxlength="3"></td>
								<td>Nombres</td>
								<td><input type='text' onkeypress="ValTexto(this)" class="nombus" name='nombres' maxlength="40"></td>
								<td>Apellido</td>
								<td><input type='text' onkeypress="ValTexto(this)" class="apebus" name='apellido' maxlength="40"></td>
							</tr>
						</table>

						<table>
							<tr class="opt2">
								<td width="10%">Area</td>
								<td>
									<select class="opt_area">
										<option value="">---Seleccione---</option>
										<?php
											$query="SELECT * FROM TABGRU ";
											$listado=funciones::listadoReturn($c,$query);
											while($reg=mysql_fetch_array($listado)){
												echo "<option  value='".$reg[0]."'>".$reg[2]."</option>";
											}
										?>
									</select>
								</td>
								<td></td>
								<td>Mes</td>
								<td>
									<select class="opt_mes">
										<option value="">---Seleccione---</option>
										<?php
											for($x=0;$x<12;$x++){
												$mes=funciones::obtener_mes($x);
												echo "<option  value='".$x."'>".$mes."</option>";
											}
										?>
									</select>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>

						<table>
							<tr class="opt3 optt3">
								
								<td>Area</td>
								<td>
									<select class="opt_area2">
										<option value="">---Seleccione---</option>
										<?php
											$query="SELECT * FROM TABGRU ";
											$listado=funciones::listadoReturn($c,$query);
											while($reg=mysql_fetch_array($listado)){
												echo "<option  value='".$reg[0]."'>".$reg[2]."</option>";
											}
										?>
									</select>
								</td>
								<td></td>
								<td width="10%"></td>
								<td>
									<!--
									<select class="opt_anio">
										<option value="">---Seleccione---</option>
										<?php/*
											for($x=2000;$x<date('Y');$x++){
												echo "<option  value='".$x."'>".$x."</option>";
											}*/
										?>
									</select>
									-->
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='listado-view listado_consultas_mul'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
				        <th class='th'>&nbsp;</th>
				        <th>Trabajador</th>
				        <th>Area</th>
				        <th>Fecha Inicio</th>
				        <th>Fecha Fin</th>
				        <th>Periodo</th>
				        <th>Total D&iacute;as</th>
					</table>
				</section>
				</section>
			</section>


		</section>
	</section>
</section>
