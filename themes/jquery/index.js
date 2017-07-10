/* FUNCION PARA CREAR UN OBJETO XML DE AJAX */

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

/* FUNCTIONS JS */
var a= jQuery.noConflict();


a(function(){
   a(".botones").click(function(){
        var valor=a(this).val();
        var boton=valor.split('-');
        var url=location.href.split('=');
        var codigo=url[1].split('&');
        var nombre=url[2];
        var ajax=nuevoAjax();

        ajax.open("GET","funcion?opcion=obtener_empleados&&cod="+codigo[0]+"&nom="+nombre+"&boton="+boton[1]+"&sub="+boton[0],true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                a(".vista_employ").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                a(".vista_employ").css({"overflow":"scroll","height":"70%"});
                a(".vista_employ").html(cadena);
            }
        }
        ajax.send(null);

   }) 
});






a.ajaxSetup({ cache: false });
/* CALENDARIO DINAMICO */

a(document).ready(function(){
    setInterval(muestraReloj, 1000);
    setInterval(toolbar,1000); 
});

window.addEvent('domready', function() {
    var calendarXIII = new CalendarEightysix('exampleXIII', { 'injectInsideTarget': true, 'alwaysShow': true, 'pickable': false });
    calendarXIII.addEvent('rendermonth', function(e) {
        e.elements.each(function(day) {
            day.set('title', day.retrieve('date').format('%A %d %B'));                  
        });
    });
    calendarXIII.render();      
});


/* PANTALLA DE INICIO */
function openDialog() {
    a('#overlay').fadeIn('fast', function() {
        a('#popup').css('display','block');
        a('#popup').animate({'left':'8%'},500);
    });
}

a(document).ready(function(){
    a('.overlay').click(function(){
        a('#popup').css('position','absolute');
        a('#popup').animate({'left':'-100%'}, 500, function() {
            a('#popup').css('position','fixed');
            a('#popup').css('left','100%');
            a('#overlay').fadeOut('fast');
        });
    });
});


a(document).ready(function(){
    a('#close').click(function(){
        a('#popup').css('position','absolute');
        a('#popup').animate({'left':'-100%'}, 500, function() {
            a('#popup').css('position','fixed');
            a('#popup').css('left','100%');
            a('#overlay').fadeOut('fast');
        });
    });
});


/* PARA TABS DE PAGINA EMPRESA */
a(document).ready(function() {
    a('.datos a').wowwindow({
        draggable: true
    });
});

a(document).ready(function() {
    a('.fancybox').fancybox();
});
/* PANTALLA DE BIENVENIDA */
a(document).ready(function() {
    a('body').click(function(){
        a('.bienvenido').css({display:'none'});
    });
});

a(document).ready(function(){
    a('.bienvenido').animate({
        width: '95%',
        height: '95%',
        margin: '0px auto',
        borderRadius: '3%',
        background: 'rgba(0,0,0,0.3)',
        zIndex: '3'
    },1000);
});



// FUNCIONES DE CALENDARIO CON VALIDACIONES 
a(function(){
    console.log("Aqui Bien");
    cal_ini();
});

var myCalendar, myCalendar2;
function cal_ini() {
    fec_act=new Date;
    fecha= fec_act.getFullYear() + "-" + "0"+(fec_act.getMonth()+1)+ "-"+  "0"+fec_act.getDate();
    anios= fec_act.getFullYear();
    myCalendar = new dhtmlXCalendarObject(["date","date0","date1","date3","date5","date6","date7","date8","date9","date10","date11","date12","date13","date14","date15","date16","date17","date18","date19","date20","date21"]);
    myCalendar.setDate(fecha);
    myCalendar.setSensitiveRange(fecha,null);
    setFrom(fecha); // DESHABILITAMOS MESES ANTERIORES
    setInInterval(fecha,'2030-12-31'); // ESTABLECER UN RANGO DE FECHAS
    disableDays([anios+'-01-01',anios+'-07-28',anios+'-07-29',anios+'-07-30']); //DESHABILITAR FERIADOS
    myCalendar.disableDays("week",[5,6]); //DESHABILITAR VIERNES Y SABADOS
    
    // CALENDARIO 2
    myCalendar2 = new dhtmlXCalendarObject(["date2","date4"]);
    myCalendar2.setDate(fecha); //AGREGAMOS FECHA + 1 DIA 
    myCalendar2.disableDays("week",[5,6]);
}

function disableDays(d) {
    myCalendar.disableDays("year",d);
}

function setFrom(f) {
    myCalendar.setSensitiveRange(f,null);
}

function setTo(f) {
    myCalendar.setSensitiveRange(null,f);
}

function setInInterval(f1,f2) {
    myCalendar.setSensitiveRange(f1,f2);
}

function clearRange() {
    myCalendar.clearSensitiveRange();
}

function setOutInterval(f1,f2) {
    myCalendar.setInsensitiveRange(f1,f2);
}
//TERMINA EL CALENDARIO


/* PARA CALENDARIO DE CUMPLEAÑOS */

a(document).ready(function(){
    a(window).load(function(){ a(window).resize() });
    
    a(window).resize(function(){
        var wscr = a(".datetime").width();
        var hscr = a(".datetime").height()-1-a('#barcal').height();
        var counttr = a("#minical tr").length-1; 
        var counttd = a("#minical th").length; 

        a('#minical').css("width", wscr);
        a('#minical').css("height", hscr);
        a('.bodybox').css("height",(hscr/counttr)-(a('.headbody').height()+a('#barcal').height()))
        a('#minical th').css("width",(wscr/counttd));
    });
    
    a('.prevmonth').click(function(){
        alert('mes anterior');
    });

    a('.nextmonth').click(function(){
        alert('mes siguiente');
    });

});




/* FUNCION PARA CAMBIO DE CUMPLEAÑOS */

