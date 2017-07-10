<?php
    $sn_parts = explode("/", $_SERVER['SCRIPT_NAME']);
    $base_folder = count($sn_parts) > 1 ? $sn_parts[count($sn_parts)-2]:"";
    define("BASE_FOLDER", $base_folder);
    
    $uri = strpos($_SERVER['REQUEST_URI'], "?") ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")):$_SERVER['REQUEST_URI'];
    $view_file = substr($uri, strpos($uri, BASE_FOLDER."/") + strlen(BASE_FOLDER."/"));
    $view_file = "/".$view_file;
    
    session_start();

    include("config/config.php");
    include("config/texto.php");
    include("config/routes.php");
    include("controller/main.php");
    include("model/main.php");

    foreach($ENRUTADOR as $key1 => $page1)
    { 
        foreach($page1['path'] as $key2 => $page2)
        { 
            if($page2 == $view_file)
            {
                define("VIEW_FILE", $page1['view_file']);
                break;
            }
        }
    }

    $var=substr($view_file, 1,5);
    if(!defined("VIEW_FILE") && ($var == "login" || $var == "mobil" || $var == "admin" || $var == "webma" || $var == "acces"))
    {
        define("VIEW_FILE", "admin/error.php");
    }
    else if(!defined("VIEW_FILE"))
    {
        define("VIEW_FILE", "error.php");   
    }

    /*
    if( funciones::esMovil() ){
        header('location:mobile/home');
    }
    */

    $url = substr(VIEW_FILE, 0,5);
    if(file_exists("view/".VIEW_FILE))
    {
        if(defined("FI_TEMPLATE") && file_exists("template/".FI_TEMPLATE))
        {
            include("template/".FI_TEMPLATE);
        }
        else
        {
                 if( $url == "admin" )      { include('template/admin.php');    }
            else if( $url == "modif" )      { include('template/modificar.php');}
            else if( $url == "docum" )      { include("template/archivo.php");}
            else if( $url == "mobil" )      { include("template/mobile.php");}
                 else                       { include("template/login.php");    }
        }
    }
?>