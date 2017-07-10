<article class='container-left'>
	<section class="accordion">
		
		<?php
			$query = "SELECT codpro, pronom FROM permisos INNER JOIN tuser ON usecod = fkusecod INNER JOIN tsubpro ON fksubpro = codspro INNER JOIN programa ON codpro = codprofk WHERE useali = '".$values['usuario']."' GROUP BY 1 order by 1";
			$consul = funciones::listadoReturn($c,$query);
			$ruta=substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], BASE_FOLDER."/")+strlen(BASE_FOLDER."/"));	
			$ruta2= substr($ruta, 6,strlen($ruta)-6);

			while($reg=mysql_fetch_array($consul))
			{	
				if($reg[1] != "REPORTE")
				{
					echo "<h3>$reg[1]</h3>";
					echo "<section>";
					$cadena = "SELECT fksubpro, nomspro,rutaspr FROM permisos INNER JOIN tuser ON usecod=fkusecod INNER JOIN tsubpro ON fksubpro=codspro INNER JOIN programa ON codpro=codprofk WHERE estper='1' AND useali='".$values['usuario']."' and codprofk=$reg[0] order by 2";
					$consul2 = funciones::listadoReturn($c,$cadena);
					while ( $reg2=mysql_fetch_array($consul2)) 
					{
						echo "<article><a class='ruta' id='$reg2[2]' href='$reg2[2]'>$reg2[1]</a></article>";
					}
					echo "</section>";
				}
			}

		?>

	</section>	
</article>



<article class='container-left-2'>
	<section class="accordion">
		
		<?php
			$query = "SELECT codpro, pronom FROM permisos INNER JOIN tuser ON usecod = fkusecod INNER JOIN tsubpro ON fksubpro = codspro INNER JOIN programa ON codpro = codprofk WHERE useali = '".$values['usuario']."' GROUP BY 1 order by 1";
			$consul = funciones::listadoReturn($c,$query);
			$ruta=substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], BASE_FOLDER."/")+strlen(BASE_FOLDER."/"));	
			$ruta2= substr($ruta, 6,strlen($ruta)-6);

			while($reg=mysql_fetch_array($consul))
			{	
				if($reg[1] != "REPORTE")
				{
					echo "<h3>$reg[1]</h3>";
					echo "<section>";
					$cadena = "SELECT fksubpro, nomspro,rutaspr FROM permisos INNER JOIN tuser ON usecod=fkusecod INNER JOIN tsubpro ON fksubpro=codspro INNER JOIN programa ON codpro=codprofk WHERE estper='1' AND useali='".$values['usuario']."' and codprofk=$reg[0] order by 2";
					$consul2 = funciones::listadoReturn($c,$cadena);
					while ( $reg2=mysql_fetch_array($consul2)) 
					{
						echo "<article><a class='ruta' id='$reg2[2]' href='$reg2[2]'>$reg2[1]</a></article>";
					}
					echo "</section>";
				}
			}

		?>

	</section>	
</article>
