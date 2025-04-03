$(document).ready(function(){

  $('.menu-icon span').click(function(){
    if($('.sidebar').position().left == '0')  
      closeMenu();
    else
      openMenu();
  })

  $(window).resize(function(){
    if($('.sidebar').position().left == '0')  
      $('#painel-content').css("width","calc(100% - 300px)")
    else
      $('#painel-content').css("width","calc(100% - 50px)")
      
  })

})

function closeMenu(){
    $('.side-content span').stop().animate({opacity: 0},200,'swing',function(){
      $('.sidebar').stop().animate({left: "-250"},400)
      $('#painel-content').stop().animate({left: "50",width: "+=250"},400);
      $('.side-content i').stop().animate({left:'245'},400);
      
    });

    setTimeout(function(){
        $('.menu-icon i').removeClass("fa-backward");
        $('.menu-icon i').addClass("fa-forward");
    },400)
    
    $('.menu-icon span').attr('title',"Abrir menu lateral");
}

function openMenu(){
    $('.sidebar').stop().animate({left: "0"},300)
    $('#painel-content').stop().animate({left: "300",width: "-=250"},300)
    $('.side-content i').stop().animate({'left':'25'},300,'swing',function(){
      $('.side-content span').stop().animate({opacity: 1},200);
    });
  
    setTimeout(function(){
      $('.menu-icon i').addClass("fa-backward");
      $('.menu-icon i').removeClass("fa-forward");
    },200);
  
    $('.menu-icon span').attr('title',"Fechar menu lateral");
}