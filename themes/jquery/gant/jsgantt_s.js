var JSGantt; if (!JSGantt) JSGantt = {};
var vTimeout = 0;
var vBenchTime = new Date().getTime();

JSGantt.isIE = function () {
   if(typeof document.all != 'undefined')
      return true;
   else
      return false;
}

JSGantt.TaskItem = function(pID, pName, pStart, pEnd, pColor, pLink, pMile, pRes, pComp, pGroup, pParent, pOpen, pDepend, pCaption)
{

      var vID    = pID;
      var vName  = pName;
      var vStart = new Date();   
      var vEnd   = new Date();
      var vColor = pColor;
      var vLink  = pLink;
      var vMile  = pMile;
      var vRes   = pRes;
      var vComp  = pComp;
      var vGroup = pGroup;
      var vParent = pParent;
      var vOpen   = pOpen;
      var vDepend = pDepend;
      var vCaption = pCaption;
      var vDuration = '';
      var vLevel = 0;
      var vNumKid = 0;
      var vVisible  = 1;
      var x1, y1, x2, y2;

      if (vGroup != 1)
      {  
         vStart = JSGantt.parseDateStr(pStart,g.getDateInputFormat());
         vEnd   = JSGantt.parseDateStr(pEnd,g.getDateInputFormat());
      }

      this.getID       = function(){ return vID };
      this.getName     = function(){ return vName };
      this.getStart    = function(){ return vStart};
      this.getEnd      = function(){ return vEnd  };
      this.getColor    = function(){ return vColor};
      this.getLink     = function(){ return vLink };
      this.getMile     = function(){ return vMile };
      this.getDepend   = function(){ if(vDepend) return vDepend; else return null };
      this.getCaption  = function(){ if(vCaption) return vCaption; else return ''; };
      this.getResource = function(){ if(vRes) return vRes; else return '&nbsp';  };
      this.getCompVal  = function(){ if(vComp) return vComp; else return 0; };
      this.getCompStr  = function(){ if(vComp) return vComp+'%'; else return ''; };

      this.getDuration = function(vFormat){ 
         if (vMile) 
            vDuration = '-';
         else if (vFormat=='hour')
         {
            tmpPer =  Math.ceil((this.getEnd() - this.getStart()) /  ( 60 * 60 * 1000) );
            if(tmpPer == 1) vDuration = '1 Hora';
            else vDuration = tmpPer + ' Horas';
         }else if (vFormat=='minute'){
            tmpPer =  Math.ceil((this.getEnd() - this.getStart()) /  ( 60 * 1000) );
            if(tmpPer == 1) vDuration = '1 Minuto';
            else vDuration = tmpPer + ' Minutos';
         }else {
            tmpPer =  Math.ceil((this.getEnd() - this.getStart()) /  (24 * 60 * 60 * 1000) + 1);
            if(tmpPer == 1)  vDuration = '1 Dia';
            else             vDuration = tmpPer + ' Dias';
         }
         return( vDuration )
      };

      this.getParent   = function(){ return vParent };
      this.getGroup    = function(){ return vGroup };
      this.getOpen     = function(){ return vOpen };
      this.getLevel    = function(){ return vLevel };
      this.getNumKids  = function(){ return vNumKid };
      this.getStartX   = function(){ return x1 };
      this.getStartY   = function(){ return y1 };
      this.getEndX     = function(){ return x2 };
      this.getEndY     = function(){ return y2 };
      this.getVisible  = function(){ return vVisible };
     this.setDepend   = function(pDepend){ vDepend = pDepend;};
      this.setStart    = function(pStart){ vStart = pStart;};
      this.setEnd      = function(pEnd)  { vEnd   = pEnd;  };
      this.setLevel    = function(pLevel){ vLevel = pLevel;};
      this.setNumKid   = function(pNumKid){ vNumKid = pNumKid;};
      this.setCompVal  = function(pCompVal){ vComp = pCompVal;};
      this.setStartX   = function(pX) {x1 = pX; };
      this.setStartY   = function(pY) {y1 = pY; };
      this.setEndX     = function(pX) {x2 = pX; };
      this.setEndY     = function(pY) {y2 = pY; };
      this.setOpen     = function(pOpen) {vOpen = pOpen; };
      this.setVisible  = function(pVisible) {vVisible = pVisible; };
}

