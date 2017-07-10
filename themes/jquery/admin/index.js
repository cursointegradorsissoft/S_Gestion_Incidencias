$(document).ready(function(){
    $( ".accordion" ).accordion();
});


$(document).ready(function(){
   $(".calendario").datepicker({
    changeMonth: true 
    });
});


$(function(){
    cal_ini("2015-12-31");
});

var myCalendar, myCalendar2;
function cal_ini(f) {
    fec_act=new Date;
    fecha= fec_act.getFullYear() + "-" + "0"+(fec_act.getMonth()+1)+ "-"+ fec_act.getDate();
    anios= fec_act.getFullYear();
    myCalendar = new dhtmlXCalendarObject(["date","date0","date1","date2","date3","date4","date5","date6","date7","date8","date9","date10","date11","date12","date13","date14","date15","date16","date17","date18","date19","date20","date21","date22","date23","date24"]);
    myCalendar.setDate(fecha);
    
        
    myCalendar2 = new dhtmlXCalendarObject(["date25","date26","date27","date28","date29","date30","date31","date32","date33","date34","date35","date36","date37","date38","date39","date40","date41","date42","date43","date44","date45","date46","date47","date48","date49","date50"]);
    myCalendar2.setDate(fecha);
}



$(document).ready(function(){
    $('.mensajeria').click(function(){
        $(this).animate({height:'250px',width:'250px'},'slow',function(){
            $(this).animate({bottom:'15px',right:'10px'},300,function(){
                $(this).animate({bottom:'10px'},300,function(){
                    $(this).animate({bottom:'15px'},300,function(){
                        $(this).animate({bottom:'10px'},300)
                    })
                })
            })
        });
    });

    $('.cabecera').click(function(){
        $(this).animate({width:'100%',fontSize:'15px'},300);
    });
});



$(document).ready(function(){
    $('footer').click(function(){
        $('.mensajeria').animate({width:'180px',height:'25px',fontSize:'12px'},500);
    });
});



window.onload = function(){inactividad();}
window.onload = function(){Desactivar();}


function inactividad(){
    setTimeout("location.href='salir';",900000);
}


function Desactivar(){
    for (var i = 1; i <= 100; i++) {
        if($(".text"+i).length>0){
            $(".text"+i).attr("disabled",true);
        }
    }
}


function Activar(){
    for (var i = 1; i <= 100; i++) {
        $('.text'+i).attr('disabled',false);
    }
}

function Listado(){
    $('.listado').css({display:'block'});
    $('.registro').css({display:'none'});
}

$(document).ready(function(){
    $('#boton').click(function(){
        $('.listado').css({display:'none'});
        $('.registro').css({display:'block'});
    });
});


/* PARA MANEJO DE MENUS */

function DesBoton(){
    $("#btn1").attr("disabled",true);
    //document.getElementById('btn7').disabled = true;
    //document.getElementById('btn8').disabled = true;
    $("#btn1").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
    $("#btn7").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
    $("#btn8").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
}

function BtnAnadir(){
    $("#btn4").attr("disabled",true);
    $("#btn5").attr("disabled",true);
    $("#btn6").attr("disabled",true);

    $("#btn4").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
    $("#btn5").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
    $("#btn6").css({background: "rgba(199,199,199,1)", opacity:"0.5"});

    $("#btn7").attr("disabled",false);
    $("#btn8").attr("disabled",false);
    $("#btn7").css({background: "none", opacity:"1"});
    $("#btn8").css({background: "none", opacity:"1"});
}

function Habilitar(){
    $('.deta').css({
        background:'rgba(235,235,235,1)',
        borderTop: '1px solid rgba(0,0,0,0.5)',
        borderLeft: "1px solid rgba(0,0,0,0.5)",
        borderRight: "1px solid rgba(0,0,0,0.5)",
        borderBottom: "1px solid rgba(81,142,204,1)"
    });

    $('.deta2').css({
        background:'none',
        borderTop: "1px solid rgba(81,142,204,1)",
        borderLeft: "1px solid rgba(81,142,204,1)",
        borderRight: "1px solid rgba(81,142,204,1)",
        borderBottom: "none"
    });
}

function visualizar()
{
    setTimeout("$('#boton').click();",1000);
}

function nuevoAjax()
{ 
    var xmlhttp=false;
    try
    {
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
        try
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(E)
        {
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
        }
    }
    return xmlhttp; 
}


