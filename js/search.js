$(document).ready(function(){

    $("#search-button").click(function(event){
        console.log(event);
        if(!$("#search").hasClass("active"))
        {
            $("#search").addClass("active");
            $("#search .input").focus();
        } else {
            $("#search").removeClass("active");
        }
        
    });

/*  function logout(event){
        event.preventDefault();

        if(confirm("Vrei sa iesi din cont?"))
        {
             $("#navbar_login_session").attr("href", "logout.php");
        }
    };
*/
    $.ajax({
        type: "GET",
        url: "./login_session.php",
        data: {},
        success: function(e)
        {
            var icon = $("#navbar_login_session").find("i");
            if(e == "")
            {
                $("#navbar_login_session").html("<a href='login.php'>"+e+"</a>");
            } else {
                $("#navbar_login_session").html("<a href='logout.php' onclick='logout(event)'>"+e+"</a>");
            }
            $("#navbar_login_session a").append(icon);
        }
    });

    $.ajax({
        type: "POST",
        url: "./cartAction.php",
        data: {
            'action':'item_count'
        },
        success: function(e)
        {
            if(e > 0)
            {
                $("#cart_bubble").show();
                $("#cart_bubble").text(e);
            } else {
                $("#cart_bubble").hide();
                $("#cart_bubble").text("");
            }
        }
    });

    
})
    