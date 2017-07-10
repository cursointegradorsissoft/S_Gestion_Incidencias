function muestraReloj() {
    var fechaHora = new Date();
    var horas = fechaHora.getHours();
    var minutos = fechaHora.getMinutes();
    var segundos = fechaHora.getSeconds();
    if(horas < 10) { horas = '0' + horas; }
    if(minutos < 10) { minutos = '0' + minutos; }
    if(segundos < 10) { segundos = '0' + segundos; }
    document.getElementById("reloj").innerHTML = horas+':'+minutos+':'+segundos;
}

window.onload = function() {
  setInterval(muestraReloj, 1000);
}

$(function(){
	$(".evento_menu").click(function(){
		$("#menu_opt").fadeIn();
	});
});


/* PARA SLIDER DEL INDEX */
jQuery(document).ready(function ($) {
    var options = {
        $AutoPlay: true,   
        $AutoPlaySteps: 1,                                 
        $AutoPlayInterval: 2000,                           
        $PauseOnHover: 1, 
        $ArrowKeyNavigation: true,  
        $SlideDuration: 500,        
        $MinDragOffsetToSlide: 20,                        
        $SlideSpacing: 0, 
        $DisplayPieces: 1, 
        $ParkingPosition: 0,  
        $UISearchMode: 1, 
        $PlayOrientation: 1,                                
        $DragOrientation: 3,                                

        $BulletNavigatorOptions: { 
            $Class: $JssorBulletNavigator$, 
            $ChanceToShow: 2, 
            $ActionMode: 1,
            $AutoCenter: 2,                                 
            $Lanes: 1,
            $SpacingX: 10,
            $SpacingY: 10,
            $Orientation: 2 
        },

        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$,
            $ChanceToShow: 2, 
            $AutoCenter: 0                                  
        },

        $ThumbnailNavigatorOptions: {
            $Class: $JssorThumbnailNavigator$,
            $ChanceToShow: 2,
            $ActionMode: 0,
            $DisableDrag: true,
            $Orientation: 2 
        }
    };

    var jssor_slider2 = new $JssorSlider$("slider2_container", options);

    function ScaleSlider() {
        var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
        if (parentWidth)
            jssor_slider2.$SetScaleWidth(Math.min(parentWidth, 800));
        else
            window.setTimeout(ScaleSlider, 30);
    }

    ScaleSlider();

    /* FUNCION PARA MOBILE */
    if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
        $(window).bind('resize', ScaleSlider);
    }
});


/* SLIDER DEL INDEX (CUMPLEAÑOS, VACACIONES E INGRESOS) */
var actual=1;
var actual2=1;
var actual3=1;
$(document).on("ready", main());

function main(){
    var intervalo = setInterval("runSlider()", 3000);
    var intervalo = setInterval("runSlider2()", 4500);
    var intervalo = setInterval("runSlider3()", 5500);
}

function runSlider(){
    if(actual == $(".containerSlider").size()){
        actual = 0;
    }

    $("#containerSlider").animate({
        marginTop: (-1*actual*$("#containerSlider").eq(0).height())
    },1000);
    actual++;
}

function runSlider2(){
    if(actual2 == $(".containerSlider2").size()){
        actual2 = 0;
    }

    $("#containerSlider2").animate({
        marginTop: (-1*actual2*$("#containerSlider2").eq(0).height())
    },1000);
    actual2++;
}

function runSlider3(){
    if(actual3 == $(".containerSlider3").size()){
        actual3 = 0;
    }

    $("#containerSlider3").animate({
        marginTop: (-1*actual3*$("#containerSlider3").eq(0).height())
    },1000);
    actual3++;
}