JSGantt.GanttChart =  function(pGanttVar, pDiv, pFormat)
{

      var vGanttVar = pGanttVar;
      var vDiv      = pDiv;
      var vFormat   = pFormat;
      var vShowRes  = 1;
      var vShowDur  = 1;
      var vShowComp = 1;
      var vShowStartDate = 1;
      var vShowEndDate = 1;
      var vDateInputFormat = "mm/dd/yyyy";
      var vDateDisplayFormat = "mm/dd/yy";
     var vNumUnits  = 0;
      var vCaptionType;
      var vDepId = 1;
      var vTaskList     = new Array(); 
     var vFormatArr     = new Array("day","week","month","quarter");
      var vQuarterArr   = new Array(1,1,1,2,2,2,3,3,3,4,4,4);
      var vMonthDaysArr = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
      var vMonthArr     = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
     this.setFormatArr  = function()     {
                                vFormatArr = new Array();
                                for(var i = 0; i < arguments.length; i++) {vFormatArr[i] = arguments[i];}
                                if(vFormatArr.length>4){vFormatArr.length=4;}
                               };
      this.setShowRes   = function(pShow) { vShowRes  = pShow; };
      this.setShowDur   = function(pShow) { vShowDur  = pShow; };
      this.setShowComp  = function(pShow) { vShowComp = pShow; };
      this.setShowStartDate   = function(pShow) { vShowStartDate = pShow; };
      this.setShowEndDate     = function(pShow) { vShowEndDate = pShow; };
      this.setDateInputFormat = function(pShow) { vDateInputFormat = pShow; };
      this.setDateDisplayFormat = function(pShow) { vDateDisplayFormat = pShow; };
      this.setCaptionType = function(pType) { vCaptionType = pType };
      this.setFormat = function(pFormat){ 
         vFormat = pFormat; 
         this.Draw(); 
      };

      this.getShowRes  = function(){ return vShowRes };
      this.getShowDur  = function(){ return vShowDur };
      this.getShowComp = function(){ return vShowComp };
      this.getShowStartDate = function(){ return vShowStartDate };
      this.getShowEndDate = function(){ return vShowEndDate };
      this.getDateInputFormat = function() { return vDateInputFormat };
      this.getDateDisplayFormat = function() { return vDateDisplayFormat };
      this.getCaptionType = function() { return vCaptionType };
      this.CalcTaskXY = function () 
      {
         var vList = this.getList();
         var vTaskDiv;
         var vParDiv;
         var vLeft, vTop, vHeight, vWidth;

         for(i = 0; i < vList.length; i++)
         {
            vID = vList[i].getID();
            vTaskDiv = document.getElementById("taskbar_"+vID);
            vBarDiv  = document.getElementById("bardiv_"+vID);
            vParDiv  = document.getElementById("childgrid_"+vID);

            if(vBarDiv) {
               vList[i].setStartX( vBarDiv.offsetLeft );
               vList[i].setStartY( vParDiv.offsetTop+vBarDiv.offsetTop+6 );
               vList[i].setEndX( vBarDiv.offsetLeft + vBarDiv.offsetWidth );
               vList[i].setEndY( vParDiv.offsetTop+vBarDiv.offsetTop+6 );
            }
         }
      }

      this.AddTaskItem = function(value)
      {
         vTaskList.push(value);
      }

      this.getList   = function() { return vTaskList };

      this.clearDependencies = function()
      {
         var parent = document.getElementById('rightside');
         var depLine;
         var vMaxId = vDepId;
         for ( i=1; i<vMaxId; i++ ) {
            depLine = document.getElementById("line"+i);
            if (depLine) { parent.removeChild(depLine); }
         }
         vDepId = 1;
      }

      this.sLine = function(x1,y1,x2,y2) {

         vLeft = Math.min(x1,x2);
         vTop  = Math.min(y1,y2);
         vWid  = Math.abs(x2-x1) + 1;
         vHgt  = Math.abs(y2-y1) + 1;

         vDoc = document.getElementById('rightside');

    var oDiv = document.createElement('div');

    oDiv.id = "line"+vDepId++;
         oDiv.style.position = "absolute";
    oDiv.style.margin = "0px";
    oDiv.style.padding = "0px";
    oDiv.style.overflow = "hidden";
    oDiv.style.border = "0px";

    // set attributes
    oDiv.style.zIndex = 0;
    oDiv.style.backgroundColor = "red";
   
    oDiv.style.left = vLeft + "px";
    oDiv.style.top = vTop + "px";
    oDiv.style.width = vWid + "px";
    oDiv.style.height = vHgt + "px";

    oDiv.style.visibility = "visible";
   
    vDoc.appendChild(oDiv);

      }

      this.dLine = function(x1,y1,x2,y2) {

         var dx = x2 - x1;
         var dy = y2 - y1;
         var x = x1;
         var y = y1;

         var n = Math.max(Math.abs(dx),Math.abs(dy));
         dx = dx / n;
         dy = dy / n;
         for ( i = 0; i <= n; i++ )
         {
            vx = Math.round(x); 
            vy = Math.round(y);
            this.sLine(vx,vy,vx,vy);
            x += dx;
            y += dy;
         }

      }

      this.drawDependency =function(x1,y1,x2,y2)
      {
         if(x1 + 10 < x2)
         { 
            this.sLine(x1,y1,x1+4,y1);
            this.sLine(x1+4,y1,x1+4,y2);
            this.sLine(x1+4,y2,x2,y2);
            this.dLine(x2,y2,x2-3,y2-3);
            this.dLine(x2,y2,x2-3,y2+3);
            this.dLine(x2-1,y2,x2-3,y2-2);
            this.dLine(x2-1,y2,x2-3,y2+2);
         }
         else
         {
            this.sLine(x1,y1,x1+4,y1);
            this.sLine(x1+4,y1,x1+4,y2-10);
            this.sLine(x1+4,y2-10,x2-8,y2-10);
            this.sLine(x2-8,y2-10,x2-8,y2);
            this.sLine(x2-8,y2,x2,y2);
            this.dLine(x2,y2,x2-3,y2-3);
            this.dLine(x2,y2,x2-3,y2+3);
            this.dLine(x2-1,y2,x2-3,y2-2);
            this.dLine(x2-1,y2,x2-3,y2+2);
         }
      }

      this.DrawDependencies = function () {
         this.CalcTaskXY();
         this.clearDependencies();
         var vList = this.getList();
         for(var i = 0; i < vList.length; i++)
         {
            vDepend = vList[i].getDepend();
            if(vDepend) {
               var vDependStr = vDepend + '';
               var vDepList = vDependStr.split(',');
               var n = vDepList.length;

               for(var k=0;k<n;k++) {
                  var vTask = this.getArrayLocationByID(vDepList[k]);
               }
            }
         }
      }


      this.getArrayLocationByID = function(pId)  {
         var vList = this.getList();
         for(var i = 0; i < vList.length; i++)
         {
            if(vList[i].getID()==pId)
               return i;
         }
      }


   this.Draw = function()
   {
      var vMaxDate = new Date();
      var vMinDate = new Date(); 
      var vTmpDate = new Date();
      var vNxtDate = new Date();
      var vCurrDate = new Date();
      var vTaskLeft = 0;
      var vTaskRight = 0;
      var vNumCols = 0;
      var vID = 0;
      var vMainTable = "";
      var vLeftTable = "";
      var vRightTable = "";
      var vDateRowStr = "";
      var vItemRowStr = "";
      var vColWidth = 0;
      var vColUnit = 0;
      var vChartWidth = 0;
      var vNumDays = 0;
      var vDayWidth = 0;
      var vStr = "";
      var vNameWidth = 220;   
      var vStatusWidth = 70;
      var vLeftWidth = 360;

      if(vTaskList.length > 0)
      {
         JSGantt.processRows(vTaskList, 0, -1, 1, 1);
         vMinDate = JSGantt.getMinDate(vTaskList, vFormat);
         vMaxDate = JSGantt.getMaxDate(vTaskList, vFormat);
         if(vFormat == 'day') {
            vColWidth = 18;
            vColUnit = 1;
         }
         

         vNumDays = (Date.parse(vMaxDate) - Date.parse(vMinDate)) / ( 24 * 60 * 60 * 1000);
         vNumUnits = Math.ceil(vNumDays / vColUnit);
          
         
         vChartWidth = vNumUnits * vColWidth + 1;
         vDayWidth = (vColWidth / vColUnit) + (1/vColUnit);


         vMainTable =
            '<TABLE id=theTable cellSpacing=0 cellPadding=0 border=0>'+
            '<TBODY>'+
            '<TR>' +
            '<TD vAlign=top bgColor=#ffffff>';

         if(vShowRes !=1) vNameWidth+=vStatusWidth;
         if(vShowDur !=1) vNameWidth+=vStatusWidth;
         if(vShowComp!=1) vNameWidth+=vStatusWidth;
         if(vShowStartDate!=1) vNameWidth+=vStatusWidth;
         if(vShowEndDate!=1) vNameWidth+=vStatusWidth;
         
         vLeftTable =
            '<DIV class=scroll id=leftside style="width:' + vLeftWidth + 'px" onscroll=scroll1_div() >'+
               '<TABLE cellSpacing=0 cellPadding=0 border=0><TBODY>' +
               '<TR style="HEIGHT: 20px">' +
                  '<TD style="WIDTH: 15px; "></TD>' +
                  '<TD style="WIDTH: ' + vNameWidth + 'px; "><NOBR></NOBR></TD>'; 

         if(vShowRes ==1) vLeftTable += '  <TD style="WIDTH: ' + vStatusWidth + 'px;"></TD>' ;
         if(vShowDur ==1) vLeftTable += '  <TD style="WIDTH: ' + vStatusWidth + 'px;"></TD>' ;
         if(vShowComp==1) vLeftTable += '  <TD style="WIDTH: ' + vStatusWidth + 'px;"></TD>' ;
         if(vShowStartDate==1) vLeftTable += '<TD style="WIDTH: ' + vStatusWidth + 'px;"></TD>' ;
         if(vShowEndDate==1) vLeftTable += '<TD style="WIDTH: ' + vStatusWidth + 'px;"></TD>' ;

         var css1="BORDER-TOP: #efefef 1px solid; background: orange; text-align:center !important; color:rgba(255,255,255,1); HEIGHT: 17px !important; padding-left:5px;padding-right:5px; FONT-SIZE: 12px;";
         var img = "src='../themes/jquery/gant/icons/filter.png'";

         vLeftTable +='</TR>'+
         '<TR style="HEIGHT: 20px; overflow:hidden;">' +
            '<TD style=" '+css1+' WIDTH: 15px;  "></TD>' +
            '<TD style=" '+css1+' WIDTH: ' + vNameWidth + 'px; " >Nombres y Apellidos <img '+img+' onclick=filtrado_scroll1("nombres") /></TD>' ;
         if(vShowDur ==1) vLeftTable += '<TD style=" '+css1+' BORDER-LEFT: #efefef 1px solid; " >Total <img '+img+' onclick=filtrado_scroll1("total") /> </TD>' ;
         if(vShowStartDate==1) vLeftTable += '<TD style=" '+css1+' BORDER-LEFT: #efefef 1px solid; " > Fecha Inicio <img '+img+' onclick=filtrado_scroll1("inicio") /> </TD>' ;
         if(vShowEndDate==1) vLeftTable += '<TD style=" '+css1+' BORDER-LEFT: #efefef 1px solid; " >Fecha Fin<img '+img+' onclick=filtrado_scroll1("fin") /> </TD>' ;
         if(vShowRes ==1) vLeftTable += '  <TD style=" '+css1+' BORDER-LEFT: #efefef 1px solid; " >Tomados</TD>' ;
         if(vShowComp==1) vLeftTable += '  <TD style=" '+css1+' BORDER-LEFT: #efefef 1px solid; " >Pendientes</TD>' ;
     
         vLeftTable += '</TR>';

         for(i = 0; i < vTaskList.length; i++)
         {  
            
            if(vTaskList[i].getGroup()){
               vBGColor = "f3f3f3";
               vRowType = "group";
            }else{
               vBGColor  = "ffffff";
               vRowType  = "row";
            }

            vID = vTaskList[i].getID();
            if(vTaskList[i].getVisible() == 0) 
               vLeftTable += '<TR id=child_' + vID + ' bgcolor=#' + vBGColor + ' style="display:none"  onMouseover=g.mouseOver(this,' + vID + ',"left","' + vRowType + '") onMouseout=g.mouseOut(this,' + vID + ',"left","' + vRowType + '")>' ;
            else
               vLeftTable += '<TR id=child_' + vID + ' bgcolor=#' + vBGColor + ' onMouseover=g.mouseOver(this,' + vID + ',"left","' + vRowType + '") onMouseout=g.mouseOut(this,' + vID + ',"left","' + vRowType + '")>' ;

            vLeftTable += 
               '<TD class=gdatehead style="WIDTH: 15px; HEIGHT: 20px; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;">&nbsp;</TD>' +
               '<TD class=gname style="WIDTH: ' + vNameWidth + 'px; HEIGHT: 20px; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px;" nowrap><NOBR><span style="color: #aaaaaa">';

            for(j=1; j<vTaskList[i].getLevel(); j++) {
               vLeftTable += '&nbsp&nbsp&nbsp&nbsp';
            }

            vLeftTable += '</span>';
            if(vTaskList[i].getGroup()) {
               if(vTaskList[i].getOpen() == 1) 
                  vLeftTable += '<SPAN id="group_' + vID + '" style="color:#000000; cursor:pointer; font-weight:bold; FONT-SIZE: 12px;" onclick="JSGantt.folder(' + vID + ','+vGanttVar+');'+vGanttVar+'.DrawDependencies();">&ndash;</span><span style="color:#000000">&nbsp</SPAN>' ;
               else
                  vLeftTable += '<SPAN id="group_' + vID + '" style="color:#000000; cursor:pointer; font-weight:bold; FONT-SIZE: 12px;" onclick="JSGantt.folder(' + vID + ','+vGanttVar+');'+vGanttVar+'.DrawDependencies();">+</span><span style="color:#000000">&nbsp</SPAN>' ;
            } else {
               vLeftTable += '<span style="color: #000000; font-weight:bold; FONT-SIZE: 12px;">&nbsp&nbsp&nbsp</span>';
            }

            var spaces="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            var elemento=spaces+spaces+spaces;
            if (vTaskList[i].getName().trim() == "Ninguno" ){
               elemento = spaces+spaces+spaces+spaces;
            }

            //JSGantt.formatDateStr( vTaskList[i].getStart(), vDateDisplayFormat)

            vLeftTable += 
               '<span onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200); style="cursor:pointer" nomrap> ' + vTaskList[i].getName() + '</span></NOBR>'+elemento+'</TD>' ;
            if(vShowDur ==1) vLeftTable += '  <TD class=gname style="WIDTH: 60px; HEIGHT: 20px; TEXT-ALIGN: center; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;" align=center>'+spaces+'<NOBR>' + vTaskList[i].getDuration(vFormat) + '</NOBR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</TD>' ;
            if(vShowStartDate==1) vLeftTable += '  <TD class=gname style="WIDTH: 60px; HEIGHT: 20px; TEXT-ALIGN: center; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;" align=center>'+spaces+'<NOBR>' + JSGantt.formatDateStr( vTaskList[i].getStart(), vDateDisplayFormat) + '</NOBR>'+spaces+'&nbsp&nbsp&nbsp&nbsp</TD>' ;
            if(vShowEndDate==1) vLeftTable += '  <TD class=gname style="WIDTH: 60px; HEIGHT: 20px; TEXT-ALIGN: center; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;" align=center>'+spaces+'<NOBR>' + JSGantt.formatDateStr( vTaskList[i].getEnd(), vDateDisplayFormat) + '</NOBR>'+spaces+'</TD>' ;
            if(vShowRes ==1) vLeftTable += '  <TD class=gname style="WIDTH: 60px; HEIGHT: 20px; TEXT-ALIGN: center; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;" align=center>'+spaces+'<NOBR>' + vTaskList[i].getResource() + '</NOBR>'+spaces+'</TD>' ;
            if(vShowComp==1) vLeftTable += '  <TD class=gname style="WIDTH: 60px; HEIGHT: 20px; TEXT-ALIGN: center; BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid;" align=center>'+spaces+'<NOBR>' + vTaskList[i].getCompStr()  + '</NOBR>'+spaces+'</TD>' ;
            
            vLeftTable += '</TR>';
         }

         vLeftTable += '</TD></TR>';

         vLeftTable += '</TD></TR></TBODY></TABLE></DIV></TD>';
         vMainTable += vLeftTable;


         vRightTable = 
         '<TD style="width: ' + vChartWidth + 'px;" vAlign=top bgColor=#ffffff>' +
         '<DIV class=scroll2 id=rightside onscroll=scroll2_div()>' +
         '<TABLE style="width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
         '<TBODY><TR style="HEIGHT: 18px">';
                  
         vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
         vTmpDate.setHours(0);
         vTmpDate.setMinutes(0);

         while(Date.parse(vTmpDate) <= Date.parse(vMaxDate))
         {  
            vStr = vTmpDate.getFullYear() + '';
            vStr = vStr.substring(2,4);
            
            if(vFormat == 'day')
            {
               var formato=JSGantt.formatDateStr(vTmpDate,vDateDisplayFormat);
               var fi = formato.split("/");
               var ini = fi[1]+"/"+fi[0]+"/"+fi[2];
               vTmpDate.setDate(vTmpDate.getDate()+6);
               var formato2=JSGantt.formatDateStr(vTmpDate, vDateDisplayFormat)
               var ff=formato2.split("/");
               var fin = ff[1]+"/"+ff[0]+"/"+ff[2];
               vRightTable += '<td class=gdatehead style="FONT-SIZE: 12px; HEIGHT: 19px; background:rgba(0,51,102,0.3); padding-right:5px; padding-left:5px;" align=center colspan=7>'+ ini +' - '+ fin +'</td>';
               vTmpDate.setDate(vTmpDate.getDate()+1);
            }
         }

         vRightTable += '</TR><TR>';

         vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
         vNxtDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
         vNumCols = 0;
         
         while(Date.parse(vTmpDate) <= Date.parse(vMaxDate))
         {  
            if(vFormat == 'day' )
            {
               if( JSGantt.formatDateStr(vCurrDate,'mm/dd/yyyy') == JSGantt.formatDateStr(vTmpDate,'mm/dd/yyyy')) {
                  vWeekdayColor  = "ccccff";
                  vWeekendColor  = "9999ff";
                  vWeekdayGColor  = "bbbbff";
                  vWeekendGColor = "8888ff";
               } else {
                  vWeekdayColor = "ffffff";
                  vWeekendColor = "cfcfcf";
                  vWeekdayGColor = "f3f3f3";
                  vWeekendGColor = "c3c3c3";
               }

               var css2="BORDER-TOP: #efefef 1px solid; FONT-SIZE: 12px; BORDER-LEFT: #efefef 1px solid; ";
               var fecha = vTmpDate.getFullYear() + "-"+ (vTmpDate.getMonth()+1) + "-"+vTmpDate.getDate();

               if(vTmpDate.getDay() % 6 == 0) {
                  vDateRowStr  += '<td class="gheadwkend" id="gheadwkend" style="'+css2+' HEIGHT: 19px; cursor:pointer; " bgcolor=#' + vWeekendColor + ' align=center onclick=filtar_fecha("'+ fecha +'") ><div style="width: '+vColWidth+'px; "  >' + vTmpDate.getDate() + '</div></td>';
                  vItemRowStr  += '<td class="gheadwkend" id="gheadwkend" style="'+css2+' cursor: default;"  bgcolor=#' + vWeekendColor + ' align=center><div style="width: '+vColWidth+'px">&nbsp</div></td>';
               } else {
                  vDateRowStr += '<td class="ghead" id="ghead" style="'+css2+' HEIGHT: 19px; cursor:pointer; "  bgcolor=#' + vWeekdayColor + ' align=center onclick=filtar_fecha("'+ fecha +'") ><div style="width: '+vColWidth+'px;  ">' + vTmpDate.getDate() + '</div></td>';
                  if( JSGantt.formatDateStr(vCurrDate,'mm/dd/yyyy') == JSGantt.formatDateStr(vTmpDate,'mm/dd/yyyy')) 
                     vItemRowStr += '<td class="ghead" style="'+css2+' cursor: default;"  bgcolor=#' + vWeekdayColor + ' align=center ><div style="width: '+vColWidth+'px">&nbsp&nbsp</div></td>';
                  else
                     vItemRowStr += '<td class="ghead" style="'+css2+' cursor: default;"  align=center><div style="width: '+vColWidth+'px" >&nbsp&nbsp</div></td>';
               }
               vTmpDate.setDate(vTmpDate.getDate() + 1);
            }
         }

         vRightTable += vDateRowStr + '</TR>';
         vRightTable += '</TBODY></TABLE>';

         for(i = 0; i < vTaskList.length; i++)
         {
            vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
            vTaskStart = vTaskList[i].getStart();
            vTaskEnd   = vTaskList[i].getEnd();

            vNumCols = 0;
            vID = vTaskList[i].getID();

            vNumUnits = (vTaskList[i].getEnd() - vTaskList[i].getStart()) / (24 * 60 * 60 * 1000) + 1;
            
            if(vTaskList[i].getVisible() == 0) 
               vRightTable += '<DIV id=childgrid_' + vID + ' style="position:relative; display:none;">';
            else
               vRightTable += '<DIV id=childgrid_' + vID + ' style="position:relative">';
            
            if( vTaskList[i].getMile()) {
               vRightTable += '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                  '<TR id=childrow_' + vID + ' class=yesdisplay style="HEIGHT: 20px" onMouseover=g.mouseOver(this,' + vID + ',"right","mile") onMouseout=g.mouseOut(this,' + vID + ',"right","mile")>' + vItemRowStr + '</TR></TABLE></DIV>';

               vDateRowStr = JSGantt.formatDateStr(vTaskStart,vDateDisplayFormat);
               vTaskLeft = (Date.parse(vTaskList[i].getStart()) - Date.parse(vMinDate)) / (24 * 60 * 60 * 1000);

               vTaskRight = 1

               alert("Aqui No Se Ingresa");
               vRightTable +=
                  '<div id=bardiv_' + vID + ' style="position:absolute; top:0px; left:' + Math.ceil((vTaskLeft * (vDayWidth) + 1)) + 'px; height: 18px; width:160px; overflow:hidden;">' +
                  '  <div id=taskbar_' + vID + ' title="' + vTaskList[i].getName() + ': ' + vDateRowStr + '" style="height: 16px; width:12px; overflow:hidden; cursor: pointer;" onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200);>';

               if(vTaskList[i].getCompVal() < 100)
                  vRightTable += '&loz;</div>' ;
               else
                  vRightTable += '&diams;</div>' ;

                  if( g.getCaptionType() ) {
                     vCaptionStr = '';
                     switch( g.getCaptionType() ) {           
                        case 'Caption':    vCaptionStr = vTaskList[i].getCaption();  break;
                        case 'Resource':   vCaptionStr = vTaskList[i].getResource();  break;
                        case 'Duration':   vCaptionStr = vTaskList[i].getDuration(vFormat);  break;
                        case 'Complete':   vCaptionStr = vTaskList[i].getCompStr();  break;
                     }
                     vRightTable += '<div style="FONT-SIZE:12px; position:absolute; top:2px; width:120px; left:12px">' + vCaptionStr + '</div>';
                  }
               vRightTable += '</div>';
            } else {
               vDateRowStr = JSGantt.formatDateStr(vTaskStart,vDateDisplayFormat) + ' - ' + JSGantt.formatDateStr(vTaskEnd,vDateDisplayFormat)
               vTaskRight = (Date.parse(vTaskList[i].getEnd()) - Date.parse(vTaskList[i].getStart())) / (24 * 60 * 60 * 1000) + 1/vColUnit;
               vTaskLeft = Math.ceil((Date.parse(vTaskList[i].getStart()) - Date.parse(vMinDate)) / (24 * 60 * 60 * 1000));

               if(vFormat='day')
               {
                  var tTime=new Date();
                  tTime.setTime(Date.parse(vTaskList[i].getStart()));
                  if (tTime.getMinutes() > 29)
                     vTaskLeft+=.5
               }

               var css3 = "Z-INDEX: -4; float:left;  background-color:rgba(0,51,102,1); overflow: hidden; width:1px;";
               var css4 = "Z-INDEX: -4; float:right; background-color:rgba(0,51,102,1); overflow: hidden; width:1px;";

               if( vTaskList[i].getGroup()) {
                  vRightTable += '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                  '<TR id=childrow_' + vID + ' class=yesdisplay style="HEIGHT: 20px" bgColor=#f3f3f3 onMouseover=g.mouseOver(this,' + vID + ',"right","group") onMouseout=g.mouseOut(this,' + vID + ',"right","group")>' + vItemRowStr + '</TR></TABLE></DIV>';
                  
                  vRightTable +=
                  '<div id=bardiv_' + vID + ' style="position:absolute; top:5px; left:' + Math.ceil(vTaskLeft * (vDayWidth) + 1) + 'px; height: 7px; width:' + Math.ceil((vTaskRight) * (vDayWidth) - 1) + 'px">' +
                    '<div id=taskbar_' + vID + ' title="' + vTaskList[i].getName() + ': ' + vDateRowStr + '" class=gtask style="background-color:rgba(0,51,102,1); height: 7px; width:' + Math.ceil((vTaskRight) * (vDayWidth) -1) + 'px;  cursor: pointer;opacity:0.9;">' +
                      '<div style="Z-INDEX: -4; float:left; background-color:rgba(0,51,102,1); height:3px; overflow: hidden; margin-top:1px; ' +
                            'margin-left:1px; margin-right:1px; filter: alpha(opacity=80); opacity:0.8; width:' + vTaskList[i].getCompStr() + '; ' + 
                            'cursor: pointer;" onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200);>' +
                        '</div>' +
                     '</div>' +
                     '<div style=" '+css3+' height:4px;"></div>' +
                     '<div style=" '+css4+' height:4px;"></div>' +
                     '<div style=" '+css3+' height:3px;"></div>' +
                     '<div style=" '+css4+' height:3px;"></div>' +
                     '<div style=" '+css3+' height:2px;"></div>' +
                     '<div style=" '+css4+' height:2px;"></div>' +
                     '<div style=" '+css3+' height:1px;"></div>' +
                     '<div style=" '+css4+' height:1px;"></div>' ;

                  if( g.getCaptionType() ) {
                     vCaptionStr = '';
                     switch( g.getCaptionType() ) {           
                        case 'Caption':    vCaptionStr = vTaskList[i].getCaption();  break;
                        case 'Resource':   vCaptionStr = vTaskList[i].getResource();  break;
                        case 'Duration':   vCaptionStr = vTaskList[i].getDuration(vFormat);  break;
                        case 'Complete':   vCaptionStr = vTaskList[i].getCompStr();  break;
                     }
                     vRightTable += '<div style="FONT-SIZE:12px; position:absolute; top:-3px; width:120px; left:' + (Math.ceil((vTaskRight) * (vDayWidth) - 1) + 6) + 'px">' + vCaptionStr + '</div>';
                  }
                  vRightTable += '</div>' ;
               } else {

                  vDivStr = '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                     '<TR id=childrow_' + vID + ' class=yesdisplay style="HEIGHT: 20px" bgColor=#ffffff onMouseover=g.mouseOver(this,' + vID + ',"right","row") onMouseout=g.mouseOut(this,' + vID + ',"right","row")>' + vItemRowStr + '</TR></TABLE></DIV>';
                  vRightTable += vDivStr;
                                    
                  var size_left = Math.ceil(vTaskLeft * (vDayWidth) + (1*vTaskLeft));
                  var size_right = Math.ceil(((vTaskRight * vDayWidth) + vTaskRight) -1);
                  vRightTable +=
                     '<div id=bardiv_' + vID + ' style="position:absolute; top:4px; left:' + size_left + 'px; height:18px; width:' + size_right + 'px">' +
                        '<div id=taskbar_' + vID + ' title="' + vTaskList[i].getName() + ': ' + vDateRowStr + '" class=gtask style="background-color:rgba(78,158,207,0.8); height: 13px; width:' + size_right + 'px; cursor: pointer;opacity:0.9;" ' +
                           'onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200); >' +
                           '<div class=gcomplete style="Z-INDEX: -4; float:left; background-color:rgba(100,130,255,1); height:5px; overflow: auto; margin-top:4px; filter: alpha(opacity=40); opacity:0.4; width:' + vTaskList[i].getCompStr() + '; overflow:hidden">' +
                           '</div>' +
                        '</div>';

                  if( g.getCaptionType() ) {
                     vCaptionStr = '';
                     switch( g.getCaptionType() ) {           
                        case 'Caption':    vCaptionStr = vTaskList[i].getCaption();  break;
                        case 'Resource':   vCaptionStr = vTaskList[i].getResource();  break;
                        case 'Duration':   vCaptionStr = vTaskList[i].getDuration(vFormat);  break;
                        case 'Complete':   vCaptionStr = vTaskList[i].getCompStr();  break;
                     }
                     vRightTable += '<div style="FONT-SIZE:12px; position:absolute; top:-3px; width:120px; left:' + size_right + 'px">' + vCaptionStr + '</div>';
                  }
                  vRightTable += '</div>' ;
               }
            }
            vRightTable += '</DIV>';
         }
         vMainTable += vRightTable + '</DIV></TD></TR></TBODY></TABLE></BODY></HTML>';
         vDiv.innerHTML = vMainTable;
      }
   } 

   this.mouseOver = function( pObj, pID, pPos, pType ) {
      if( pPos == 'right' )  vID = 'child_' + pID;
      else vID = 'childrow_' + pID;
      
      pObj.bgColor = "#ffffaa";
      vRowObj = JSGantt.findObj(vID);
      if (vRowObj) vRowObj.bgColor = "#ffffaa";
   }

   this.mouseOut = function( pObj, pID, pPos, pType ) {
      if( pPos == 'right' )  vID = 'child_' + pID;
      else vID = 'childrow_' + pID;
      
      pObj.bgColor = "#ffffff";
      vRowObj = JSGantt.findObj(vID);
      if (vRowObj) {
         if( pType == "group") {
            pObj.bgColor = "#f3f3f3";
            vRowObj.bgColor = "#f3f3f3";
         } else {
            pObj.bgColor = "#ffffff";
            vRowObj.bgColor = "#ffffff";
         }
      }
   }
}   