function seteo_mes(mes){
    var num=parseInt(mes);
    var texto="";
    switch(num){
        case 1: texto="Enero"; break;
        case 2: texto="Febrero"; break;
        case 3: texto="Marzo"; break;
        case 4: texto="Abril"; break;
        case 5: texto="Mayo"; break;
        case 6: texto="Junio"; break;
        case 7: texto="Julio"; break;
        case 8: texto="Agosto"; break;
        case 9: texto="Setiembre"; break;
        case 10: texto="Octubre"; break;
        case 11: texto="Noviembre"; break;
        case 12: texto="Diciembre"; break;
    }
    return texto;
}

a(function(){
    a(".avanzar").click(function(){
        var index=a(this).attr("title");

        var agregar=parseInt(index)+1;
        var disminuir=parseInt(index);

        var valor=agregar;
        var valor2= disminuir;

        var texto=a(".title text").html();
        var texto2=texto.substring(texto.indexOf('C'),texto.indexOf('d')+3);

        if(agregar<10){
            valor="0"+valor;
            valor2="0"+disminuir;
        }
        else if(agregar==13){
            valor="0"+1;
            valor2="0"+disminuir;
        }
        else
        {
            valor=valor;
            valor2=valor2;
        }

        a(this).attr("title",valor);
        a(".retroceder").attr("title",valor2);
        a(".title text").html(texto2+seteo_mes(valor));
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=listar_cumpleanios&&mes="+valor,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                a(".lista-birthday").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                a(".lista-birthday").html(cadena);
            }
        }
        ajax.send(null);
    })


    a(".retroceder").click(function(){
        var index=a(this).attr("title");

        if( (parseInt(index)-1)==0 ){ index="12"; }else{index=index;}
        var agregar=parseInt(index)-1;
        var disminuir=parseInt(index);

        var valor=agregar;
        var valor2= disminuir;
        
        var texto=a(".title text").html();
        var texto2=texto.substring(texto.indexOf('C'),texto.indexOf('d')+3);

        if(agregar<10){
            valor="0"+valor;
            valor2=disminuir;
        }
        else
        {
            valor=valor;
            valor2=valor2;
        }
        a(this).attr("title",valor);
        a(".avanzar").attr("title",valor2);
        a(".title text").html(texto2+seteo_mes(disminuir));

        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=listar_cumpleanios&&mes="+disminuir,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                a(".lista-birthday").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                a(".lista-birthday").html(cadena);
            }
        }
        ajax.send(null);
    })
})

/* HASTA AQUI TERMINA LA FUNCION DE MANEJO DE PAGINACION DINAMICA */




/* FUNCIONES PARA LISTADO DE VACACIONES PROGRAMADAS  */
a(function(){

    a(".img_avan").click(function(){
        var index=a(this).attr("title");

        var agregar=parseInt(index)+1;
        var disminuir=parseInt(index);

        var valor=agregar;
        var valor2= disminuir;

        var texto=a(".title-pad").html();
        var texto2=texto.substring(texto.indexOf('P'),texto.indexOf('s')+1);

        if(agregar<10){
            valor="0"+valor;
            valor2="0"+disminuir;
        }
        else if(agregar==13){
            valor="0"+1;
            valor2="0"+disminuir;
        }
        else
        {
            valor=valor;
            valor2=valor2;
        }

        a(this).attr("title",valor);
        a(".img_retro").attr("title",valor2);
        a(".title-pad").html(texto2 + " : "+seteo_mes(valor));
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=listar_vac_pro&&mes="+valor,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                a(".vista_employ").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('{*}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                a(".vista_employ").html(cadena);
            }
        }
        ajax.send(null);
    })

    a(".img_retro").click(function(){
        var index=a(this).attr("title");
        var f = new Date();
        var anio=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
        if(parseInt(index)>= parseInt(f.getMonth()+1)){
            var agregar=parseInt(index)-1;
            var disminuir=parseInt(index);
            
            var valor=agregar;
            var valor2= disminuir;

            var texto=a(".title-pad").html();
            var texto2=texto.substring(texto.indexOf('P'),texto.indexOf('s')+1);

            if(agregar<10){
                valor="0"+valor;
                valor2=disminuir;
            }
            else
            {
                valor=valor;
                valor2=valor2;
            }
            a(this).attr("title",valor);
            a(".img_avan").attr("title",valor2);
            a(".title-pad").html(texto2 + " : "+seteo_mes(disminuir));
            var ajax=nuevoAjax();
            ajax.open("GET","funcion?opcion=listar_vac_pro&&mes="+disminuir,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    a(".vista_employ").html("");
                    var xmlre=ajax.responseText;
                    var posicion=xmlre.indexOf('+')+1;
                    var posicionfin =xmlre.indexOf('{*}');
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                    a(".vista_employ").html(cadena);
                }
            }
            ajax.send(null);
        }
        
    })
})
/* AQUI TERMINA LAS FUNCIONES DE LISTADO VACIONES DINAMICAS */








/* FUNCIONE DE LOS POPUD HA GENERAR Y CONSULTAR VACACIONES */

function compruebaTecla(evt){
    var tecla = evt.which || evt.keyCode;
    if(tecla == 27){
        a(".popud_consul").fadeOut();
        a(".popud_genera").fadeOut();
        a(".mensaje_gen").html("");
        a(".mensaje_con").html("");
        a(".dcto").val("");
        a(".dni").val("");
        a(".popud_permisos").fadeOut();
        a(".popud_consul_permiso").fadeOut();
    }
}

function documento(sol,area){
    window.open("documento?sol="+sol+"&&a="+area);
}


function editar(sol,ini,fin,tot,per){
    a(".agregar_vacaciones_edt").fadeIn();
    a(".date2").val(ini);
    a(".finmod").val(fin);
    a(".permod").text(per);
    a(".radiomod").val(tot);
    a(".solcod").val(sol);
}

a(document).ready(function(){
    var intervalo = setInterval("rangodias()", 500);
});


