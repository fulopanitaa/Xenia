$(document).ready(function(){

//marime
    $("#sizeSetter .select-items div").click(function(){
        $("#addToCartForm input[name='marime']").val($(this).text());
    });

//cantitate

    $("#productQuanBox input[type='number']").on("change", function()
    {
        $("#addToCartForm input[name='cantitate']").val($(this).val());
    });



    $("#addToCartForm").submit(function(event)
    {
        event.preventDefault();

        if($(this).find("input[name='marime']").val() == "")
        {
            alert("Selectati o marime!");
        } else {
            $.ajax({
                type: "POST",
                url: "./cartAction.php",
                data: {
                    'action':'addItem',
                    'id':$(this).find("input[name='id']").val(),
                    'cantitate':$(this).find("input[name='cantitate']").val(),
                    'marime':$(this).find("input[name='marime']").val()
                },
                success: function(e)
                {
                    if(e == "ok")
                    {
                        alert("Produsul a fost adaugat!");
                    } else {
                        alert("A aparut o eroare. Mai incearca o data.");
                    }
                }
            });
        }
    })
});