JSGantt.processRows = function(pList, pID, pRow, pLevel, pOpen){
   var vMinDate = new Date();
   var vMaxDate = new Date();
   var vMinSet  = 0;
   var vMaxSet  = 0;
   var vList    = pList;
   var vLevel   = pLevel;
   var i        = 0;
   var vNumKid  = 0;
   var vCompSum = 0;
   var vVisible = pOpen;
   
   for(i = 0; i < pList.length; i++)
   {
      if(pList[i].getParent() == pID) {
         vVisible = pOpen;
         pList[i].setVisible(vVisible);
         if(vVisible==1 && pList[i].getOpen() == 0) 
            vVisible = 0;
            
         pList[i].setLevel(vLevel);
         vNumKid++;

         if(pList[i].getGroup() == 1) {
            JSGantt.processRows(vList, pList[i].getID(), i, vLevel+1, vVisible);
         }

         if( vMinSet==0 || pList[i].getStart() < vMinDate) {
            vMinDate = pList[i].getStart();
            vMinSet = 1;
         }

         if( vMaxSet==0 || pList[i].getEnd() > vMaxDate) {
            vMaxDate = pList[i].getEnd();
            vMaxSet = 1;
         }
         vCompSum += pList[i].getCompVal();
      }
   }

   if(pRow >= 0) {
      pList[pRow].setStart(vMinDate);
      pList[pRow].setEnd(vMaxDate);
      pList[pRow].setNumKid(vNumKid);
      pList[pRow].setCompVal(Math.ceil(vCompSum/vNumKid));
   }
}