function rangodias()
{
    if(a(".fecini").length>0 && a(".fecfin").length>0){
        var fechaini = a('.fecini').val();
        var fechafin = a('.fecfin').val();
        if(fechaini!="" && fechafin!=""){
            var car1= fechaini.substring(4,5).trim();
            var car2= fechafin.substring(4,5).trim();
            var aFecha1 = fechaini.split(car1); 
            var aFecha2 = fechafin.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
            var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            var total=parseInt(a(".total").html());
            a(".totday").val(dias+1);
        }
    }

    if(a(".fecinimod").length>0 && a(".fecfinmod").length>0){
        var fechaini = a('.fecinimod').val();
        var fechafin = a('.fecfinmod').val();
        if(fechaini!="" && fechafin!=""){
            var car1= fechaini.substring(4,5).trim();
            var car2= fechafin.substring(4,5).trim();
            var aFecha1 = fechaini.split(car1); 
            var aFecha2 = fechafin.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
            var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            var total=parseInt(a(".total").html());
            a(".totdaymod").val(dias+1);
        }
    }

    if(a(".fecinie").length>0 && a(".fecfine").length>0){
        var fechaini = a('.fecinie').val();
        var fechafin = a('.fecfine').val();
        if(fechaini!="" && fechafin!=""){
            var car1= fechaini.substring(4,5).trim();
            var car2= fechafin.substring(4,5).trim();
            var aFecha1 = fechaini.split(car1); 
            var aFecha2 = fechafin.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
            var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            a(".totdaye").val(dias+1);
        }
    }

    if(a(".horinie").length>0 && a(".horfine").length>0){
        var horfine = a(".horfine").val().split(" ");
        var horinie = a(".horinie").val().split(" ");
        var parinie = horinie[0].split(":");
        var parfine = horfine[0].split(":");
        if(horinie!="" && horfine!=""){
            var hini,hfin,mini,mfin;
            horinie[1]=="PM"?hini = parseInt(parinie[0])+12:hini=parseInt(parinie[0]);
            horfine[1]=="PM"?hfin = parseInt(parfine[0])+12:hfin=parseInt(parfine[0]);
            mini=parinie[1];
            mfin=parfine[1];
            tminus = mfin - mini;
            thoras = hfin - hini;
            if (tminus < 0) {
                thoras--; tminus = 60 + tminus;
            }
            var horas = thoras.toString();
            var minutos = tminus.toString();
            if (horas.length < 2){
                horas = "0"+horas;
            }
            if (horas.length < 2){
                horas = "0"+horas;
            }
            a(".total_hrs").val(horas+":"+minutos);
        }
    }
}


/* COMPROBAR DIAS LABORABLES Y NO LABORABLES  */
function obtener_lab_nolab(fecinie,fecfine)
{
    var fecini=fecinie.split("/");
    var fecfin=fecfine.split("/");

    var laborables=0;
    var nolaborals=0;

    var i = new Date(fecini[2],parseInt(fecini[1])-1,parseInt(fecini[0])); 
    var f = new Date(fecfin[2],parseInt(fecfin[1])-1,parseInt(fecfin[0])); 

    var total=0;
    var dia = new Array(7);
        dia[0] = "Domingo";
        dia[1] = "Lunes";
        dia[2] = "Martes";
        dia[3] = "Miercoles";
        dia[4] = "Jueves";
        dia[5] = "Viernes";
        dia[6] = "Sabado";
    
    if(i.getMonth()==f.getMonth()){
        console.log("|");
        console.log("------------------------------------");
        console.log("Cuando los Meses son Iguales");
        for(var x=i.getDate();x<=f.getDate();x++){
            var fn= new Date(fecini[2],parseInt(fecini[1])-1,x);
            if(fn.getDay()==6 || fn.getDay()==0){
                nolaborals++;
            }
            else
            {
                laborables++;
            }
            console.log(x + " - " + dia[fn.getDay()] + "  - " + fn.getDay());
            total++;
        }
        console.log("<----> Total Laborables  => "    +   laborables);
        console.log("<----> Total No Laborables  => " +   nolaborals);
        console.log("<----> Total Dias  => "          +   total);
        console.log("------------------------------------");
        console.log("|");
    }
    else
    {
        console.log("|");
        console.log("------------------------------------");
        console.log("Cuando los Meses NO son Iguales");
        var mf = new Date(fecfin[2],parseInt(fecfin[1])-1,0);
        for(var x=i.getDate();x<=mf.getDate();x++){
            var fn= new Date(fecini[2],parseInt(fecini[1])-1,x);
            if(fn.getDay()==6 || fn.getDay()==0){
                nolaborals++;
            }
            else
            {
                laborables++;
            }
            console.log(x + " - " + dia[fn.getDay()] + "  - " + fn.getDay());
            total++;
        }  
        
        for(var x=1;x<=f.getDate();x++){
            var fn= new Date(fecfin[2],parseInt(fecfin[1])-1,x);
            if(fn.getDay()==6 || fn.getDay()==0){
                nolaborals++;
            }
            else
            {
                laborables++;
            }
            console.log(x + " - " + dia[fn.getDay()] + "  - " + fn.getDay());
            total++;
        }
        console.log("<----> Total Laborables  => "    +   laborables);
        console.log("<----> Total No Laborables  => " +   nolaborals);
        console.log("<----> Total Dias  => "          +   total);

    }    

    return total+","+laborables+","+nolaborals+","+f.getDay();
}

function popud_informe(m)
{
    a(".popud_aviso").css({"z-index":"1000"});
    a(".popud_aviso .accion table tbody tr:eq(0) td").html(m);
    a(".popud_aviso").fadeIn();
    a(".popud_aviso .mensaje").animate({"margin-top":"30%"},300,function(){
        a(this).animate({"margin-top":"31%"},300,function(){
            a(this).animate({"margin-top":"27%"},300);
        })
    }); 
}

