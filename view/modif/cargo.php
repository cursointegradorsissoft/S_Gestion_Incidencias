<script type="text/javascript">
function datos(cod,nom){
	window.opener.document.registrar.codcarmod.value = cod;
	window.opener.document.registrar.nomcarmod.value = nom;

	window.opener.document.registrar.codcar.value = cod;
	window.opener.document.registrar.nomcar.value = nom;

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
			$query2 = "SELECT * FROM TFUNC WHERE FUNNOM LIKE '%' '".$_POST['dato']."' '%' ";
			$consul=funciones::listadoReturn($c,$query2);

			if(mysql_num_rows($consul)==0){
				echo "<script>alert('No existe el cliente. Intentelo Nuevamente .... ')</script>";
			}
			else
			{
               	echo "<section class='medio'><fieldset><section class='tabla'";
                echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
				echo "<tr><th>Codigo</th><th>Nombre</th></tr>";
				while ($reg = mysql_fetch_array($consul)) {

					$codigo=$reg[0];
					$nombre=$reg[1];
					$codigo=str_replace(" ", "&nbsp;", $codigo);
					$nombre=str_replace(" ", "&nbsp;", $nombre);

					echo "<tr OnClick=datos('$codigo','$nombre') >";
					for($x=0;$x<mysql_num_fields($consul);$x++)
					{
						if($x==0)
						{
							echo "<td>$reg[$x]</td>";
						}
						else
						{
							echo "<td style='text-align:left; padding-left:2%;'>$reg[$x]</td>";
						}
					}
					echo "</tr>";
				}
               echo "</table></form></section></fieldset></section>";
			}
		}
		else
		{
			header("location:cargo");
		}
	}
	else
	{
		$query = "select * from tfunc";
		$consul=funciones::listadoReturn($c,$query);
	        echo "<section class='medio'><fieldset><section class='tabla'";
	        echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
			echo "<tr><th>Codigo</th><th>Nombre</th></tr>";
			while ($reg = mysql_fetch_array($consul)) {

				$codigo=$reg[0];
				$nombre=$reg[1];
				$codigo=str_replace(" ", "&nbsp;", $codigo);
				$nombre=str_replace(" ", "&nbsp;", $nombre);

				echo "<tr OnClick=datos('$codigo','$nombre') >";
				for($x=0;$x<mysql_num_fields($consul);$x++)
				{
					if($x==0)
					{
						echo "<td>$reg[$x]</td>";
					}
					else
					{
						echo "<td style='text-align:left; padding-left:2%;'>$reg[$x]</td>";
					}
				}
				echo "</tr>";
			}
        echo "</table></form></section></fieldset></section>";

	}
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
    echo "</section>";
	
?>