JSGantt.getMinDate = function getMinDate(pList, pFormat){
   var vDate = new Date();
   vDate.setFullYear(pList[0].getStart().getFullYear(), pList[0].getStart().getMonth(), pList[0].getStart().getDate());

   for(i = 0; i < pList.length; i++)
   {
      if(Date.parse(pList[i].getStart()) < Date.parse(vDate))
      vDate.setFullYear(pList[i].getStart().getFullYear(), pList[i].getStart().getMonth(), pList[i].getStart().getDate());
   }

   if (pFormat=='day')
   {
      vDate.setDate(vDate.getDate() - 1);
      while(vDate.getDay() % 7 > 0)
      {
         vDate.setDate(vDate.getDate() - 1);
      }
   }
   return(vDate);
}

JSGantt.getMaxDate = function (pList, pFormat){
   var vDate = new Date();
   vDate.setFullYear(pList[0].getEnd().getFullYear(), pList[0].getEnd().getMonth(), pList[0].getEnd().getDate());

   for(i = 0; i < pList.length; i++)
   {
      if(Date.parse(pList[i].getEnd()) > Date.parse(vDate))
      {
         vDate.setTime(Date.parse(pList[i].getEnd()));
      }  
   }

   if (pFormat=='day')
   {
      vDate.setDate(vDate.getDate() + 1);
      while(vDate.getDay() % 6 > 0)
      {
         vDate.setDate(vDate.getDate() + 1);
      }
   }
   return(vDate);
}