a(function(){

    var AltWin = parseInt(a(window).height());
    var CenAltCon = parseInt((AltWin / 2));
    var YpopCon = CenAltCon - parseInt((110 / 2));
    var YpopCon2 = CenAltCon - parseInt((550 / 2));
    var YpopCon3 = CenAltCon - parseInt((200 / 2));
    var YpopCon4 = CenAltCon - parseInt((200 / 2));
    var YpopCon5 = CenAltCon - parseInt((350 / 2));

    a(".popud_consul .mensaje").css({"margin-top":YpopCon+"px"});
    a(".popud_genera .mensaje").css({"margin-top":YpopCon+"px"});
    a(".genera_vaca .contenedor").css({"margin-top":YpopCon2+"px"});
    a(".consul_vaca .contenedor").css({"margin-top":YpopCon2+"px"});
    a(".download_permisos_usu .contenedor").css({"margin-top":YpopCon5+"px"});

    a(".panel_registro_permiso .register_per").css({"margin-top":YpopCon2+"px"});
    a(".popud_consul_permiso .mensaje").css({"margin-top":YpopCon+"px"});
    a(".popud_permisos .mensaje").css({"margin-top":YpopCon+"px"});
    a(".consul_vaca_permiso .contenedor").css({"margin-top":YpopCon2+"px"});
    a(".agregar_vacaciones .generar_vaca_content").css({"margin-top":(YpopCon3+100)+"px"});
    a(".agregar_vacaciones_edt .generar_vaca_content_edt").css({"margin-top":(YpopCon4+100)+"px"});

    a(".agregar_permisos .generar_permisos_content").css({"margin-top":(YpopCon3+100)+"px"});
    a(".agregar_permisos_edt .generar_permisos_content_edt").css({"margin-top":(YpopCon3+100)+"px"});

    if (window.addEventListener) {
        window.addEventListener("keydown", compruebaTecla, false);
    } else if (document.attachEvent) {
        document.attachEvent("onkeydown", compruebaTecla);
    }

    //FUNCIONES DE CONSULTAS Y LLAMADAS MEDIANTE EL EVENTO DE AJAX
    a(".consulta").click(function(){
        a(".popud_consul").fadeIn();
    });
    a(".popud_consul").dblclick(function(){
        a(".popud_consul").fadeOut();
    });
    a(".consultar_trabajador").click(function(){
        var docu=a(".dcto").val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=consult_vaca&&dni="+docu,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {   
                a(".dcto").val("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                if(cadena=="Ninguno"){
                    a(".mensaje_con").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_con").html("Ud. no cuenta con solicitudes de vacaciones. ");
                    a(".dcto").val("");
                    a(".dcto").focus();
                }else if(cadena=="No_Existe"){
                    a(".mensaje_con").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_con").html("Clave Incorrecto. ");
                    a(".dcto").val("");
                    a(".dcto").focus();
                }else{
                    a(".popud_consul").fadeOut();
                    a(".consul_vaca").fadeIn();
                    a(".mensaje_con").html("");
                    a(".consul_vaca .contenedor .body").html("");
                    a(".consul_vaca .contenedor .body").html(cadena);
                }
            }
        }
        ajax.send(null);
    })
    a(".close_consulta").click(function(){
        a(".consul_vaca .body").html("");
        a(".consul_vaca").fadeOut();
        a(".solicitud").val("");
        a(".dni").val("");
    });



    //FUNCIONES DE LLAMAS A GENERAR SOLICITUD DE VACACIONES
    a(".generar").click(function(){
        a(".popud_genera").fadeIn();
    });
    a(".popud_genera").dblclick(function(){
        a(".popud_genera").fadeOut();
    });
    a(".consultar_dni").click(function(){
        var dni=a(".dni").val().toUpperCase();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=buscar_cliente&&dni="+dni,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('{-}');

                var posicion2=xmlre.indexOf('{-}')+3;
                var posicionfin2 =xmlre.indexOf('*');

                var posicion3=xmlre.indexOf('+')+1;
                var posicionfin3 =xmlre.indexOf('*');

                var cadena=ajax.responseText.substring(posicion,posicionfin);
                var cadena2=ajax.responseText.substring(posicion2,posicionfin2);
                var cadena3=ajax.responseText.substring(posicion3,posicionfin3);

                if(cadena3=="Ninguno"){
                    a(".mensaje_gen").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen").html("Clave Incorrecta. ");
                    a(".dni").val("");
                    a(".dni").focus();
                }else if(cadena3=="Vacio"){
                    a(".mensaje_gen").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen").html("Ingrese la Clave. ");
                    a(".dni").val("");
                    a(".dni").focus();
                /*
                }else if(cadena3=="Incompleto"){
                    a(".mensaje_gen").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen").html("A&uacute;n no cumple 1 a&ntilde;o como m&iacute;nimo. ");
                    a(".dni").val("");
                    a(".dni").focus();
                
                }else if(cadena3=="Agotado"){
                    a(".mensaje_gen").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen").html("No cuenta con d&iacute;as disponibles para solicitud. ");
                    a(".dni").val("");
                    a(".dni").focus();
                }else if(cadena3=="Pendiente"){
                    a(".mensaje_gen").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen").html("Ud. tiene Solicitud Pendientes. ");
                    a(".dni").val("");
                    a(".dni").focus(); 
                */
                }else{
                    a(".dni").val("");
                    a(".popud_genera").fadeOut();
                    a(".genera_vaca").fadeIn();
                    a(".mensaje_gen").html("");
                    a(".genera_vaca .contenedor .body").html("");
                    a(".genera_vaca .contenedor .body").html(cadena);

                    a(".agregar_vacaciones .periodo").html("");
                    a(".agregar_vacaciones .periodo").html(cadena2);
                }
            }
        }
        ajax.send(null);
    });

    a(".close_genera").click(function(){
        a(".genera_vaca .limpiar").html("");
        a(".genera_vaca .detalle .date").val("");
        a(".genera_vaca .detalle .fin").val("");
        a(".genera_vaca .detalle input:radio").attr('checked',false);
        a(".genera_vaca").fadeOut();
        a(".nomreg").val("");
        a(".dnireg").val("");
    });


    a(".fecfin").click(function(){
        var cod=parseInt(a(".codigo").html());
        var valor=parseInt(a('.totday').val())-1;
        var ajax= new nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_acumulados&&cod="+cod,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('{-}')+3;
                var posicionfin =xmlre.indexOf('+');
                var cadena=parseInt(ajax.responseText.substring(posicion,posicionfin));
                var resultado=cadena-(valor+1);
                //a(".total").html(resultado);
            }
        }
        ajax.send(null);
    });


    a(".modrad").click(function(){
        var cod=parseInt(a(".codigo").html());
        var valor=parseInt(a('input:radio[name=moddia]:checked').val())-1;
        var ajax= new nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_acumulados&&cod="+cod,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('{-}')+3;
                var posicionfin =xmlre.indexOf('+');
                var cadena=parseInt(ajax.responseText.substring(posicion,posicionfin));
                var resultado=cadena-(valor+1);
                var ini=a(".date2").val();
                var fecfin=sumaFecha(valor,ini);
                //a(".total").html(resultado);
                a(".fin").val(fecfin);
            }
        }
        ajax.send(null);
    });
    
    
    a(".mostrar_ventana").click(function(){
        var total=a(".total").html();
        if(parseInt(total)>0){
            a(".agregar_vacaciones").fadeIn();
        }else{
            crear_popud("Mensaje: Solicitud de Vacaciones","Ud. no cuenta con d&iacute;as disponibles para vacaciones.");
        }
    });

    a(".cerrar_popud_mensaje").click(function(){
        a(".popud_mensaje_alert").fadeOut();
        a(".apertura").animate({"margin-top":"0%"},500);
    });


    a(".cancelar").click(function(){
        a(".totday").val("");
        a(".fecfin").val("");
        a(".fecini").val("");
        a(".agregar_vacaciones").fadeOut();
    });

    a(".cancelar_edt").click(function(){
        a(".totdaymod").val("");
        a(".fecfinmod").val("");
        a(".fecinimod").val("");
        a(".solcod").val("");
        a(".agregar_vacaciones_edt").fadeOut();
    });

    var Fecha = new Date();
    var sFecha =Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear();

    a(".fecfin").click(function(){
        var valor = a(".fecini").val();
        var total = parseInt(a(".total").html());
        if(valor==""){
           alert("Ingrese la Fecha Inicio");
        }
        else
        {
            var set_fec = valor.split("-");
            var fec_new = new Date( set_fec[0], set_fec[1], set_fec[2]);
            
            var add_fec = sumaFecha(total,set_fec[2]+"/"+set_fec[1]+"/"+set_fec[0]);
            var set_add = add_fec.split("/");
            var fec_add = set_add[2]+"-"+set_add[1]+"-"+set_add[0];
            
            myCalendar2.setSensitiveRange(valor,fec_add);
            console.log("Elementos Nuevos => " + valor + " ||| " + fec_add  + " ||| " + total);
        }    
    });

    a(".fecfinmod").click(function(){
        var valor = a(".fecinimod").val();
        var total = parseInt(a(".total").html());
        if(valor==""){
            alert("Ingrese la Fecha Inicio");
        }
        else
        {
            var set_fec = valor.split("-");
            var fec_new = new Date( set_fec[0], set_fec[1], set_fec[2]);
            
            var add_fec = sumaFecha(total,set_fec[2]+"/"+set_fec[1]+"/"+set_fec[0]);
            var set_add = add_fec.split("/");
            var fec_add = set_add[2]+"-"+set_add[1]+"-"+set_add[0];
            
            myCalendar2.setSensitiveRange(valor,fec_add);
            console.log("Elementos Nuevos => " + valor + " ||| " + fec_add  + " ||| " + total);
        }    
    });

    
    a(".guardar").click(function(){

        var inimod=a(".fecini").val().split("-");
        var ini=inimod[2]+"/"+inimod[1]+"/"+inimod[0];
        
        var finmod=a(".fecfin").val().split("-");
        var fin=finmod[2]+"/"+finmod[1]+"/"+finmod[0];

        var tot     = a('.totday').val();
        var per     = a(".periodo").val();
        var cod     = a(".codigo").html().trim();
        var tra     = a(".nom").html().trim() + ", " + a(".ape").html().trim();
        var total   = parseInt(a(".total").html());

        var tot_lab = a(".si_lab").val();
        var tot_nla = a(".no_lab").val();

        var fecini=Date.parse(ini);
        var fecre=Date.parse(sFecha);

        var vector = obtener_lab_nolab(ini,fin);
        var partes = vector.split(",");
        var laborables  = parseInt(partes[1]);
        var nolaborables= parseInt(partes[2]);
        var diafin = parseInt(partes[3]);
        var msn="";
        tot_nla==""?tot_nla=0:tot_nla=tot_nla;

        console.log(vector);
        console.log("------------------------------------");
        
        if(total>=tot)
        {
            if(tot<7)
            {
                var msn= "El m&iacute;nimo de vacaciones es de 7 d&iacute;as.<br/> Vuelva a Intentarlo.";
                popud_informe(msn);    
            }
            else
            {
                if( fecini<fecre ) 
                {
                    a(".fecini").val("");
                    a(".fecini").css({"background":"rgba(255,0,0,0.1)"});
                    a(".fecini").attr("placeholder","Fecha Incorrecta");
                }
                else
                {
                    if(diafin == 5 || diafin == 6 )
                    {
                        msn = "Sus vacaciones no pueden terminar un d&iacute;a no laborable.<br/> Vuelva a Seleccionar."
                        popud_informe(msn); 
                    }
                    else
                    {
                        if(total==tot)
                        {
                            if( nolaborables> tot_nla )
                            {
                                msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                                popud_informe(msn); 
                            }
                            else if( laborables>tot_lab )
                            {
                                msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                                popud_informe(msn);
                            }
                            else
                            {
                                var ajax=nuevoAjax();
                                ajax.open("GET","funcion?opcion=registrar_solicitud&&cod="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&per="+per+"&&tra="+tra+"&&lab="+laborables+"&&nla="+nolaborables,true);
                                ajax.onreadystatechange=function()
                                {
                                    if(ajax.readyState==4 && ajax.status==200)
                                    {
                                        var xmlre=ajax.responseText;
                                        var posicion=xmlre.indexOf('{-}')+3;
                                        var posicionfin =xmlre.indexOf('{+}');
                                        var cadena=ajax.responseText.substring(posicion,posicionfin);

                                        ini="";fin="";tot="";per="";cod="";tra="";

                                        a(".date2").val("");
                                        a(".finmod").val("");
                                        a(".solcod").val("");
                                        a(".fecini").val("");
                                        a(".fecfin").val("");

                                        a('.totday').val("");
                                        a(".periodo").val("");
                                        a(".codigo").html("");
                                        a(".genera_vaca").fadeOut();
                                        a(".agregar_vacaciones").fadeOut();
                                        a(".popud_genera").fadeOut();

                                        popud_informe("Solicitud Generada Correctamente.<br/> Estaremos en contacto.");

                                    }
                                }
                                ajax.send(null);
                            }
                        }
                        else
                        {

                            if( nolaborables > tot_nla )
                            {
                                msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                                popud_informe(msn); 
                                alert(nolaborables);
                            }
                            else if( laborables > tot_lab )
                            {
                                msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                                popud_informe(msn);
                                alert(laborables);
                            }
                            else
                            {
                                var ajax=nuevoAjax();
                                ajax.open("GET","funcion?opcion=registrar_solicitud&&cod="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&per="+per+"&&tra="+tra+"&&lab="+laborables+"&&nla="+nolaborables,true);
                                ajax.onreadystatechange=function()
                                {
                                    if(ajax.readyState==4 && ajax.status==200)
                                    {
                                        var xmlre=ajax.responseText;
                                        var posicion=xmlre.indexOf('{-}')+3;
                                        var posicionfin =xmlre.indexOf('{+}');
                                        var cadena=ajax.responseText.substring(posicion,posicionfin);
                                        ini="";fin="";tot="";per="";cod="";tra="";

                                        a(".date2").val("");
                                        a(".finmod").val("");
                                        a(".solcod").val("");
                                        a(".fecini").val("");
                                        a(".fecfin").val("");

                                        a('.totday').val("");
                                        a(".periodo").val("");
                                        a(".codigo").html("");
                                        a(".genera_vaca").fadeOut();
                                        a(".agregar_vacaciones").fadeOut();
                                        a(".popud_genera").fadeOut();
                                        
                                        popud_informe("Solicitud Generada Correctamente.<br/> Estaremos en contacto.");
                                    }
                                }
                                ajax.send(null);
                            }
                            
                        }
                    }
                }
            }
        }
        else
        {
            var msn= " Ud. se ha excedido de la cantidad de d&iacute;as disponibles.<br/> Solo dispone de "+ total +" d&iacute;as de vacaciones";
            popud_informe(msn);
        }
        
    });

    a(".cerrar_all").click(function(){
        a(".popud_aviso").fadeOut();
    })
    
    a(".modificar").click(function(){

        var sol=a(".solcod").val();
        var inimod=a(".fecinimod").val().split("-");
        var ini=inimod[2]+"/"+inimod[1]+"/"+inimod[0];
        
        var finmod=a(".fecfinmod").val().split("-");
        var fin=finmod[2]+"/"+finmod[1]+"/"+finmod[0];


        var tot=a('.totdaymod').val();
        var total   = parseInt(a(".total").html());

        var tot_lab = a(".si_lab").val();
        var tot_nla = a(".no_lab").val();

        var fecini=Date.parse(ini);
        var fecre=Date.parse(sFecha);

        var vector = obtener_lab_nolab(ini,fin);
        var partes = vector.split(",");
        var laborables  = parseInt(partes[1]);
        var nolaborables= parseInt(partes[2]);
        var diafin = parseInt(partes[3]);
        var msn="";
        tot_nla==""?tot_nla=0:tot_nla=tot_nla;

        console.log(vector);
        console.log("------------------------------------");

        if(total>=tot)
        {
            if(tot<7)
            {
                var msn= "El m&iacute;nimo de vacaciones es de 7 d&iacute;as.<br/> Vuelva a Intentarlo.";
                popud_informe(msn);    
            }
            else
            {
                
                if( fecini<fecre ) 
                {
                    a(".fecinimod").val("");
                    a(".fecinimod").css({"background":"rgba(255,0,0,0.1)"});
                    a(".fecinimod").attr("placeholder","Fecha Incorrecta");
                }
                else
                {
                    if(diafin == 5 || diafin == 6 )
                    {
                        msn = "Sus vacaciones no pueden terminar un d&iacute;a no laborable.<br/> Vuelva a Seleccionar."
                        popud_informe(msn); 
                    }
                    else
                    {
                        if(total==tot)
                        {
                            if( nolaborables> tot_nla )
                            {
                                msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                                popud_informe(msn); 
                            }
                            else if( laborables>tot_lab )
                            {
                                msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                                popud_informe(msn);
                            }
                            else
                            {
                                var ajax=nuevoAjax();
                                ajax.open("GET","funcion?opcion=modificar_solicitud&&sol="+sol+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&lab="+laborables+"&&nla="+nolaborables,true);
                                ajax.onreadystatechange=function()
                                {
                                    if(ajax.readyState==4 && ajax.status==200)
                                    {
                                        var xmlre=ajax.responseText;
                                        var posicion=xmlre.indexOf('{-}')+3;
                                        var posicionfin =xmlre.indexOf('+');
                                        var cadena=ajax.responseText.substring(posicion,posicionfin);

                                        sol="";ini="";fin="";tot="";

                                        a(".fecinimod").val("");
                                        a(".fecfinmod").val("");
                                        a(".solcod").val("");
                                        a(".fecini").val("");
                                        a(".fecfin").val("");

                                        a('.totdaymod').val("");
                                        a(".solcod").html("");
                                        a(".genera_vaca").fadeOut();
                                        a(".agregar_vacaciones").fadeOut();
                                        a(".popud_genera").fadeOut();
                                        a(".agregar_vacaciones_edt").fadeOut();

                                        popud_informe("Registro Modificado Correctamente.<br/> Nos estaremos comunicando con Ud.");

                                    }
                                }
                                ajax.send(null);
                            }
                        }
                        else
                        {

                            if( nolaborables > tot_nla )
                            {
                                msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                                popud_informe(msn); 
                                alert(nolaborables);
                            }
                            else if( laborables > tot_lab )
                            {
                                msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                                popud_informe(msn);
                                alert(laborables);
                            }
                            else
                            {
                                var ajax=nuevoAjax();
                                ajax.open("GET","funcion?opcion=modificar_solicitud&&sol="+sol+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&lab="+laborables+"&&nla="+nolaborables,true);
                                ajax.onreadystatechange=function()
                                {
                                    if(ajax.readyState==4 && ajax.status==200)
                                    {
                                        var xmlre=ajax.responseText;
                                        var posicion=xmlre.indexOf('{-}')+3;
                                        var posicionfin =xmlre.indexOf('+');
                                        var cadena=ajax.responseText.substring(posicion,posicionfin);

                                        sol="";ini="";fin="";tot="";

                                        a(".fecinimod").val("");
                                        a(".fecfinmod").val("");
                                        a(".solcod").val("");
                                        a(".fecini").val("");
                                        a(".fecfin").val("");

                                        a('.totdaymod').val("");
                                        a(".solcod").html("");
                                        a(".genera_vaca").fadeOut();
                                        a(".agregar_vacaciones").fadeOut();
                                        a(".popud_genera").fadeOut();
                                        a(".agregar_vacaciones_edt").fadeOut();

                                        popud_informe("Registro Modificado Correctamente.<br/> Nos estaremos comunicando con Ud.");

                                    }
                                }
                                ajax.send(null);
                            }
                            
                        }
                    }
                }
            }
        }
        else
        {
            var msn= " Ud. se ha excedido de la cantidad de d&iacute;as disponibles.<br/> Solo dispone de "+ total +" d&iacute;as de vacaciones";
            popud_informe(msn);
        }

            
        

    });
});


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


/* COMPROBAR CUANTAS VECES REPITE LOS DIAS */

a(function(){
    
});


/* FUNCIONES PARA SOLICITUD DE PERMISOS */
a(function(){

    a('.inicio_time').ptTimeSelect();
    a('.fin_time').ptTimeSelect();

    a(".comision").change(function(){
        a(".otros_opt").css({"display":"none"});
        a(".opt_comi input:radio").attr('checked',false);
        a(".opt_per input:radio").attr('checked',false);
        a(".opt_datetime input:radio").attr('checked',false);
        a(".opt_datetime").css({"display":"none"});
        a(".opt_time").css({"display":"none"});
        a(".opt_date").css({"display":"none"});
        a(".fecinie").val("");
        a(".fecfine").val("");
        a(".horinie").val("");
        a(".horfine").val("");
        a(".obsperm").val("");
    });

    a(".comision").click(function(){
        var valor=a(this).val();
        if(valor=="1"){
            a(".opt_per").css({"display":"none"});
            a(".opt_comi").css({"display":"block"});
        }else if (valor=="2"){
            a(".opt_per").css({"display":"block"});
            a(".opt_comi").css({"display":"none"});
        }
    })

    a(".por_comision").change(function(){
        var valor=a(this).val();
        a(".opt_datetime").css({"display":"block"});
        if(valor=="5")
        {
            a(".otros_opt").css({"display":"block"});
        }else{
            a(".otros_opt").css({"display":"none"});
        } 
    })

    a(".por_personal").change(function(){
        var valor=a(this).val();
        a(".opt_datetime").css({"display":"block"});
        if(valor=="9")
        {
            a(".otros_opt").css({"display":"block"});
        }else{
            a(".otros_opt").css({"display":"none"});
        }     
    })

    a(".opt_date_option").click(function(){
        var valor=a(this).val();
        if(valor=="2"){
            a(".opt_time").css({"display":"block"});
            a(".opt_date").css({"display":"none"});
        }else{
            a(".opt_date").css({"display":"block"});
            a(".opt_time").css({"display":"none"});
        }
    })

    a(".opt_date_option").change(function(){
        a(".fecinie").val("");
        a(".fecfine").val("");
        a(".horinie").val("");
        a(".horfine").val("");
    })

    a(".contenedor_menu .permisos").click(function(){
        a(".popud_permisos").fadeIn();    
    })

    a(".panel_registro_permiso .cancelar").click(function(){
        a(".panel_registro_permiso").fadeOut();    
    })


    a(".agregar_permisos .cancelar").click(function(){
        a(".agregar_permisos").fadeOut();    
    })


    a(".contenedor_menu .consultar_permiso").click(function(){
        a(".popud_consul_permiso").fadeIn();    
    })


    a(".nuevo_permiso").click(function(){
        a(".agregar_permisos").fadeIn();
    });


    /* PARA GUARDAR LA SOLICITUD DE PERMISO */
    a(".consultar_permisos").click(function(){
        var dni=a(".caja_dni_per").val().toUpperCase();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=consult_permisos_emitidos_add&&dni="+dni,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);


                if(cadena=="No_Existe" && dni!=""){
                    a(".mensaje_gen_per").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen_per").html("Clave Incorrecta. ");
                    a(".caja_dni_per").val("");
                    a(".caja_dni_per").focus();
                }else if(cadena!="Ninguno" && dni==""){
                    a(".mensaje_gen_per").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_gen_per").html("Ingrese la Clave. ");
                    a(".caja_dni_per").val("");
                    a(".caja_dni_per").focus();
                }else{
                    a(".caja_dni_per").val("");
                    a(".popud_permisos").fadeOut();
                    a(".panel_registro_permiso").fadeIn();
                    a(".mensaje_gen_per").html("");
                    a(".register_per .body").html("");
                    a(".register_per .body").html(cadena);
                }

            }
        }
        ajax.send(null);
    });
    
    a(".guardar_permi").click(function(){
        var codigo=a(".codigo_per").val();
        var fecini=a(".fecinie").val();
        var fecfin=a(".fecfine").val();
        var horini=a(".horinie").val();
        var horfin=a(".horfine").val();
        var codtip=a('input:radio[name=tipo]:checked').val();
        var cotide=a(".codtipdet").val();
        var obsper=a(".obsperm").val();
        var array=codigo+"&&fi="+fecini+"&&ff="+fecfin+"&&hi="+horini+"&&hf="+horfin+"&&ct="+codtip+"&&td="+cotide+"&&ob="+obsper;
        var ajax=nuevoAjax();


        ajax.open("GET","funcion?opcion=registrar_permiso&&cd="+array,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('{+}')+3;
                var posicionfin =xmlre.indexOf('{*}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);

                codigo="";  fecini="";  fecfin="";  horini="";
                horfin="";  codtip="";  cotide="";  obsper="";

                a(".fecinie").val("");
                a(".fecfine").val("");
                a(".horinie").val("");
                a(".horfine").val("");

                a(".popud_permisos").fadeOut();
                a(".panel_registro_permiso").fadeOut();
                a(".popud_genera").fadeOut();

                a(".agregar_permisos").fadeOut();   

                a(".popud_aviso").fadeIn();
                a(".popud_aviso .mensaje").animate({"margin-top":"30%"},300,function(){
                    a(this).animate({"margin-top":"27%"},300,function(){
                        a(this).animate({"margin-top":"31%"},300,function(){
                            a(this).animate({"margin-top":"27%"},300,function(){
                                a(this).animate({"margin-top":"31%"},300,function(){
                                    a(this).animate({"margin-top":"27%"},300);
                                })
                            })
                        })
                    })
                });
            }
        }
        ajax.send(null);
        
    })
    



    /* PARA CONSULTA DE PERMISOS */
    a(".consultar_permiso_em").click(function(){
        var dni=a(".dcto_emitido").val().toUpperCase();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=consult_permisos_emitidos&&dni="+dni,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);

                if(cadena=="No_Existe" && dni!=""){
                    a(".mensaje_con_em_per").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_con_em_per").html("Clave Incorrecta. ");
                    a(".dcto_emitido").val("");
                    a(".dcto_emitido").focus();
                }else if(cadena!="Ninguno" && dni==""){
                    a(".mensaje_con_em_per").css({"color":"red","margin-left":"18px","margin-bottom":"55px"});
                    a(".mensaje_con_em_per").html("Ingrese la Clave. ");
                    a(".dcto_emitido").val("");
                    a(".dcto_emitido").focus();
                }else{
                    a(".dcto_emitido").val("");
                    a(".popud_consul_permiso").fadeOut();
                    a(".consul_vaca_permiso").fadeIn();
                    a(".mensaje_con_em_per").html("");
                    a(".consul_vaca_permiso .contenedor .body").html("");
                    a(".consul_vaca_permiso .contenedor .body").html(cadena);
                }
            }
        }
        ajax.send(null);
    });

    a(".close_consulta_emitida").click(function(){
        a(".consul_vaca_permiso").fadeOut();
    });

});


