$( document ).ready(function(){

    let domainContainer = document.getElementById("containerDomain"),
    levelContainer = document.getElementById("containerLevel");


    $("#addDomain").click(function(event){
    	let labelDomainField = document.createElement("input");
    	labelDomainField.setAttribute("type", "text");
        labelDomainField.setAttribute("placeholder", "Label :");

        let buttonInsertDomain = document.createElement("button");
        buttonInsertDomain.innerHTML = "Ajouter";

        domainContainer.appendChild(labelDomainField);
        domainContainer.appendChild(buttonInsertDomain);

        buttonInsertDomain.onclick = function(event){
        	let label = labelDomainField.value;
        	if(label.length != 0){
        		$.ajax({
	        		data : {method : "createDomain", label : label},
	    			type : "post",
	    			url : "./app/model/Domain.php",
	    			success: function(response)
	                {
	                    
	                }
	        	});
        	}else{
        		alert("Il faut remplir le champ pour créer un domaine !");
        	}
        	
        }
    });

    $(".modifDomain").click(function(event){
    	let validateButton = document.createElement("button");
    	validateButton.innerHTML = "Valider";

    	let deleteButton = document.createElement("button");
    	deleteButton.innerHTML = "Supprimer";

    	domainContainer.appendChild(validateButton);
    	domainContainer.appendChild(deleteButton);

    	let labelField = document.getElementById("label" + $(this).val()),
    	domain_ID = $(this).val();

    	labelField.removeAttribute("disabled");

    	validateButton.onclick = function(event){
    		$.ajax({
    			data : {method : "updateDomain", label : labelField.value, domain_ID : domain_ID},
				type : "post",
				url : "./app/model/Domain.php",
				success: function(response)
	            {
	                
	            }
    		});
    	};

    	deleteButton.onclick = function(event){
			$.ajax({
	    		data : {method : "deleteDomain", domain_ID : domain_ID},
				type : "post",
				url : "./app/model/Domain.php",
				success: function(response)
	            {
	                
	            }
	    	});
    	};
    });

    $("#addLevel").click(function(event){
    	let labelLevelField = document.createElement("input");
    	labelLevelField.setAttribute("type", "text");
        labelLevelField.setAttribute("placeholder", "Label :");

        let buttonInsertLevel = document.createElement("button");
        buttonInsertLevel.innerHTML = "Ajouter";

        levelContainer.appendChild(labelLevelField);
        levelContainer.appendChild(buttonInsertLevel);

        buttonInsertLevel.onclick = function(event){
        	let level = labelLevelField.value;
        	if(level.length != 0){
        		$.ajax({
	        		data : {method : "createLevel", level : level},
	    			type : "post",
	    			url : "./app/model/Level.php",
	    			success: function(response)
	                {
	                    
	                }
	        	});
        	}else{
        		alert("Il faut remplir le champ pour créer un niveau !");
        	}
        	
        }
    });

    $(".modifLevel").click(function(event){
    	let validateButton = document.createElement("button");
    	validateButton.innerHTML = "Valider";

    	let deleteButton = document.createElement("button");
    	deleteButton.innerHTML = "Supprimer";

    	levelContainer.appendChild(validateButton);
    	levelContainer.appendChild(deleteButton);

    	let labelField = document.getElementById("label" + $(this).val()),
    	level_ID = $(this).val();

    	labelField.removeAttribute("disabled");

    	validateButton.onclick = function(event){
    		$.ajax({
    			data : {method : "updateLevel", level : labelField.value, level_ID : level_ID},
				type : "post",
				url : "./app/model/Level.php",
				success: function(response)
	            {
	                
	            }
    		});
    	};

    	deleteButton.onclick = function(event){
			$.ajax({
	    		data : {method : "deleteLevel", level_ID : level_ID},
				type : "post",
				url : "./app/model/Level.php",
				success: function(response)
	            {
	                
	            }
	    	});
    	};
    });
});