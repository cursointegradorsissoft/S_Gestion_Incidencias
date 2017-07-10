/* LISTADOS DE LOS BOTONES GENERALES */
$(function(){

    $(".exp_personal").click(function(){
        window.location="../modificar/listado?opt=Trabajador";
    });

    $(".exp_almuerzo").click(function(){
        window.location="../modificar/listado?opt=Almuerzo";
    });

    $(".exp_actividad").click(function(){
        window.location="../modificar/listado?opt=Actividad";
    });

    $(".exp_area").click(function(){
        window.location="../modificar/listado?opt=Area";
    });
    
    $(".exp_cambio").click(function(){
        window.location="../modificar/listado?opt=Cambio";
    });

    $(".exp_cargo").click(function(){
        window.location="../modificar/listado?opt=Cargo";
    });

    $(".exp_mensual").click(function(){
        window.location="../modificar/listado?opt=Mensual";
    });

    $(".exp_puntual").click(function(){
        window.location="../modificar/listado?opt=Puntual";
    });

    $(".exp_local").click(function(){
        window.location="../modificar/listado?opt=Local";
    });

    $(".exp_moneda").click(function(){
        window.location="../modificar/listado?opt=Moneda";
    });

    $(".exp_nacimiento").click(function(){
        window.location="../modificar/listado?opt=Nacimiento";
    });

    $(".exp_noticia").click(function(){
        window.location="../modificar/listado?opt=Noticia";
    });

    $(".exp_sedemar").click(function(){
        window.location="../modificar/listado?opt=Marca";
    });

    $(".exp_solicitud").click(function(){
        window.location="../modificar/listado?opt=Solicitud";
    });

    $(".exp_subarea").click(function(){
        window.location="../modificar/listado?opt=SubArea";
    });

    $(".exp_vacaciones").click(function(){
        var ini=$(".date").val();
        var fin=$(".date2").val();
        var cod=$(".codigo").val();
        var nom=$(".nombre").val();
        var ape=$(".apellido").val();
        window.location="../modificar/listado?opt=Vacaciones&&cod="+cod+"&&nom="+nom+"&&ape="+ape+"&&ini="+ini+"&&fin="+fin;
    });

    $(".exp_tipocomida").click(function(){
        window.location="../modificar/listado?opt=TipoComida";
    });
        
    $(".exp_permisos_jefe").click(function(){
        var texto=$(".interno").html();
        var posicion=texto.indexOf('<br>')+4;
        var posicionfin =texto.indexOf('</form>');
        var cadena=texto.substring(posicion,posicionfin).trim();
        window.location="../modificar/listado?opt=Permisos_Jefatura&&usu="+cadena;
    });
    
    $(".exp_permisos_vigilancia").click(function(){
        window.location="../modificar/listado?opt=Permisos_Vigilancia";
    });
    
    $(".exp_permisos_recursos").click(function(){
        window.location="../modificar/listado?opt=Registro_de_Permisos";
    });
    
    var valor = 0
    $(".exp_permisos_personal").click(function(){
        valor=valor+1
        confirm("Permisos Denegado");
        console.log("Eventos Activados " + valor);
        //window.location="../modificar/listado?opt=permiso_personal";
    });
        
    $(".exporta_data_cons").click(function(){
        var valor = $("[name=opcion]:checked").val();
        var apebu = $(".apebus").val();
        var codbu = $(".codbus").val();
        var nombu = $(".nombus").val();
        var mesbu = $(".opt_mes").val();
        var arebu = $(".opt_area").val();
        var are2b = $(".opt_area2").val();
        var optra = "";
        switch(valor)
        {
            case '1': optra = 'bus_trabajador'; break;
            case '2': optra = 'bus_programado'; break;
            case '3': optra = 'bus_acumulados'; break;
            case '4': optra = 'bus_cumpliran'; break;
        }
        var texto= optra+"&&ape="+apebu+"&&cod="+codbu+"&&nom="+nombu+"&&mes="+mesbu+"&&are="+arebu+"&&are2="+are2b;
        window.location="../modificar/listado?opt=Historial_Vacaciones&&optra="+texto;
    });

});