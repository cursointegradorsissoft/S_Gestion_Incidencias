<section class='content-general'>
	
	<section class='superior'>
		<form method="post" name="registrar">
		<input type="hidden" name="form" value="2">
		<section class='left' style="width:250px !important">Empresa: MODIFICAR CLAVE</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' name="boton" value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' id='btn1'>
			</section>

		</section>
	</section>

	<section class='medio'>
		
		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' name="boton2" value='Modificar' id="boton2">
		</section>

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
			<section class='deta'>Mis Datos</section><section class='deta2'>Mantenimiento</section>
			<section class='contenido' id="contenido">
				<fieldset>
					<legend>Solo Vista</legend>
						<section class="form">

						<table>					
							<tr>
								<td></td>
								<td>Usuario</td>
								<td><input type='text' name='codigo' readonly="" value=<?php echo $values['usuario']; ?> maxlength="2"></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
								
							<tr>
								<td></td>
								<td>Clave</td>
								<td><input type='password' name='clave' readonly="" value=<?php echo $values['clave']; ?> maxlength="2"></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
						</section>
				</fieldset>
			</section>


			<section class='contenido2'>
				<fieldset>
					<legend>Datos del Registro</legend>
						<section class="form">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td></td>
								<td>Clave</td>
								<td><input type='password' name='clave1' class="cla1" maxlength="20"></td>
								<td><input type="text" class="nivel_seg" value="Seguridad"></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td>Confirmar Clave</td>
								<td><input type='password' name='clave2' class="cla2" onblur="valclave(this)" maxlength="20"></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td></td>
								<td><span class="span"></span></td>
							</tr>

						</table>
						</form>
						</section>
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
			$alias=$values['usuario'];
			$men=ValModUsu2($alias,$_POST['clave1']);
			if($men == "No Agrego" || $men == "No Modifico") { echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	
			echo "<script>visualizar();</script>";
		}
	}
?>