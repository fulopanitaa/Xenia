$(document).ready(function(){
    $("#opennav").click(function(){
      $("nav").css("display","block");
      $("#opennav").css("display","none");

      if ($(window).width() <= 850) {  
        $("article").css("width","100%");
           // is mobile device
    }   
    else 
    $("article").css("width","85%");
    });
  
    $("#logo").click(function(){
      $("nav").css("display","none");
      $("article").css("width","100%");
      $("#opennav").css("display","block");
      

      
    });
    });