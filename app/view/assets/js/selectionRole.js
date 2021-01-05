$( document ).ready(function(){
    $(".errorEmptyCandidate").hide();
    $(".errorEmptyProjectManager").hide();
    $(".errorEmptyAdmin").hide();

    $(".errorGlobalCandidate").hide();
    $(".errorGlobalProjectManager").hide();
    $(".errorGlobalAdmin").hide();

    let candidateId = $("#candidateId"),
    candidatePassword = $("#candidatePassword");

    let projectManagerId = $("#projectManagerId"),
    projectManagerPassword = $("#projectManagerPassword");

    let adminId = $("#adminId"),
    adminPassword = $("#adminPassword");

    $("#candidateButton").click(function(event){
    	$.ajax({
			data : {method : "getCandidate", user : candidateId.val(), pass : candidatePassword.val()},
			type : "post",
			url : "./app/model/Candidate.php",
			success: function(response)
			{
                var exist = JSON.parse(response);

                if (candidateId.val() == "" || candidatePassword.val() == "")
                {
                    $(".errorEmptyCandidate").show();
                    $(".errorGlobalCandidate").hide();
                }

                if(exist == false){
                	$(".errorEmptyCandidate").hide();
                    $(".errorGlobalCandidate").show();
                }
                else if(exist == true){
                    document.location.href="http://localhost/idleDevlopment/index.php?p=accueil&role=candidat";
                }

			}
	    });
    });

    $("#projectManagerButton").click(function(event){
    	$.ajax({
			data : {method : "getProjectManager", user : projectManagerId.val(), pass : projectManagerPassword.val()},
			type : "post",
			url : "./app/model/ProjectManager.php",
			success: function(response)
			{
                var exist = JSON.parse(response);

                if (projectManagerId.val() == "" || projectManagerPassword.val() == "")
                {
                    $(".errorEmptyProjectManager").show();
                    $(".errorGlobalProjectManager").hide();
                }

                if(exist == false){
                	$(".errorEmptyProjectManager").hide();
                    $(".errorGlobalProjectManager").show();
                }
                else if(exist == true){
                    document.location.href="http://localhost/idleDevlopment/index.php?p=accueil&role=projectManager";
                }

			}
	    });
    });

    $("#adminButton").click(function(event){
    	$.ajax({
			data : {method : "getAdmin", user : adminId.val(), pass : adminPassword.val()},
			type : "post",
			url : "./app/model/Admin.php",
			success: function(response)
			{
                var exist = JSON.parse(response);

                if (adminId.val() == "" || adminPassword.val() == "")
                {
                    $(".errorEmptyAdmin").show();
                    $(".errorGlobalAdmin").hide();
                }

                if(exist == false){
                	$(".errorEmptyAdmin").hide();
                    $(".errorGlobalAdmin").show();
                }
                else if(exist == true){
                    document.location.href="http://localhost/idleDevlopment/index.php?p=accueil&role=admin";
                }

			}
	    });
    });
});