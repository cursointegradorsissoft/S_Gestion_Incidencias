
<section class='conteiner'>
	<section class='top'>
		<img src="themes/images/slogan.png">
	</section>

	<section class='bottom'>
		<form method="POST">
			<table>
				<tr><td>Usuario</td></tr>
				<tr><td><input type="text" name="usuario" class="usuario" placeholder="@Usuario" required=""></td></tr>
				<tr><td>Clave</td></tr>
				<tr><td><input type="password" name="clave" class="clave" placeholder="password" ></td></tr>
				<tr><td></td></tr>
				<tr><td><input type="submit" name="boton" value="INGRESAR"></td></tr>
				<tr><td><a href="#">Olvidaste tu contrase&ntilde;a ?</a></td></tr>			
			</table>
		</form>
	</section>

	<section class="inf">
		Copyright 2014 Braillard Peru, All right reserved.
	</section>
</section>
<?php
	if($_POST)
	{
		if($_POST['boton'] == "INGRESAR")
		{	
			$usu=funciones::limpiar_cadena($_POST['usuario']);
			$cla=funciones::limpiar_cadena($_POST['clave']);
			
			$men=validar($usu ,$cla);
			if(is_array($men))
			{	
				if($men["estado"]=="2")
				{
					echo "<script>mensaje('El usuario ya ha ingresado al sistema.  Favor de verificar.</br></br> Comun&iacute;quese con el Dep. de Sistemas')</script>";
				}
				else if($men["estado"]=="3")
				{
					echo "<script>mensaje('El usuario esta deshabilitado.</br></br> Comun&iacute;quese con el Dep. de Sistemas')</script>";
				}else{
					ValModUsu3($men["usuario"],"2");
					$_SESSION['data'] = json_encode($men);
					header("location:./login/admin");
				}
			}
			else
			{
				echo "<script>mensaje('$men </br> Vuelva a intentarlo.')</script>";
			}
		}
	}
?>