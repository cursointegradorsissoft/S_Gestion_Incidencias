<article class='right-content'>
	<article class='text'>
		Eventos
	</article>
	<?php $fecha=funciones::fecha(); ?>
	<article  class='title'>
		 <?php 
			 $mes=date('m');
			 echo "<img src='".funciones::url("/themes/images/previous.png")."' width='15px' height='15px' style='cursor:pointer' class='retroceder' title='$mes'></img>";
			 echo "<text>".$TITULO['cumpleaos']. " de ".$fecha['mes']."</text>";
			 echo "<img src='".funciones::url("/themes/images/next.png")."' width='15px' height='15px' style='cursor:pointer' class='avanzar' title='$mes'></img>";
		 ?>
	</article>
	
	<article class='element'>
		
		<section class='banner-birthday'>
			<img src=<?php echo funciones::url("/themes/images/birthday2.png"); ?> >
		</section>

		<section class='lista-birthday'>
			<?php

				$query="SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP,PERAPM),FUNNOM,PERCUM, DAY(PERFNA),year(CURDATE())-year(PERFNA),PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) and DAY(PERFNA)=DAY(CURDATE()) AND PEREST='' AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM desc";
				$val = funciones::listadoReturn($c,$query);
				while($reg=mysql_fetch_array($val))
				{						
					echo "<a href='mensaje?cod=$reg[0]&&nom=$reg[1]'>";
						echo "<section class='detalle2'>";
						echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[6]")."'></section>";
						echo "<section class='descrip'>";
						echo "<form><table><tr>El $reg[3]</br>es cumplea&ntilde;os de:</br>";
						echo "<span>$reg[1]</span></br>$reg[2]</br><span></span></br></table></form></section>";
						echo "</section>";
						
					echo "</a>";		
				}

				$query2="SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP,PERAPM),FUNNOM,PERCUM, DAY(PERFNA),year(CURDATE())-year(PERFNA),PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) AND DAY(CURDATE())<>DAY(PERFNA) AND PEREST='' AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM desc";
				$val2 = funciones::listadoReturn($c,$query2);

				while($reg=mysql_fetch_array($val2))
				{
					echo "<section class='detalle'>";
					echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[6]")."'></section>";
					echo "<section class='descrip'>";
					echo "<form><table><tr>El $reg[3]</br>es cumplea&ntilde;os de:</br>";
					echo "<span>$reg[1]</span></br>$reg[2]</br><span></span></br></table></form></section>";
					echo "</section>";	
				}
				
			?>
		</section>
	</article>
</article>
