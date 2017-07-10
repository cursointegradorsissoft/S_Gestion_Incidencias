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

function setear_json(val){
    var dato=val.substring(val.indexOf(':')+2, val.length-1);
    return dato;
}


function tener_radio(){
    $(".radio").click(function(){
        var valor=$(this).val();
        return valor;
    })
}


function fecha_actual(){
    var Fecha = new Date();
    return parseInt(Fecha.getFullYear() + "" + (Fecha.getMonth() +1) + "" + Fecha.getDate());
}

function fecha_seteado(f){
    var div=f.split("-");
    return parseInt(div[2] + "" + parseInt(div[1]) + "" + div[0]);
}

// PARA LA CANCELACION O MODIFICACION DE VACACIONES
$(function(){
    var Fecha = new Date();
    var sFecha =Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear();

    //MENSAJE DE DOCUMENTOS ASOCIADOS NUEVOS
    $(".modificar_vacaciones").click(function(){
        var fecini = fecha_seteado($(".fecini").val());
        var fecfin = fecha_seteado($(".fecfin").val());
        var urlact = location.href;
        var parurl = urlact.split("=");
        var solvac = $("."+parurl[1]).val();
        var fecact = fecha_actual();   
        if(fecini<=fecact && fecfin>=fecact){
            Desactivar(); 
        }else{
            Activar();  
        }
    });

    $(".save_mod").click(function(){
        var urlact = location.href;
        var parurl = urlact.split("=");
        var ruta = "";

        var ajax=nuevoAjax();
        if( $("."+parurl[1]).length>0){
            var cod = $("."+parurl[1]).val().trim();
            var ini = $(".fecini").val();
            var fin = $(".fecfin").val();
            var tot = $(".totday2").val();
            ruta="funcion?opcion=mod_vaca&&cod="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot;
            var total = parseInt($(".totday"+cod).val());
        }else{
            var cod = $(".percod").val();
            var ini = $(".inifec").val();
            var fin = $(".finfec").val();
            var tot = $(".totday").val();
            ruta="funcion?opcion=reg_vaca&&per="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot;
            var total = parseInt($(".totacu").val());
        }
        

        var tot_lab = $(".si_lab"+cod).val();
        var tot_nla = $(".no_lab"+cod).val();
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
        /*
        if(total>=tot)
        {*/
            /*if(tot<7){
                msn = "El m&iacute;nimo de vacaciones es de 7 d&iacute;as.<br/> Vuelva a Seleccionar."
                informe(msn); 
            }
            else
            {*/
                if(diafin == 5 || diafin == 6 )
                {
                    msn = "Sus vacaciones no pueden terminar un d&iacute;a no laborable.<br/> Vuelva a Seleccionar."
                    informe(msn); 
                }
                else
                {
                    if(total==tot)
                    {
                        if( nolaborables> tot_nla )
                        {
                            msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                            informe(msn); 
                        }
                        else if( laborables>tot_lab )
                        {
                            msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                            informe(msn);
                        }
                        else
                        {
                            var ajax=nuevoAjax();
                            ajax.open("GET",ruta+"&&lab="+laborables+"&&nla="+nolaborables,true);
                            ajax.onreadystatechange=function()
                            {
                                if(ajax.readyState==4 && ajax.status==200){
                                    var xmlre=ajax.responseText;
                                    var posicion=xmlre.indexOf('{+}')+3;
                                    var posicionfin =xmlre.indexOf('{-}');
                                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                                    $("#btn8").trigger("click");
                                    informe(cadena);
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
                            informe(msn); 
                        }
                        else if( laborables > tot_lab )
                        {
                            msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                            informe(msn);
                        }
                        else
                        {
                            var ajax=nuevoAjax();
                            ajax.open("GET",ruta+"&&lab="+laborables+"&&nla="+nolaborables,true);
                            ajax.onreadystatechange=function()
                            {
                                if(ajax.readyState==4 && ajax.status==200){
                                    var xmlre=ajax.responseText;
                                    var posicion=xmlre.indexOf('{+}')+3;
                                    var posicionfin =xmlre.indexOf('{-}');
                                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                                    $("#btn8").trigger("click");
                                    informe(cadena);
                                }
                            }
                            ajax.send(null);
                        }
                        
                    }
                }
            //}

            /*
        }
        else
        {
            var msn= " Ud. se ha excedido de la cantidad de d&iacute;as disponibles.<br/> Solo dispone de "+ total +" d&iacute;as de vacaciones";
            informe(msn);
        }*/
        
    });

    // MENSAJE DE ELIMINACION DE DOCUMENTOS GENERADOS
    $(".eliminar_vacaciones").click(function(){
        $("#btn6").unbind("click");
        var fecini = fecha_seteado($(".fecini").val());
        var fecfin = fecha_seteado($(".fecfin").val());
        var urlact = location.href;
        var parurl = urlact.split("=");
        var solvac = $("."+parurl[1]).val();
        var fecact = fecha_actual();   
        var ajax=nuevoAjax()

        if(fecact<fecini && fecact<fecfin){
            ajax.open("GET","funcion?opcion=del_vaca&&cod="+solvac,true);
            ajax.onreadystatechange=function(){
                if(ajax.readyState == 4 && ajax.status==200)
                {
                    var xmlhtp=ajax.responseText;
                    var posini=xmlhtp.indexOf("{+}")+3;
                    var posfin=xmlhtp.indexOf("{-}");
                    var cadena=ajax.responseText.substring(posini,posfin);
                    $("#btn8").trigger("click");
                    informe(cadena);
                }
            }
            ajax.send(null);
        }else{
            informe("No se puede ELIMINAR el documento por motivo que est&aacute; vigente.");
            Desactivar();
        }
    });


});



//GENERAR PERMISO  (DENAGAR O CANCELAR) DE LA MISMA JEFATURA
$(function(){
    $(".ajax").unbind("click");

    $(".permiso").click(function(){

        $("#btn7").attr("disabled",false);
        $("#btn7").css({background: "none", opacity:"1"});

        var valor=$(this).val();
        var codigo=$(this).parent().parent().children("td:eq(0)").text();

        var ajax=nuevoAjax();

        if(valor=="si")
        {
            ajax.open("GET", "funcion?opcion=conceder&&cod="+codigo, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                    var posicion=xmlre.indexOf("{-}")+3;
                    var posicionfin=xmlre.indexOf("*");
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                } 
            }
            ajax.send(null);
        }
        else
        {
            ajax.open("GET", "funcion?opcion=denegar&&cod="+codigo, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                } 
            }
            ajax.send(null);
        }
    })
    
    $(".conceder").click(function(){
        $(".visualizar").trigger("click");
    });

})


