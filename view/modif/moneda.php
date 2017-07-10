<?php
	header("Content-type: aplication/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=moneda.xls");

	echo "<section class='tipo_cambio'>";
	$codigo = $_REQUEST['cod'];
	$query = "select * from tmone where moncod='$codigo'";
	$consul=funciones::listadoReturn($c,$query);
	echo "<form method='post'>";
		echo "<table>";
		echo "<th colspan=2>Modificar Moneda</th>";
		while ($reg = mysql_fetch_array($consul)) {
			echo "<tr><td>Compra</td><td><input type='text' name='nombre' value='$reg[1]'></td></tr>";
		}
			echo "<tr><td colspan=2><input type='submit' name='boton' value='Modificar'></td></tr>";
		echo "</table>";
	echo "</echo>";
	echo "</section>";

	if($_POST)
	{
		if($_POST['boton'] == 'Modificar')
		{
			ValModMone($codigo,$_POST['nombre']);
			echo "<script>window.close()</script>";
		}
	}

?>