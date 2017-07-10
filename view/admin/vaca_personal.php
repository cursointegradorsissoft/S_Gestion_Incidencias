<script type="text/javascript">
	$(function(){
		$("#btn4").unbind("click");
		$("#btn5").unbind("click");
		$("#btn6").unbind("click");
		$("#btn7").unbind("click");
		$("#btn8").unbind("click");		
	});
</script>

<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<section class='left' style="width: 55%;">Empresa: MIS VACACIONES</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='submit' name="boton" value='Excel' id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
	
		<!--
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' name="boton" value='A&ntilde;adir' id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name="boton" value='Modificar' id="btn5">
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Eliminar' id='btn6'>
		</section>
		-->

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Guardar' name = "boton" id='btn7'>
		</section>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' name="boton" value='Cancelar' id='btn8'>
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
								<input type="hidden" name="form" value="1">
								<td>A&ntilde;o de Trabajo</td>
								<td>
									<select name="periodo" class="sel_anio">
									<?php
										$consulta="SELECT YEAR(PERFIG) FROM TPERS INNER JOIN TUSER ON PERCOD=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
										$datos = funciones::listadoReturn($c,$consulta);
										while($reg=mysql_fetch_array($datos))
										{
											$_SESSION['anio']=$reg[0];
										}

										for($x=$_SESSION['anio'];$x<=date("Y");$x++)
										{
											echo "<option value='$x'> Periodo ".$x;
										}
									?>
									</select>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
						</section>
				</fieldset>

				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th'>&nbsp;</th>
						<th>Codigo</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th>Total D&iacute;as</th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$periodo = $_POST['periodo'];
		
								$query = "SELECT CODSOL,FECINI,FECFIN,TOTDAY FROM TSOLIC INNER JOIN TUSER ON CODPER=CODUSEPER WHERE USEALI='".$values['usuario']."' ";
								$val = funciones::listadoReturn($c,$query);
								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:left; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}else if($x==1 || $x==2){
              								echo "<td style='text-align:center;''><a href='#?cod=$reg[0]'>".str_replace('-', '/', date(' d-m-Y', strtotime($reg[$x])) )."</a></td>";}
										else
										{
											echo "<td style='text-align:center;''><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
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
			</section>

					</form>

		</section>
	</section>
</section>