/* FUNCIONES PARA SETEAR EL CESADO DEL TRABAJADOR */

setInterval("comprobar_cese();",500);
function comprobar_cese(){
    if($(".modificar_cese").length>0){
        var valor=$(".modificar_cese").val();
        if(valor != "" ){
            $(".guardar_cese").attr("type","button");   
            console.log("Ya existe un Valor y es : " + valor);
        }else{
            $(".guardar_cese").attr("type","submit");
            console.log("Campo Vacio");
        }           
    }
}

$(function(){
    $(".guardar_cese").click(function(){
        var cod=$("[name=CodMos]").val();

        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_totacu&&cod="+cod,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlhtp = ajax.responseText;
                var inipos = xmlhtp.indexOf("+")+1;
                var finpos = xmlhtp.indexOf("*");
                var cadena = ajax.responseText.substring(inipos,finpos);
                var diatot = cadena.split(",");

                $.msgBox({
                    title: "Informe del Sistema",
                    content: "El Colaborador que desea cesar, dispone de vacaciones pendientes:<br/>Total Pendientes = "+diatot[0]+" .<br/>Al cesarlo todo se ha de ajustar a cero.<br/> Desea cesarlo ?.",
                    type: "info",
                    buttons: [{ value: "Si" }, { value: "No"}],
                    success: function (result) {
                        if (result == "Si") {
                            $(".guardar_cese").attr("type","submit");
                            $(".guardar_cese").trigger("click");
                        }
                        else
                        {
                            location.href = '#';
                        }
                    }
                });
            }
        }   
        ajax.send(null);
    });

});


/* FUNCIONES PARA CALCULAR LOS DIAS DE VACACIONES */
$(function(){

    $(".btn4val").blur(function(){
        if($(".periodo").val()== null){
            informe("Ud. a&uacute;n no puede realizar la Solicitud de Vacaciones. </br> Esto es debido a que no ha cumplido la regla de la empresa: </br> - M&iacute;nimo 1 a&ntilde;o de trabajo.");
            setTimeout(function() {
                $('#btn8').trigger('click');
            }, 4000);
        }
    })

    $(".periodo").change(function(){
        var ajax=nuevoAjax();
        var anio=$(this).val();
        var codigo=$(".codigo0").val();
        var totals2=totals;
        ajax.open("GET", "funcion?opcion=periodo&anio="+anio+"&codigo="+codigo, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('{')+1;
                var posicionfin =xmlre.indexOf('}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                var json=cadena.split(',');

                // VALIDACION DE DIAS HABILES DE TRABAJO
                var caja=$(".cajadia").val();
                var radio=$(".radio").val();
                var diashabiles=setear_json(json[0]);

                if(radio>diashabiles)
                {
                    $(".totales").html(diashabiles);
                    informe("Ha &eacute;xcedido de la cantidad de d&iacute;as. </br> Ud. s&oacute;lo dispone de : "+diashabiles + " d&iacute;as en este </br>periodo")
                }
                if(diashabiles<1){
                    $("#btn7").css({"display":"none"});
                }
            }
        }
        ajax.send(null);
    })
})