/* VISTA PREVIA DE MANUALES */
a(function(){
    
    a(".download_manual").click(function(){
        a(".download_permisos_usu").fadeIn();
    });

    a(".close_consulta_dowloand").click(function(){
        a(".download_permisos_usu").fadeOut();
    });

});


a(function(){
    //setInterval("crear_popud('Demostracion de Ejemplo','Probando Ejecucion de Popud');",3000);
})

/* DOCUMENTO FINAL DE PERMISOS */
function documento_permiso(sol){
    a(this).parent().attr("target","_blank");
    window.open("pdf_permiso?perm="+sol);
}


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





/* SLIDER FOR NUESTRO PERSONAL */
var actual=1;
var actual2=1;
var actual3=1;
var actual4=1;
a(document).on("ready", main());


function main(){
    var intervalo = setInterval("runSlider()", 3000);
    var intervalo = setInterval("runSlider2()", 4500);
    var intervalo = setInterval("runSlider3()", 5500);
    var intervalo = setInterval("runSlider4()", 2500);
}

function runSlider(){
    if(actual == a(".containerSlider").size()){
        actual = 0;
    }

    a("#containerSlider").animate({
        marginTop: (-1*actual*a("#containerSlider").eq(0).height())
    },1000);
    actual++;
}

function runSlider2(){
    if(actual2 == a(".containerSlider2").size()){
        actual2 = 0;
    }

    a("#containerSlider2").animate({
        marginTop: (-1*actual2*a("#containerSlider2").eq(0).height())
    },1000);
    actual2++;
}

