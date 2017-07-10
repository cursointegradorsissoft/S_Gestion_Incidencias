var g = new JSGantt.GanttChart('g',document.getElementById('contenedor'), 'day');

function nuevoAjax()
{ 
  var xmlhttp=false;
  try
  {
    xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
  }catch(e){
    try
    {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }catch(E){
      if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
    }
  }
  return xmlhttp; 
}
 

/* /*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\ */
/* ---------------------------------------- */
/*  FUNCIONES PARA HISTORIAL DE VACACIONES  */
/* ---------------------------------------- */
/* /*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\ */
var num = 100000;
$(function(){

    if($("#contenedor").length>0){
      var orden=3;
      var area=$(".area").val();
      //llamar_gant1(g,orden,area);
      g = new JSGantt.GanttChart('g',document.getElementById('contenedor'), 'day');
      var ajax=nuevoAjax();
      ajax.open("GET","funcion?opcion=obtener_vacaciones&&orden="+orden+"&&area="+area,true);
      ajax.onreadystatechange=function()
      {
          if(ajax.readyState==4 && ajax.status==200)
          {
              var htpxml  = ajax.responseText; 
              var posini1 = htpxml.indexOf("{-}")+3;
              var posfin1 = htpxml.indexOf("{/}")-2;
              var textos1 = ajax.responseText.substring(posini1,posfin1);
              var array1  = textos1.split(",");

              var posini2 = htpxml.indexOf("{/}")+3;
              var posfin2 = htpxml.indexOf("{*}")-2;
              var textos2 = ajax.responseText.substring(posini2,posfin2);
              var array2  = textos2.split(",");

              g.setShowRes(1);
              g.setShowDur(1);
              g.setShowComp(1); 
              g.setCaptionType('Resource');

              for(var z=0; z<array1.length; z++){
                var array3 = array1[z].split("-");
                var optcod = array3[0];
                var tomados = array3[3];
                var pendiente = array3[4];
                g.AddTaskItem(new JSGantt.TaskItem(array3[0], array3[1] , '', '', '00ff00', array3[0],0, array3[3], pendiente, 1, 0, 0));
                
                for(var y=0;y<array2.length;y++){
                    var array4 = array2[y].split("-");
                    if(optcod == array4[0]){
                        num = num + 1;
                        g.AddTaskItem(new JSGantt.TaskItem(num, array4[1], array4[2], array4[3], '00ff00', optcod, 0, tomados, pendiente, 0, optcod, 1));
                    }
                }
              }
              g.Draw(); 
              g.DrawDependencies();
          }
      }
      ajax.send(null);


      $(".area").change(function(){
        var h;
        var orden=3;
        var area=$(".area").val();
        u = new JSGantt.GanttChart('g',document.getElementById('contenedor'), 'day');
        var ajax=nuevoAjax();
        ajax.open("GET","funcion?opcion=obtener_vacaciones&&orden="+orden+"&&area="+area,true);
        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4 && ajax.status==200)
            {
                var htpxml  = ajax.responseText; 
                var posini1 = htpxml.indexOf("{-}")+3;
                var posfin1 = htpxml.indexOf("{/}")-2;
                var textos1 = ajax.responseText.substring(posini1,posfin1);
                var array1  = textos1.split(",");

                var posini2 = htpxml.indexOf("{/}")+3;
                var posfin2 = htpxml.indexOf("{*}")-2;
                var textos2 = ajax.responseText.substring(posini2,posfin2);
                var array2  = textos2.split(",");

                u.setShowRes(1);
                u.setShowDur(1);
                u.setShowComp(1); 
                u.setCaptionType('Resource');

                for(var z=0; z<array1.length; z++){
                  var array3 = array1[z].split("-");
                  var optcod = array3[0];
                  var tomados = array3[3];
                  var pendiente = array3[4];
                  u.AddTaskItem(new JSGantt.TaskItem(array3[0], array3[1] , '', '', '00ff00', array3[0],0, array3[3], pendiente, 1, 0, 0));
                  
                  for(var y=0;y<array2.length;y++){
                      var array4 = array2[y].split("-");
                      if(optcod == array4[0]){
                          num = num + 1;
                          u.AddTaskItem(new JSGantt.TaskItem(num, array4[1], array4[2], array4[3], '00ff00', optcod, 0, tomados, pendiente, 0, optcod, 1));
                      }
                  }
                }
                u.Draw(); 
                u.DrawDependencies();
            }
        }
        ajax.send(null);
      });

    }
});