$(document).ready(function(){
    $(".listado table a").click(function(){
        Desactivar();
    });

    DesBoton();

    $(".listado-view table td a").click(function(){

        

        Habilitar(); 
        $('.contenido').css({display: "none"});
        $('.contenido2').css({display: "block"});

        $("#btn8").css({background: "none", opacity:"1"});

        
        var link = $(this).attr('href');
        var rest = link.substring(6,(link.length)+6);
        $("#cod").val(rest);
        $("#cod2").val(rest);
        
        var imagen= $(this).parent().parent().children("td:eq(11)").text();
        $("td #img").attr('src','../themes/images/employ/'+imagen+'');

        $("td #codMod").val($(this).parent().parent().children("td:eq(0)").text());

        $("td #busqueda9").val($(this).parent().parent().children("td:eq(4)").text());

        $("table td .imagen").attr('src','../themes/images/news/'+rest+'.jpg');
        $("table td .imagen").css({width:'95%',height:'10%'});

        
        $("#list2 #imagen2").html("<img src='../themes/images/sedes/"+rest+"/1.jpg' />");

        for(var x=1;x<100;x++)
        {
           $(".text"+x).val($(this).parent().parent().children("td:eq("+x+")").text()); 
           $(".text"+x).val($(this).parent().parent().children("td:eq("+x+")").text());
        }
    });

    $(".boton #boton2").click(function(){
        Habilitar();
        $('.contenido').css({display: "none"});
        $('.contenido2').css({display: "block"});
    });

    $(".listado-view2 table a").click(function(){
        Habilitar(); 
        $('.contenido').css({display: "none"});
        $('.contenido2').css({display: "block"});

        $("#btn8").css({background: "none", opacity:"1"});


        var link = $(this).attr('href');
        var rest = link.substring(6,(link.length)+6);
        $("#cod").val(rest);
        $("#cod2").val(rest);
        
        var imagen= $(this).parent().parent().children("td:eq(11)").text();
        $("#list1 #imagen1").html("<img src='../themes/images/employ/"+imagen+"' >");

        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion=opt_firma_traba&cod="+rest, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                if(cadena==""){
                    $("#list4 #imagen4").html("<img src='../themes/images/firmas/no-disponible.jpg' >");
                }else{
                    $("#list4 #imagen4").html("<img src='../themes/images/firmas/"+cadena+"' >");
                }
            }
        }
        ajax.send(null);


        $("td #codMod").val($(this).parent().parent().children("td:eq(0)").text());

        $("td #busqueda9").val($(this).parent().parent().children("td:eq(4)").text());

        $("table td .imagen").attr('src','../themes/images/news/'+rest+'.jpg');
        $("table td .imagen").css({width:'95%',height:'10%'});

        for(var x=1;x<100;x++)
        {
           $(".text"+x).val($(this).parent().parent().children("td:eq("+x+")").text()); 
        }
    });


    $("#btn4").click(function(){
        BtnAnadir();
        Habilitar();
        $('.contenido').css({display: "none"});
        $('.contenido2').css({display: "none"});
        $('.contenido3').css({display: "block"});
        Desactivar();
    });

    $("#btn5").click(function(){
        BtnAnadir();
        Activar();
    });

    $("#btn6").click(function(){ 
        setTimeout("$('#boton').click();");
    });

    $("#btn8").click(function(){ 
       setTimeout("$('#boton').click();");
    });

});


$(document).ready(function(){

    var alto = parseInt(screen.height);
    var ancho = parseInt(screen.width);
    var centroalto = parseInt((alto / 2));
    var centroancho = parseInt((ancho / 2));
    var Xpopud = centroancho - parseInt((450 / 2));
    var Ypopud = centroalto - parseInt((550 / 2));


    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=450, height=500, top="+Ypopud+", left="+Xpopud;

    function popud9()
    {
        $("#bloque").fadeIn();
        window.open("../modificar/personal","",opciones);
    }

    $(".busqueda1").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/local","",opciones);
    });

    $(".busqueda2").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/cargo","",opciones);
    });

    $(".busqueda3").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/area","",opciones);
    });

    $(".busqueda4").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/subarea","",opciones);
    });

    $("#busqueda5").dblclick(function(){
        $("#bloque").fadeIn();
       window.open("../modificar/local","",opciones);
    });

    $("#busqueda6").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/cargo","",opciones);
    });

    $("#busqueda7").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/area","",opciones);
    });

    $("#busqueda8").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/subarea","",opciones);
    });

    $("#busqueda9").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/personal","",opciones);
    });

    $("#busqueda10").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/personal","",opciones);
    });

    $(".buscar_jefe").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/personal","",opciones);
    });

    $("#busqueda11").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/vacaciones","",opciones);
    });

    $("#busqueda12").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/vacaciones","",opciones);
    });

    $(".busqueda13").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/area","",opciones);
    });

    $(".busqueda14").dblclick(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/permisos","",opciones);
    });

    $(".sol_vac").click(function(){
        $("#bloque").fadeIn();
        window.open("../modificar/solicitud","",opciones);
    });

});


