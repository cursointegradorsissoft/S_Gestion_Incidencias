<section class='content-general'>
	<section class='superior' >
	<form method="post" name="registrar">
		<section class='left' style='width:50%'>Empresa: SOLICITUD DE PERMISOS JEFATURA</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_permisos_jefe" name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<br/>
	<section class='inferior'>
		<section class='content'>
			<section class='deta' val="1">Consultas</section>
			<section class='deta2' val="0"></section>

			<section class='contenido'>
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
					<section class="form">
						<table style="width:100%;" cellpadding="0" cellspacing="0">
							<tr>
								<td>Estado</td>
								<td>
									<select class="estado">
										<option value="0">--- Seleccione --</option>
										<option value="aprobado">Aprobados</option>
										<option value="cancelado">Cancelados</option>
										<option value="pendiente">Pendientes</option>
									</select>
								</td>

								<td>Por Concepto de</td>
								<td>
									<select class="concepto">
										<option value="0">--- Seleccione --</option>
										<option value="comision">Comisi&oacute;n</option>
										<option value="personal">Personal</option>
									</select>
								</td>

								<td style="text-align:right">Tipo &nbsp;</td>
								<td>
									<select class="tipo">
										<option value="0">--- Seleccione --</option>
										<option value="fecha">Fecha</option>
										<option value="hora">Hora</option>
									</select>								
								</td>

								<td></td>
								<td><input type="button" class="ver_filtro_jef" value="Seleccionar" style="float:right !important"></td>

							</tr>
						</table>
					</section>
				</fieldset>


				<section class='listado-view'>
					<section class="form filtrar_jefatura">
						<table cellpadding="0" cellspacing="0" class="tbody">
							<tbody>
								<tbody>
				                  <th class='th'>&nbsp;</th>
				                  <th>Codigo</th>     <th>Nombres y Apellidos</th>    <th>Area</th>
				                  <th>Salida</th>     <th>Retorno</th>                <th>Total</th>
				                  <th>Asunto</th>     <th>Aprobar</th>                 <th>Cancelar</th>
				                  <th>Ejecutar</th>
				                </tbody>
							</tbody>
						</table>
					</section>
				</section>
			</section>



	</section>
</section>