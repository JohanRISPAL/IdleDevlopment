$(document).ready(function(){

	//hide create question container and created question container
	$("#createQuestionContainer").hide();
	$("#createdQuestionContainer").hide();

	//get all question created
	$.ajax({
        data : {method : "getQuestion"},
        type : "post",
        url : "./app/model/Question.php",
        success: function(response)
        {
        	//get the container of the created question
        	let listQuestion = document.getElementById("listQuestion");

        	//get all questions
        	let questions = JSON.parse(response);

        	//for each questions, create a button and add it
        	$.each(questions, function(index, val){
        		let button = document.createElement("button");

        		button.setAttribute("class", "buttonQuestion");
        		button.setAttribute("value", val["_id"]);
        		button.innerHTML = val["_label"];

        		listQuestion.appendChild(button);
        	});
        }
    });

    //show question's informations
    $("#listQuestion").on("click", ".buttonQuestion", function(event){
    	//show div question's created and hide div question's creation, delete and create button
		$("#createdQuestionContainer").show();
		$("#modifQuestion").show();
    	$("#confirmModifQuestion").hide();
    	$("#supprQuestion").hide();
    	$("#createQuestionContainer").hide();

    	//get question's id
    	let question_ID = $(this).val();

    	//get the question
    	$.ajax({
    		data : {method : "getQuestionById", id : question_ID},
    		type : "post",
    		url : "./app/model/Question.php",
    		success: function(answer){
    			let question = JSON.parse(answer);

    			//set question's information in the field
    			//in the input 
    			let questionLabel = document.getElementById("labelCreatedQuestion");
    			questionLabel.setAttribute("value", question[0]["_label"]);

    			//if it is eliminatory
    			let checkboxEliminatory = document.getElementById("isELiminatoryCreatedCheckBox");
    			if(question[0]["isEliminatory"] == 1){
    				checkboxEliminatory.setAttribute("checked", true);
    			}

    			//in dropdowns
    			let dropdownDomain = document.getElementById("dropdownDomainCreatedQuestion"),
    			dropdownLevel = document.getElementById("dropdownLevelCreatedQuestion");

    			//get the question's domain and add it in the dropdown
    			$.ajax({
    				data : {method : "getDomainById", id : question[0]["_domain_ID"]},
    				type : "post",
    				url : "./app/model/Domain.php",
    				success: function(answer){
    					let domain = JSON.parse(answer);

    					let option = document.createElement("option");
    					option.setAttribute("value", domain[0]["_id"]);
    					option.innerHTML = domain[0]["_label"];

    					dropdownDomain.appendChild(option);
    				}
    			});

    			//get the question's level and add it in the dropdown
    			$.ajax({
    				data : {method : "getLevelById", id : question[0]["_level_ID"]},
    				type : "post",
    				url : "./app/model/Level.php",
    				success: function(answer){
    					let level = JSON.parse(answer);

    					let option = document.createElement("option");
    					option.setAttribute("value", level[0]["_id"]);
    					option.innerHTML = level[0]["_label"];

    					dropdownLevel.appendChild(option);
    				}
    			});

    			//get answers
    			$.ajax({
			        data : {method : "getAnswerByQuestion", question_ID : question[0]["_id"]},
			        type : "post",
			        url : "./app/model/Answer.php",
			        success: function(answer)
			        {
			        	let answers = JSON.parse(answer);

			        	let i = 1;

			        	$.each(answers, function(index, val){
		            		let label = document.getElementById("labelAnswerCreated"+i),
		            		radioButton = document.getElementById("radioAnswerCreated"+i),
		            		hidden = document.getElementById("hiddenAnswerCreated"+i);

		            		label.setAttribute("value", val["_label"]);
		            		hidden.setAttribute("value", val["_id"]);

		            		if(val["_isTrue"] == 1){
		            			radioButton.setAttribute("checked", true);
		            		}
		            		i++;
		            	});
			        }
			    });

			    //set the question's id in buttons value
			    document.getElementById("confirmModifQuestion").setAttribute("value", question_ID);
			    document.getElementById("supprQuestion").setAttribute("value", question_ID);
    		}
    	})
    });

    //modif one question
    $("#modifQuestion").click(function(event){
    	//show actions button and hide modifButton
    	$("#modifQuestion").hide();
    	$("#confirmModifQuestion").show();
		$("#supprQuestion").show();

		//remove disabled on fields
		document.getElementById("labelCreatedQuestion").removeAttribute("disabled");
		document.getElementById("isELiminatoryCreatedCheckBox").removeAttribute("disabled");
		document.getElementById("dropdownDomainCreatedQuestion").removeAttribute("disabled");
		document.getElementById("dropdownLevelCreatedQuestion").removeAttribute("disabled");

		for(let i = 1; i < 5; i++){
			let label = document.getElementById("labelAnswerCreated"+i),
    		radioButton = document.getElementById("radioAnswerCreated"+i);

    		label.removeAttribute("disabled");
			radioButton.removeAttribute("disabled");
		}

		//get other domains and add them in the dropdown
		let domain_ID = document.getElementById("dropdownDomainCreatedQuestion").value;
		$.ajax({
			data : {method : "getOtherDomain", id : domain_ID},
			type : "post",
			url : "./app/model/Domain.php",
			success: function(answer){
				let domains = JSON.parse(answer);

				$.each(domains, function(index, val){
            		let option = document.createElement("option");
					option.setAttribute("value", val["_id"]);
					option.innerHTML = val["_label"];

					document.getElementById("dropdownDomainCreatedQuestion").appendChild(option);
            	});
			}
		});

		//get other levels and add them in the dropdown
		let level_ID = document.getElementById("dropdownLevelCreatedQuestion").value;
		$.ajax({
			data : {method : "getOtherLevel", id : level_ID},
			type : "post",
			url : "./app/model/Level.php",
			success: function(answer){
				let levels = JSON.parse(answer);

				$.each(levels, function(index, val){
            		let option = document.createElement("option");
					option.setAttribute("value", val["_id"]);
					option.innerHTML = val["_label"];

					document.getElementById("dropdownLevelCreatedQuestion").appendChild(option);
            	});
			}
		});
    });

    //if confirmButton is pressed
    $("#confirmModifQuestion").click(function(event){
    	//get question's id
    	let question_ID = $(this).val();
    	isEliminatory = 0;

		if($('input[id=isELiminatoryCheckBox]').is(':checked')){
			isEliminatory = 1;
		}

		//get the new information
		let label = document.getElementById("labelCreatedQuestion").value,
		level_ID = document.getElementById("dropdownLevelCreatedQuestion").value,
		domain_ID = document.getElementById("dropdownDomainCreatedQuestion").value;

		//update in bdd
		$.ajax({
			data : {method : "updateQuestion", label : label, isEliminatory : isEliminatory, level_ID : level_ID, domain_ID : domain_ID, id : question_ID},
			type : "post",
			url : "./app/model/Question.php",
			success : function(answer){

			}
		});

		//update answer
		for(let i = 1; i < 5; i++){
			let answer_ID = document.getElementById("hiddenAnswerCreated"+i).value,
			label = document.getElementById("labelAnswerCreated"+i).value,
			isTrue = 0;

			if($('input[id=radioAnswerCreated'+i+']').is(':checked')){
				isTrue = 1;
			}

			$.ajax({
				data : {method : "updateAnswer", label : label, isTrue : isTrue, id : answer_ID},
				type : "post",
				url : "./app/model/Answer.php",
				success : function(answer){

				}
			});
		}

		//set disabled on fields
		document.getElementById("labelCreatedQuestion").setAttribute("disabled", true);
		document.getElementById("isELiminatoryCreatedCheckBox").setAttribute("disabled", true);
		document.getElementById("dropdownDomainCreatedQuestion").setAttribute("disabled", true);
		document.getElementById("dropdownLevelCreatedQuestion").setAttribute("disabled", true);

		for(let i = 1; i < 5; i++){
			let label = document.getElementById("labelAnswerCreated"+i),
    		radioButton = document.getElementById("radioAnswerCreated"+i);

    		label.setAttribute("disabled", true);
			radioButton.setAttribute("disabled", true);
		}

		//hide div
		$("#createdQuestionContainer").hide();
    	
    });

    //delete question and answers
   	$("#supprQuestion").click(function(event){
   		//get the question's id
   		let question_ID = $(this).val();

		$.ajax({
			data : {method : "deleteQuestion", id : question_ID},
			type : "post",
			url : "./app/model/Question.php",
			success : function(answer){

			}
		});

		$.ajax({
			data : {method : "deleteAnswer", id : question_ID},
			type : "post",
			url : "./app/model/Answer.php",
			success : function(answer){

			}
		});

		//remove the button of the question
		$('button[class="buttonQuestion"][value="'+question_ID+'"]').remove();

		//set disabled on fields
		document.getElementById("labelCreatedQuestion").setAttribute("disabled", true);
		document.getElementById("isELiminatoryCreatedCheckBox").setAttribute("disabled", true);
		document.getElementById("dropdownDomainCreatedQuestion").setAttribute("disabled", true);
		document.getElementById("dropdownLevelCreatedQuestion").setAttribute("disabled", true);

		for(let i = 1; i < 5; i++){
			let label = document.getElementById("labelAnswerCreated"+i),
    		radioButton = document.getElementById("radioAnswerCreated"+i);

    		label.setAttribute("disabled", true);
			radioButton.setAttribute("disabled", true);
		}

		//hide div
		$("#createdQuestionContainer").hide();
		
	});

	//set information to create a question
	$("#createQuestion").click(function(event){
		$("#createQuestionContainer").show();
		$("#createdQuestionContainer").hide();
		
		//get all domains and add them in the dropdown
        $.ajax({
        data : {method : "getAllDomain"},
        type : "post",
        url : "./app/model/Domain.php",
            success: function(answer) 
            {
            	let domains = JSON.parse(answer);
            	$.each(domains, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val["_id"]);
            		option.innerHTML = val["_label"];

            		document.getElementById("dropdownDomain").appendChild(option);
            	});
            }
        });

        //get all levels and add them in the dropdown
        $.ajax({
        data : {method : "getAllLevel"},
        type : "post",
        url : "./app/model/Level.php",
            success: function(answer) 
            {
            	let levels = JSON.parse(answer);
            	$.each(levels, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val["_id"]);
            		option.innerHTML = val["_label"];

            		document.getElementById("dropdownLevel").appendChild(option);
            	});
            }
        });
	});

	//create a question
	$(".buttonCreateQuestion").click(function(event){

    	let label = $("#labelQuestion").val();

    	//if the question is eliminatory
		if( $('input[class=isELiminatoryCheckBox]').is(':checked') ){
			$.ajax({
	        data : {method : "createQuestion", label : label , isEliminatory : 1, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
	        type : "post",
	        url : "./app/model/Question.php",
	            success: function(answer) 
	            {
	            	let question = JSON.parse(answer);

	            	//create the button and add it in html
	            	let button = document.createElement("button");
	            	button.setAttribute("class", "buttonQuestion");
	            	button.setAttribute("value", question["_id"]);
	            	button.innerHTML = question["_label"];

	            	document.getElementById("listQuestion").appendChild(button);
	            	
	            	for(let i = 1; i <= 4; i++){
	            		let answerLabel = $("#labelAnswer"+i).val(),
						isCheckedAnswer = 0;
						if ($('input[id=radioAnswer'+i+']').is(':checked')){
							isCheckedAnswer = 1;
						}

						$.ajax({
				        data : {method : "createAnswer", label : answerLabel , isTrue : isCheckedAnswer},
				        type : "post",
				        url : "./app/model/Answer.php",
				        	success : function(answer)
				        	{

				        	}
				        });
	            	}
			    	
	            }
	        });
		}else{
			$.ajax({
	        data : {method : "createQuestion", label : label , isEliminatory : 0, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
	        type : "post",
	        url : "./app/model/Question.php",
	            success: function(answer) 
	            {
	            	let question = JSON.parse(answer);

	            	//create the button and add it in html
	            	let button = document.createElement("button");
	            	button.setAttribute("class", "buttonQuestion");
	            	button.setAttribute("value", question["_id"]);
	            	button.innerHTML = question["_label"];

	            	document.getElementById("listQuestion").appendChild(button);

	            	for(let i = 1; i <= 4; i++){
	            		let answerLabel = $("#labelAnswer"+i).val(),
						isCheckedAnswer = 0;
						if ($('input[id=radioAnswer'+i+']').is(':checked')){
							isCheckedAnswer = 1;
						}

						$.ajax({
				        data : {method : "createAnswer", label : answerLabel , isTrue : isCheckedAnswer},
				        type : "post",
				        url : "./app/model/Answer.php",
				        	success : function(answer)
				        	{

				        	}
				        });
	            	}
			    	
	            }
	        });
		}

		//clean input
        document.getElementById("labelQuestion").value = "";
        for (var i = 1; i > 5; i++) {
        	document.getElementById("labelAnswer"+i).value = "";
        }

        //hide the div
        $("#createQuestionContainer").hide();
        
    });

});