function cerrar(m) {
    $.msgBox({
        title: "Cerrar Sesi&oacute;n",
        content: m,
        type: "info",
        buttons: [{ value: "Si" }, { value: "No"}],
        success: function (result) {
            if (result == "Si") {
                location.href = 'salir';
            }
            else
            {
                location.href = '#';
            }
        }
    });
}


function agrego() {
    $.msgBox({
        title: "Registro Satisfactorio",
        content: 'Verifique en su listado',
        type: "info",
        buttons: [{ value: "Ok" }],
        success: function (result) {
            if (result == "Ok") {
                location.href = '#';
            }
        }
    });
}


function informe(m) {
    $.msgBox({
        title: "Mensaje de Informacion",
        content: m,
        type: "info",
        buttons: [{ value: "Ok" }],
        success: function (result) {
            if (result == "Ok") {
                location.href = '#';
            }
        }
    });
}


function error() {
    $.msgBox({
        title: "Vuelva a Intentarlo",
        content: 'Ingrese todos los par&aacute;metros',
        type: "info",
        buttons: [{ value: "Ok" }],
        success: function (result) {
            if (result == "Ok") {
                location.href = '#';
            }
        }
    });
}

function eliminado() {
    $.msgBox({
        title: "Registro Eliminado",
        content: 'Eliminado Satisfactoriamente',
        type: "info",
        buttons: [{ value: "Ok" }],
        success: function (result) {
            if (result == "Ok") {
                location.href = '#';
            }
        }
    });
}

function ayuda(m) {
    $.msgBox({
        title: "Mensaje de Informaci&oacute;n",
        content: m,
        type: "alert",
        buttons: [{ value: "Listo" }],
        success: function (result) {
            if (result == "Listo") {
                location.href = '#';
            }
        }
    });
}

function herramienta(m) {
    $.msgBox({
        title: "Panel de Herramientas",
        content: "Falta Implementar",
        type: "prompt",
        inputs  : [
          {type: "text", label:"Tu Correo:", value:"BraillardPeru.com.pe", required: true}
        ],
        buttons: [{ value: "Comprendo" }],
        success: function (result) {
            if (result == "Comprendo") {
                location.href = '#';
            }
        }
    });
}

$(function(){
    $("#files").on('change',function(){
        $('#imagen2').html('');
        var archivos = document.getElementById('files').files;
        var navegador = window.URL || window.webkitURL;

        for(x=0; x<archivos.length ; x++) 
        {
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name= archivos[x].name;
            
            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/gif')
            {
                $('#imagen2').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
            }
            else
            {
                var objeto_url = navegador.createObjectURL(archivos[x]);
                $("#imagen2").append("<img src="+objeto_url+">");
            }
        }
    });
});

$(function(){
    $("#files2").on('change',function(){
        $('#imagen').html('');
        var archivos = document.getElementById('files2').files;
        var navegador = window.URL || window.webkitURL;

        for(x=0; x<archivos.length ; x++) 
        {
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name= archivos[x].name;
            
            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/gif')
            {
                $('#imagen').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
            }
            else
            {
                var objeto_url = navegador.createObjectURL(archivos[x]);
                $("#imagen").append("<img src="+objeto_url+">");
            }
        }
    });
});


/* AÑADIDO RECIENTEMENTE */
$(function(){
    $("#files3").on('change',function(){
        $('#imagen3').html('');
        var archivos = document.getElementById('files3').files;
        var navegador = window.URL || window.webkitURL;

        for(x=0; x<archivos.length ; x++) 
        {
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name= archivos[x].name;
            
            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/gif')
            {
                $('#imagen3').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
            }
            else
            {
                var objeto_url = navegador.createObjectURL(archivos[x]);
                $("#imagen3").append("<img src="+objeto_url+">");
            }
        }
    });


    $("#files1").on('change',function(){
        $('#imagen1').html('');
        var archivos = document.getElementById('files1').files;
        var navegador = window.URL || window.webkitURL;

        for(x=0; x<archivos.length ; x++) 
        {
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name= archivos[x].name;
            
            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/gif')
            {
                $('#imagen1').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
            }
            else
            {
                var objeto_url = navegador.createObjectURL(archivos[x]);
                $("#imagen1").append("<img src="+objeto_url+">");
            }
        }
    });


    $("#files4").on('change',function(){
        $('#imagen4').html('');
        var archivos = document.getElementById('files4').files;
        var navegador = window.URL || window.webkitURL;

        for(x=0; x<archivos.length ; x++) 
        {
            var size = archivos[x].size;
            var type = archivos[x].type;
            var name= archivos[x].name;
            
            if(type!= 'image/jpg' && type!= 'image/png' && type!= 'image/jpeg' && type!= 'image/gif')
            {
                $('#imagen4').append("<p style='color:red'>El tipo "+type+" no es permitido</p>");
            }
            else
            {
                var objeto_url = navegador.createObjectURL(archivos[x]);
                $("#imagen4").append("<img src="+objeto_url+">");
            }
        }
    });
});

