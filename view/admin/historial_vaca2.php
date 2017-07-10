<section class='content-general'>
	
	<section class='superior'>
	<form method="post" name="registrar" enctype='multipart/form-data'>
		<section class='left'>Empresa: HISTORIAL DE VACACIONES GENERALES</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' name="boton" id='btn3'>
			</section>
			</a>
			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_history_vaca"  value='Excel' name="boton" id='btn2'>
			</section>
			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' name="boton" id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);?> >
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' value='Cancelar' name="boton" id='btn8'>
		</section>
		</a>
	</section>

	<section class='inferior'>
		<section class='content'>
			<section class='deta'>Consulta</section><section class='deta2'></section>
			<section class='contenido'>
				<fieldset>
					<legend>Criterio de Selecci&oacute;n</legend>
					<section class="form">
						<table>
							<tr>
								<input type="hidden" name="form" value="1">
								<td>Area</td>
								<td>
									<select class="area">
									  <?php
									    $query = " SELECT '0' AS CODGRU, '--- SELECCIONE---' AS DESGRU FROM TABGRU LIMIT 0,1
									               UNION ALL 
									               SELECT CODGRU, DESGRU FROM TABGRU ";
									    $sql = funciones::listadoReturn($c,$query);
									    while($fec=mysql_fetch_array($sql))
									    { 
									        echo "<option value='$fec[0]'>".$fec[1];
									    }
									  ?>  
									</select>
								</td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>

				<section class='dgantt' id="contenedor" style='overflow:hidden !important; '>
				</section>

				<script language="javascript" src=<?php echo funciones::url("/themes/jquery/admin/funciones_gant.js");?> ></script>

			</section>

		</section>
	</section>
</section>