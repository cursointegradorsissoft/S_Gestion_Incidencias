<?php
	/*
	header("Content-type: aplication/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=area.xls");
	*/
?>
<script type="text/javascript">
	function datos(cod,nom){
		window.opener.document.registrar.codaremod.value = cod;
		window.opener.document.registrar.nomaremod.value = nom;
		window.opener.document.registrar.codare.value = cod;
		window.opener.document.registrar.nomare.value = nom;
		window.opener.document.registrar.codigofin.value = cod;
		window.opener.document.registrar.nombrearea.value = nom;
		window.opener.$("#bloque").fadeOut();
		window.close();
	}
</script>

<?php
	echo "<section class='ayuda'>";
    echo    "<section class='arriba'>
                <section class='opt1'>
                    <form method='post'><table class='tabla'><tr><td class='td'>Areas </td></tr></table>
                    <input type='text' name='dato' readonly=''></form>
                </section><section class='opt3'>
                    <input type='button' class='boton' value='Buscar' name='buscar'/>
				</section>                        
            </section>";

	$query = "select ARECOD,ARENOM from tarea";
	$consul=funciones::listadoReturn($c,$query);
		echo "<section class='medio'><fieldset><section class='tabla'";
        echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
		echo "<th>Codigo</th><th>Nombre</th>";
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