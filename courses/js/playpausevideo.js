var myVideo = document.getElementById('princess'); 

function playPause() { 
  if (myVideo.paused) 
    myVideo.play(); 
  else 
	myVideo.pause(); 
}