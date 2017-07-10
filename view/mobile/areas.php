<article class='right-content'>
	<article class='text'>
		<?php echo $TITULO['areas']; ?>
	</article>
	<article  class='title'>Nuestras &Aacute;reas</article>
	
	<article class='element'>

		<?php
			$query = "select ARECOD,ARENOM from tarea";
			$val=funciones::listadoReturn($c,$query);
			
			echo "<section class='listado-area'>";
			while($reg=mysql_fetch_array($val))
			{
				for($x=1;$x<mysql_num_fields($val);$x++)
				{
					if( $reg[0]==4 )
					{
						echo "<section class='area'>";
						echo "<a href='areas2?cod=1'><img src='".funciones::url("/themes/images/areas/$reg[0].png")."'></a></br>";
						echo "COMERCIAL";
						echo "</section>";
					}
					else if( $reg[0]==13 )
					{
						echo "<section class='area'>";
						echo "<a href='areas2?cod=2'><img src='".funciones::url("/themes/images/areas/$reg[0].png")."'></a></br>";
						echo "POSTVENTA";
						echo "</section>";
					}
					else if( ($reg[0]>=1 && $reg[0]<=3) || ($reg[0]==5) || ($reg[0]>=7 && $reg[0]<=10) )
					{
						echo "<section class='area'>";
						echo "<a href='sub_areas?cod=$reg[0]&&nom=$reg[1]'><img src='".funciones::url("/themes/images/areas/$reg[0].png")."'></a></br>";
						echo utf8_decode($reg[$x]);
						echo "</section>";
					}
				}
			}
			echo "</section>";
		?>
		
	</article>
</article>