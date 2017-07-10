<article class='right-content'>
	<article class='text'>
		Comedor
	</article>
	<article  class='title'>
		<?php echo $TITULO['comedor']; ?>
		<p>Del <?php $fecha=funciones::fecha(); echo $fecha['semana2']; ?></p>
	</article>
	
	<article class='element'>
		<section class='content'>
			<?php
				$query = "select * from talmu";
				$cons= funciones::listadoReturn($c,$query);
				$fecha = funciones::fecha();
				$y=1;

				echo "<table>";
				for($w=1; $w<mysql_num_fields($cons)-1;$w++)
				{
					mb_strtoupper($fecha['dia']) == mb_strtoupper(mysql_field_name($cons, $w))?$diaName="th":$diaName="";
					echo "<th class=$diaName>".mb_strtoupper(mysql_field_name($cons, $w))."</th>";
				}
				echo "</table>";

				while ($reg = mysql_fetch_array($cons)) 
				{
					$clase='text';
					$mensaje="";
					switch ($y) {
						case 1:$mensaje="Entrada"; break;
						case 3:$mensaje="Plato de Fondo"; $clase="textright"; break;
						case 6:$mensaje="Postre"; break;
						case 8:$mensaje="Bebida"; $clase="textright"; break;
					}
					echo "<table><tr>";
					if($y==1){
						echo "<section class='img'><img src='".funciones::url("/themes/images/1.png")."'><section class='$clase'>$mensaje</section></section>";
					}else if($y==3){
						echo "<section class='img'><img src='".funciones::url("/themes/images/3.png")."'><section class='$clase'>$mensaje</section></section>";
					}else if($y==6){
						echo "<section class='img'><img src='".funciones::url("/themes/images/5.png")."'><section class='$clase'>$mensaje</section></section>";
					}else if($y==8){
						echo "<section class='img'><img src='".funciones::url("/themes/images/7.png")."'><section class='$clase'>$mensaje</section></section>";
					}else if($y==10){
						echo "<section class='img2'>Porci&oacute;n</section>";
					}

					for($x=1; $x<mysql_num_fields($cons)-1;$x++)
					{
						mb_strtoupper($fecha['dia']) == mb_strtoupper(mysql_field_name($cons, $x))?$dia="clase-dia":$dia="";
						echo "<td class=$dia>".utf8_decode($reg[$x])."</td>";
					}
					$y++;
					echo "</tr></table>";
				}
			?>
		</section>

		<section class='mensaje'>
			Buen Provecho!!!
		</section>
	</article>
</article>