/* OBTENER EL DETALLE DEL SOLICITANTE */
$(function(){
    $("table td .ajax").click(function(){
        var code=$(this).parent().parent().children("td:eq(0)").text().trim();
        var ajax=nuevoAjax();

        ajax.open("GET", "funcion?opcion=solicitud&&cod="+code, true);
        ajax.onreadystatechange=function() 
        { 
            if (ajax.readyState==4 && ajax.status==200)
            {
                var xmlre = ajax.responseText;
                var posicion=xmlre.indexOf('{')+1;
                var posicionfin =xmlre.indexOf('}');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                var json=cadena.split(',');

                console.log(cadena +"-------"+code);
                // VALIDACION DE DIAS HABILES DE TRABAJO
                $(".codigo").val(setear_json(json[0]));
                $(".codper").val(setear_json(json[1]));
                $(".nomper").val(setear_json(json[2]));
                $(".cargo").val(setear_json(json[3]));
                $(".area").val(setear_json(json[4]));
                $(".inicio").val(setear_json(json[5]));
                $(".fecfin").val(setear_json(json[6]));
                $(".totday").val(setear_json(json[7]));
                $(".perio").val(setear_json(json[8]));

            } 
        }
        ajax.send(null);
    });
})


//GENERAR PERMISO  (DENAGAR O CANCELAR) DE LA MISMA JEFATURA
$(function(){
    $(".ajax").unbind("click");

    $(".permiso").click(function(){

        $("#btn7").attr("disabled",false);
        $("#btn7").css({background: "none", opacity:"1"});

        var valor=$(this).val();
        var codigo=$(this).parent().parent().children("td:eq(0)").text();

        var ajax=nuevoAjax();

        if(valor=="si")
        {
            ajax.open("GET", "funcion?opcion=conceder&&cod="+codigo, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                    var posicion=xmlre.indexOf("{-}")+3;
                    var posicionfin=xmlre.indexOf("*");
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                } 
            }
            ajax.send(null);
        }
        else
        {
            ajax.open("GET", "funcion?opcion=denegar&&cod="+codigo, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                } 
            }
            ajax.send(null);
        }
    })
    
    $(".conceder").click(function(){
        $(".visualizar").trigger("click");
    });

})







// FUNCION DINAMICA QUE EJECUTA EL PERMISO POR LA BUSQUEDA O FILTRO PERSONALIZADO 
function conceder_permisos(sol,est){
    var ajax=nuevoAjax();

    if(est=="si"){
        ajax.open("GET","funcion?opcion=conceder_rh_masivo&&sol="+sol, true);
    }else{
        ajax.open("GET","funcion?opcion=denegar_rh_masivo&&sol="+sol, true);
    }
        
    ajax.onreadystatechange=function() 
    { 
        if (ajax.readyState==4 && ajax.status==200)
        {
            var xmlre = ajax.responseText;
            var posicion=xmlre.indexOf('{-}')+3;
            var posicionfin =xmlre.indexOf('|');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
        } 
    }
    ajax.send(null);
}

//ENVIO DE CORREO MASIVO DESDE RECURSOS HUMANOS
$(function(){
    $(".envio_masivo").attr("disabled",true);
    $(".enviar_masivo").attr("disabled",true);

    $(".enviar_masivo").click(function(){
        var correo =$(".area_rh").val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=respuesta_masiva&&correo="+correo,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200){
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('{-}')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                alert(cadena);
            }
        }
        ajax.send(null);
    })
})


// GENERAR PERMISO  (DENAGAR O CANCELAR) DE RECURSOS HUMANOS
$(function(){
    $(".ajax").unbind("click");

    $(".permiso_rh").click(function(){

        $("#btn7").attr("disabled",false);
        $("#btn7").css({background: "none", opacity:"1"});

        var valor=$(this).val();
        var codigo=$(this).parent().parent().children("td:eq(0)").text();
        var nom=$(this).parent().parent().children("td:eq(1)").text();
        var inicio=$(this).parent().parent().children("td:eq(4)").text().split('/');
        var finali=$(this).parent().parent().children("td:eq(5)").text().split('/');
        var tot=$(this).parent().parent().children("td:eq(6)").text();
        var ajax=nuevoAjax();

        var ini=inicio[1]+"/"+inicio[0]+"/"+inicio[2];
        var fin=finali[1]+"/"+finali[0]+"/"+finali[2];

        if(valor=="si")
        {
            ajax.open("GET", "funcion?opcion=conceder_rh&&cod="+codigo+"&&n="+nom+"&&i="+ini+"&&f="+fin+"&&t="+tot, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                } 
            }
            ajax.send(null);
        }
        else
        {
            ajax.open("GET", "funcion?opcion=denegar_rh&&cod="+codigo+"&&n="+nom+"&&i="+ini+"&&f="+fin+"&&t="+tot, true);
            ajax.onreadystatechange=function() 
            { 
                if (ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre = ajax.responseText;
                } 
            }
            ajax.send(null);
        }

    })
    
    $(".conceder").click(function(){
        $(".visualizar").trigger("click");
    });
    
})



$(function(){
    $(".ajax").unbind("click");

    $(".otros").click(function(){
        $("#btn7").attr("disableb",false);
        $("#btn7").css({background:"none",opacity:"1"});

        var valor=$(this).val();
        var codigo=$(this).parent().parent().children("td:eq(0)").text();
        var ajax=nuevoAjax();

        if(valor=="si")
        {
            ajax.open("GET","function?opcion=eliminar&&cod="+codigo,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre=ajax.responseText;
                }
            }
            ajax.send(null);
        }
        else
        {
            ajax.open("GET","funcion=opcion=borrar&&cod="+codigo,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre=ajax.responseText;
                }
            }
            ajax.send(null);
        }

    });


})