function scroll1_div(){ 
  var scroll = $(".scroll").scrollTop();
  $( ".scroll2" ).scrollTop(scroll);
}

function scroll2_div(){ 
  var scroll = $(".scroll2").scrollTop();
  $( ".scroll" ).scrollTop(scroll);
}


/* /*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\ */
/* ---------------------------------------- */
/*  FUNCIONES PARA VACACIONES PROGRAMADOAS  */
/* ---------------------------------------- */
/* /*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\/*|*\ */

$(function(){
    if ( $("#contenedor2").length>0){
      var area=$(".area2").val();
      var orde = 3;
      var a;
      var fecha="";
      llamar_gant2(a,orde,area,fecha);


      var num = 100000;
      $(".area2").change(function(){
          var area =$(".area2").val();
          var orde = 3;
          var b;
          var fecha="";
          llamar_gant2(b,orde,area,fecha);
      })
    }
});


function filtar_fecha(val){
  var fech = val;
  var area = $(".area2").val();
  var order = 3;
  var f;
  llamar_gant2(f,order,area,fech);
}

var tp=0;
function filtrado_scroll1(val){
    var order;
    var area=$(".area2").val();
    var fecha="";

    switch(val){
      case 'nombres':  order=2;   break;
      case 'inicio':   order=3;   break;
      case 'fin':      order=4;   break;
      case 'total':    order=6;   break; 
    }

    if(tp==0){
        tp=tp+1;  order= order + " ASC ";
    }else{
        tp=tp-1;  order= order + " DESC ";
    }
    llamar_gant2(i,order,area,fecha);
}


function llamar_gant2(letra,order,area,fecha){
  letra = new JSGantt.GanttChart('g',document.getElementById('contenedor2'), 'day');
  var ajax=nuevoAjax();
    ajax.open("GET","funcion?opcion=obtener_vacaciones2&&orden="+order+"&&area="+area+"&&fecha="+fecha,true);
    ajax.onreadystatechange=function()
    {
        if(ajax.readyState==4 && ajax.status==200)
        {   
            var htpxml  = ajax.responseText; 
            var posini = htpxml.indexOf("{/}")+3;
            var posfin = htpxml.indexOf("{*}")-2;
            var textos = ajax.responseText.substring(posini,posfin);
            var array  = textos.split(",");

            letra.setShowRes(1);
            letra.setShowDur(1);
            letra.setShowComp(1); 
            letra.setCaptionType('Resource');

            if( textos.length>2){
                for( var z = 0 ; z< array.length; z++){
                  var array2 = array[z].split("-");
                  var optcol;
                  array2[4]==1?optcol=0:optcol=50;
                  var pendiente = parseInt(array2[6]-array2[7]);
                  letra.AddTaskItem(new JSGantt.TaskItem(z, array2[1], array2[2], array2[3], '00ff00', array2[0],0, array2[7], pendiente, optcol, 0, 1, 100));
                }
            }else{
                $("#contenedor2").html("");
                letra.AddTaskItem(new JSGantt.TaskItem(0, "Ninguno", "01/01/2015", "12/31/2015", '00ff00', 'ruta',0, "", 100, 0, 0, 1, 100));
            }
            letra.Draw(); 
            letra.DrawDependencies();
        }
    }
    ajax.send(null);
}

/* PARA APERTURAR HISTORIAL DINAMICO */
function historial(cod){
    $("#bloque").fadeIn();
    var alto          = parseInt(screen.height);
    var ancho         = parseInt(screen.width);
    var centroalto    = parseInt((alto / 2));
    var centroancho   = parseInt((ancho / 2));
    var Xpopud        = centroancho - parseInt((600 / 2));
    var Ypopud        = centroalto - parseInt((600 / 2));
    var OpenWindow    = window.open("../modificar/historial?cod="+cod, "newwin", "height=600,width=600,top="+Ypopud+",left="+Xpopud); 
}

/* PARA EXPORTAR LAS TABLAS A EXCEL */
$(function(){
    
    $(".exp_gant_excel").click(function(event) {
        html2canvas($(".scroll2"),{
            onrendered: function(canvas){
                theCanvas = canvas;
                //document.body.appendChild(canvas);
                var canvasData = canvas.toDataURL("image/png");
                $.ajax({
                    url:'../modificar/envio_excel', 
                    type:'POST', 
                    data:{
                        data:canvasData
                    }
                });
            }
        });
        $("#datos_a_enviar").val($("<div>").append( $(".scroll").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });

    
    $(".exp_history_vaca").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('#contenedor').html()));
        e.preventDefault();
    });
    
});




