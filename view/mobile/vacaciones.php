<article class='right-content'>
	<article class='text'>
		Novedades > Personas en vacaciones
	</article>
	
	<article class='element'>
		<section class='banner'> 
		</section>
		<section class="pag-din">
			<?php
				$fecha=funciones::fecha();
				$mes=date('m');
			 	echo "<img src='".funciones::url("/themes/images/previous.png")."' class='img_retro' title='$mes'></img>";
				echo "<section class='title-pad' style='float:left; padding-top:1.5%'>Programaci&oacute;n de Vacaciones : ".$fecha['mes']."</section>";
				echo "<img src='".funciones::url("/themes/images/next.png")."' class='img_avan' style='float:left' title='$mes'></img>";
			?>
		</section>
		<?php
			echo "<section class='listado'>";
				echo "<section class='vista_employ'>";
				$query3 = "SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP,PERAPM), PEREMA, FUNNOM, PERTE2, PERTE3, 
				FECINI, DATE_ADD(FECFIN, INTERVAL 1 DAY), PERIMG FROM TSOLIC ,TPERS ,TAREA,TFUNC WHERE 
				CODPER = percod AND PERARE = arecod AND PERFUN = funcod AND curdate() BETWEEN FECINI AND 
				FECFIN AND STATUS='RA' ORDER BY FECINI";

				$val3=funciones::listadoReturn($c,$query3);
				while ($fil=mysql_fetch_array($val3))
				{
					echo "<section class='emp_deta'>";
						echo "<section class='imagen'>
								<section class='circle'>
									<img src='".funciones::url("/themes/images/employ/$fil[8]")."'>
								</section>
							</section>";
						echo "<section class='descrip'><table>";
							echo "<th>CARGO</th><th>CELULAR</th>";
							echo "<tr><td>$fil[3]</td><td>$fil[4]/$fil[5]</td></tr>";
							echo "<th>NOMBRE</th><th>FECHA DE SALIDA</th>";
							echo "<tr><td>$fil[1]</td><td>$fil[6]</td></tr>";
							echo "<th>CORREO</th><th>FECHA DE INGRESO</th>";
							echo "<tr><td>$fil[2]</td><td>$fil[7]</td></tr>";
						echo "</table></section>";
					echo "</section>";
				}
				echo "</section>";
			echo "</section>";
		?>
		<section class='opciones'>
			<input type="button" value="Consultar Vacaciones" class="consulta">
			<input type="button" value="Generar Vacaciones" class="generar">				 
		</section>
	</article>
</article>



<!-- BLOQUE RESPUESTA DE AVISO -->
<section class="popud_aviso">
	<section class="mensaje">
		<section class="header">Informe de Sistema</section>
		<section class="accion">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td>Solicitud Enviada Correctamente.<br>Estaremos en Contacto</td>
				</tr>
				<tr>
					<td><input type="button" value="Cerrar" class="cerrar_all"></td>
				</tr>
			</table>
			<span class="mensaje_gen"></span>		
		</section>
	</section>
</section>

<!-- BLOQUE DE CONSULTA -->
<section class="popud_consul">
	<section class="mensaje">
		<section class="header">Consultar Vacaciones</section>
		<section class="accion">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td>N&deg; Documento</td>
					<td><input type="text" maxlength="8" class="dcto"></td>
					<td><input type="button" value="Buscar" class="consultar_trabajador"></td>
				</tr>
			</table>
			<span class="mensaje_con"></span>				
		</section>
	</section>
</section>

<section class="consul_vaca">
	<section class="contenedor">
		<section class="header">
			Consulta de Vacaciones
		</section>
		<section class="body">
		</section>
		<section class="footer">
			<input type="button" value="Salir" class="close_consulta">
		</section>
	</section>
</section>

<!-- BLOQUE DE REGISTRO -->
<section class="popud_genera">
	<section class="mensaje">
		<section class="header">Generar Vacaciones</section>
		<section class="accion">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td>N&deg; Documento</td>
					<td><input type="text" maxlength="8" class="dni"></td>
					<td><input type="button" value="Buscar" class="consultar_dni"></td>
				</tr>
			</table>
			<span class="mensaje_gen"></span>		
		</section>
	</section>
</section>

<section class="genera_vaca">
	<section class="contenedor">
		<section class="header">
			Solicitud de Vacaciones
		</section>
		<section class="body">
			<fieldset>
				<section class="limpiar">

				</section>
				<section class='detalle'>
					 <table>
						 <tr>
							<td>Fecha Inicio</td><td><input id="date" maxlength="10" class='date'></td>
						 </tr>
						 <tr>
							<td>Total D&iacute;as</td>
							<td>
							 	<input type='radio' name='dias' class='radio' value='7' text='15'>7
								<input type='radio' name='dias' class='radio' value='15' text='15'>15
								<input type='radio' name='dias' class='radio' value='30' text='15'>30
							</td>
						 </tr>
						 <tr>
							<td>Periodo</td>
							<td>
							 	<select class='periodo' name='periodo'>
								<option value='2014'>2014</option>
								</select>
							</td>
						 </tr>
						 <tr>
							<td>Fecha Fin</td>
							<td><input type='text' readonly="true" class='fin'></td>
						 </tr>
					 </table>
				</section>
			 </fieldset>
		</section>
		<section class="footer">
			<input type="button" value="Guardar" class="guardar">
			<input type="button" value="Salir" class="close_genera">
		</section>
	</section>
</section>

</article>