function runSlider3(){
    if(actual3 == a(".containerSlider3").size()){
        actual3 = 0;
    }

    a("#containerSlider3").animate({
        marginTop: (-1*actual3*a("#containerSlider3").eq(0).height())
    },1000);
    actual3++;
}

function runSlider4(){
    if(actual4 == a(".containerSlider4").size()){
        actual4 = 0;
    }

    a("#containerSlider4").animate({
        marginTop: (-1*actual4*a("#containerSlider4").eq(0).height())
    },1000);
    actual4++;
}


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
  setInterval(toolbar,1000);
}

function toolbar()
{
    a(window).scroll(function(){
        if (a(this).scrollTop() > 150) a('.volverarriba').fadeIn();
        else a('.volverarriba').fadeOut();
    });

    a(document).on("click",".volverarriba",function(e){
        e.preventDefault();
        a("html, body").stop().animate({ scrollTop: 0 }, "slow");
    });
}



/* FUNCION DE CREACION DE POPUD PERSONALIZADO */
function crear_popud(t,m)
{
    a(".popud_mensaje_alert").css({"z-index":"1000"});
    a(".popud_mensaje_alert").fadeIn();
    a(".popud_mensaje_alert .titulo").html("");
    a(".popud_mensaje_alert .texto").html("");
    a(".popud_mensaje_alert .titulo").html(t);
    a(".popud_mensaje_alert .texto").html(m);
    a(".apertura").animate({"margin-top":"30%"},500,function(){
        a(".apertura").animate({"margin-top":"28%"},300);
    });
}

