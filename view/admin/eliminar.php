<?php
	$est = $_REQUEST['est'];
	$codigo = $_REQUEST['cod'];
	switch ($est) {
		case 1:
			ValCamEli($codigo);
			break;
		case 2:
			valEliCar($codigo);
			break;
		case 3:
			ValEliNot($codigo);
			break;
		case 4:
			ValEliAct($codigo);
			break;
		case 5:
			ValEliLoc($codigo);
			break;
		case 6:
			ValEliActSubA($codigo);
			break;
		case 7:
			ValEliArea($codigo);
			break;
		case 8:
			ValEliMone($codigo);
			break;
		case 9:
			ValEliTiCo($codigo);
			break;
		case 10:
			ValEliPer($codigo);
			break;
	}
?>