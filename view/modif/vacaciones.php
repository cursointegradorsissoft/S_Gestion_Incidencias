<script type="text/javascript">
	function datos(cod,nom,ape,coda,noma,codc,nomc){

		window.opener.document.registrar.codemp.value = cod;
		window.opener.document.registrar.nomemp.value = nom;
		window.opener.document.registrar.apeemp.value = ape;
		window.opener.document.registrar.codare.value = coda;
		window.opener.document.registrar.nomare.value = noma;
		window.opener.document.registrar.codcar.value = codc;
		window.opener.document.registrar.nomcar.value = nomc;		

		window.opener.document.registrar.codempmod.value = cod;
		window.opener.document.registrar.nomempmod.value = nom;
		window.opener.document.registrar.apeempmod.value = ape;
		window.opener.document.registrar.codaremod.value = coda;
		window.opener.document.registrar.nomaremod.value = noma;
		window.opener.document.registrar.codcarmod.value = codc;
		window.opener.document.registrar.nomcarmod.value = nomc;	

		window.opener.$("#bloque").fadeOut();
	}
</script>

<?php
	echo "<section class='personal'>";

	echo "<section class='search'>
			<form method='post'>
				<input type='text' placeholder='Nombre o apellido' name='dato'>
			</form>
		</section>";
	
	if($_POST)
	{
		if($_POST['dato'] != NULL)
		{
			$cadena = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, ARECOD, ARENOM,FUNCOD, FUNNOM, DATEDIFF(curdate(),perfig) FROM tpers INNER JOIN TAREA ON PERARE=ARECOD  INNER JOIN TFUNC ON FUNCOD=PERFUN ";
			$query2 = "$cadena WHERE  PERFCS IS NULL AND PEREST<>'A' AND (concat_ws(' ',PERNOM,PERAPP) LIKE '%' '".$_POST['dato']."' '%') or  (PERNOM LIKE '%' '".$_POST['dato']."' '%') group by tpers.percod ";
			$consul=funciones::listadoReturn($c,$query2);

			if(mysql_num_rows($consul)==0){
				echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
			}
			else
			{
				echo "<form method='post' action=''><table cellpadding='0' cellspacing='0'>";
				echo "<th>Codigo</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>";
				while ($reg = mysql_fetch_array($consul)) {
					if($reg[8]>100){ //CONSIDERANDO SOLO MINIMO
						$codigo=$reg[0];
						$nombre=$reg[1];
						$apellido=$reg[2];
						$arecod=$reg[4];
						$arenom=$reg[5];
						$carcod=$reg[6];
						$carnom=$reg[7];

						$codigo=str_replace(" ", "&nbsp;", $codigo);
						$nombre=str_replace(" ", "&nbsp;", $nombre);
						$apellido=str_replace(" ", "&nbsp;", $apellido);
						$arecod=str_replace(" ", "&nbsp;", $arecod);
						$arenom=str_replace(" ", "&nbsp;", $arenom);
						$carcod=str_replace(" ", "&nbsp;", $carcod);
						$carnom=str_replace(" ", "&nbsp;", $carnom);

						echo "<tr OnClick=datos('$codigo','$nombre','$apellido','$arecod','$arenom','$carcod','$carnom') >";
						for($x=0;$x<4;$x++)
						{
							echo "<td class='codtot'>$reg[$x]</td>";
						}
						echo "</tr>";
					}
					
				}
				echo "</table></form></section>";
				echo "<section class='pagination_employ'>&nbsp;</section>";
			}
		}
		else
		{
			header("location:vacaciones");
		}
	}
	else
	{
		$query = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, ARECOD, ARENOM,FUNCOD, FUNNOM,DATEDIFF(curdate(),perfig) FROM tpers INNER JOIN TAREA ON PERARE=ARECOD  INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PERFCS IS NULL AND PEREST<>'A' GROUP BY PERCOD";
		$val = funciones::listadoReturn($c,$query);
		$nro = mysql_num_rows($val);
		$reg_por_pagina = 22;
		@$num_pag=$_GET['num'];

		if(is_numeric($num_pag))$inicio=($num_pag-1)*$reg_por_pagina;
		else $inicio=0;

		$query2 = "SELECT PERCOD, PERNOM, PERAPP, PERAPM, ARECOD, ARENOM,FUNCOD, FUNNOM,DATEDIFF(curdate(),perfig) FROM tpers INNER JOIN TAREA ON PERARE=ARECOD  INNER JOIN TFUNC ON FUNCOD=PERFUN WHERE PERFCS IS NULL AND PEREST<>'A' GROUP BY PERCOD LIMIT $inicio,$reg_por_pagina  ";
		$val2=funciones::listadoReturn($c,$query2);

		$cant_paginas=round($nro / $reg_por_pagina);

		echo "<form method='post' action=''><table cellpadding='0' cellspacing='0'>";
		echo "<th>Codigo</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>";
		while ($reg = mysql_fetch_array($val2)) {
			if($reg[8]>364){
				$codigo   =  $reg[0];
				$nombre   =  $reg[1];
				$apellido =  $reg[2];
				$arecod   =  $reg[4];
				$arenom   =  $reg[5];
				$carcod   =  $reg[6];
				$carnom   =  $reg[7];

				$codigo=str_replace(" ", "&nbsp;", $codigo);
				$nombre=str_replace(" ", "&nbsp;", $nombre);
				$apellido=str_replace(" ", "&nbsp;", $apellido);
				$arecod=str_replace(" ", "&nbsp;", $arecod);
				$arenom=str_replace(" ", "&nbsp;", $arenom);
				$carcod=str_replace(" ", "&nbsp;", $carcod);
				$carnom=str_replace(" ", "&nbsp;", $carnom);

				echo "<tr OnClick=datos('$codigo','$nombre','$apellido','$arecod','$arenom','$carcod','$carnom') >";
				for($x=0;$x<4;$x++)
				{
					echo "<td class='codtot'>$reg[$x]</td>";
				}
				echo "</tr>";
			}
		}
		echo "</table></form>";

		echo "<section class='pagination_employ'>";
		   	$url="vacaciones";
			funciones::paginacion($url,$num_pag,$cant_paginas);
	   	echo "</section>";
	}
	echo "</section>";
?>