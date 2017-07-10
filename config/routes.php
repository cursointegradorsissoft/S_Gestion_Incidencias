<?php
    $ENRUTADOR = array();

// RUTAS DE ACCESOS LOGIN
    $ENRUTADOR[] = array(
            'path' => array(    
                '',
                '/',         
                '/login',
                '/webmail',
                '/acceso',
		'/intranet',
                ),
            'view_file' => 'login.php',         
            'defaults' => array(
                'lang' => ""
                )
            );
        
     $ENRUTADOR[] = array(
            'path' => array(             
                '/login/salir',
                '/webmail/salir',
                '/acceso/salir',
                '/admin/salir'
                ),
            'view_file' => 'admin/salir.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

/* RUTAS PARA ADMINISTRADOR INICIO  */
        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/admin',
                '/webmail/admin',
                '/acceso/admin',
                '/admin/admin'
                ),
            'view_file' => 'admin/admin.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


/* RUTAS PARA MANTENIMIENTO  */

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/categoria',
                '/webmail/categoria',
                '/acceso/categoria',
                '/admin/categoria'
                ),
            'view_file' => 'admin/categoria.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/empresa',
                '/webmail/empresa',
                '/acceso/empresa',
                '/admin/empresa'
                ),
            'view_file' => 'admin/empresa.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/estado',
                '/webmail/estado',
                '/acceso/estado',
                '/admin/estado'
                ),
            'view_file' => 'admin/estado.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/incidencia',
                '/webmail/incidencia',
                '/acceso/incidencia',
                '/admin/incidencia'
                ),
            'view_file' => 'admin/incidencia.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/perfil',
                '/webmail/perfil',
                '/acceso/perfil',
                '/admin/perfil'
                ),
            'view_file' => 'admin/perfil.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/lugarIncidencia',
                '/webmail/lugarIncidencia',
                '/acceso/lugarIncidencia',
                '/admin/lugarIncidencia'
                ),
            'view_file' => 'admin/lugarIncidencia.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/seguimiento',
                '/webmail/seguimiento',
                '/acceso/seguimiento',
                '/admin/seguimiento'
                ),
            'view_file' => 'admin/seguimiento.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

/* RUTAS PARA ADMINISTRADOR  */   

    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/eliminar',
                '/webmail/eliminar',
                '/acceso/eliminar',
                '/admin/eliminar',
                ),
            'view_file' => 'admin/eliminar.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/usuario',
                '/webmail/usuario',
                '/acceso/usuario',
                '/admin/usuario',
                ),
            'view_file' => 'admin/usuario.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/clave',
                '/webmail/clave',
                '/acceso/clave',
                '/admin/clave',
                ),
            'view_file' => 'admin/clave.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/programas',
                '/webmail/programas',
                '/acceso/programas',
                '/admin/programas',
                ),
            'view_file' => 'admin/programas.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/subprograma',
                '/webmail/subprograma',
                '/acceso/subprograma',
                '/admin/subprograma',
                ),
            'view_file' => 'admin/subprograma.php',         
            'defaults' => array(
                'lang' => ""
                )
            );
    

    $ENRUTADOR[] = array(
            'path' => array(             
                '/login/permisos',
                '/webmail/permisos',
                '/acceso/permisos',
                '/admin/permisos',
                ),
            'view_file' => 'admin/permisos.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    

    /* RUTAS DE MODIFICACION */

    $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/cambio',
                ),
            'view_file' => 'modif/cambio.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(  
                '/modificar/listado'
                ),
            'view_file' => 'modif/listado.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/personal_grupo',
                ),
            'view_file' => 'modif/personal_grupo.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/alerta',
                ),
            'view_file' => 'modif/alerta.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/cargo',
                ),
            'view_file' => 'modif/cargo.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/noticia',
                ),
            'view_file' => 'modif/noticia.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/actividad',
                ),
            'view_file' => 'modif/actividad.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/local',
                ),
            'view_file' => 'modif/local.php',         
            'defaults' => array(
                'lang' => ""
                )
            );
        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/area',
                ),
            'view_file' => 'modif/area.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/subarea',
                ),
            'view_file' => 'modif/subarea.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/moneda',
                ),
            'view_file' => 'modif/moneda.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
        'path' => array(             
            '/modificar/tipocomida',
            ),
        'view_file' => 'modif/tipocomida.php',         
        'defaults' => array(
            'lang' => ""
            )
        );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/personal',
                ),
            'view_file' => 'modif/personal.php',         
            'defaults' => array(
                'lang' => ""
                )
            );
    
    
        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/vacaciones',
                ),
            'view_file' => 'modif/vacaciones.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/almuerzo',
                ),
            'view_file' => 'modif/almuerzo.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/permisos',
                ),
            'view_file' => 'modif/permisos.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/solicitud',
                ),
            'view_file' => 'modif/solicitud.php',         
            'defaults' => array(
                'lang' => ""
                )
            );


    /* RUTAS PARA AJAX Y SUS FUNCIONES */

        $ENRUTADOR[] = array(
            'path' => array(             
                '/funcion'
                ),
            'view_file' => 'funcion.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    
    $ENRUTADOR[] = array(
            'path' => array(  
                '/login/funcion',           
                '/admin/funcion',
                '/modificar/funcion'
                ),
            'view_file' => 'admin/funcion.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    


    /* ---------------------------- */

            /* RUTAS NUEVAS */

        $ENRUTADOR[] = array(
            'path' => array(  
                '/modificar/envio_excel'
                ),
            'view_file' => 'modif/envio_excel.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/funcion'
                ),
            'view_file' => 'funcion.php',         
            'defaults' => array(
                'lang' => ""
                )
            );
     
        $ENRUTADOR[] = array(
            'path' => array(             
                '/modificar/historial',
                ),
            'view_file' => 'modif/historial.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/historial_vaca2',
                '/webmail/historial_vaca2',
                '/acceso/historial_vaca2',
                '/admin/historial_vaca2'
                ),
            'view_file' => 'admin/historial_vaca2.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

    
        $ENRUTADOR[] = array(
            'path' => array(             
                '/login/historial_vaca3',
                '/webmail/historial_vaca3',
                '/acceso/historial_vaca3',
                '/admin/historial_vaca3'
                ),
            'view_file' => 'admin/historial_vaca3.php',         
            'defaults' => array(
                'lang' => ""
                )
            );

