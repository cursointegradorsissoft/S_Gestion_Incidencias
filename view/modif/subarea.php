<script type="text/javascript">
	function datos(cod,nom){
		window.opener.document.registrar.codsaremod.value = cod;
		window.opener.document.registrar.nomsaremod.value = nom;

		window.opener.document.registrar.codsare.value = cod;
		window.opener.document.registrar.nomsare.value = nom;

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
	echo "<section class='ayuda'>";
      echo "<section class='arriba'>";
        echo "<section class='opt1' style='width:99% !important'>";
            echo "<form method='post'>";
	          echo "<table class='tabla'>";
	            echo "<tr>";
	              echo "<td class='td'>Areas</td>";
	             echo "</tr>";
	           echo "</table>";
				echo "<select name='tipo' style='width:90%' class='tipo'>";
					$cadena = "select * from tarea";
					$resultado=funciones::listadoReturn($c,$cadena);
					while($fil = mysql_fetch_array($resultado))
					{
						echo "<option value='".$fil[0]."'/>".$fil[1];
					}
				echo "</select>";
			  echo "</form>";
			echo "</section>";
	   	echo "</section>";
		echo "<section class='medio'>";
		  echo "<fieldset>";
			echo "<section class='tabla'>";
	       	  echo "<form method='post' action=''>";
	        	echo "<table cellpadding='0' cellspacing='0' class='mGrid2 lista_subarea'>";
					echo "<th>C&oacute;digo</th><th>Nombre</th>";
				echo "</table>";
			  echo "</form>";
			echo "</section>";
		  echo "</fieldset>";
		echo "</section>";
		echo "<section class='abajo'>";
    	   echo "<input type='button' name='boton' class='btmod_salir' value='Salir'/>";                
	    echo "</section>";
	echo "</section>";
?>