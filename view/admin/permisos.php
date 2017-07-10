
<section class='content-general'>
	
	<section class='superior'>
	<form method="post" name="registrar">
		<section class='left'>Empresa: PERMISOS</section>
		<section class='right'>

			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' name="boton" id='btn3'>
			</section>
			</a>

			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='submit' value='Excel' name="boton" id='btn2'>
			</section>

			<section class='acceso' style="background-image: url('../themes/images/imprimir.png');">
				<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir' name="boton" id='btn1'>
			</section>
		</section>
	</section>

	<section class='medio'>
		<section class='boton' style="background-image: url('../themes/images/mas.gif');">
			<input type='button' value='A&ntilde;adir' name="boton" id='btn4'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/modificar.png'); background-size: 25% 40%;">
			<input type='button' value='Modificar' name="boton" id='btn5'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/eliminar.png'); background-size: 25% 40%;">
			<input type='submit' value='Eliminar' name="boton" id='btn6'>
		</section>

		<section class='boton' style="background-image: url('../themes/images/guardar.png'); background-size: 25% 40%;">
			<input type='submit' value='Guardar' name="boton" id='btn7'>
		</section>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='boton' style="background-image: url('../themes/images/salir.png'); background-size: 25% 40%;">
			<input type='submit' value='Cancelar' name="boton" id='btn8'>
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
								<td><input type='text' name='codigo' onkeypress="ValNumero(this)" maxlength="3"></td>
								<td>Descripci&oacute;n</td>
								<td><input type='text' name='usuario' onkeypress="ValTexto(this)" maxlength="40"></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="2.5%">&nbsp;</th>
							<th width="11.3%">Codigo</th>
							<th width="44.3%">Usuario</th>
							<th width="21.7%">Total de Permisos</th>
							<th>Agregar/Quitar</th>
					</table>
				</section>

				<section class='listado-view3'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="2.6%"></th>
						<th width="11.5%"></th>
						<th width="45.1%"></th>
						<th width="22.3%"></th>
						<th></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$user = $_POST['usuario'];

								$cadena = "select usecod,useali,count(codspro) from permisos inner join tuser on usecod=fkusecod inner join tsubpro on fksubpro=codspro inner join programa on codpro=codprofk";
								$cadena2 ="UNION ALL SELECT USECOD,USEALI,'0' FROM TUSER WHERE usecod not in (select fkusecod from permisos)";
								if($codigo != NULL && $user == NULL)
								{
									$query = "$cadena where estper='1' and usecod=$codigo group by usecod";
								}
								else if($codigo == NULL && $user != NULL )
								{
									$query = "$cadena where estper='1' and  (useali LIKE '%' '".$user."' '%') group by usecod";
								}
								else
								{
									$query = "$cadena where estper='1' group by usecod $cadena2";
								}

								$val = funciones::listadoReturn($c,$query);
								$parametros = "this.href,this.target,'width=450,height=500,top=100,left=230'";

								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else
										{
											echo "<td><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
									}
										echo "<td><a href='../modificar/permisos?cod=$reg[0]' target='permisos' onclick=window.open($parametros);return false; ><img src='../themes/images/mas.gif' height='20' width='20'/></a></td>";
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
								<td class='td'><input type="text" name="CodMos" id="cod" class="caja3" readonly="" maxlength="3"></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="modact" id='text1' class="busqueda14" onkeypress="ValTexto(this)" maxlength="40"></td>
							</tr>

							<tr>
								<td>Fecha</td>
								<td class='td'><input type="date" name="modfec" id='text2' onkeypress="ValTexto(this)" maxlength="10"></td>
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
							<tr>
							<?php
									$tabla = "tacti";
									$campo = "actcod";
									$c = funciones::codigo($tabla,$campo);
								?>
								<input type="hidden" name="form" value="2">
								<td>Codigo</td>
								<td class='td'><input type="text" name"codigofin" id='text6' class="caja3" maxlength="3" readonly="" value=<?php echo $c; ?>></td>
								<td></td><td></td><td></td>
							</tr>
							
							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><input type="text" name="descrip" id='text4' onkeypress="ValTexto(this)" maxlength="40"></td>
							</tr>

							<tr>
								<td>Fecha</td>
								<td class='td'><input type="date" name="fecha" id='text5' onkeypress="ValTexto(this)" maxlength="10"></td>
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
			$codnot= $_POST['codigofin'];
			$codmod= $_POST['CodMos'];

			if($codmod != NULL)
			{
				$men=ValModAct($codmod,$_POST['modact'],$_POST['modfec']);

				var_dump($_SESSION['permitir']);
			}
			else
			{
			    $men=ValRegAct($codnot,$_POST['descrip'],$_POST['fecha']);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliAct($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>