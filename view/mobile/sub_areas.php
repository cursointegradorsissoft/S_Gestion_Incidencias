<article class='right-content'>
	<article class='text'>
		&Aacute;rea > <?php echo $_REQUEST['nom']; $_SESSION['nom']=$_REQUEST['nom']; ?>
	</article>
	<article  class='title-subarea'>Sub-&Aacute;reas</article>
	
	<article class='element'>

		<?php
			$query = "select * from tsare where SARCOD='".$_REQUEST['cod']."' ";
			$val=funciones::listadoReturn($c,$query);
			$_SESSION['cod']=$_REQUEST['cod'];

			$gerente=$_SESSION['cod'];

			echo "<section class='listado-sub'>";
				echo "<section class='sub-area'>";
					echo "<section  class='title'>Sub-&Aacute;reas</section>";
					echo "<section class='table'><form method='POST'><table>";
				while($reg=mysql_fetch_array($val))
				{	
				    echo "<td><input type='button' name='boton' class='botones' value='$reg[1]"."-"."$reg[2]'></td>";
				}
					echo "</table></form></section>";
				echo "</section>";

				switch ($gerente) {
					case 1:	 	$x=9; 	$y=2;	break;
					case 4:	 	$x=9; 	$y=3;	break;
					case 12: 	$x=9; 	$y=3;	break;
					case 3: 	$x=9; 	$y=4;	break;
					case 6: 	$x=9; 	$y=5;	break;
					case 13: 	$x=9; 	$y=5;	break;
					default: 	$x=$gerente; 	$y=1;	break;
				}

				$consulta = "SELECT PERCOD,concat_ws(' ',PERNOM, PERAPP,PERAPM), PEREMA, PERANE,FUNNOM,PERTE2,PERTEL,PERIMG 
				from tfunc inner join tpers on PERFUN=FUNCOD inner join tsare on PERSRE=SARCOR INNER JOIN TAREA 
				on SARCOD=ARECOD WHERE PEREST<>'A' AND PERFCS IS NULL AND  PERARE='$x' and SARCOR='$y' GROUP BY 1";

				$val2=funciones::listadoReturn($c,$consulta);
				if($x==0 && $y==0){ $clase ='display:none'; }else{ $clase='overflow:hidden; height:8%';}
				echo "<section class='vista_employ_area' id='template' style='$clase'>";
				while ($fil=mysql_fetch_array($val2))
				{
					echo "<section class='emp_deta' style='height:100%'>";
						echo "<section class='imagen'>
								<section class='circle'>
									<img src='".funciones::url("/themes/images/employ/$fil[7]")."'>
								</section>
							</section>";
						echo "<section class='descrip'><table>";
							echo "<th>CARGO</th><th>TEL&Eacute;FONO</th>";
							echo "<tr><td>$fil[4]</td><td>$fil[6]</td></tr>";
							echo "<th>NOMBRE</th><th>ANEXO</th>";
							echo "<tr><td>$fil[1]</td><td>$fil[3]</td></tr>";
							echo "<th>CORREO</th><th>CELULAR</th>";
							echo "<tr><td>$fil[2]</td><td>$fil[5]</td></tr>";
						echo "</table></section>";
					echo "</section>";
				}
				echo "</section>";
					
				if($_POST)
				{
					if(isset($_POST['boton']))
					{
						$codigo=$_REQUEST['cod'];
						$nombre=$_REQUEST['nom'];
						header("location:subarea3?cod=$codigo&&nom=$nombre");
					}
					
				}

			echo "</section>";
		?>
		
	</article>
</article>
