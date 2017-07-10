<?php
	header("Content-type: aplication/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=noticia.xls");

	echo "<section class='noticia'>";
	$codigo = $_REQUEST['cod'];
	$query = "select * from tnoti where notcod='$codigo'";
	$consul=funciones::listadoReturn($c,$query);
	echo "<form method='post'>";
		echo "<table>";
		echo "<th colspan=2>Modificar Noticia</th>";
		while ($reg = mysql_fetch_array($consul)) {
			echo "<tr><td>Titulo</td><td><input type='text' name='titulo' value='$reg[1]'></td></tr>";
			echo "<tr><td>Descripcion</td><td><textarea name='desc' rows='8' cols='25'>$reg[2]</textarea></td></tr>";
			echo "<tr><td>Imagen</td><td class='td'><img src=".funciones::url("/themes/images/news/".$reg[0].".jpg")."></td></tr>";
		}
			echo "<tr><td colspan=2><input type='submit' name='boton' value='Modificar'></td></tr>";
		echo "</table>";
	echo "</form>";
	echo "</section>";

	if($_POST)
	{
		if($_POST['boton'] == 'Modificar')
		{
			validarModificacionNoticia($codigo,$_POST['titulo'],$_POST['desc']);
			echo "<script>window.close()</script>";
		}
	}

?>