/* FUNCION PARA LISTADO DE VACACIONES JEFATURA */
$(function(){
    $(".tipo_sv").change(function(){
        document.getElementById("listado").innerHTML="----";

        var tipo=$(this).val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=listado&&tipo="+tipo,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200){
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                document.getElementById("listado").innerHTML=cadena;
            }
        }
        ajax.send(null);
    })
})



/* FUNCION PARA LISTADO DE VACACIONES RECURSOS HUMANOS */

$(function(){

    $(".area_rh").change(function(){
        $('.tipo_sv_RH').val('1');
        $(".conceder").css({"opacity": "0.5", "background": "rgb(199,199,199)" });
        $(".enviar_masivo").attr("disabled",true);
    })

    $(".tipo_sv_RH").change(function(){

        var tipo=$(this).val();
        var area=$(".area_rh option:selected").text().trim();

        if(tipo=="PR"){
            $(".conceder").css({"opacity": "1", "background": "none" });
            $(".enviar_masivo").attr("disabled",false);
            $(".tit_jeft").html("Aceptar");
            $(".tit_rrhh").html("Cancelar");
        }
        else
        {
            $(".conceder").css({"opacity": "0.5", "background": "rgb(199,199,199)" });
            $(".enviar_masivo").attr("disabled",true);
            $(".tit_jeft").html("Jefatura");
            $(".tit_rrhh").html("RR.HH.");
        }

        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=listado_rh&&tipo="+tipo+"&&area="+area,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200){
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                document.getElementById("listado_rh").innerHTML=cadena;
            }
        }
        ajax.send(null);
    })
})


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



$(function(){
    var intervalo = setInterval("rangodias()", 500);
});


