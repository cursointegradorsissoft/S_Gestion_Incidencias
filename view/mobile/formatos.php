<article class='right-content'>
	<article class='text'>
		Formatos
	</article>
	<article  class='title'><?php echo $TITULO['formatos']; ?></article>
	
	<article class='element'>
		<?php
			for($x=1;$x<=12;$x++)
			{
				switch ($x) {
					case 1: $men = "FORMATO</br> DE ACCIDENTES PERSONALES"; 
							$ruta = funciones::url("/themes/Formatos/Accidentes del personal/Accidentes Personales.doc"); break;
					case 2: $men = "FORMATO</br> DE AUTOS </br>DEL PERSONAL"; 
							$ruta = funciones::url("/themes/Formatos/Autos del personal/Autos de personal.doc"); break;
					case 3: $men = "FORMATO DE </br> COMISIONES </br> POR ADS"; 
							$ruta = funciones::url("/themes/Formatos/Comisiones por ADS/Comisiones por ADS.docx"); break;
					case 4: $men = "FORMATO DE COMPRA </br>Y BAJA DE ACTIVOS</br> FIJOS";
							$ruta = funciones::url("/themes/Formatos/Compra y baja de activos fijos/Compras y Bajas de Activo fijo.doc"); break;
					case 5: $men = "COPIA </br>DE LIQUIDACI&Oacute;N</br> DE VI&Aacute;TICOS"; 
							$ruta = funciones::url("/themes/Formatos/Formato Liquidacion Viaticos/Copia de Liquidaci&oacute;n de Viaticos.xlsx"); break;
					case 6: $men = "FORMATO DE</br> CR&Eacute;DITOS</br> AL PERSONAL"; 
							$ruta = funciones::url("/themes/Formatos/Creditos al Personal/Creditos al personal.doc"); break;
					case 7: $men = "FICHA DE </br>CONTACTO PARA EMPLEADO"; 
							$ruta = funciones::url("/themes/Formatos/Formato de Contacto para Empleados/Formato-Empleado.pdf"); break;
					case 8: $men = "FORMATO</br> ADS";
							$ruta = funciones::url("/themes/Formatos/Formato de Contacto para ADS/Formato-ADS.pdf"); break;
					case 9: $men = "FORMATO DE</br> RETOMA DE</br> VEH&Iacute;CULOS"; 
							$ruta = funciones::url("/themes/Formatos/Retoma de Vehiculos/Retoma de vehiculos.doc"); break;
					case 10: $men = "FORMATO DE </br>SOLICITUD DE</br> VACACIONES"; 
							$ruta = funciones::url("/themes/Formatos/Formato de Vacaciones/Solicitud-vacaciones.pdf"); break;
					case 11: $men = "TICKETS AEREOS</br> Y ALOJAMIENTOS"; 
							$ruta = funciones::url("/themes/Formatos/Tickets Aereos y Alojamiento/Tickets areos y alojamiento.doc"); break;
					case 12: $men = "VI&Aacute;TICOS DEL </br>PERSONAL"; 
							$ruta = funciones::url("/themes/Formatos/Viaticos del Personal/Viaticos del personal.doc"); break;
				}

				echo "<article class='opt1'>
						<article class='image'>
							<article class='circle'>
								<article class='circle-interno'>
									<a href='$ruta' target='blank'>
										<img src='".funciones::url("/themes/images/opt".$x.".png")."'>
									</a>
								</article>
							</article>
						</article>
						<article class='descrip'>
							$men
						</article>
					</article>";
			}
		?>			
	</article>
</article>