JSGantt.findObj = function (theObj, theDoc){
   var p, i, foundObj;

   if(!theDoc) theDoc = document;
   if( (p = theObj.indexOf("?")) > 0 && parent.frames.length){
      theDoc = parent.frames[theObj.substring(p+1)].document;
      theObj = theObj.substring(0,p);
   }

   if(!(foundObj = theDoc[theObj]) && theDoc.all) 
   foundObj = theDoc.all[theObj];

   for (i=0; !foundObj && i < theDoc.forms.length; i++) 
   foundObj = theDoc.forms[i][theObj];

   for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++)
   foundObj = JSGantt.findObj(theObj,theDoc.layers[i].document);

   if(!foundObj && document.getElementById)

   foundObj = document.getElementById(theObj);
   return foundObj;
}

JSGantt.changeFormat = function(pFormat,ganttObj) {
   if(ganttObj) 
   {
      ganttObj.setFormat(pFormat);
      ganttObj.DrawDependencies();
   }
   else
      alert('Chart undefined');
}

JSGantt.folder= function (pID,ganttObj) {

   var vList = ganttObj.getList();

   for(i = 0; i < vList.length; i++)
   {
      if(vList[i].getID() == pID) {

         if( vList[i].getOpen() == 1 ) {
            vList[i].setOpen(0);
            JSGantt.hide(pID,ganttObj);

            if (JSGantt.isIE()) 
               JSGantt.findObj('group_'+pID).innerText = '+';
            else
               JSGantt.findObj('group_'+pID).textContent = '+';
            
         } else {

            vList[i].setOpen(1);

            JSGantt.show(pID, 1, ganttObj);

               if (JSGantt.isIE()) 
                  JSGantt.findObj('group_'+pID).innerText = '–';
               else
                  JSGantt.findObj('group_'+pID).textContent = '–';

         }

      }
   }
}

