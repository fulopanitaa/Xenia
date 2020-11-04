function addToWish(event)
{
    event.preventDefault();
 
    $.ajax({
        type: "POST",
        url: "./wishAction.php",
        data: {
            'action':'addItem',
            'id': $(event.target).find("input[name='id']").val(),
        },
        success: function(e)
        {
            if(e == "ok")
            {
                alert("Produsul a fost adaugat!");
            } else {
                alert("A aparut o eroare. Mai incearca o data.");
                console.log(e);
            }
        }
    });
}