$(document).ready(function(){

	/*
		de fiecare data cand input ul cu id #ziua
		se modifica, cu ajax, se ia de pe pagina
		free_hours.php orele libere din ziua selectata
	*/
	$('#ziua').change(function() {
		$.ajax({
			method: "GET",
			url: 'free_hours.php',
			data: {
				data: $('#ziua').val()
			},
			success : function(data) {
				var hours = data.trim().split(" ");
				$('#ora').html("");
				for(var hour of hours)
				{
					$('#ora').append('<option value="'+hour+'">'+hour+'</option>');
				}
				$('#ora').prop("disabled", false);
			}
		});
	});
})