JSGantt.hide= function (pID,ganttObj) {
   var vList = ganttObj.getList();
   var vID   = 0;

   for(var i = 0; i < vList.length; i++)
   {
      if(vList[i].getParent() == pID) {
         vID = vList[i].getID();
         JSGantt.findObj('child_' + vID).style.display = "none";
         JSGantt.findObj('childgrid_' + vID).style.display = "none";
         vList[i].setVisible(0);
         if(vList[i].getGroup() == 1) 
            JSGantt.hide(vID,ganttObj);
      }

   }
}

JSGantt.show = function (pID, pTop, ganttObj) {
   var vList = ganttObj.getList();
   var vID   = 0;

   for(var i = 0; i < vList.length; i++)
   {
      if(vList[i].getParent() == pID) {
         vID = vList[i].getID();
         if(pTop == 1) {
            if (JSGantt.isIE()) { // IE;

               if( JSGantt.findObj('group_'+pID).innerText == '+') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }

            } else {
 
               if( JSGantt.findObj('group_'+pID).textContent == '+') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }

            }

         } else {

            if (JSGantt.isIE()) { // IE;
               if( JSGantt.findObj('group_'+pID).innerText == '–') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }
            } else {
               if( JSGantt.findObj('group_'+pID).textContent == '–') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }
            }
         }

         if(vList[i].getGroup() == 1) JSGantt.show(vID, 0,ganttObj);
      }
   }
}

