<?php
	
	ob_clean();
	ob_start();
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Vacaciones_Programadas.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

    $data = $_POST['data'];
	$data = substr($data,strpos($data,",")+1);
	$data = base64_decode($data);
	$file = 'themes/images/historial/historial.png';
	file_put_contents($file, $data);

	$valores="bgcolor='orange' align='center' style='color:white;BORDER: #efefef 1px solid; '";
	$table = $_POST['datos_a_enviar'];

	$tabla1 = str_replace('<img src="../themes/jquery/gant/icons/filter.png" onclick="filtrado_scroll1(&quot;nombres&quot;)">', "", $table);
	$tabla2 = str_replace('<img src="../themes/jquery/gant/icons/filter.png" onclick="filtrado_scroll1(&quot;total&quot;)">', "", $tabla1);
	$tabla3 = str_replace('<img src="../themes/jquery/gant/icons/filter.png" onclick="filtrado_scroll1(&quot;inicio&quot;)">', "", $tabla2);
	$tabla4 = str_replace('<img src="../themes/jquery/gant/icons/filter.png" onclick="filtrado_scroll1(&quot;fin&quot;)">', "", $tabla3);

	echo "<table>
			<tr>
				<td>
				 	$tabla4
				</td>
				<td>
					<img src='".RUTA.$file."' style='width:10px !important; height:10px !important;' >
				</td>
			</tr>
		  </table>";

?>