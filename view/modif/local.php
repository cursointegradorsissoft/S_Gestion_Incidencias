<script type="text/javascript">
function datos(cod,nom){
	window.opener.document.registrar.codlocmod.value = cod;
	window.opener.document.registrar.nomlocmod.value = nom;

	window.opener.document.registrar.codloc.value = cod;
	window.opener.document.registrar.nomloc.value = nom;
		
	window.opener.$("#bloque").fadeOut();
	
	window.close();
}

$(document).ready(function(){
        $('.btmod_salir').click(function(){
            window.opener.$('#bloque').fadeOut(); 
            window.close();  
        });
    });
    
</script>
<?php
	/*
	header("Content-type: aplication/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=local.xls");
	*/
	
	echo "<section class='ayuda'>";
    echo    "<section class='arriba'>
                <section class='opt1'>
                    <form method='post'><table class='tabla'><tr><td class='td'>Locales Braillard</td></tr></table>
                    <input type='text' placeholder='Local' name='dato' readonly=''></form>
                </section>
                
                <section class='opt3'>
                    <input type='button' class='boton' value='Buscar' name='buscar'/>
				</section>                        
            </section>";

	$query = "select * from tloca";
	$consul=funciones::listadoReturn($c,$query);
		echo "<section class='medio'><fieldset><section class='tabla'";
        echo "<form method='post' action=''><table cellpadding='0' cellspacing='0' class='mGrid2'>";
		echo "<th>Nombre</th><th>Direccion</th><th>Distrito</th>";
		while ($reg = mysql_fetch_array($consul)) {

			$codigo=$reg[0];
			$nombre=$reg[1];
			$codigo=str_replace(" ", "&nbsp;", $codigo);
			$nombre=str_replace(" ", "&nbsp;", $nombre);

			echo "<tr OnClick=datos('$codigo','$nombre') >";
			for($x=1;$x<=3;$x++)
			{
				if($x>0 && $x<4)
				{
					echo "<td>$reg[$x]</td>";
				}
			}
			echo "</tr>";
		}
		echo "</table></form></section></fieldset></section>";

    	echo "<section class='abajo'>
            <input type='button' name='boton' class='btmod_salir' value='Salir'/>                
            </section>";		

	echo "</section>";
?>