JSGantt.taskLink = function(pRef,pWidth,pHeight) 
{
   var alto          = parseInt(screen.height);
   var ancho         = parseInt(screen.width);
   var centroalto    = parseInt((alto / 2));
   var centroancho   = parseInt((ancho / 2));
   var Xpopud        = centroancho - parseInt((600 / 2));
   var Ypopud        = centroalto - parseInt((600 / 2));
   var OpenWindow    = window.open(pRef, "newwin", "height=600,width=600,top="+Ypopud+",left="+Xpopud); 
}

JSGantt.parseDateStr = function(pDateStr,pFormatStr) {
   var vDate =new Date();  
   vDate.setTime( Date.parse(pDateStr));
      
   switch(pFormatStr) 
   {
     case 'mm/dd/yyyy':
        var vDateParts = pDateStr.split('/');
         vDate.setFullYear(parseInt(vDateParts[2], 10), parseInt(vDateParts[0], 10) - 1, parseInt(vDateParts[1], 10));
         break;
     case 'dd/mm/yyyy':
        var vDateParts = pDateStr.split('/');
         vDate.setFullYear(parseInt(vDateParts[2], 10), parseInt(vDateParts[1], 10) - 1, parseInt(vDateParts[0], 10));
         break;
     case 'yyyy-mm-dd':
        var vDateParts = pDateStr.split('-');
         vDate.setFullYear(parseInt(vDateParts[0], 10), parseInt(vDateParts[1], 10) - 1, parseInt(vDateParts[1], 10));
         break;
    }
    return(vDate);
}

