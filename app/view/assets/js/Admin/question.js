$(document).ready(function(){

	let dropdownDomain = document.getElementById("dropdownDomain"),
	dropdownLevel = document.getElementById("dropdownLevel"),
	listQuestion = document.getElementById("listQuestion");

	$("#createQuestionContainer").hide();
	$("#createdQuestionContainer").hide();

	$.ajax({
        data : {method : "getQuestion"},
        type : "post",
        url : "./app/model/Question.php",
        success: function(response)
        {
        	let questions = JSON.parse(response);
        	$.each(questions, function(index, val){
        		let button = document.createElement("button");
        		button.setAttribute("id", "buttonQuestion");
        		button.setAttribute("value", val["_id"]);
        		button.innerHTML = val["_label"];
        		listQuestion.appendChild(button);
        	});
        }
    });

    $("#listQuestion").on("click", "#buttonQuestion", function(event){
    	$("#createdQuestionContainer").show();
    	$("#confirmModifQuestion").hide();
    	$("#supprQuestion").hide();
    	$("#createQuestionContainer").hide();
    	let questionID = $(this).val();

    	$.ajax({
	        data : {method : "getQuestionById", id : questionID},
	        type : "post",
	        url : "./app/model/Question.php",
	        success: function(response)
	        {
	        	let question = JSON.parse(response);

	        	let labelQuestion = document.getElementById("labelCreatedQuestion");
	        	labelQuestion.setAttribute("value", question[0]["_label"]);

	        	let isEliminatory = document.getElementById("isELiminatoryCreatedCheckBox");
	        	if(question[0]["_isEliminatory"] == 1){
	        		isEliminatory.setAttribute("checked", true);
	        	}

	        	let dropdownDomainCreated = document.getElementById("dropdownDomainCreatedQuestion"),
	        	dropdownLevelCreated = document.getElementById("dropdownLevelCreatedQuestion");

	        	$.ajax({
			        data : {method : "getDomainById", id : question[0]["_domain_ID"]},
			        type : "post",
			        url : "./app/model/Domain.php",
			        success: function(response)
			        {
			        	let domain = JSON.parse(response);

			        	let option = document.createElement("option");
			        	option.setAttribute("value", domain[0]["_id"]);
	            		option.innerHTML = domain[0]["_label"];

	            		dropdownDomainCreated.appendChild(option);
			        }
			    });

			    $.ajax({
			        data : {method : "getLevelById", id : question[0]["_level_ID"]},
			        type : "post",
			        url : "./app/model/Level.php",
			        success: function(response)
			        {
			        	let level = JSON.parse(response);

			        	let option = document.createElement("option");
			        	option.setAttribute("value", level[0]["_id"]);
	            		option.innerHTML = level[0]["_label"];

	            		dropdownLevelCreated.appendChild(option);
			        }
			    });

			    $.ajax({
			        data : {method : "getAnswerByQuestion", question_ID : questionID},
			        type : "post",
			        url : "./app/model/Answer.php",
			        success: function(response)
			        {
			        	let answers = JSON.parse(response);

			        	let i = 1;

			        	$.each(answers, function(index, val){
		            		let labelAnswer = document.getElementById("labelAnswerCreated"+i),
		            		radioAnswer = document.getElementById("radioAnswerCreated"+i),
		            		hiddenAnswer = document.getElementById("hiddenAnswerCreated"+i);

		            		labelAnswer.setAttribute("value", val["_label"]);
		            		hiddenAnswer.setAttribute("value", val["_id"]);

		            		if(val["_isTrue"] == 1){
		            			radioAnswer.setAttribute("checked", true);
		            		}
		            		i++;
		            	});
			        }
			    });

			    $("#modifQuestion").click(function(event){
					$("#confirmModifQuestion").show();
    				$("#supprQuestion").show();

					labelQuestion.removeAttribute("disabled");
					isEliminatory.removeAttribute("disabled");
					dropdownDomainCreated.removeAttribute("disabled");
					dropdownLevelCreated.removeAttribute("disabled");

					$("#dropdownDomainQuestion option[value='"+dropdownDomainCreated.value+"']").remove();
					$("#dropdownLevelQuestion option[value='"+dropdownLevelCreated.value+"']").remove();

					$.ajax({
						data : {method : "getAllLevel"},
						type : "post",
						url : "./app/model/Level.php",
						success : function(response){
							let levels = JSON.parse(response);

				        	$.each(levels, function(index, val){
			            		let option = document.createElement("option");
			            		option.setAttribute("value", val["_id"]);
			            		option.innerHTML = val["_label"];

			            		dropdownLevelCreated.appendChild(option);
			            	});
						}
					});

					$.ajax({
						data : {method : "getAllDomain"},
						type : "post",
						url : "./app/model/Domain.php",
						success : function(response){
							let domains = JSON.parse(response);

				        	$.each(domains, function(index, val){
			            		let option = document.createElement("option");
			            		option.setAttribute("value", val["_id"]);
			            		option.innerHTML = val["_label"];

			            		dropdownDomainCreated.appendChild(option);
			            	});
						}
					});

					for(let i = 1; i < 5; i++){
						let labelAnswer = document.getElementById("labelAnswerCreated"+i),
	            		radioAnswer = document.getElementById("radioAnswerCreated"+i);

	            		labelAnswer.removeAttribute("disabled");
						radioAnswer.removeAttribute("disabled");
					}

					$("#confirmModifQuestion").click(function(event){
						isCheck = 0;

						if($('input[id=isELiminatoryCheckBox]').is(':checked')){
							isCheck = 1;
						}

						level_ID = dropdownLevelCreated.value;
						domain_ID = dropdownDomainCreated.value;

						$.ajax({
							data : {method : "updateQuestion", label : labelQuestion.value, isEliminatory : isCheck, level_ID : level_ID, domain_ID : domain_ID, id : questionID},
							type : "post",
							url : "./app/model/Question.php",
							success : function(response){

							}
						});

						for(let i = 1; i < 5; i++){
							let answerID = document.getElementById("hiddenAnswer"+i).value,
							labelAnswer = document.getElementById("labelAnswerCreated"+i).value,
							isTrue = 0;

							if($('input[id=radioAnswerCreated'+i+']').is(':checked')){
								isTrue = 1;
							}

							$.ajax({
							data : {method : "updateAnswer", label : labelAnswer, isTrue : isTrue, id : answerID},
							type : "post",
							url : "./app/model/Answer.php",
							success : function(response){

							}
						});
						}
					});


					$("#supprQuestion").click(function(event){
						$.ajax({
							data : {method : "deleteQuestion", id : questionID},
							type : "post",
							url : "./app/model/Question.php",
							success : function(response){

							}
						});

						$.ajax({
							data : {method : "deleteAnswer", id : questionID},
							type : "post",
							url : "./app/model/Answer.php",
							success : function(response){

							}
						});
						
					});
					
			    });
	        }
	    });
    });

	$(".createQuestion").click(function(event){
		$("#createQuestionContainer").show();
		$("#createdQuestionContainer").hide();
		
        $.ajax({
        data : {method : "getAllDomain"},
        type : "post",
        url : "./app/model/Domain.php",
            success: function(response) 
            {
            	let domains = JSON.parse(response);
            	$.each(domains, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val["_id"]);
            		option.innerHTML = val["_label"];

            		dropdownDomain.appendChild(option);
            	});
            }
        });

        $.ajax({
        data : {method : "getAllLevel"},
        type : "post",
        url : "./app/model/Level.php",
            success: function(response) 
            {
            	let levels = JSON.parse(response);
            	$.each(levels, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val["_id"]);
            		option.innerHTML = val["_label"];

            		dropdownLevel.appendChild(option);
            	});
            }
        });

        $(".buttonCreateQuestion").click(function(event){

        	let questionLabel = $("#labelQuestion").val();

			if( $('input[class=isELiminatoryCheckBox]').is(':checked') ){
				$.ajax({
		        data : {method : "createQuestion", label : questionLabel , isEliminatory : 1, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
		        type : "post",
		        url : "./app/model/Question.php",
		            success: function(response) 
		            {
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
					        	success : function(response)
					        	{

					        	}
					        });
		            	}
				    	
		            }
		        });
			}else{
				$.ajax({
		        data : {method : "createQuestion", label : questionLabel , isEliminatory : 0, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
		        type : "post",
		        url : "./app/model/Question.php",
		            success: function(response) 
		            {
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
					        	success : function(response)
					        	{

					        	}
					        });
		            	}
				    	
		            }
		        });
			}

        });
	});
});