function rangodias()
{
    for(var x=1;x<100;x++){
        if($(".fecini"+x).length>0 && $(".fecfin"+x).length>0){
            var fechaini = $('.fecini'+x).val();
            var fechafin = $('.fecfin'+x).val();
            if(fechaini!="" && fechafin!=""){
                var car1= fechaini.substring(2,3).trim();
                var car2= fechafin.substring(2,3).trim();
                var aFecha1 = fechaini.split(car1); 
                var aFecha2 = fechafin.split(car2); 
                var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
                var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
                var dif = fFecha2 - fFecha1;
                var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
                $(".total"+x).val(dias+1);

            }
        }
    }


    if($(".inifec").length>0 && $(".finfec").length>0){
        var fechaini = $('.inifec').val();
        var fechafin = $('.finfec').val();
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
    }


    if($(".fecini").length>0 && $(".fecfin").length>0){
        var fechaini = $('.fecini').val();
        var fechafin = $('.fecfin').val();

        if(fechaini!="" && fechafin!=""){
            var car1= fechaini.substring(2,3).trim();
            var car2= fechafin.substring(2,3).trim();
            var aFecha1 = fechaini.split(car1); 
            var aFecha2 = fechafin.split(car2); 
            var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
            var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
            $(".totamod").val(dias+1);
        }
    }

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


/* FUNCIONES DE PROGRAMACION VACACIONES */
$(function(){
    
    var Fecha = new Date();
    var sFecha =Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear();

    $(".calen_fin").click(function(){
        var css = $(this).attr("class");
        var ini = css.indexOf("fec")+6;
        var cad = css.substring(ini,css.length);
        var tot = $(".totals"+cad).val();
        var fei = $(".fecini"+cad).val();
        
        if(fei==""){
           alert("Ingrese la Fecha Inicio");
        }
        else
        {
            var set_fec = valor.split("/");
            var fec_new = new Date( set_fec[0], set_fec[1], set_fec[2]);
            
            var add_fec = sumaFecha(tot,set_fec[2]+"/"+set_fec[1]+"/"+set_fec[0]);
            var set_add = add_fec.split("/");
            var fec_add = set_add[2]+"-"+set_add[1]+"-"+set_add[0];
            
            myCalendar2.setSensitiveRange(valor,fec_add);
            console.log("Elementos Nuevos => " + valor + " ||| " + fec_add  + " ||| " + total);
        }              
    });

    $(".programar").click(function(){

        $("#btn7").attr("disableb",false);
        $("#btn7").css({background:"none",opacity:"1"});
        $(".envio_masivo").attr("disabled",false);
        $(".envio_masivo").css({background:"none",opacity:"1"});


        var cod=$(this).parent().parent().children("td:eq(0)").text();
        var ini=$(".fecini"+cod).val();
        var fin=$(".fecfin"+cod).val();
        var tot=$(".total"+cod).val();
        
        var total   = parseInt($(".totals"+cod).val());
        var tot_lab = $(".si_lab"+cod).val();
        var tot_nla = $(".no_lab"+cod).val();

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
        /*
        if(total>=tot)
        {*/
            if(tot<7){
                msn = "El m&iacute;nimo de vacaciones es de 7 d&iacute;as.<br/> Vuelva a Seleccionar."
                informe(msn); 
                $("[name=programar"+cod+"]").attr("checked",false);
            }
            else
            {
                if(diafin == 5 || diafin == 6 )
                {
                    msn = "Sus vacaciones no pueden terminar un d&iacute;a no laborable.<br/> Vuelva a Seleccionar."
                    informe(msn); 
                    $("[name=programar"+cod+"]").attr("checked",false);
                }
                else
                {
                    if(total==tot)
                    {
                        if( nolaborables> tot_nla )
                        {
                            msn= " Ud. tiene pendientes S&aacute;bados y Domingos en sus vacaciones.<br/> Seleccione "+ tot_nla +" d&iacute;as no laborables.";
                            informe(msn); 
                            $("[name=programar"+cod+"]").attr("checked",false);
                        }
                        else if( laborables>tot_lab )
                        {
                            msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                            informe(msn);
                            $("[name=programar"+cod+"]").attr("checked",false);
                        }
                        else
                        {
                            var ajax=nuevoAjax();
                            ajax.open("GET","funcion?opcion=reg_sol_jef&&cod="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&lab="+laborables+"&&nla="+nolaborables,true);
                            ajax.onreadystatechange=function()
                            {
                                if(ajax.readyState==4 && ajax.status==200){
                                    var xmlre=ajax.responseText;
                                    var posicion=xmlre.indexOf('|')+1;
                                    var posicionfin =xmlre.indexOf('*');
                                    var cadena=ajax.responseText.substring(posicion,posicionfin);
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
                            informe(msn); 
                            $("[name=programar"+cod+"]").attr("checked",false);
                        }
                        else if( laborables > tot_lab )
                        {
                            msn= " Ud. tiene pendientes "+ tot_lab +" d&iacute;as laborables(Lunes a Viernes).<br/> Favor de Seleccionar Correctamente";
                            informe(msn);
                            $("[name=programar"+cod+"]").attr("checked",false);
                        }
                        else
                        {
                            var ajax=nuevoAjax();
                            ajax.open("GET","funcion?opcion=reg_sol_jef&&cod="+cod+"&&ini="+ini+"&&fin="+fin+"&&tot="+tot+"&&lab="+laborables+"&&nla="+nolaborables,true);
                            ajax.onreadystatechange=function()
                            {
                                if(ajax.readyState==4 && ajax.status==200){
                                    var xmlre=ajax.responseText;
                                    var posicion=xmlre.indexOf('|')+1;
                                    var posicionfin =xmlre.indexOf('*');
                                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                                }
                            }
                            ajax.send(null);
                        }
                        
                    }
                }
            }
            /*
        }
        else
        {
            var msn= " Ud. se ha excedido de la cantidad de d&iacute;as disponibles.<br/> Solo dispone de "+ total +" d&iacute;as de vacaciones";
            informe(msn);
            $("[name=programar"+cod+"]").attr("checked",false);
        }*/

        // SOLO HASTA AQUI
    });
    

    $(".conceder .programar").click(function(){
        informe("Registros Guardados Correctament");
    })
        
    $(".envio_masivo").mouseover(function(){
        var usuario=$(".interno").html().trim().split("<br>");
        var correo =usuario[1].substring(0,usuario[1].length-7);
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=programacion_masiva&&correo="+correo,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200){
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('{-}')+3;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
            }
        }
        ajax.send(null);
    })
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



/* FUNCIONES DE CAPTURA DE DOCUMENTOS */
$(function(){
    $(".documento").unbind("click");

    $(".documento").click(function(){
        var sol=$(this).parent().parent().children("td:eq(0)").text();
        var area=$(this).parent().parent().children("td:eq(3)").text();
        var cod="";

        switch(area){
            case "Sistemas":                            cod=1; break;
            case "Contabilidad":                        cod=2; break;
            case "Creditos y Finanzas":                 cod=3; break;
            case "Finanzas":                            cod=4; break;
            case "Marketing":                           cod=5; break;
            case "Recursos Humanos":                    cod=6; break;
            case "Gerencia Administracion y Finanzas":  cod=8; break;
            case "Amalie":                              cod=9; break;
            case "Logistica":                           cod=10; break;
            case "Comercial":                           cod=11; break;
            case "Industrial":                          cod=12; break;
            case "PostVenta":                           cod=13; break;
        }

        $(this).parent().attr("target","_blank");
        window.open("../documento?sol="+sol+"&&a="+cod);
    });

});



function documento(sol){
    var area=$(".area_rh").val();
    $(this).parent().attr("target","_blank");
    window.open("../documento?sol="+sol+"&&a="+area);
}



/* BUSQUEDA AVANZADA CON AJAX */
$(function(){
    $(".bus_cod").keyup(function(){
        var codigo=$(this).val().trim().toUpperCase();
        if(codigo!=""){
            var ajax=nuevoAjax();
            ajax.open("GET","funcion?opcion=list_employ_cod&&cod="+codigo,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre=ajax.responseText;
                    var posicion=xmlre.indexOf('{/}')+3;
                    var posicionfin =xmlre.indexOf('{-}');
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                    $(".listado-view2").html(cadena);
                }
            }
            ajax.send(null);
        }
    });
    $(".bus_cod").blur(function(){
        var valor=$(this).val().toUpperCase();
        if(valor!=""){
            $(".pers_click").trigger("click");
        }
    });

    $(".bus_nom").keyup(function(){
        var nombre=$(this).val().trim().toUpperCase();
        if(nombre!=""){
            var ajax=nuevoAjax();
            ajax.open("GET","funcion?opcion=list_employ&&nom="+nombre,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre=ajax.responseText;
                    var posicion=xmlre.indexOf('|')+1;
                    var posicionfin =xmlre.indexOf('*');
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                    $(".listado-view2").html(cadena);
                }
            }
            ajax.send(null);
        }
    });
    $(".bus_nom").blur(function(){
        var valor=$(this).val().toUpperCase();
        if(valor!=""){
            $(".pers_click").trigger("click");
        }
    });

    $(".bus_ape").keyup(function(){
        var apellido=$(this).val().trim().toUpperCase();

        if(apellido!=""){
            var ajax=nuevoAjax();
            ajax.open("GET","funcion?opcion=list_employ_ape&&ape="+apellido,true);
            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4 && ajax.status==200)
                {
                    var xmlre=ajax.responseText;
                    var posicion=xmlre.indexOf('|')+1;
                    var posicionfin =xmlre.indexOf('{-}');
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                    $(".listado-view2").html(cadena);
                }
            }
            ajax.send(null);
        }
    });
    $(".bus_ape").blur(function(){
        var valor=$(this).val().toUpperCase();
        if(valor!=""){
            $(".pers_click").trigger("click");
        }
    });

});



