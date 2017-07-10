<script type="text/javascript">
	function datos(cod,nom){
		window.opener.document.registrar.empmod.value = cod;
		window.opener.document.registrar.nommod.value = nom;		

		window.opener.document.registrar.codemp.value = cod;
		window.opener.document.registrar.nomemp.value = nom;

		window.opener.$("#bloque").fadeOut();
		window.close();
	}
</script>

<?php
    echo "<section class='ayuda'>";
    echo    "<section class='arriba'>
                    <section class='opt1'>
                        <form method='post'>
                        <table class='tabla'><tr><td class='td'>Funcion</td></tr></table>
                        <input type='text' placeholder='Ingrese funcion' name='dato'>
                    </section>
                    <section class='opt3'>
                        <input type='submit' class='boton' value='Buscar' name='buscar'/>
                        </form>
                    </section>                        
            </section>";
	
	
	if($_POST)
	{
		if($_POST['dato'] != NULL)
		{
			$query2 = "select * from tpers where (concat_ws(' ',PERNOM,PERAPP) LIKE '%' '".$_POST['dato']."' '%') or  (PERNOM LIKE '%' '".$_POST['dato']."' '%') group by tpers.percod ";
			$consul=funciones::listadoReturn($c,$query2);

			if(mysql_num_rows($consul)==0){
				echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
			}
			else
			{

				echo "<section class='medio'><fieldset><section class='tabla'";
                echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
				echo "<th>Codigo</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>";
				while ($reg = mysql_fetch_array($consul)) {
					$codigo=$reg[0];
					$nombre=$reg[1].", ".$reg[2];
					$codigo=str_replace(" ", "&nbsp;", $codigo);
					$nombre=str_replace(" ", "&nbsp;", $nombre);

					echo "<tr OnClick=datos('$codigo','$nombre') >";
					for($x=0;$x<4;$x++)
					{
						echo "<td>$reg[$x]</td>";
					}
					echo "</tr>";
				}
				  echo "</table></form></section></fieldset></section>";
			}
		}
		else
		{
			header("location:personal");
		}
	}
	else
	{
		$query = "select * from tpers where perest='' and perfcs is null ";
		$val = funciones::listadoReturn($c,$query);
	    echo "<section class='medio'><fieldset><section class='tabla'";
	    echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
		echo "<th>Codigo</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>";
		while ($reg = mysql_fetch_array($val)) {
			$codigo=$reg[0];
			$nombre=$reg[1].", ".$reg[2];
			$codigo=str_replace(" ", "&nbsp;", $codigo);
			$nombre=str_replace(" ", "&nbsp;", $nombre);

			echo "<tr OnClick=datos('$codigo','$nombre') >";
			for($x=0;$x<4;$x++)
			{
				echo "<td>$reg[$x]</td>";
			}
			echo "</tr>";
		}
		echo "</table></form></section></fieldset></section>";

		echo "<section class='abajo'>
            <input type='button' name='boton' class='btmod_salir' value='Salir'/>                
            <script type='text/javascript'>
                $(document).ready(function(){
                    $('.btmod_salir').click(function(){
                        window.opener.$('#bloque').fadeOut(); 
                        window.close();  
                    });
                });
            </script>
            </section>";
	}
	echo "</section>";
?>