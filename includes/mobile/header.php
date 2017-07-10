<section class="header">

	<section class="top">
		<section class="container">
			<section class="imagen">
				<img src=<?php echo funciones::url("/themes/images/slogan.png")?> >
			</section>
			<section class="login">
				<section class="imagen evento_menu">
					<img src=<?php echo funciones::url("/themes/images/menu_mobil.png")?> >
				</section>
			</section>
		</section>
	</section>

	<section class="nav">
		<section class="container">
			<section class="fecha">
				<?php
					$fecha=funciones::fecha();
					echo $fecha['completo'];
				?>
			</section>
			<section class="hora" id="reloj">
			</section>
		</section>	
	</section>

</section>