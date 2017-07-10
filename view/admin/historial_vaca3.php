  <section class='content-general'>
	
	<section class='superior'>
		<form action="../modificar/envio_excel" method="post" target="_blank" id="FormularioExportacion">
			<section class='left'>Empresa: VACACIONES PROGRAMADAS</section>
			<section class='right'>
				<a href="admin">
				<section class='acceso' style="background-image: url('../themes/images/salir.png');">
					<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' name="boton" id='btn3'>
				</section>
				</a>
				<section class='acceso' style="background-image: url('../themes/images/excel.png');">
					<input type='button' class="exp_gant_excel"  value='Excel' name="boton" id='btn2'>
				</section>
				<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
					<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' name="boton" id='btn1'>
				</section>
			</section>

			<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
		</form>
	</section>

	<section class='medio'>
		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
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
								<td>Area<?php echo date("Y-m-d"); ?></td>
								<td>
									<select class="area2">
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

				<section class='dgantt' id="contenedor2" style='overflow:hidden !important; '>
				</section>
				<script language="javascript" src=<?php echo funciones::url("/themes/jquery/admin/funciones_gant.js");?> ></script>

				<article class="leyenda" style="width:98%; height:5%; margin:0px auto; overflow:hidden; padding:5px; ">
					IMPORTANTE: &nbsp;
					<span style="background:#045FB4; opacity:0.8; padding:1px 8px 1px 8px ;"></span>&nbsp;  En Curso &nbsp;&nbsp;&nbsp;
					<span style="background:#FF4000; opacity:0.8; padding:1px 8px 1px 8px ;"></span> &nbsp; Programadas
				</article>
				
			</section>
		</section>
	</section>
</section>
