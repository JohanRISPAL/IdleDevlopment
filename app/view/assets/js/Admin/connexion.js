$( document ).ready(function(){
    var user = $("#username"),
		pwd = $("#password");
        
	$(".errorGlobal").hide();
    $(".errorEmpty").hide();
    $(".banned").hide();

    $("#bouttonConnexion").click(function(event){

    		$.ajax({
    			data : {method : "getAdmin", user : user.val(), pass : pwd.val()},
    			type : "post",
    			url : "./app/view/assets/js/fonctionJs.php",
    			success: function(response)
    			{
                    var reponse = JSON.parse(response);
                    console.log(reponse);

                    if (reponse == false)
                    {
                        exist = false;
                    }

                    else
                    {
                        exist = true; 
                    }

                    if (user.val() == "" || pwd.val() == "")
                    {
                        user.css({
                            borderColor : 'red',
                            color : 'red',
                        });
                        pwd.css({
                            borderColor : 'red',
                            color : 'red',
                        });

                        $(".banned").hide();
                        $(".errorEmpty").show();
                        $(".errorGlobal").hide();
                    }
                    
                    else if (exist == false)
                    {
                        user.css({
                            borderColor : 'red',
                            color : 'red',
                        });
                        pwd.css({
                            borderColor : 'red',
                            color : 'red',
                        });

                        $(".banned").hide();
                        $(".errorGlobal").show();
                        $(".errorEmpty").hide();
                    }

                    else if (exist == true)
                    {
                        document.location.href="http://localhost/idleDevlopment/index.php?p=accueil&role=admin";
                    }

    			}
		    });
            
	});    
});