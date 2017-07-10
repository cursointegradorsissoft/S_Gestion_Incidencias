<section id="menu_opt">
	<section class="contenedor_menu">
		<section class="top">
			Men&uacute; de Navegaci&oacute;n
		</section>

		<section class="bottom">
			<?php
				$nav=funciones::navsItemsMobile();
				foreach ($nav as $val1 => $val2) {
					$replace = array('/');
					$item_data = $val2['default'];
					$thisurl =  $item_data['page'];
			?>
				<section class="opt">
					<a href='<?php echo funciones::url($thisurl) ?>'>
						<section class="imagen" style='<?php echo $item_data['color']?>'>
							<img src='<?php echo $item_data['imagen']?>'>
						</section>
					</a>
					<section class="texto"><?php echo $item_data['label']?></section>
				</section>
			<?php
				}
			?>

		</section>
	</section>
</section>