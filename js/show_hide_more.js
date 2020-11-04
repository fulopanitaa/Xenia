var a;
	function show_hide_more()
	{
		if(a==1)
		{
			document.getElementById("more").style.display="block";
			return a=0;
		}
		else
		{
			document.getElementById("more").style.display="none";
			return a=1;
		}
	}