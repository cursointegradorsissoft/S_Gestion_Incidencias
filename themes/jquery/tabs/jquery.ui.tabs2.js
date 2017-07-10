var a= jQuery.noConflict();

a(document).ready(function(){
  a("#tabs").tabs();
});

a(document).ready(function(){
  a("ul.tabs li").click(function(){
    a("ul.tabs li").removeClass("active");

    a(this).addClass("active"); 
    a(".tab_content").hide();

    var content = a(this).find("a").attr("href"); 
    a(content).fadeIn(); 
    return false;
  });
});


a(document).ready(function(){
  a("#distrito").change(function(){
    var marca = a("#marca").val();
    var depar = a("#departamento").val();
    var distr = a("#distrito").val();

      a(".crokis-sede .view").css({background: "url('themes/images/sedes/croquis/"+distr+".png')", backgroundSize: "100% 100%"});

      switch(marca)
      {
        case "1":
          a(".image-sede .view").css({background: "url('themes/images/sedes/peugeot/"+distr+".jpg')", backgroundSize: "100% 100%"});
          break;
        case "2":
          a(".image-sede .view").css({background: "url('themes/images/sedes/baic/"+distr+".jpg')", backgroundSize: "100% 100%"});
          break;
        case "3":
          a(".image-sede .view").css({background: "url('themes/images/sedes/amalie/"+distr+".jpg')", backgroundSize: "100% 100%"});
          break;
        case "4":
          a(".image-sede .view").css({background: "url('themes/images/sedes/industrial/"+distr+".png')", backgroundSize: "100% 100%"});
          break;
      }

  });
});

a(document).ready(function(){
  a(".detail-marca").css({display: "block"});
  a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1.png')", backgroundSize: "100% 100%"});

  a(".view-marcas  ul li .img").hover(function(){
    //a(this).css({background: "url('themes/images/marcas/1.png')", backgroundSize: "100% 100%"});
  });

  a(".pagination ul li").click(function(){
    var ruta = a(this).find("a").attr("href");
    var rutanueva = ruta.substring(1,ruta.length);
      if(rutanueva == "pag1")
      {
        a(".interno1").css({display: "block"});
        a(".interno2").css({display: "none"});
      }
      else if(rutanueva== "pag2")
      {
        a(".interno1").css({display: "none"});
        a(".interno2").css({display: "block"});
      }
  });

  a(".view-marcas ul li").click(function(){
    var valor = a(this).find("a").attr("href"); 
    var valorNuevo = valor.substring(1,valor.length);

    /*
    for (var i = 1; i <= 5; i++) {
      alert("Nuevo" + i);
    };
    */

    switch(valorNuevo) {
        case 'peugeot':
            a(".detail-marca").css({display: "block"});
            a(".detail-marca2").css({display: "none"});
            a(".detail-marca3").css({display: "none"});
            a(".detail-marca4").css({display: "none"});
            a(".detail-marca5").css({display: "none"});
            a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img2").css({background: "url('themes/images/marcas/2c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img3").css({background: "url('themes/images/marcas/3c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img4").css({background: "url('themes/images/marcas/4c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img5").css({background: "url('themes/images/marcas/5c.png')", backgroundSize: "100% 100%"});
            break;
        case 'baic':
            a(".detail-marca").css({display: "none"});
            a(".detail-marca2").css({display: "block"});
            a(".detail-marca3").css({display: "none"});
            a(".detail-marca4").css({display: "none"});
            a(".detail-marca5").css({display: "none"});
            a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img2").css({background: "url('themes/images/marcas/2.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img3").css({background: "url('themes/images/marcas/3c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img4").css({background: "url('themes/images/marcas/4c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img5").css({background: "url('themes/images/marcas/5c.png')", backgroundSize: "100% 100%"});
            break;
        case 'amalie':
            a(".detail-marca").css({display: "none"});
            a(".detail-marca2").css({display: "none"});
            a(".detail-marca3").css({display: "block"});
            a(".detail-marca4").css({display: "none"});
            a(".detail-marca5").css({display: "none"});
            a(".interno1").css({display: "block"});
            a(".interno2").css({display: "none"});
            a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img2").css({background: "url('themes/images/marcas/2c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img3").css({background: "url('themes/images/marcas/3.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img4").css({background: "url('themes/images/marcas/4c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img5").css({background: "url('themes/images/marcas/5c.png')", backgroundSize: "100% 100%"});
            break;
        case 'postventa':
            a(".detail-marca").css({display: "none"});
            a(".detail-marca2").css({display: "none"});
            a(".detail-marca3").css({display: "none"});
            a(".detail-marca4").css({display: "block"});
            a(".detail-marca5").css({display: "none"});
            a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img2").css({background: "url('themes/images/marcas/2c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img3").css({background: "url('themes/images/marcas/3c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img4").css({background: "url('themes/images/marcas/4.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img5").css({background: "url('themes/images/marcas/5c.png')", backgroundSize: "100% 100%"});
            break;
        case 'industrial':
            a(".detail-marca").css({display: "none"});
            a(".detail-marca2").css({display: "none"});
            a(".detail-marca3").css({display: "none"});
            a(".detail-marca4").css({display: "none"});
            a(".detail-marca5").css({display: "block"});
            a(".interno1").css({display: "block"});
            a(".view-marcas  ul li .img").css({background: "url('themes/images/marcas/1c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img2").css({background: "url('themes/images/marcas/2c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img3").css({background: "url('themes/images/marcas/3c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img4").css({background: "url('themes/images/marcas/4c.png')", backgroundSize: "100% 100%"});
            a(".view-marcas  ul li .img5").css({background: "url('themes/images/marcas/5.png')", backgroundSize: "100% 100%"});
            break;
    }
  });
});