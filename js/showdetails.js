$(document).ready(function(){
  $(".image").mouseover(function(){
    $(".pname").slideDown();
  });
  $(".image").mouseout(function(){
    $(".pname").css("display","none");
  });
  });