/* LISTADO DINAMICA DE SUB AREA */

$(function(){

    if($(".tipo").length>0){
        var tipo_sl=$(".tipo").val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=lista_subarea&&cod="+tipo_sl,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".lista_subarea").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".lista_subarea").html(cadena);
            }
        }
        ajax.send(null);
    }

    $(".tipo").change(function(){
        var codigo=$(this).val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=lista_subarea&&cod="+codigo,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".lista_subarea").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".lista_subarea").html(cadena);
            }
        }
        ajax.send(null);
    });
});



/* RETORNO DE VALORES VACACIONES POR TRABAJADOR */
$(function(){
    $(".codtot").click(function(){
        var codtot=$(this).parent().children("td:eq(0)").text();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_totacu&&cod="+codtot,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('+')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                var parte=cadena.split(",");
                window.opener.$(".totacu").val(parte[0]);
                window.opener.$(".totlab").val(parte[1]);
                window.opener.$(".totnla").val(parte[2]);
                if(cadena!=""){
                    window.close();
                }
            }
        }
        ajax.send(null);
    });
});




/* VALIDACION DE CAMPOS Y VALORES */
$(function(){

    $("#totdias").mouseover(function(){
        var total=$("#totdias").val();
        var finss=$(".totacu").val();
        if(parseInt(total)>parseInt(finss))
        {
            informe("La cantidad de d&iacute;as indicada est&aacute; fuera de la cantidad que Ud. dispone, favor de volver a seleccionar.");
        }
    });

    $(".validar").mouseover(function(){
        var total=$("#totdias").val();
        var finss=$(".totacu").val();
        if(parseInt(total)>parseInt(finss))
        {
            informe("La cantidad de d&iacute;as indicada est&aacute; fuera de la cantidad que Ud. dispone, favor de volver a seleccionar.");
        }
    });

});



/* FUNCION PARA FILTRADO DE PERMISOS */
$(function(){

    if($(".bus_per").length>0){
        var opcion=$(".bus_per").val();
        var dato=opcion.split('-');
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_permisos&&subp="+dato[0]+"&usu="+dato[1],true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".permisos_list").html(cadena);
            }
        }
        ajax.send(null);
    }


    $(".bus_per").change(function(){
        var value=$(this).val();
        var dato=value.split('-');
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_permisos&&subp="+dato[0]+"&usu="+dato[1],true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".permisos_list").html(cadena);
            }
        }
        ajax.send(null);
    });

    $(".cerrar_permiso").click(function(){
        window.close();
    });
})

function permitir(cod,usu){
    var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=dar_permiso&&subp="+cod+"&usu="+usu,true);
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200)
        {
            var xmlre=ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('*');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            console.log(cadena);
        }
    }
    ajax.send(null);
}

function denegar(cod,usu){
    var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=denegar_permiso&&subp="+cod+"&usu="+usu,true);
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200)
        {
            var xmlre=ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('*');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            console.log(cadena);
        }
    }
    ajax.send(null);
}


/* -------------------- */




/* FUNCION PARA AGREGAR PERSONAL AL GRUPO */

