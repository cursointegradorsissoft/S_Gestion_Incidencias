<?php
	class conexion
	{
		var $conex;
		var $data;

		public function conectar()
		{
			$cn = mysql_connect(DOMAIN,USERNAME,PASSWORD) or die(mysql_error());
			$this->conex = $cn;
		}

		public function database()
		{
			$dt = mysql_select_db(DATABASE) or die(mysql_error());
			$this->data = $dt;
		}
	}

	$clase = new conexion();
	$clase -> conectar();
	$clase -> database();
	$c = $clase ->conex;
	$conix = $clase ->data;
?>