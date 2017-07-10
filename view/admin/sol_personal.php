<section class='content-general'>
	<section class='superior' >
	<form method="post" name="registrar">
		<section class='left' style='width:50%'>Empresa: SOLICITUD DE PERMISOS PERSONAL</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_permisos_personal" name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<br/>
	<section class='inferior'>
		<section class='content'>
			<section class='deta pest_comi' val="1">Por Comisiones</section>
			<section class='deta2 pest_pers' val="0">Por Asuntos Personales</section>

			<section class='contenido'>
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
					<section class="form">
						<table>
							<tr>
								<td>Seleccione una opci&oacute;n</td>
								<td><input type="radio" name="tipo_tem" value="fecha" class="tipo_tem">Fechas</td>
								<td><input type="radio" name="tipo_tem" value="horas" class="tipo_tem">Horas</td>
								<td></td>
								<td> <input type="button" class="ver_filtro" value="Filtrar"></td>
								<td></td>
							</tr>
						</table>
						</section>
				</fieldset>


				<section class='listado-view'>
					<section class="form filtrar_vigilancia">
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