/* SOLO HASTA AQUI */


/* VALIDACION DE CAMPOS */
function ValTexto(x)
{
    var dato = $(x).val();
    if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
    {
        event.returnValue = false;
        $(x).attr('placeholder','Solo Texto');
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
    else
    {
        $(x).css({color:'rgba(0,51,102,1)'});
        $(x).css({background:'rgba(255,255,255,1)'});
    }
}

function valtitulo(x) {
    var e= event.keyCode;
    if ( ((e<48) || (e>57)) || ((e!=32) && (e<65) || (e>90) && (e<97) || (e>122)) )
    {
        $(x).css({background:'rgba(255,255,255,1)'});
    } 
    else 
    {
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
}

function ValNumero(x)
{
    var dato = $(x).val();
    if ((event.keyCode < 48) || (event.keyCode > 57)) 
    {
        event.returnValue = false;
        $(x).attr('placeholder','Solo Numeros');
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
    else
    {
        $(x).css({color:'rgba(0,51,102,1)'});
        $(x).css({background:'rgba(255,255,255,1)'});
    }
}

function ValNumero2(x)
{
    var dato = $(x).val();
    if(dato>12 || dato<1)
    {
        event.returnValue = false;
        $(x).attr('placeholder','Rango no Permitido');
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
    else
    {
        $(x).css({color:'rgba(0,51,102,1)'});
        $(x).css({background:'rgba(255,255,255,1)'});
    }
}


function ValNumeroAnio(x)
{
    var dato = $(x).val();
    if(dato>2020 || dato<2010)
    {
        event.returnValue = false;
        $(x).attr('placeholder','Rango no Permitido');
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
    else
    {
        $(x).css({color:'rgba(0,51,102,1)'});
        $(x).css({background:'rgba(255,255,255,1)'});
    }
}


function moneda(x) {
    var expreg2 = /(\d{2})(?:\.(\d{0,2}))?/;
    var dato= $(x).val();

    if ( !((event.keyCode < 48) || (event.keyCode > 57)) || expreg2.test(dato))
    {
        $(x).css({background:'rgba(255,255,255,1)'});
    } 
    else 
    {
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
}


function validarEmail(x) {
    var expreg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    var dato= $(x).val();
    
    if (expreg.test(dato))
    {
        $(x).css({background:'rgba(255,255,255,1)'});
    } 
    else 
    {
        $(x).css({background:'rgba(255,0,0,0.1)'});
    }
}


$(document).ready(function(){
    var intervalo = setInterval("rangodias()", 500);
});


function rangodias()
{
    if($(".fecini").length>0 && $(".fecfin").length>0){
        var fechaini = $('.fecini').val();
        var fechafin = $('.fecfin').val();

        var fechaini2 = $('.inifec').val();
        var fechafin2 = $('.finfec').val();

        if(fechaini!="" && fechafin!=""){
            var car1= fechaini.substring(2,3).trim();
            var car2= fechafin.substring(2,3).trim();
            var aFecha1 = fechaini.split(car1); 
            var aFecha2 = fechafin.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
            var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            $(".totday").val(dias+1);
        }

        if(fechaini2!="" && fechafin2!=""){
            var car1= fechaini2.substring(2,3).trim();
            var car2= fechafin2.substring(2,3).trim();
            var aFecha1 = fechaini2.split(car1); 
            var aFecha2 = fechafin2.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
            var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            $(".totdias2").val(dias+1);
        }
    }
    
}


function valclave(x)
{
    var clave1=$(".cla1").val();
    var clave2=$(".cla2").val();
    if(clave1 != clave2)
    {
        $(".span").css({color:"red"});
        $(".span").html("Claves no coinciden");
        $(".cla1").css({background:"rgba(255,0,0,0.1)"});
        $(".cla2").css({background:"rgba(255,0,0,0.1)"});
    }else{
        $(".span").html("");
        $(".cla1").css({background:"none"});
        $(".cla2").css({background:"none"});
    }
}


function valclave2(x)
{
    var clave1=$(".cla3").val();
    var clave2=$(".cla4").val();
    if(clave1 != clave2)
    {
        $(".span").css({color:"red"});
        $(".span").html("Claves no coinciden");
        $(".cla3").css({background:"rgba(255,0,0,0.1)"});
        $(".cla4").css({background:"rgba(255,0,0,0.1)"});
    }else{
        $(".span").html("");
        $(".cla3").css({background:"none"});
        $(".cla4").css({background:"none"});
    }
}


$(function(){
    $(".rrhh").click(function(){
        var data=$(this).val();
        if(data=="A"){
            $(".rrhh img").css({"display":"block"});
            $(".arriba .rrhh img").attr('src','../themes/images/firma1.jpg');
        }else{
            $(".rrhh img").css({"display":"block"});
            $(".rrhh img").attr("src","../themes/images/cancelado.jpg");
            $(".rrhh img").css({"width":"80%","height":"90%","margin-left":"25px", "margin-top":"10px"});
        }
    });

    $(".employ").click(function(){
        var data=$(this).val();
        if(data=="A"){
            $(".employ img").css({"display":"block"});
            $(".arriba .employ img").attr('src','../themes/images/firma2.jpg');
        }else{
            $(".employ img").css({"display":"block"});
            $(".employ img").attr("src","../themes/images/cancelado.jpg");
            $(".employ img").css({"width":"80%","height":"90%","margin-left":"25px", "margin-top":"10px"});
        }
    });

    $(".jefe").click(function(){
        var data=$(this).val();
        if(data=="A"){
            $(".jefe img").css({"display":"block"});
            $(".arriba .jefe img").attr('src','../themes/images/firma3.jpg');
        }else{
            $(".jefe img").css({"display":"block"});
            $(".jefe img").attr("src","../themes/images/cancelado.jpg");
            $(".jefe img").css({"width":"80%","height":"90%","margin-left":"25px", "margin-top":"10px"});
        }
    });

})







$(function(){
    var total=$(".totales").val();

    $(".radio").click(function(){
        $(".cajadia").attr("disabled","true");
        var valor=parseInt($(this).val())-1;
        var fechaini = $('.inicio').val();
        var fin=sumaFecha(valor,fechaini);

        var retorno=total-valor;

        $(".totales").val(retorno);
        $(".fechafin").val(fin);
        if(retorno<0){
            var mensaje="Ud. est&aacute; excediendo del valor permitido, solo tiene "+total+" d&iacute;as disponibles.</br> Vuelva a intentarlo";
            informe(mensaje);
            $("#btn7").attr("disabled",true);
            $("#btn7").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
        }
        else
        {
            $("#btn7").attr("disabled",false);
            $("#btn7").css({background: "none", opacity:"1"});
        }
    })

    $(".cajadia").blur(function(){
        $(".radio").attr("disabled","true");
        var valor=parseInt($(this).val())-1;
        var fechaini = $('.inicio').val();
        var fin=sumaFecha(valor,fechaini);
        var retorno=total-valor;

        $(".totales").val(retorno);
        $(".fechafin").val(fin);
        if(retorno<0){
            var mensaje="Ud. est&aacute; excediendo del valor permitido, solo tiene "+total+" d&iacute;as disponibles.</br> Vuelva a intentarlo";
            informe(mensaje);
            $("#btn7").attr("disabled",true);
            $("#btn7").css({background: "rgba(199,199,199,1)", opacity:"0.5"});
        }
        else
        {
            $("#btn7").attr("disabled",false);
            $("#btn7").css({background: "none", opacity:"1"});
        }
    })


    $(".inicio").change(function(){
        var fechaini = $(this).val();
        var valor = parseInt($(".cajadia").val())-1;
        var valor2 = parseInt($(".radio").val())-1;
        if($(".fechafin").val()!= "")
        {
            if(valor>0 && valor2==0)
            {
                var fin=sumaFecha(valor,fechaini);
            }
            else if(valor==0 && valor2>0)
            {
                var fin=sumaFecha(valor2,fechaini);
            } 
            $(".fechafin").val(fin);
        }
    })

})






sumaFecha = function(d, fecha)
{
     var Fecha = new Date();
     var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
     var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
     var aFecha = sFecha.split(sep);
     var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
     fecha= new Date(fecha);        
     fecha.setDate(fecha.getDate()+parseInt(d));
     var anno=fecha.getFullYear();
     var mes= fecha.getMonth()+1;
     var dia= fecha.getDate();
     mes = (mes < 10) ? ("0" + mes) : mes;
     dia = (dia < 10) ? ("0" + dia) : dia;
     var fechaFinal = dia+sep+mes+sep+anno;
     return (fechaFinal);
 }





/* FUNCION DEL CORREO (ACCESO DE DATO CORREO) */

$(function(){

    $(".correo").keypress(function(){
        var nombre=$(".nombre").val();
        var apelli=$(this).val();
        var correo=nombre.substring(0,1)+apelli+"@braillardperu.com";
        $(".mail").val(correo.toUpperCase());
    })

    $(".correo").blur(function(){
        var nombre=$(".nombre").val();
        var apelli=$(this).val();
        var correo=nombre.substring(0,1)+apelli+"@braillardperu.com";
        $(".mail").val(correo.toUpperCase());
    })

});





/* CLONACION DE EVENTO TR */
$(function(){
    $(".clonar").click(function(){
        var valor=$(".clonar").index(this);
        var posicion=parseInt(valor)+1;
        alert(posicion);
        var $tabla = $('.tbody'),
            $siguiente = $tabla.find("tbody").children("tr:eq("+posicion+")"),
            $nuevo = $siguiente.clone(this);
            $siguiente.after($nuevo);
    });
});




/* VALIDAR NIVEL DE SEGURIDAD */

$(function(){
    $(".nivel_seg").css({"background":"#F5BCA9", "width":"100%", "border-radius":"5px", "text-align":"center"}); 
    $(".nivel_seg").attr({"disabled":true}); 

    $(".cla1").keyup(function(){
        var valor=$(this).val();
        if( valor.indexOf('_')>-1){
            $(".nivel_seg").val("Insegura");
            $(".nivel_seg").css({"background":"#D8F781"}); 
            if(valor.indexOf('@')>-1){
                $(".nivel_seg").val("Confiable");
                $(".nivel_seg").css({"background":"#9AFE2E"}); 
                if(valor.indexOf('-')>-1){
                    $(".nivel_seg").val("Asegurado");
                    $(".nivel_seg").css({"background":"#58FAD0"}); 
                } 
            }  
        }
        else
        {
             $(".nivel_seg").val("Inseguro");
             $(".nivel_seg").css({"background":"#81BEF7"});   
        }
    })
})

/* FUNCION PARA LOS MEDIA QUERY */
$(function(){

    $(".menu_min").mouseover(function () {
        $(".container-left-2").animate({"margin-left":"0px"},500);
        $(".container-left-2").css({"display":"block"});
    }).mouseout(function () {
         $(".container-left-2").animate({"margin-left":"-500px"},500);
    });

    $(".container-left-2").mouseover(function () {
        $(this).css({"display":"block"});
    })
    

})


/* PROPORCIONAR CLAVE PERSONAL A CADA USUARIO */
$(function(){

    $('.val_check').prop('checked', true);
    $('.fecini').prop('disabled', true);
    $('.fecfin').prop('disabled', true);
    $('.codigo').prop('disabled', true);
    $('.nombre').prop('disabled', true);
    $('.apellido').prop('disabled', true);

    $(".val_check").click(function(){
        if($('.val_check').is(':checked') )
        {
            $('.fecini').prop('disabled', true);
            $('.fecfin').prop('disabled', true);
            $('.codigo').prop('disabled', true);
            $('.nombre').prop('disabled', true);
            $('.apellido').prop('disabled', true);
            
            $('.fecini').val("");
            $('.fecfin').val("");
            $('.codigo').val("");
            $('.nombre').val("");
            $('.apellido').val("");

            $(".habilitar_ch").html("Habilitar");  
        }else{
            $('.fecini').prop('disabled', false);
            $('.fecfin').prop('disabled', false);
            $('.codigo').prop('disabled', false);
            $('.nombre').prop('disabled', false);
            $('.apellido').prop('disabled', false);
            $(".habilitar_ch").html("Deshabilitar");  
        }
    });

    $(".dni_new").keyup(function(){
        var perdn=$(this).val();
        var fecin=$(".perfin").val();
        var perno=$(".pernom").val();
        var peram=$(".perapm").val();
        var perfn=$(".perfn").val();        
        var clanew=fecin.substring(3,5)+perno.substring(0,1)+perdn.substring(0,2)+peram.substring(0,1)+perdn.substring(4,6)+perfn.substring(8,10);

        $(".clanewadd").val(clanew);
    });
});



/* FUNCION PARA LAS PESTAÑAS DE PERMISOS  UNICAMENTE PARA VIGILANCIA */
$(function(){

    $('.inicio_time').ptTimeSelect();
    $('.fin_time').ptTimeSelect();

    $(".pest_comi").click(function(){
        $(".pest_comi").css({"background":"white","border-top":"1px solid rgba(81,142,204,1)","border-left":"1px solid rgba(81,142,204,1)","border-right":"1px solid rgba(81,142,204,1)","border-bottom": "none"});
        $(".pest_pers").css({"background":"rgba(235,235,235,1)","border-top":"1px solid rgba(0,0,0,0.5)","border-left":"1px solid rgba(0,0,0,0.5)","border-right":"1px solid rgba(0,0,0,0.5)","border-bottom": "1px solid rgba(81,142,204,1)"});
        $(".pest_comi").attr("val","1");
        $(".pest_pers").attr("val","0");
        $(".inferior input:radio").attr('checked',false);
        $(".filtrar_vigilancia").html("");
    })

    $(".pest_pers").click(function(){
        $(".pest_pers").css({"background":"white","border-top":"1px solid rgba(81,142,204,1)","border-left":"1px solid rgba(81,142,204,1)","border-right":"1px solid rgba(81,142,204,1)","border-bottom": "none"});
        $(".pest_comi").css({"background":"rgba(235,235,235,1)","border-top":"1px solid rgba(0,0,0,0.5)","border-left":"1px solid rgba(0,0,0,0.5)","border-right":"1px solid rgba(0,0,0,0.5)","border-bottom": "1px solid rgba(81,142,204,1)"});
        $(".pest_comi").attr("val","0");
        $(".pest_pers").attr("val","1");
        $(".inferior input:radio").attr('checked',false);
        $(".filtrar_vigilancia").html("");
    })

    $(".tipo_tem").click(function(){
        var nombres=$(".nom_emp").val();
        var valor_comi=parseInt($(".pest_comi").attr("val"));
        var valor_pers=parseInt($(".pest_pers").attr("val"));
        var texto_comi=$(".pest_comi").html();
        var texto_pers=$(".pest_pers").html();
        var radio_acti=$("input:radio[name=tipo_tem]:checked").val();
        var ruta="";
        if(valor_comi>valor_pers){
            ruta="buscar_comisiones&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }else{
            ruta="buscar_personal&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }
        $(".filtrar_vigilancia").html("");

        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_vigilancia").html(cadena);
            }
        }
        ajax.send(null);
    })
    

    $(".nom_emp").keyup(function(){
        var nombres=$(".nom_emp").val();
        var valor_comi=parseInt($(".pest_comi").attr("val"));
        var valor_pers=parseInt($(".pest_pers").attr("val"));
        var texto_comi=$(".pest_comi").html();
        var texto_pers=$(".pest_pers").html();
        var radio_acti=$("input:radio[name=tipo_tem]:checked").val();
        var ruta="";
        console.log(nombres);
        if(valor_comi>valor_pers){
            ruta="buscar_comisiones&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }else{
            ruta="buscar_personal&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }
        $(".filtrar_vigilancia").html("");

        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_vigilancia").html(cadena);
            }
        }
        ajax.send(null);
    })
    
    
    $(".ver_filtro").click(function(){
        var nombres=$(".nom_emp").val();
        var valor_comi=parseInt($(".pest_comi").attr("val"));
        var valor_pers=parseInt($(".pest_pers").attr("val"));
        var texto_comi=$(".pest_comi").html();
        var texto_pers=$(".pest_pers").html();
        var radio_acti=$("input:radio[name=tipo_tem]:checked").val();
        var ruta="";
        if(valor_comi>valor_pers){
            ruta="buscar_comisiones&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }else{
            ruta="buscar_personal&&tipo="+radio_acti+"&&est=AR&&nom="+nombres;
        }
        $(".filtrar_vigilancia").html("");

        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_vigilancia").html(cadena);
            }
        }
        ajax.send(null);
    })

    $(".boton_aplicando").click(function(){
        alert("Enviando Correctamente");
    })

})


function boton_comision(val,tipo,opcion){
    var inicio=$(".sal"+val).val();
    var fin=$(".ret"+val).val();
    $(".filtrar_vigilancia").html("");
    ruta="actualizar_vigilante&&tipo="+opcion+"&&cod="+val+"&&ini="+inicio+"&&fin="+fin;
    var ajax=nuevoAjax();
    ajax.open("GET", "funcion?opcion="+ruta, true);
    ajax.onreadystatechange=function() 
    { 
        if (ajax.readyState==4 && ajax.status==200)
        {
            var xmlre = ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('{+}');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            $(".ver_filtro").trigger("click");
          }
    }
    ajax.send(null);
}



/* ACCIONES PARA PERMISOS DE JEFATURA */
$(function(){
    $(".ver_filtro_jef").click(function(){
        var estado=$(".estado").val();
        var concep=$(".concepto").val();
        var tipo=$(".tipo").val();
        var ruta="";
        ruta="filtrar_jefatura&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_jefatura").html(cadena);
            }
        }
        ajax.send(null);
    })

    $(".concepto").change(function(){
        var estado=$(".estado").val();
        var concep=$(".concepto").val();
        var tipo=$(".tipo").val();
        var ruta="";
        ruta="filtrar_jefatura&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_jefatura").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".tipo").change(function(){
        var estado=$(".estado").val();
        var concep=$(".concepto").val();
        var tipo=$(".tipo").val();
        var ruta="";
        ruta="filtrar_jefatura&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_jefatura").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".estado").change(function(){
        var estado=$(".estado").val();
        var concep=$(".concepto").val();
        var tipo=$(".tipo").val();
        var ruta="";
        ruta="filtrar_jefatura&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_jefatura").html(cadena);
            }
        }
        ajax.send(null);
    });

})


