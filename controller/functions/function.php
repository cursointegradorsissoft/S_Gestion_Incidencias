<?php
    
    class funciones
    {
        public static function validar_rutas($cn, $usuario, $opt)
        {
            $sql= "SELECT NOMSPRO,RUTASPR,USEALI FROM PERMISOS INNER JOIN TSUBPRO ON CODSPRO=FKSUBPRO 
            INNER JOIN TUSER ON USECOD=FKUSECOD WHERE USEALI='".$usuario."' AND RUTASPR='".$opt."' ";
            $con = mysql_query($sql);
            return $con;
        }

        public static function validar_rutas_totales($cn, $opt)
        {
            $sql= "SELECT NOMSPRO, RUTASPR FROM PERMISOS INNER JOIN TSUBPRO ON CODSPRO=FKSUBPRO WHERE 
            RUTASPR='".$opt."' GROUP BY 1 ";
            $con = mysql_query($sql);
            return $con;
        }

        public static function listado($cn, $query)
        {
            $con = mysql_query($query);

            echo "<table border='1' >";

            while($fil=mysql_fetch_array($con))
            {
                echo "<tr>";
                    for($x=0;$x<mysql_num_fields($con);$x++)
                    {
                        echo "<td>".$fil[$x]."</td>";
                    }
                echo "</tr>";
            }

            echo "</table>";

            return $con;
        }

        public static function listadoReturn($cn, $query)
        {
            $con = mysql_query($query);
            return $con;
        }

        public static function listadoWhere($query)
        {
            $con = mysql_query($query);
            return $con;
        }

        public static function insertar($tabla, $values)
        {
            $v ='Agrego';
            $ins = array();
            foreach ($values as $field => $val) 
            {
                $ins[] = "'".$val."'";
            }

            $ins = implode(',', $ins);
            $fields = implode( ',' , array_keys($values));
            $query= "INSERT INTO ".$tabla." ($fields) values($ins)";
            mysql_query($query) or die($v='No Agrego');
            
            return $v;
        }

        public static function modificar($tabla, $condicion, $values)
        {
            $v ='Agrego';
            $ins = array();
            foreach ($values as $field => $val) 
            {
                $ins[] = $field."='".$val."'";
            }
            $ins = implode(',', $ins);
            $query= "UPDATE ".$tabla." set $ins where $condicion ";
            mysql_query($query) or die($v='No Modifico');
            return $v;
        }

        public static function codigo( $tabla,$campo)
        {
            $cant=0;
            $sql= "SELECT CASE WHEN MAX($campo) IS NULL THEN 1 ELSE MAX($campo)+1 END AS codsal FROM $tabla";
            $cant= mysql_query($sql);
            while($reg=mysql_fetch_array($cant))
            {
                return $reg[0];
            }
        }

        public static function eliminar($tabla, $condicion)
        {
            $v ='Agrego';
            $query= "DELETE FROM ".$tabla." where $condicion ";
            mysql_query($query) or die($v='No Agrego');
            return $v;
        }

        public static function navsItems()
        {
            $items = array(
                    'inicio' => array(
                        'default' => array('page'=>'/index.php', 'label'=>'Inicio')
                        ),
                    'empresa' => array(
                        'default' => array('page'=>'/empresa', 'label'=>'La Empresa')
                        ),
                    'areas' => array(
                        'default' => array('page'=>'/areas', 'label'=>'&Aacute;reas')
                        ),
                    'novedades' => array(
                        'default' => array('page'=>'/novedades', 'label'=>'Novedades')
                        ),
                    'cumpleaños' => array(
                        'default' => array('page'=>'/cumpleaos', 'label'=>'Cumplea&ntilde;os')
                        ),
                    'vacaciones' => array(
                        'default' => array('page'=>'/vacaciones', 'label'=>'Vacaciones')
                        ),
                    'comedor' => array(
                        'default' => array('page'=>'/comedor', 'label'=>'Comedor')
                        ),
                    'formatos' => array(
                        'default' => array('page'=>'/formatos', 'label'=>'Formatos')
                        ),
                    'telefono' => array(
                        'default' => array('page'=>'/telefonos', 'label'=>'Tel&eacute;fonos')
                        )
                    );  
            return $items;
        }


        public static function navsItemsMobile()
        {
            $items = array(
                    'inicio' => array(
                        'default' => array('page'=>'/mobil/inicio', 'label'=>'Inicio', 'imagen' => '../themes/images/iconos_mobile/inicio.png', 'color' => 'background:rgb(0,51,102);' )
                        ),
                    'empresa' => array(
                        'default' => array('page'=>'/mobil/empresa', 'label'=>'La Empresa', 'imagen' => '../themes/images/iconos_mobile/formatos.png', 'color' => 'background:rgb(255,0,132);')
                        ),
                    'areas' => array(
                        'default' => array('page'=>'/mobil/areas', 'label'=>'&Aacute;reas', 'imagen' => '../themes/images/iconos_mobile/inicio2.png', 'color' => 'background:rgb(255,103,15);')
                        ),
                    'novedades' => array(
                        'default' => array('page'=>'/mobil/novedades', 'label'=>'Novedades', 'imagen' => '../themes/images/iconos_mobile/eventos.png', 'color' => 'background:rgb(73,192,240);')
                        ),
                    'cumpleaños' => array(
                        'default' => array('page'=>'/mobil/cumpleaos', 'label'=>'Cumplea&ntilde;os', 'imagen' => '../themes/images/iconos_mobile/documentos.png', 'color' => 'background:rgb(204,0,0);')
                        ),
                    'vacaciones' => array(
                        'default' => array('page'=>'/mobil/vacaciones', 'label'=>'Vacaciones', 'imagen' => '../themes/images/iconos_mobile/eventos2.png', 'color' => 'background:rgba(0,0,0,0.7);')
                        ),
                    'comedor' => array(
                        'default' => array('page'=>'/mobil/comedor', 'label'=>'Comedor', 'imagen' => '../themes/images/iconos_mobile/noveades2.png', 'color' => 'background:#4B088A;')
                        ),
                    'formatos' => array(
                        'default' => array('page'=>'/mobil/formatos', 'label'=>'Formatos', 'imagen' => '../themes/images/iconos_mobile/cumpleaos.png', 'color' => 'background:#0B4C5F;')
                        ),
                    'telefonos' => array(
                        'default' => array('page'=>'/mobil/telefonos', 'label'=>'Tel&eacute;fonos', 'imagen' => '../themes/images/iconos_mobile/telefonos.png', 'color' => 'background:#0A122A;')
                        ),
                    'accesos' => array(
                        'default' => array('page'=>'/mobil/telefonos', 'label'=>'Accesos', 'imagen' => '../themes/images/iconos_mobile/novedades.png', 'color' => 'background:#1B2A0A;')
                        )
                    );  
            return $items;
        }


        public static function url($uri="", $force_relative_path = FALSE)
        {
            $o = "/".BASE_FOLDER.$uri;
            $o = strpos($o, "//") === 0 ? substr($o, 1):$o;
            
            if($force_relative_path === FALSE)
            {
                $domains = array();
                for($i=1; $i<=10; $i++)
                {
                    if(defined("FI_DOMAIN".$i))
                    {
                        eval("\$domains[] = FI_DOMAIN".$i.";");
                    }
                }           
                if(count($domains) > 0)
                {

                    foreach($domains as $key => $d)
                    {
                        if("http://".$_SERVER['HTTP_HOST'] == $d)
                        {
                            return $d.$o;
                        }
                    }

                    return $domains[0].$o;
                }
            }   
            return $o;
        }

        public static function darPerm()
        {
            $permisos = array(
                    'programas' => array(
                        'default' => array('page'=>'/programas', 'label'=>'programas')
                        )
                    );  
            return $permisos;
        }

        public static function fecha()
        {
            $hoy = getdate();
            $hora=($hoy['hours'].":".$hoy['minutes']);

            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
                            "Septiembre","Octubre","Noviembre","Diciembre");
            $completo=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
            

            $year = date('Y');
            $week = date('W');
            $fechaInicioSemana  = date('d-m-Y', strtotime($year . 'W' . str_pad($week , 2, '0', STR_PAD_LEFT)));
            
            $inicio = date('d', strtotime($fechaInicioSemana.' 0 day'));
            $fin = date('d', strtotime($fechaInicioSemana.' 6 day'));
            $fin2 = date('d', strtotime($fechaInicioSemana.' 4 day'));
            $fecha = array(
                            'dia' => $dias[date('w')],
                            'fecha' => date('d'),
                            'mes' => $meses[date('n')-1],
                            'año' => date('Y'),
                            'hora' => $hora,
                            'completo' => $completo,
                            'semana' => "Lunes ". $inicio . " al Domingo " . $fin . " de " . $meses[date('n')-1],
                            'semana2' => "Lunes ". $inicio . " al Viernes " . $fin2 . " de " . $meses[date('n')-1],
                            'inicio' => $inicio,
                            'fin' => $fin
                             );

            return $fecha;
        }


        public static function fecha_solicitud($fecha)
        {
            $hoy = $fecha;
            $hora=($hoy['hours'].":".$hoy['minutes']);

            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
                            "Septiembre","Octubre","Noviembre","Diciembre");
            $completo=$dias[date('w', strtotime($fecha))]." ".date('d', strtotime($fecha))." de ".$meses[date('n', strtotime($fecha))-1]. " del ".date('Y');
            return $completo;
        }

        public static function obtener_mes($indice){
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
                            "Septiembre","Octubre","Noviembre","Diciembre");
            return $meses[$indice];
        }

        public static function paginacion($url, $num_pag,$cant_paginas)
        {
            if($num_pag>1)echo "<a href='$url?num='".($num_pag-1)."'><img src='themes/images/previous.png'></a>";
                for($i=1;$i<=$cant_paginas;$i++){
                    if($i==$num_pag) echo $i." ";
                    else echo "<a href='$url?&&num=$i'>".$i." "."  "."</a>";
                }
            if($num_pag<$cant_paginas)echo "<a href='$url?num='".($num_pag+1)."'><img src='themes/images/next.png'></a>";
        }

        public static function paginacion2($url, $num_pag,$cant_paginas)
        {
            for($i=1;$i<=$cant_paginas;$i++){
                if($i==$num_pag) echo $i." ";
                else echo "<a href='$url?&&num=$i'>".$i." "."  "."</a>";
            }
        }

        public static function subirImagen($directorio, $n)
        {
            $nombre = $_FILES[$n]['name'];
            $tipo = $_FILES[$n]['type'];
            $tamano = $_FILES[$n]['size'];
            move_uploaded_file($_FILES[$n]['tmp_name'],$directorio.$nombre) or die("Seleccione la Imagen");
            return $nombre;
        }


        public static function subirVariasImagenes($directorio, $n, $codigo)
        {
            mkdir($directorio.$codigo,0777,true);
            chmod($directorio.$codigo,0777);

            $nombre2=array();
            for ($x=0; $x <count($_FILES[$n]['name']) ; $x++) 
            { 
                $file   =$_FILES['files2'];
                $nombre =$file['name'][$x];
                $tipo   =$file['type'][$x];
                $ruta_provisional = $file['tmp_name'][$x];
                $carpeta= $directorio.$codigo."/";

                if($tipo != 'imagen/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo!= 'image/gif')
                {
                   echo "<p style='color:red'>Error: El archivo no es una imagen</p>";
                }
                else
                {
                    $src = $carpeta.$nombre;
                    move_uploaded_file($ruta_provisional, $src);
                    $nombre2[$x] = $nombre;
                }
            }
            return $nombre2;
        }


         public static function subirextraimagen($directorio, $n, $codigo)
        {
            $nombre2=array();
            for ($x=0; $x <count($_FILES[$n]['name']) ; $x++) 
            { 
                $file   =$_FILES['files2'];
                $nombre =$file['name'][$x];
                $tipo   =$file['type'][$x];
                $ruta_provisional = $file['tmp_name'][$x];
                $carpeta= $directorio.$codigo."/";

                if($tipo != 'imagen/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo!= 'image/gif')
                {
                   echo "<p style='color:red'>Error: El archivo no es una imagen</p>";
                }
                else
                {
                    $src = $carpeta.$nombre;
                    move_uploaded_file($ruta_provisional, $src);
                    $nombre2[$x] = $nombre;
                }
            }
            return $nombre2;
        }
        
        public static function dameFecha($fecha,$dia)
        {   
            list($day,$mon,$year) = explode('-',$fecha);
            return date('d-m-Y',mktime(0,0,0,$mon,$day+$dia,$year));        
        }
        
        public static function dias_transcurridos($fecha_i,$fecha_f)
        {
            $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
            $dias   = abs($dias); $dias = floor($dias);     
            return $dias;
        }
        
        public static function limpiar_cadena($cadena){
            $string = str_replace(
                        array( "[^A-Za-z0-9]","\\", "¨", "º", "-", "~","#", "|", "!", 
                               "$", "%", "&", "/","(", ")", "?", "'", "¡", "¿", "[", 
                               "^", "`", "]","+", "}", "{", "¨", "´", ">", "< ", ";",
                                ",", ":", "=", "or", "*", "from", "\"", "·", " "),
                                '',
                             $cadena
                    );
            return htmlspecialchars($string);
        }
        
        

        /* FUNCION PARA DETECTAR NAVEGADOR ( SI ES MOBIL O PC ) */
        function mobile(){
            $hua=$_SERVER['HTTP_USER_AGENT'];
            if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i',strtolower($hua)))$m=true;
            if(strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0||
            ((isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE']))))$m=true;
         
            $mua=strtolower(substr($hua,0,4));

            $ma = array('w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird',
                        'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric',
                        'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c',
                        'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi',
                        'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'oper', 'palm', 'pana',
                        'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany',
                        'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal',
                        'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-',
                        'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr',
                        'webc', 'winw', 'xda', 'xda-');

            if(in_array($mua,$ma)) $m=true;
            if(strpos(strtolower(@$_SERVER['ALL_HTTP']),'OperaMini')>0) $m=true;
            if(strpos(strtolower($hua),'windows')>0&&strpos(strtolower($hua),'IEMobile')<=0) $m=true;
            return $m;
        }

        function esMovil(){
            return eregi( 'ipod|iphone|ipad|android|opera mini|blackberry|palm os|windows ce|Bada|Windows Phone|Symbian', $_SERVER['HTTP_USER_AGENT'] );
        }

        public static function Seteo_tiempo($valor)
        {
            $seteo_hora=split(" ", $valor);
            if($seteo_hora[1]=="PM")
            {   
                $nuevafecha=date("H:i",strtotime('+12 hours', strtotime(date("h:i",strtotime($seteo_hora[0])))));
            }
            else
            {
                $nuevafecha=date("H:i",strtotime($seteo_hora[0]));
            }
            return $nuevafecha;
        }




        /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
        //////// CORREO POR SOLICITUD DE VACACIONES ////////
        *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/

        // CUANDO UN USUARIO EMITE INDIVIDUALMENTE
        public static function envio_correo_solicitud($jefe,$trabajador,$inicio,$fin,$total,$periodo){
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true; 
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "SOLICITUD DE VACACIONES";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );
            


            $body="
                <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>SOLICITUD DE VACACIONES</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td> El Colaborador         </td><td>: </td><td style='color:#192456'>$trabajador</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Ha emitido una solicitud de vacaciones con los siguientes datos:</td><td style='color:#192456'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                    <tr><td>&nbsp;</td> <td> - Fecha Inicio         </td><td>:  </td><td style='color:#192456'>".funciones::fecha_solicitud($inicio)."</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Fecha Fin            </td><td>:  </td><td style='color:#192456'>".funciones::fecha_solicitud($fin)."</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Total de D&iacute;as </td><td>:  </td><td style='color:#192456'> $total      </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Periodo              </td><td>:  </td><td style='color:#192456'> $periodo    </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Aceptar o Denegar La Solicitud de Vacaciones Ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }

        // CUANDO EL JEFE LO APRUEBA
        public static function envio_correo_solicitud_jefe($jefe,$area,$trabajador,$inicio,$fin,$total,$periodo){
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true;
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  
            
            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "RESPESUTA JEFATURA A SOLICITUD DE VACACIONES";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            $address2          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            $mail->AddAddress($address2, " GIANCARLO URBANO " );
            
            $body="



            <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                            
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>SOLICITUD DE VACACIONES</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td> El Jefe de $area         </td><td>: </td><td style='color:#0B2161'>$jefe</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Ha APROBADO una solicitud de vacaciones con los siguientes datos:</td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                    <tr><td>&nbsp;</td> <td> - Colaborador         </td><td>: </td><td style='color:#0B2161'>$trabajador</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Fecha Inicio         </td><td>:  </td><td style='color:#0B2161'>".funciones::fecha_solicitud($inicio)."</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Fecha Fin            </td><td>:  </td><td style='color:#0B2161'>".funciones::fecha_solicitud($fin)."</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Total de D&iacute;as </td><td>:  </td><td style='color:#0B2161'> $total      </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Periodo              </td><td>:  </td><td style='color:#0B2161'> $periodo    </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Aceptar o Denegar La Solicitud de Vacaciones Ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>

            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }

        // CUANDO ES ACEPTADO O RECHAZADO POR RRRHH
        public static function enviar_correo($jefe,$usuario,$estado,$inicio,$fin,$total){
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true; 
                        
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp";  
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25; 

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "RESPUESTA A LA SOLICITUD DE VACACIONES";  

            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );

            $mail->IsHTML(true);

            if($estado  ==  "Aprobado"){
                $msg    =   "
                            <tr><td>&nbsp;</td> <td>Sus vacaciones est&aacute;n programadas </td> <td>:</td>  <td style='color:#0B2161'></td></tr>
                            <tr><td>&nbsp;</td> <td>Desde                                   </td> <td>:</td>  <td style='color:#0B2161'>".funciones::fecha_solicitud($inicio)."</td></tr>
                            <tr><td>&nbsp;</td> <td>Hasta                                   </td> <td>:</td>  <td style='color:#0B2161'>".funciones::fecha_solicitud($fin)."</td></tr>
                            <tr><td>&nbsp;</td> <td>Con un total de                         </td> <td>:</td>  <td style='color:#0B2161'>$total d&iacute;as</td></tr>
                            <tr><td>&nbsp;</td> <td colspan='3'>Favor de acercarse al &aacute;rea de Recursos Humanos. </td></tr>";
            }else{
                $msg    =   "";
            }
            
            $body="


            <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                            <img src='https://www.mediafire.com/convkey/3e59/r73pzxpp4pus78j6g.jpg' width='100' height='87'/>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>SOLICITUD DE VACACIONES</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td></tr>
                                    <tr><td>&nbsp;</td> <td>Estimado Colaborador            </td>   <td>:</td>  <td style='color:#0B2161'>  $usuario</td></tr>
                                    <tr><td>&nbsp;</td> <td>La solicitud emitida ha sido    </td>   <td>:</td>  <td style='color:#0B2161'>  $estado</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td></tr>
                                    $msg
                                    <tr><td>&nbsp;</td> <td colspan='3'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Gracias</td></tr>
                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Verifique en su Vaciones Programadas:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/vacaciones' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }


        // CUANDO SE PROGRAMA VACACIONES
        public static function envio_correo_solicitud_masivo( $jefe, $cuerpo, $nombre, $area ){

            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true;
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "PROGRAMACION DE VACACIONES";  

            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, "JEFATURA"); 
            $mail->AddAddress($address3, " GIANCARLO URBANO " );
            

            $body="

            <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>PROGRAMACION DE VACACIONES</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr>
                                        <td>
                                            <table style='font-family: Arial; width:100%;'>
                                                <tr><td>&nbsp;</td> <td colspan='3'></td></tr>
                                                <tr><td>&nbsp;</td> <td> El Jefe de $area         </td><td>: </td><td style='color:#0B2161'>$nombre</td></tr>
                                                <tr><td>&nbsp;</td> <td colspan='3'>Ha programado vacaciones para su personal:</td><td style='color:#0B2161'></td></tr>
                                                <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                            </table>
                                        </td>
                                    <tr>

                                    <tr>
                                        <td>
                                            <table cellpadding='0' cellspacing='0' style='font-family: Arial;border:1px solid #252525; width:100%;'>
                                                <tr style=' color:#FAFAFA; background:#0B2161; text-align:center; '>
                                                    <td>Nombres</td>
                                                    <td>Fecha Inicio</td>
                                                    <td>Fecha Fin</td>
                                                    <td>Total Dias</td>
                                                    <td>Periodo</td>
                                                </tr>
                                                $cuerpo
                                            </table>
                                        </td>
                                    <tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Aceptar o Denegar La Programaci&oacute;n de Vacaciones Ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>


            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $body;
        }
        

        // RESPUESTA DE RECURSOS HUMANOS A LA PROGRAMACION DE VACACIONES
        public static function envio_correo_respuesta_masivo( $jefe, $cuerpo, $nombre, $area ){


            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true;
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "RESPUESTA PROGRAMACION DE VACACIONES"; 
             
            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );
            

            $body="

            <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>RESPUESTA PROGRAMACION DE VACACIONES</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr>
                                        <td>
                                            <table style='font-family: Arial; width:100%;'>
                                                <tr><td>&nbsp;</td> <td colspan='3'> Estimado $nombre, Jefe de $area </td><td style='color:#0B2161'></td></tr>
                                                <tr><td>&nbsp;</td> <td colspan='3'>El Jefe de Recursos Humanos ha evaluado su solicitud y se detalla a </td><td style='color:#0B2161'></td></tr>
                                                <tr><td>&nbsp;</td> <td colspan='3'>continuaci&oacute;n lo establecido: </td><td style='color:#0B2161'></td></tr>
                                                <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                            </table>
                                        </td>
                                    <tr>

                                    <tr>
                                        <td>
                                            <table cellpadding='0' cellspacing='0' style='font-family: Arial;border:1px solid #252525; width:100%;'>
                                                <tr style=' color:#FAFAFA; background:#0B2161; text-align:center; '>
                                                    <td>Nombres</td>
                                                    <td>Fecha Inicio</td>
                                                    <td>Fecha Fin</td>
                                                    <td>Total Dias</td>
                                                    <td>Periodo</td>
                                                    <td>Estado</td>
                                                </tr>
                                                $cuerpo
                                            </table>
                                        </td>
                                    <tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Verifique su Programaci&oacute;n de Vacaciones ingresando a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>

            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $body;
        }
        
        /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
        ///////// CORREO POR SOLICITUD DE PERMISOS /////////
        *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
        public static function enviar_correo_usuario($jefe, $tra,$tipo, $concepto, $inicio, $finali,$diferente)
        {
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true; 
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "SOLICITUD DE PERMISOS";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );
            


            $body="
                <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>SOLICITUD DE PERMISO</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td> El Colaborador         </td><td>: </td><td style='color:#192456'>$tra</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Ha emitido una solicitud de permisos ( $tipo ) con los siguientes datos:</td><td style='color:#192456'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                    <tr><td>&nbsp;</td> <td> - Por Concepto de      </td><td>:  </td><td style='color:#192456'>".$concepto."    </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Fecha Inicio         </td><td>:  </td><td style='color:#192456'>".$inicio."      </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Fecha Fin            </td><td>:  </td><td style='color:#192456'>".$finali."      </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Total                </td><td>:  </td><td style='color:#192456'>". $diferente." </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Aceptar o Denegar La Solicitud de Permisos Ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }

        public static function enviar_correo_jefatura($jefe, $nom_jef, $nom_are, $tra, $status)
        {
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true; 
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "RESPUESTA SOLICITUD DE PERMISOS JEFATURA";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );
            


            $body="
                <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>RESPUESTA A SOL. DE PERMISO</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td> El Sr.                 </td><td>: </td><td style='color:#192456'>$nom_jef</td></tr>
                                    <tr><td>&nbsp;</td> <td> Jefe del &Aacute;rea   </td><td>: </td><td style='color:#192456'>$nom_are</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Ha respondido la Solicitud de Permiso:</td><td style='color:#192456'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                    <tr><td>&nbsp;</td> <td> - Trabajador           </td><td>:  </td><td style='color:#192456'> $tra   </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Estado               </td><td>:  </td><td style='color:#192456'> $status  </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Aceptar o Denegar La Solicitud de Permisos Ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }

        public static function enviar_correo_recursos($jefe, $nom_jef, $nom_are, $tra, $status, $nom_rec, $nom_are_rec, $inicio, $valini, $finali, $valfin, $totals)
        {
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true; 
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  

            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "RESPUESTA SOLICITUD DE PERMISOS RR.HH.";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            //$address2          = "$jefe";
            $address3          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            //$mail->AddAddress($address2, " JEFATURA " );
            $mail->AddAddress($address3, " GIANCARLO URBANO " );


            $body="
                <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>RESPUESTA A SOL. DE PERMISO</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td> Sr.                    </td><td>: </td><td style='color:#192456'>$nom_jef</td></tr>
                                    <tr><td>&nbsp;</td> <td> Jefe del &Aacute;rea   </td><td>: </td><td style='color:#192456'>$nom_are</td></tr>

                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>El Departamento de Recursos Humanos:</td><td style='color:#192456'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                    <tr><td>&nbsp;</td> <td> Jefe                    </td><td>: </td><td style='color:#192456'>$nom_rec</td></tr>
                                    <tr><td>&nbsp;</td> <td> Jefe del &Aacute;rea   </td><td>: </td><td style='color:#192456'>$nom_are_rec</td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'>Ha respondido a la Solicitud de Permisos que Ud. ha Aprobado, se detalla a continuaci&oacute;n lo establecido:</td><td style='color:#192456'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    
                                    <tr><td>&nbsp;</td> <td> - Trabajador           </td><td>:  </td><td style='color:#192456'> $tra   </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Estado               </td><td>:  </td><td style='color:#192456'> $status  </td></tr>
                                    <tr><td>&nbsp;</td> <td> - $inicio               </td><td>:  </td><td style='color:#192456'> $valini  </td></tr>
                                    <tr><td>&nbsp;</td> <td> - $finali               </td><td>:  </td><td style='color:#192456'> $valfin  </td></tr>
                                    <tr><td>&nbsp;</td> <td> - Total               </td><td>:  </td><td style='color:#192456'> $totals  </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Para Verificar el ESTADO de Solicitud de Permiso ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>
            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }

        // CUANDO UN PERSONAL HA SIDO CESADO DE SU CONTRADO
        public static function enviar_correo_cese($dni_per,$dat_per,$are_per,$car_per,$fec_per,$tot_per){
            $mensaje="";
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPAuth   = true;
            
            $mail->Username   = "ALERTA@BRAILLARDPERU.COM";
            $mail->Password   = "Peugeot2013";
            $mail->SMTPSecure = "smtp"; 
            $mail->Host       = "9.10.11.249"; 
            $mail->Port       = 25;  
            
            $mail->FromName   = "RECURSOS HUMANOS";
            $mail->SetFrom('ALERTA@BRAILLARDPERU.COM', 'USUARIO DE MENSAJES'); 
            $mail->Subject    = "TRABAJADOR CESADO";  
            
            //$address          = "RRHH@BRAILLARDPERU.COM";
            $address2          = "GURBANO@BRAILLARDPERU.COM";

            //$mail->AddAddress($address, "RECURSOS HUMANOS"); 
            $mail->AddAddress($address2, " GIANCARLO URBANO " );
            
            $body="



            <style type='text/css'>
                @media only screen and (max-device-width: 480px) {
                    .top{width:100%}
                    .medio{width:100%}
                    .bottom{width:100%}
                    .copy{width:100%}
                    .gif{width:100%; height:auto}
                }

                <table width='700' align='center'  style='text-align:right; font-family: Arial; ' class='top'>
                    <table width='600' align='center'  style='text-align:right' class='top'>
                        </td>
                        </tr>
                    </table>

                    <table cellpadding='0' cellspacing='0' width='700' class='medio' align='center' style=' border-width:1px; border-color:#000000; border-style:solid; margin-top:10px; margin-bottom:10px;'>
                        <tr>
                            <td>
                                <table width='100%' cellpadding='10'>
                                    <tr>
                                        <td>
                                            <a href='http://www.braillardperu.com/'>
                                                <img src='https://www.mediafire.com/convkey/a0cd/va6h976zqxb5zx06g.jpg' width='180' height='61'/>
                                            </a>
                                        </td>
                                        <td style='text-align:right;'>
                                            
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='20' style='font-family: Arial; color:#FFFFFF;' bgcolor='#192456'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'>
                                                <font color='#ffffff'>
                                                    <span style='color:#DF8E2E; font-size: 30px;'>CESE DE TRABAJADOR</span><br/> 
                                                </font>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                    
                                <table width='100%'  style='font-family: Arial; color:#192456;'>
                                    
                                    <tr><td>&nbsp;</td> <td> Se ha cesado al siguiente trabajador:        </td><td>: </td><td style='color:#0B2161'></td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>
                                    
                                    <tr><td>&nbsp;</td> <td> - DNI         </td><td>: </td><td style='color:#0B2161'>$dni_per</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Colaborador         </td><td>: </td><td style='color:#0B2161'>$dat_per</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Area         </td><td>: </td><td style='color:#0B2161'>$are_per</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Cargo         </td><td>: </td><td style='color:#0B2161'>$car_per</td></tr>

                                    <tr><td>&nbsp;</td> <td> - Fecha Ingreso         </td><td>:  </td><td style='color:#0B2161'>".date('d/m/Y',strtotime($fec_per))."</td></tr>
                                    <tr><td>&nbsp;</td> <td> - Total A&ntilde;os              </td><td>:  </td><td style='color:#0B2161'> $tot_per    </td></tr>
                                    <tr><td>&nbsp;</td> <td colspan='3'></td><td style='color:#0B2161'></td></tr>

                                </table>

                                <table width='100%' cellpadding='10' style='font-family: Arial; border-top:2px solid #192456;border-bottom:2px solid #192456; color:#252525;' bgcolor='#FFFFFF'>
                                    <tr>
                                        <td>
                                            <p style='text-align:center;'><font color='#252525'>
                                            Las Vacaciones del personal cesado est&aacute;n en cero, para verificar ingresar a:<br/>
                                            <span style='color:#DF8E2E; font-size: 30px;'>Intranet Braillard SA
                                            </span><br/>
                                            <a href='http://intranet2013/braillard/login' style='color:#FF200D; text-decoration:none;'>
                                            Ingresar Intranet</a></p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <table width='700' align='center' class='copy'>
                        <tr>
                            <td>
                                <p style='font-family: Arial;font-size: 11px; text-align: center;'>
                                Departamento de Recursos Humanos : <a href='mailto:rrhh@braillardperu.com?subject=Solicitud de Vacaciones  &style='color:#006699;font-size:11px;'>rrhh@braillardperu.com</p>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </table>

            ";
                        
            $mail->MsgHTML($body);
            if(!$mail->Send()) { $mensaje = "Error de Mensaje: " . $mail->ErrorInfo;
            } else { $mensaje = "Mensaje Enviado"; }
            return $mensaje;
        }



        

    }
?>