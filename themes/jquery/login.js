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


$(function(){
    $(".msgBox").css({"background":"white"});
    $(".msgBoxImage img").attr("src","themes/images/int.png");
});

function mensaje(m) {
    $.msgBox({
        title: "Mensaje del Sistema",
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