$(function(){
    var alto = parseInt(screen.height);
    var ancho = parseInt(screen.width);
    var centroalto = parseInt((alto / 2));
    var centroancho = parseInt((ancho / 2));
    var Xpopud = centroancho - parseInt((450 / 2));
    var Ypopud = centroalto - parseInt((550 / 2));

    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=450, height=500, top="+Ypopud+", left="+Xpopud;

    $(".busqueda15").click(function(){
        var valor=$("#cod").val();
        $("#bloque").fadeIn();
        window.open("../modificar/personal_grupo?gr="+valor,"",opciones);
    });

    $(".ver_grupo").click(function(){
        var gru=$("#cod").val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=ver_grupo&&gru="+gru,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('+');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".list_grupo").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".btmod_salir").click(function(){
        window.opener.$('#bloque').fadeOut(); 
        window.close(); 
    });

    $(".btmod_guardar").click(function(){
        window.opener.$('#bloque').fadeOut(); 
        window.close(); 
    });
    
})

function add_usuario(cod,gru){
    var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=add_usuario&&cod="+cod+"&gru="+gru,true);
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200)
        {
            var xmlre=ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('+');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            window.opener.$(".list_grupo").html(cadena);
        }
    }
    ajax.send(null);
}

function del_usuario(cod,gru){
    var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=del_usuario&&cod="+cod+"&gru="+gru,true);
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200)
        {
            var xmlre=ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('+');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            window.opener.$(".list_grupo").html(cadena);
        }
    }
    ajax.send(null);
}

/* -------------------- */



/* FUNCION PARA AGREGAR PERSONAL AL GRUPO */

$(function(){
    var alto = parseInt(screen.height);
    var ancho = parseInt(screen.width);
    var centroalto = parseInt((alto / 2));
    var centroancho = parseInt((ancho / 2));
    var Xpopud = centroancho - parseInt((450 / 2));
    var Ypopud = centroalto - parseInt((550 / 2));

    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=450, height=500, top="+Ypopud+", left="+Xpopud;

    
    $(".busqueda16").click(function(){
        var valor=$("#cod").val();
        $("#bloque").fadeIn();
        window.open("../modificar/alerta?gr="+valor,"",opciones);
    });

    $(".ver_correos").click(function(){
        var gru=$("#cod").val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=ver_correo&&gru="+gru,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('+');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".list_correo").html(cadena);
            }
        }
        ajax.send(null);
    });

    $(".btmod_salir_msg").click(function(){
        window.opener.$('#bloque').fadeOut(); 
        window.close(); 
    });

    $(".btmod_guardar_msg").click(function(){
        window.opener.$('#bloque').fadeOut(); 
        window.close(); 
    });
    
})

function ver_correo_lista(){
    window.opener.$(".ver_correos").trigger("click");
}


function del_correo(cod,seq){
    var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=del_correo&&cod="+cod+"&&seq="+seq,true);
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4 && ajax.status==200)
        {
            var xmlre=ajax.responseText;
            var posicion=xmlre.indexOf('|')+1;
            var posicionfin =xmlre.indexOf('+');
            var cadena=ajax.responseText.substring(posicion,posicionfin);
            window.opener.$(".list_correo").html(cadena);
            $(".boton").trigger("click");
        }
    }
    ajax.send(null);
}

/* -------------------- */


/* FUNCIONES DE LA CONSULTA VACACIONES PERSONALES */
$(function(){
    $(".sel_anio").change(function(){
        var valor=$(this).val();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=list_vac_per&&valor="+valor,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado-view").html(cadena);
            }
        }
        ajax.send(null);
    })
});



