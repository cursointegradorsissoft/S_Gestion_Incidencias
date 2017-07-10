<section class="slider">
	<div id="slider2_container" style="position: relative; width: 800px; height: 688px; overflow: hidden;">
        <div u="slides" class="slider2_container_inter" style="cursor: move; width: 800px; height: 688px; overflow: hidden; ">
            <?php
            	$query = "select * from tacti order by actfec desc limit 0,5";
            	$val =  funciones::listadoReturn($c,$query);
            	while ($fil=mysql_fetch_array($val)) {
            		echo "<div>";
	            		echo "<img src='".funciones::url("/themes/images/Actividades/$fil[0]/$fil[4]")."' style='width:100%; height:100%;'/>";
	            		echo "<div u='thumb'></br>";
	            		echo "<section style='font-size:13px; height:65%;  overflow:hidden; color:rgba(0,0,0,0.7);font-family:Roboto-Regular;'>";
	            		//echo utf8_decode($fil[2]);
	            		echo "</section>";
	            		//echo "<a href='actividades'><input type='submit' name='ver'value='Ver Detalle'></a>";
	            		echo "</div>";
	            	echo "</div>";
            	}
            ?>
        </div>

        <div u="thumbnavigator" class="slider2-T" style="width:340px;  height:400px; margin-left:150;">
            <div style="position: absolute; display: block; width:100%; height:100%;">
            </div>
            <div u="slides">
                <div u="prototype" style="width: 300px; height: 330px; font-family:'Roboto-BlackItalic'; text-align:justify; font-size:25px;">
                    <thumbnailtemplate style="width: 100%; height: 100%;   color:rgba(0,51,102,1);"></thumbnailtemplate>
                </div>
            </div>
        </div>

        <div u="navigator" class="jssorb01" style=" -moz-transform: rotate(270deg);  ">
            <div u="prototype" style=" WIDTH: 10px;background:rgba(255,255,255,1); border:2px solid rgba(0,51,102,1); height: 20px; width:20px; margin-left:-100px; margin-top:80px; border-radius:100%; "></div>
        </div>
    </div>
</section>

<section class="introduccion">
	<section class='titulo_des'>
		INTRODUCCI&Oacute;N
	</section>
	<section class='deta'>
		<?php echo $EMPRESA['intro']; ?>
	</section>
</section>