function accionJef(codigo){
    var valor="";
    if( $("input[name='opt"+codigo+"']:radio").is(':checked')) 
    {  
        valor=$("input:radio[name='opt"+codigo+"']:checked").val();

        ruta="permisos_jefatura_solicitud&&cod="+codigo+"&&opt="+valor;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".ver_filtro_jef").trigger("click");
            }
        }
        ajax.send(null);
    } else{  
        alert("Selecciona Cancelar o Aprobar!!!"); 
    } 
}


/* ACCIONES PARA PERMISOS DE RECURSOS HUMANOS */

$(function(){
    $(".ver_filtro_rec").click(function(){
        var estado=$(".estado_rec").val();
        var concep=$(".concepto_rec").val();
        var tipo=$(".tipo_rec").val();
        var area=$(".area_rec").val();
        var ruta="";
        ruta="filtrar_recursos&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado+"&&area="+area;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_recursos").html(cadena);
            }
        }
        ajax.send(null);
    })

    $(".concepto_rec").change(function(){
        var estado=$(".estado_rec").val();
        var concep=$(".concepto_rec").val();
        var tipo=$(".tipo_rec").val();
        var area=$(".area_rec").val();
        var ruta="";
        ruta="filtrar_recursos&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado+"&&area="+area;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_recursos").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".tipo_rec").change(function(){
        var estado=$(".estado_rec").val();
        var concep=$(".concepto_rec").val();
        var tipo=$(".tipo_rec").val();
        var area=$(".area_rec").val();
        var ruta="";
        ruta="filtrar_recursos&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado+"&&area="+area;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_recursos").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".estado_rec").change(function(){
        var estado=$(".estado_rec").val();
        var concep=$(".concepto_rec").val();
        var tipo=$(".tipo_rec").val();
        var area=$(".area_rec").val();
        var ruta="";
        ruta="filtrar_recursos&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado+"&&area="+area;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_recursos").html(cadena);
            }
        }
        ajax.send(null);
    });

    $(".area_rec").change(function(){
        var estado=$(".estado_rec").val();
        var concep=$(".concepto_rec").val();
        var tipo=$(".tipo_rec").val();
        var area=$(".area_rec").val();
        var ruta="";
        ruta="filtrar_recursos&&tipo="+tipo+"&&concep="+concep+"&&estado="+estado+"&&area="+area;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".filtrar_recursos").html(cadena);
            }
        }
        ajax.send(null);
    })
})


function accionRec(codigo){
    var valor="";
    if( $("input[name='opt"+codigo+"']:radio").is(':checked')) 
    {  
        valor=$("input:radio[name='opt"+codigo+"']:checked").val();

        ruta="permisos_recursos_solicitud&&cod="+codigo+"&&opt="+valor;
        var ajax=nuevoAjax();
        ajax.open("GET", "funcion?opcion="+ruta, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('{+}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".ver_filtro_rec").trigger("click");
            }
        }
        ajax.send(null);
    } else{  
        alert("Selecciona Cancelar o Aprobar!!!"); 
    } 
}



/* DOCUMENTO FINAL DE PERMISOS */
function documento_permiso(sol){
    var area=$(".area_rh").val();
    $(this).parent().attr("target","_blank");
    window.open("../pdf_permiso?perm="+sol+"&&a="+area);
}