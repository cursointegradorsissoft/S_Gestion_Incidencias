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

var nombreselect=new Array();
nombreselect[0]="marca";
nombreselect[1]="departamento";
nombreselect[2]="distrito";
nombreselect[3]="departamento2";
nombreselect[4]="distrito2";
nombreselect[5]="departamento3";
nombreselect[6]="distrito3";

function buscarEnArray(array, dato)
{
	var x=0;
	while(array[x])
	{
		if(array[x]==dato) return x;
		x++;
	}
	return null;
}

function cargaContenido(idSelectOrigen)
{
	var posicionSelectDestino=buscarEnArray(nombreselect, idSelectOrigen)+1;
	var selectOrigen=document.getElementById(idSelectOrigen);
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	if(opcionSeleccionada==0)
	{
		var x=posicionSelectDestino, selectActual=null;
		while(nombreselect[x])
		{
			selectActual=document.getElementById(nombreselect[x]);
			selectActual.length=0;

			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
	}

	else if(idSelectOrigen!=nombreselect[nombreselect.length-1])
	{
		var idSelectDestino=nombreselect[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		var ajax=nuevoAjax();
		ajax.open("GET", "funcion?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=false;	
			}
			if (ajax.readyState==4)
			{
				selectDestino.innerHTML=ajax.responseText;				
			} 
		}
		ajax.send(null);
	}
}