<section class="personal">
	
	<section class="cumpleaos">
		<?php
			$query="SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP),FUNNOM,PERCUM,PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) AND DAY(PERFNA)=DAY(CURDATE()) AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM DESC";
			$val = funciones::listadoReturn($c,$query);
			if(mysql_num_rows($val) > 0)
			{
				while($reg=mysql_fetch_array($val))
				{	
					echo "<a href='cumpleaos'>";
					echo "<section class='containerSlider' id='containerSlider' >";
						echo "<section class='img'>";
							echo "<section class='texto'>";
								echo "Colaborador de cumplea&ntilde;os";
							echo "</section>";
							echo "<section class='logo'>";
								echo "<img src='".funciones::url("/themes/images/cumple.png")."'>";
							echo "</section>";
						echo "</section>";
						echo "<section class='data'>";
						echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[4]")."'></section>";
						echo "<section class='descrip'><span>$reg[1]</span></br>$reg[2]</section>";
						echo "</section>";
					echo "</section>";
					echo "</a>";
				}
			}
			else
			{
				$fecha = funciones::fecha();
				if($fecha['inicio']>$fecha['fin'])
				{
					$query2 = "SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP),FUNNOM,PERCUM,PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) AND DAY(CURDATE())<>DAY(PERFNA) AND PEREST='' AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM desc";
				}
				else
				{
					$query2 = "SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP),FUNNOM,PERCUM,PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) AND DAY(PERFNA) BETWEEN ".$fecha['inicio']." AND ".$fecha['fin']."  AND PEREST<>'A' AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM DESC";
				}

				$val2=funciones::listadoReturn($c,$query2);
				if(mysql_num_rows($val2)>0){
					while($reg=mysql_fetch_array($val2))
					{	
						echo "<a href='cumpleaos'>";
						echo "<section class='containerSlider' id='containerSlider' >";
							echo "<section class='img'>";
								echo "<section class='texto'>";
									echo "Colaborador de cumplea&ntilde;os";
								echo "</section>";
								echo "<section class='logo'>";
									echo "<img src='".funciones::url("/themes/images/cumple.png")."'>";
								echo "</section>";
							echo "</section>";
							echo "<section class='data'>";
							echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[4]")."'></section>";
							echo "<section class='descrip'><span>$reg[1]</span></br>$reg[2]</section>";
							echo "</section>";
						echo "</section>";
						echo "</a>";
					}
				}
				else
				{
					$query2 = "SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP),FUNNOM,PERCUM,PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD where MONTH(PERFNA)= MONTH(CURDATE()) AND DAY(CURDATE())<>DAY(PERFNA) AND PEREST='' AND PERFCS IS NULL GROUP BY 1 ORDER BY PERCUM desc";

					$val2=funciones::listadoReturn($c,$query2);
					while($reg=mysql_fetch_array($val2))
					{	
						echo "<a href='cumpleaos'>";
						echo "<section class='containerSlider' id='containerSlider' >";
							echo "<section class='img'>";
								echo "<section class='texto'>";
									echo "Colaborador de cumplea&ntilde;os";
								echo "</section>";
								echo "<section class='logo'>";
									echo "<img src='".funciones::url("/themes/images/cumple.png")."'>";
								echo "</section>";
							echo "</section>";
							echo "<section class='data'>";
							echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[4]")."'></section>";
							echo "<section class='descrip'><span>$reg[1]</span></br>$reg[2]</section>";
							echo "</section>";
						echo "</section>";
						echo "</a>";
					}
				}
			}
		?>
	</section>

	<section class="nuevos">
		<?php
			$query="SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP),FUNNOM,PERFIG,PERIMG from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOD WHERE YEAR(PERFIG) = YEAR(CURDATE()) and MONTH(CURDATE()) = MONTH(PERFIG) AND PERFCS IS NULL GROUP  BY 1 ORDER BY PERFIG ASC ";
			$val = funciones::listadoReturn($c,$query);
			if(mysql_num_rows($val) ==0)
			{
				echo "<section class='containerSlider2'>";
					echo "<section class='img'>";
						echo "<section class='texto'>";
							echo "El nuevo ingreso";
						echo "</section>";
						echo "<section class='logo'>";
							echo "<img src='".funciones::url("/themes/images/nuevo.png")."'>";
						echo "</section>";
					echo "</section>";
					echo "<section class='data'>";
					echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/162.png")."'></section>";
					echo "<section class='descrip'><span>&nbsp;</span></br>&nbsp;</section>";
					echo "</section>";
				echo "</section>";
			}
			else
			{
				while($reg=mysql_fetch_array($val))
				{	
					echo "<a href='ingresos'>";
					echo "<section class='containerSlider2' id='containerSlider2'>";
						echo "<section class='img'>";
							echo "<section class='texto'>";
								echo "El nuevo ingreso";
							echo "</section>";
							echo "<section class='logo'>";
								echo "<img src='".funciones::url("/themes/images/nuevo.png")."'>";
							echo "</section>";
						echo "</section>";
						echo "<section class='data'>";
						echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/$reg[4]")."'></section>";
						echo "<section class='descrip'><span>$reg[1]</span></br>$reg[2]</section>";
						echo "</section>";
					echo "</section>";
					echo "</a>";
				}
			}
			?>
	</section>

	<section class="nacimientos">
		<?php
			$query="select * from tnaci order by 5 desc";
			$val = funciones::listadoReturn($c,$query);
			if(mysql_num_rows($val) ==0)
			{
				echo "<section class='containerSlider3'>";
					echo "<section class='img'>";
						echo "<section class='texto'>";
							echo "Nacimientos";
						echo "</section>";
						echo "<section class='logo'>";
							echo "<img src='".funciones::url("/themes/images/nacimiento.png")."'>";
						echo "</section>";
					echo "</section>";
					echo "<section class='data'>";
					echo "<section class='photo'><img src='".funciones::url("/themes/images/employ/162.png")."'></section>";
					echo "<section class='descrip'><span>&nbsp;</span></br>&nbsp;</section>";
					echo "</section>";
				echo "</section>";
			}
			else
			{
				while($reg=mysql_fetch_array($val))
				{	
					echo "<a href='mensual'>";
					echo "<section class='containerSlider3' id='containerSlider3'>";
						echo "<section class='img'>";
							echo "<section class='texto'>";
								echo "Nacimientos";
							echo "</section>";
							echo "<section class='logo'>";
								echo "<img src='".funciones::url("/themes/images/nacimiento.png")."'>";
							echo "</section>";
						echo "</section>";
						echo "<section class='data'>";
						echo "<section class='photo'><img src='".funciones::url("/themes/images/bebe/fotos/$reg[0]/$reg[8]")."'></section>";
						echo "<section class='descrip'><span>$reg[1]</span></br>$reg[4]</section>";
						echo "</section>";
					echo "</section>";
					echo "</a>";
				}
			}
		?>
	</section>

</section>

<section class="accesos_directos">
	<section class='atajos1' style="background-image: url('<?php echo funciones::url('/themes/images/atj1.png');?>');">
		<a href="vacaciones">
			<section class='atj-opt'>
				<section class="texto">
					<section class="span">CRONOGRAMA</br>DE VACACIONES</section>
				</section>
			</section>
		</a>
	</section>
	<section class='atajos1' style="background-image: url('<?php echo funciones::url('/themes/images/atj2.png');?>');">
		<a href="comedor">
			<section class='atj-opt2'>	
				<section class="texto">
					<section class="span">REVISA EL MEN&Uacute;</br>DE LA SEMANA</section>
				</section>
			</section>
		</a>
	</section>
	<section class='atajos1' style="background-image: url('<?php echo funciones::url('/themes/images/atj3.png');?>');">
		<a href="telefonos">
			<section class='atj-opt3'>
				<section class="texto">
					<section class="span">&nbsp;&nbsp;TELEFONOS  </br>DE PERSONAL</section>
				</section>
			</section>
		</a>
	</section>
	<section class='atajos1' style="background-image: url('<?php echo funciones::url('/themes/images/atj6.jpg');?>');">
		<a href="novedades">
			<section class='atj-opt4'>	
				<section class="texto">
					<section class="span">EVENTOS </br>& </br>NOVEDADES</section>
				</section>
			</section>
		</a>
	</section>
</section>