/* CONSULTA VACACIONES POR : PROGRAMACION, QUIENES CUMPLIRAN AÑO MAS Y LOS ACUMULADOS */
$(function(){
    $(".optt1, .opt2, .optt3, .opt4").css({"display":"none"});

    $(".opt_fil").click(function(){
        var valor=$(this).val();
        if(valor==1)
        {
            $(".opt1").fadeIn();
            $(".opt2, .opt3, .opt4").css({"display":"none"});
        }
        else if(valor==2 || valor==4)
        {
            $(".opt1, .opt3, .opt4").css({"display":"none"});
            $(".opt2").fadeIn();
        }
        else if(valor==3)
        {
            $(".opt2, .opt1, .opt4").css({"display":"none"});
            $(".opt3").fadeIn();
        }
    })

    $(".opt_fil").change(function(){
        $(".listado_consultas_mul").html("");
    });


    $(".opt_fil").change(function(){
        $(".codbus").val("");
        $(".nombus").val("");
        $(".opt_area").val("");
        $(".opt_mes").val("");
        $(".opt_area2").val("");
    })


    $(".opt_mes").change(function(){
        var area=parseInt($(".opt_area").val());
        var mess= parseInt($(this).val())+1;
        var valor=$('input:radio[name=opcion]:checked').val();
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        if(valor==4 || valor==2){
            var opcion="opcion="+texto+"&&busare="+area+"&&busmes="+mess;
            var ajax=nuevoAjax();
            ajax.open("GET","funcion?"+opcion,true);
            ajax.onreadystatechange=function(){
                if(ajax.readyState==4 && ajax.status==200)
                {
                    $(".listado_consultas_mul").html("");
                    var xmlre=ajax.responseText;
                    var posicion=xmlre.indexOf('|')+1;
                    var posicionfin =xmlre.indexOf('*');
                    var cadena=ajax.responseText.substring(posicion,posicionfin);
                    $(".listado_consultas_mul").html(cadena);
                }
            }
            ajax.send(null);
        }
    });

    $(".boton_mult").click(function(){
        var valor=$('input:radio[name=opcion]:checked').val();
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        var opcion="";

        if(valor!=null && texto!=null){
            if(valor==1)
            {
                $(".opt1").fadeIn();
                $(".opt2, .opt3, .opt4").css({"display":"none"});
                var codbus=$(".codbus").val();
                var nombus=$(".nombus").val();
                var apebus=$(".apebus").val();
                opcion="opcion="+texto+"&&codbus="+codbus+"&&nombus="+nombus+"&&apebus="+apebus;
            }
            else if(valor==2 || valor==4)
            {
                $(".opt1, .opt3, .opt4").css({"display":"none"});
                $(".opt2").fadeIn();
                var busare=parseInt($(".opt_area").val());
                var busmes=parseInt($(".opt_mes").val())+1;
                opcion="opcion="+texto+"&&busare="+busare+"&&busmes="+busmes;
            }
            else if(valor==3)
            {
                $(".opt2, .opt1, .opt4").css({"display":"none"});
                $(".opt3").fadeIn();
                var busarea=parseInt($(".opt_area2").val());
                opcion="opcion="+texto+"&&busarea="+busarea;
            }
        }
        else
        {
            opcion="opcion=listado_general";
        }

        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);

    })

    $(".opt_area2").change(function(){
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        var busarea=parseInt($(".opt_area2").val());
        opcion="opcion="+texto+"&&busarea="+busarea;
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);
    });

    $(".opt_area").change(function(){
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        var busare=parseInt($(".opt_area").val());
        var busmes=parseInt($(".opt_mes").val())+1;
        opcion="opcion="+texto+"&&busare="+busare+"&&busmes="+busmes;
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);
    });


    $(".codbus").keyup(function(){
        var codbus=$(".codbus").val();
        var nombus=$(".nombus").val();
        var apebus=$(".apebus").val();
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        opcion="opcion="+texto+"&&codbus="+codbus+"&&nombus="+nombus+"&&apebus="+apebus;
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);
    })

    $(".nombus").keyup(function(){
        var codbus=$(".codbus").val();
        var nombus=$(".nombus").val();
        var apebus=$(".apebus").val();
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        opcion="opcion="+texto+"&&codbus="+codbus+"&&nombus="+nombus+"&&apebus="+apebus;
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);
    })

    $(".apebus").keyup(function(){
        var codbus=$(".codbus").val();
        var nombus=$(".nombus").val();
        var apebus=$(".apebus").val();
        var texto=$('input:radio[name=opcion]:checked').attr("text");
        opcion="opcion="+texto+"&&codbus="+codbus+"&&nombus="+nombus+"&&apebus="+apebus;
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?"+opcion,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                $(".listado_consultas_mul").html("");
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                $(".listado_consultas_mul").html(cadena);
            }
        }
        ajax.send(null);

    })
    
})




/* FUNCION PARA CONTROL DE USUARIOS */
$(function(){
    $(".Deshabilitar").click(function(){ //3
        var codigo=$(this).parent().parent().children("td:eq(0)").text();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=Deshabilitar&&cod="+codigo,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                informe(cadena);
            }
        }
        ajax.send(null);
    });

    $(".Desactivar").click(function(){ //1 
        var codigo=$(this).parent().parent().children("td:eq(0)").text();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=Desactivar&&cod="+codigo,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                informe(cadena);
            }
        }
        ajax.send(null);
    });

    $(".Habilitar").click(function(){ //1
        var codigo=$(this).parent().parent().children("td:eq(0)").text();
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=Habilitar&&cod="+codigo,true);
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4 && ajax.status==200)
            {
                var xmlre=ajax.responseText;
                var posicion=xmlre.indexOf('|')+1;
                var posicionfin =xmlre.indexOf('*');
                var cadena=ajax.responseText.substring(posicion,posicionfin);
                informe(cadena);
            }
        }
        ajax.send(null);
    });

});



$(function(){
    $(".bus_history").click(function(){
       var ini=$(".date").val();
       var fin=$(".date2").val();
       var cod=$(".codigo").val();
       var nom=$(".nombre").val();
       var ape=$(".apellido").val();

       var ajax=nuevoAjax();

       ajax.open("GET","funcion?opcion=buscar_history&&cod="+cod+"&&nom="+nom+"&&ape="+ape+"&&ini="+ini+"&&fin="+fin,true);
       ajax.onreadystatechange=function(){
           if( ajax.readyState == 4 && ajax.status==200)
           {
                var xmlhtp = ajax.responseText;
                var posini = xmlhtp.indexOf("{-}")+3;
                var posfin = xmlhtp.indexOf("{+}");
                var cadena = xmlhtp.substring(posini,posfin);
                $("#list_history").html(cadena);
           }
       }
       ajax.send(null);

    });
});


/* FUNCIONES PARA HISTORIAL */
$(function(){
    $(".cerrar_history").click(function(){
        window.opener.$("#bloque").fadeOut();
        window.close();
    });
});