<article class='right-content'>
	<article class='text'>
		Tel&eacute;fonos y contactos
	</article>
	<article  class='title'><?php echo $TITULO['telefonos']; ?></article>
	
	<article class='element'>
		<section class='search'>
			<form method="post">
				<input type="hidden" name="boton" value="telf">
				<input type="text" placeholder="Nombre o apellido" name='dato'>
			</form>
		</section>
		<?php
			if($_POST)
			{
				if($_POST['dato'] != "")
				{
					$query = "SELECT concat_ws(' ',PERNOM,PERAPP), locnom,PERTEL,PERANE,PERTE2,PERTE3 from tpers  inner join tloca  on perloc=loccod where PERFCS IS NULL AND PEREST<>'A'  AND (concat_ws(' ',PERNOM,PERAPP) LIKE '%' '".$_POST['dato']."' '%') or  (PERNOM LIKE '%' '".$_POST['dato']."' '%') AND PEREST<>'A' AND PERFCS IS NULL group by tpers.percod";
					$val = funciones::listadoReturn($c,$query);
					$nro = mysql_num_rows($val);
					$reg_por_pagina = 31;
					@$num_pag=$_GET['num'];

					if(is_numeric($num_pag))$inicio=($num_pag-1)*$reg_por_pagina;
					else $inicio=0;

					$query2 = "SELECT concat_ws(' ',PERNOM,PERAPP), locnom,PERTEL,PERANE,PERTE2,PERTE3 from tpers  inner join tloca  on perloc=loccod where PERFCS IS NULL AND PEREST<>'A'  AND (concat_ws(' ',PERNOM,PERAPP) LIKE '%' '".$_POST['dato']."' '%') or  (PERNOM LIKE '%' '".$_POST['dato']."' '%') AND PERFCS IS NULL AND PEREST<>'A' group by tpers.percod LIMIT $inicio,$reg_por_pagina ";
					$val2=funciones::listadoReturn($c,$query2);

					$cant_paginas=round($nro / $reg_por_pagina);

					if(mysql_num_rows($val2)==0){
						echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
					}
					else
					{
						echo "<form method='post' action=''><table>";
						echo "	<th>NOMBRE</th><th>SEDE</th><th>FIJO</th><th>ANEXO</th><th>CELULAR</th><th>RPM</th>";
						while($reg=mysql_fetch_array($val2))
						{	
							echo "<tr>";
							for($x=0;$x<mysql_num_fields($val2);$x++)
							{
								echo "<td>".$reg[$x]."</td>";
							}
							echo "</tr>";
						}
						echo "</table></form>";
					}
					echo "<section class='pagination'>";
						if($num_pag>1)echo "<a href='telefonos?num='".($num_pag-1)."'><img src='themes/images/previous.png'></a>";
					   	for($i=1;$i<=$cant_paginas;$i++){
					   		if($i==$num_pag) echo $i." ";
							else echo "<a href='telefonos?num=$i'>".$i." "."  "."</a>";
					  	}
					   	if($num_pag<$cant_paginas)echo "<a href='telefonos?num='".($num_pag+1)."'><img src='themes/images/next.png'></a>";
					   	echo "</section>";
				}
				else
				{
					header("location:telefonos");
				}
			}
			else
			{
				$query = "SELECT concat_ws(' ',PERNOM,PERAPP), locnom,PERTEL,PERANE,PERTE2,PERTE3 from tpers inner join tloca on perloc=loccod WHERE PERFCS IS NULL AND PEREST<>'A' group by tpers.pernom";
				$val = funciones::listadoReturn($c,$query);
				$nro = mysql_num_rows($val);
				$reg_por_pagina = 31;
				@$num_pag=$_GET['num'];

				if(is_numeric($num_pag))$inicio=($num_pag-1)*$reg_por_pagina;
				else $inicio=0;

				$query2 = "SELECT concat_ws(',',PERNOM,PERAPP), locnom,PERTEL,PERANE,PERTE2,PERTE3 from tpers  inner join tloca  on perloc=loccod WHERE PERFCS IS NULL AND PEREST<>'A' group by tpers.pernom LIMIT $inicio,$reg_por_pagina  ";
				$val2=funciones::listadoReturn($c,$query2);

				$cant_paginas=round($nro / $reg_por_pagina);

				echo "<form method='post' action=''><table>";
				echo "	<th>NOMBRE</th><th>SEDE</th><th>FIJO</th><th>ANEXO</th><th>CELULAR</th><th>RPM</th>";
				while($reg=mysql_fetch_array($val2))
				{	
					echo "<tr>";
					for($x=0;$x<mysql_num_fields($val2);$x++)
					{
						echo "<td>".$reg[$x]."</td>";
					}
					echo "</tr>";
				}
				echo "</table></form>";

				echo "<section class='pagination'>";
				if($num_pag>1)echo "<a href='telefonos?num='".($num_pag-1)."'><img src='../themes/images/previous.png'></a>";
			   	for($i=1;$i<=$cant_paginas;$i++){
			   		if($i==$num_pag) echo $i." ";
					else echo "<a href='telefonos?num=$i'>".$i." "."  "."</a>";
			  	}
			   	if($num_pag<$cant_paginas)echo "<a href='telefonos?num='".($num_pag+1)."'><img src='../themes/images/next.png'></a>";
			   	echo "</section>";
			}
		?>
		
	</article>
</article>
