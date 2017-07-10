<?php
	header("Content-type: aplication/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=cambio.xls");

	echo "<section class='tipo_cambio'>";
	$fecha = $_REQUEST['cod'];
	$query = "select * from ttica where MONFEC='$fecha'";
	$consul=funciones::listadoReturn($c,$query);
	echo "<form method='post'>";
		echo "<table>";
		echo "<th colspan=2>Modificar Tipo de Cambio</th>";
		while ($reg = mysql_fetch_array($consul)) {
			echo "<tr><td>Compra</td><td><input type='text' name='compra' value='$reg[2]'></td></tr>";
			echo "<tr><td>Centa</td><td><input type='text' name='venta' value='$reg[3]'></td></tr>";
		}
			echo "<tr><td colspan=2><input type='submit' name='boton' value='Modificar'></td></tr>";
		echo "</table>";
	echo "</echo>";
	echo "</section>";

	if($_POST)
	{
		if($_POST['boton'] == 'Modificar')
		{
			validarModificacion($fecha,$_POST['compra'],$_POST['venta']);
			echo "<script>window.close()</script>";
		}
	}

?>