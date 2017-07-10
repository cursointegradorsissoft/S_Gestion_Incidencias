<section class="menu_min"></section>

<header>
	<section class='header-left'>
		<img src=<?php echo funciones::url('/themes/images/slogan.png');?>>
	</section>

	<section class='header-right'>
		<section class='interno'>
			<form method="post">
			<?php $m="Desea Salir ?"; ?>	
				<a href='#' onclick="cerrar('<?php echo $m;?>');"><img src=<?php echo funciones::url('/themes/images/cerrar.jpg');?>></a>
			<?php
				if($_SESSION['data'] == NULL){
					header("location:../login");
				}
				else
				{
					$val=$_SESSION['data'];	
					$values = json_decode($val,true);
					echo "</br>".$values['usuario'];
				}
			?>
			</form>
		</section>
	</section>

	<section class='borde'>
		
		<a href="admin">
		<section class='opt'>
			<section class='img'><img src=<?php echo funciones::url('/themes/images/inicio.png');?>></section>
			<section class='text'>Inicio</section>
		</section>
		</a>

		<a href=<?php echo substr(VIEW_FILE, 6,strlen(VIEW_FILE)-10);  ?>>
		<section class='opt'>
			<section class='img'><img src=<?php echo funciones::url('/themes/images/actualizar.png');?>></section>
			<section class='text'>Refrescar</section>
		</section>
		</a>
		<?php $dat="Falata Implementar esta secci&oacute;n";?>
		<a href="#" onclick="herramienta('<?php echo $dat; ?>');">
		<section class='opt'>
			<section class='img'><img src=<?php echo funciones::url('/themes/images/herramienta.png');?>></section>
			<section class='text'>Herramientas</section>
		</section>
		</a>

		<a href="#" onclick="ayuda('<?php echo $men['texto'];?>');">
		<section class='opt'>
			<section class='img'><img src=<?php echo funciones::url('/themes/images/ayuda.png');?>></section>
			<section class='text'>Ayuda</section>
		</section>
		</a>
		
		<section class='opt'></section>

		<section class='fecha'>
			<?php
				$fecha=funciones::fecha();
				echo $fecha['completo'];
			?>
		</section>
	</section>
	
</header>