JSGantt.formatDateStr = function(pDate,pFormatStr) {
      vYear4Str = pDate.getFullYear() + '';
      vYear2Str = vYear4Str.substring(2,4);
      vMonthStr = (pDate.getMonth()+1) + '';
      vDayStr   = pDate.getDate() + '';

      if (vDayStr.trim() <10){ 
         vDayStr="0"+vDayStr; 
      }

      if (vMonthStr.trim() <10){ 
         vMonthStr="0"+vMonthStr; 
      }

      var vDateStr = "";   
      switch(pFormatStr) {
           case 'mm/dd/yyyy': 
               return(  vDayStr + '/' + vMonthStr + '/' + vYear4Str );
           case 'dd/mm/yyyy':
               return( vDayStr + '/' + vMonthStr + '/' + vYear4Str );
           case 'yyyy-mm-dd':
               return( vYear4Str + '-' + vMonthStr + '-' + vDayStr );
           case 'mm/dd/yy':
               return( vDayStr + '/' + vMonthStr + '/' + vYear2Str );
           case 'dd/mm/yy':
               return( vDayStr + '/' + vMonthStr + '/' + vYear2Str );
           case 'yy-mm-dd':
               return( vYear2Str + '-' + vMonthStr + '-' + vDayStr );
           case 'mm/dd':
               return( vMonthStr + '/' + vDayStr );
           case 'dd/mm':
               return( vDayStr + '/' + vMonthStr );
      }
}
