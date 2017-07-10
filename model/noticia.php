<?php

	function validarNoticia($codigo, $titulo, $descrip, $foto)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$titulo == "" ? $error='Titutlo':$error='';
		$descrip == "" ? $error = "Descripcion" : $error ='';
		$foto == "" ? $error = "Foto" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'notcod' => $codigo,
				'nottit' => utf8_encode($titulo),
				'nottxt' => utf8_encode($descrip),
				'notima' => $foto
			);

			$values=json_encode($datos);
			$val= Noticia::insertar($values);
		}
		else
		{
			$val= "Datos imcompletos  => Falta : ".$error."";
		}
		return $val;
	}

	function validarModificacionNoticia($codigo,$titulo,$desc)
	{
		$codigo == "" ? $error='Codigo':$error='';
		$titulo == "" ? $error = "Titulo" : $error ='';
		$desc == "" ? $error = "Descripcion" : $error ='';

		if(strlen($error)==0)
		{
			$datos = array(
				'nottit' => utf8_encode($titulo),
				'nottxt' => utf8_encode($desc)
			);

			$values=json_encode($datos);
			$val= Noticia::modificar($codigo,$values);
		}
	}

	function ValEliNot($codigo)
	{
		if($codigo!=null)
		{
			$val= Noticia::eliminar($codigo);
			header("location:noticia");
		}
	}

?>