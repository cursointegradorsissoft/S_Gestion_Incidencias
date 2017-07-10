<section class='content-general'>
	
	<section class='superior'>
	<form method="post" name="registrar" enctype='multipart/form-data'>
		<section class='left'>Empresa: ACTIVIDAD</section>
		<section class='right'>
			<a href="admin">
			<section class='acceso' style="background-image: url('../themes/images/salir.png');">
				<input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;Salir' name="boton" id='btn3'>
			</section>
			</a>
			<section class='acceso' style="background-image: url('../themes/images/excel.png');">
				<input type='button' class="exp_actividad"  value='Excel' name="boton" id='btn2'>
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
								<td><input type='text' name='des' onkeypress="ValTexto(this)" maxlength="40"></td>
								<td><input type='submit' name='boton' id="boton" value="Seleccionar"></td>
							</tr>
						</table>
					</section>
				</fieldset>


				<section class='header'>
					<table cellpadding="0" cellspacing="0">
							<th class='th' width="1.2%">&nbsp;</th>
							<th width="6%">Codigo</th>
							<th width="12.6%">Titulo</th>
							<th width="60.3%">Descripci&oacute;n</th>
							<th width="10%">Fecha Actividad</th>
							<th width="15%">Imagenes</th>
					</table>
				</section>
				
				<section class='listado-view'>
				<section class="form">
					<table cellpadding="0" cellspacing="0">
						<th class='th' width="1.58%"></th>
						<th width="7.2%"></th>
						<th width="12.6%"></th>
						<th width="60.4%"></th>
						<th width="10%"></th>
						<th width="18%"></th>

						<?php
						if($_POST)
						{
							if($_POST['boton'] == "Seleccionar")
							{
								$codigo = $_POST['codigo'];
								$des = $_POST['des'];

								if($codigo != NULL && $des == NULL)
								{
									$query = "select * from tacti where actcod=$codigo group by actcod";
								}
								else if($codigo == NULL && $des != NULL )
								{
									$query = "select * from tacti where (actnom LIKE '%' '".$des."' '%') group by actcod";
								}
								else
								{
									$query = "select * from tacti";
								}

								$val = funciones::listadoReturn($c,$query);
								$parametros = "this.href,this.target,'width=450,height=550,top=100,left=230'";

								while($reg=mysql_fetch_array($val))
								{	
									echo "<tr><th class='th'></th>";
									for($x=0;$x<mysql_num_fields($val);$x++)
									{
										if($x==0)
										{ 
											echo "<td style='text-align:right; padding-right:0.5% !important;'><a href='#?cod=$reg[0]'>".$reg[$x]."</a></td>";
										}
										else if($x==3){
											echo "<td><a href='#?cod=$reg[0]'>".date('d-m-Y',strtotime($reg[3]))."</a></td>";
										}
										else
										{
											echo "<td><a href='#?cod=$reg[0]'>".utf8_decode($reg[$x])."</a></td>";
										}
									}
										echo "<th><a href='../modificar/actividad?cod=$reg[0]&&nom=$reg[1]' target='actividad' onclick=window.open($parametros);return false; ><img src='../themes/images/mas.gif' height='20' width='20'/></a></th>";
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
								<td>Titulo</td>
								<td class='td'><input type="text" name="modact" class='text1' onblur="valtitulo(this)" maxlength="40"></td>
							</tr>

							<tr>
								<td>Descripci&oacute;n</td>
								<td class='td'><textarea rows="10" cols="40" class="text2" name="desmod" ></textarea></td>
							</tr>

							<tr>
								<td>Fecha</td>
								<td class='td'><input type="text" name="modfec" class='text3 date2' id="date2"  onkeypress="ValTexto(this)" maxlength="10">
							</tr>

						</table>
					</section>
				</fieldset>
			</section>


			<style type="text/css">
				.container-right .content-general .inferior .content .contenido3 fieldset #list2
				{
					width: 36%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
					overflow: hidden;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen
				{
					width:90%;
					height:80%;
					margin: 0px auto;
					border:1px solid rgba(199,199,199,1);
					overflow: scroll;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset #list2 #imagen img
				{
					width:40%;
					height:40%;
					margin: 2%;
					border:1px solid rgba(199,199,199,1);
					overflow: hidden;
				}

				.container-right .content-general .inferior .content .contenido3 fieldset .form
				{
					width: 60%;
					height: 90%;
					margin: 0px auto;
					margin-top: 2.5%;
					float:left;
				}
			</style>

			<section class='contenido3'>
				<fieldset>
					<legend>Datos del Registro</legend>

						<section id='list2'>
							<section id='imagen'></section>
							<input type='file' id='files2' name='files2[]' multiple>
						</section>

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
									<td class='td'><input type="text" name="codigofin" class="caja3" maxlength="3" readonly="" value=<?php echo $c; ?>></td>
									<td></td><td></td><td></td>
								</tr>
								
								<tr>
									<td>Titulo</td>
									<td class='td'><input type="text" name="descrip" onkeypress="valtitulo(this)" maxlength="40"></td>
								</tr>

								<tr>
									<td>Descripci&oacute;n</td><td class='td'><textarea rows="10" cols="40"  name="desnew"></textarea></td>
								</tr>

								<tr>
									<td>Fecha</td>
									<td class='td'><input type="text" name="fecha" id="date" class="date" placeholder="dd/mm/aaaa" maxlength="10"></td>
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
			$directorio = RUTA.'/themes/images/Actividades/';

			if($codmod != NULL)
			{
				$men=ValModAct($codmod,utf8_encode($_POST['modact']),utf8_encode($_POST['desmod']),$_POST['modfec']);
			}
			else
			{
				$nombre=funciones::subirVariasImagenes($directorio,'files2',$codnot);
				$men=ValRegAct($codnot,utf8_encode($_POST['descrip']),utf8_encode($_POST['desnew']),$_POST['fecha'],$nombre);
			}

			if($men == "No Agrego" || $men == "No Modifico")	{ echo "<script>error('');</script>";
			} else { echo "<script>agrego('');</script>"; }	

			echo "<script>visualizar();</script>";
		}
		else if ($_POST['boton'] == "Eliminar")
		{
			$directorio = RUTA.'/themes/images/Actividades/'.$_POST['CodMos']."/";
			foreach(glob($directorio."/*.*") as $archivos_carpeta)  
			{  
			 	unlink($archivos_carpeta); 
			}  
			rmdir($directorio);
			echo $directorio;
			echo "<script>eliminado('');</script>";
			$codeli = $_POST['CodMos'];
			ValEliAct($codeli);
			ValEliActDet($codeli);
		}
		else if($_POST['boton'] == trim("Excel"))
		{
			header("location:../modificar/area");
		}
	}
?>