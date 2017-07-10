<script type="text/javascript">

	function datos(cod,nom,ape,are,sub,codcar,nomcar,ini,fin,tot){
		window.opener.$("#busqueda11").val(cod); //CODIGO EMPLEADO
		window.opener.$("#text12").val(nom); // NOBRE EMPLEADO
		window.opener.$("#text13").val(ape); // APELLIDO EMPLEADO
		window.opener.$("#text15").val(are); // CODIGO DE AREA
		window.opener.$("#text16").val(sub); // NOMBRE AREA
		window.opener.$("#text17").val(codcar); // CODIGO CARGO
		window.opener.$("#text18").val(nomcar); // NOMBRE CARGO
		window.opener.$("#text19").val(ini); // FECHA INICIAL
		window.opener.$("#text20").val(fin); // FECHA FINAL
		window.opener.$("#totdias").html(tot); // CANTIDAD DIAS
		window.opener.$("#bloque").fadeOut();
		window.close();
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
			$query2 = "SELECT CODPER,PERNOM,PERAPP,ARECOD,ARENOM,FUNCOD,FUNNOM,DATE_FORMAT(FECINI,'%d/%m/%Y'), 
		DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC INNER JOIN TPERS ON PERCOD=CODPER 
		INNER JOIN TUSER ON CODUSEPER=PERCOD 	INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
		TSARE ON PERSRE=SARCOR INNER JOIN TFUNC ON PERFUN=FUNCOD  WHERE STATUS='RA' AND PERFCS IS NULL AND PEREST='' GROUP BY 1  ";

			$consul=funciones::listadoReturn($c,$query2);

			if(mysql_num_rows($consul)==0){
				echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
			}
			else
			{
				echo "<form method='post' action=''><table cellpadding='0' cellspacing='0'>";
				echo "<th>Codigo</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>";
				while ($reg = mysql_fetch_array($consul)) {
					$codigo=str_replace(" ", "&nbsp;", $reg[0]);
					$nombre=str_replace(" ", "&nbsp;", $reg[1]);
					$apellido=str_replace(" ", "&nbsp;", $reg[2]);
					$area=str_replace(" ", "&nbsp;", $reg[3]);
					$subarea=str_replace(" ", "&nbsp;", $reg[4]);

					$codcar=str_replace(" ", "&nbsp;", $reg[5]);
					$nomcar=str_replace(" ", "&nbsp;", $reg[6]);

					$inicio=str_replace(" ", "&nbsp;", $reg[7]);
					$fin=str_replace(" ", "&nbsp;", $reg[8]);
					$total=str_replace(" ", "&nbsp;", $reg[9]);

					echo "<tr OnClick=datos('$codigo','$nombre','$apellido','$area','$subarea','$codcar','$nomcar','$inicio','$fin','$total') >";
					for($x=0;$x<4;$x++)
					{
						echo "<td>$reg[$x]</td>";
					}
					echo "</tr>";
				}
				echo "</table></form></section>";
				echo "<section class='pagination_employ'>&nbsp;</section>";
			}
		}
		else
		{
			header("location:personal");
		}
	}
	else
	{
		$query = "SELECT CODPER,PERNOM,PERAPP,ARECOD,ARENOM,FUNCOD,FUNNOM,DATE_FORMAT(FECINI,'%d/%m/%Y'), 
		DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC INNER JOIN TPERS ON PERCOD=CODPER 
		INNER JOIN TUSER ON CODUSEPER=PERCOD 	INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
		TSARE ON PERSRE=SARCOR INNER JOIN TFUNC ON PERFUN=FUNCOD  WHERE STATUS='RA' AND PERFCS IS NULL AND PEREST='' GROUP BY 1  ";

		$val = funciones::listadoReturn($c,$query);
		$nro = mysql_num_rows($val);
		$reg_por_pagina = 22;
		@$num_pag=$_GET['num'];

		if(is_numeric($num_pag))$inicio=($num_pag-1)*$reg_por_pagina;
		else $inicio=0;

		$query2 = "SELECT CODPER,PERNOM,PERAPP,ARECOD,ARENOM,FUNCOD,FUNNOM,DATE_FORMAT(FECINI,'%d/%m/%Y'), 
		DATE_FORMAT(FECFIN,'%d/%m/%Y'), TOTDAY FROM TSOLIC INNER JOIN TPERS ON PERCOD=CODPER 
		INNER JOIN TUSER ON CODUSEPER=PERCOD 	INNER JOIN TAREA ON PERARE=ARECOD INNER JOIN 
		TSARE ON PERSRE=SARCOR INNER JOIN TFUNC ON PERFUN=FUNCOD  WHERE STATUS='RA' AND PERFCS IS NULL AND PEREST='' GROUP BY 1 
		  LIMIT $inicio,$reg_por_pagina  ";

		$val2=funciones::listadoReturn($c,$query2);

		$cant_paginas=round($nro / $reg_por_pagina);

		echo "<form method='post' action=''><table cellpadding='0' cellspacing='0'>";
		echo "<th>Codigo</th><th>Nombre</th><th>Area</th><th>Sub-Area</th>";
		while ($reg = mysql_fetch_array($val2)) {
			$codigo=str_replace(" ", "&nbsp;", $reg[0]);
			$nombre=str_replace(" ", "&nbsp;", $reg[1]);
			$apellido=str_replace(" ", "&nbsp;", $reg[2]);
			$area=str_replace(" ", "&nbsp;", $reg[3]);
			$subarea=str_replace(" ", "&nbsp;", $reg[4]);

			$codcar=str_replace(" ", "&nbsp;", $reg[5]);
			$nomcar=str_replace(" ", "&nbsp;", $reg[6]);

			$inicio=str_replace(" ", "&nbsp;", $reg[7]);
			$fin=str_replace(" ", "&nbsp;", $reg[8]);
			$total=str_replace(" ", "&nbsp;", $reg[9]);

			echo "<tr OnClick=datos('$codigo','$nombre','$apellido','$area','$subarea','$codcar','$nomcar','$inicio','$fin','$total') >";
			for($x=0;$x<4;$x++)
			{
				echo "<td>$reg[$x]</td>";
			}
			echo "</tr>";
		}
		echo "</table></form>";

		echo "<section class='pagination_employ'>";
		   	$url="personal";
			funciones::paginacion($url,$num_pag,$cant_paginas);
	   	echo "</section>";
	}
	echo "</section>";
?>