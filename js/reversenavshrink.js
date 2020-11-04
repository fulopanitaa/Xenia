
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
  if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
	document.getElementById("nav").style.paddingTop = "43px";
	document.getElementById("nav").style.height = "100px";
	document.getElementById("logo").style.height = "80px";
	document.getElementById("logo").style.top = "10px";


  } else {
    //document.getElementsById("nav").style.height = "90px";
	document.getElementById("nav").style.paddingTop = "25px";
	document.getElementById("nav").style.height = "70px";
	document.getElementById("logo").style.height = "55px";
	document.getElementById("logo").style.top = "0px";

  }
}