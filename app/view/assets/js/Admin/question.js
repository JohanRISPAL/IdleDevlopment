$(document).ready(function(){

	let createQuestionContainer = document.getElementById("createQuestionContainer");

	$(".createButton").click(function(event){
		let questionField = document.createElement("input");
		questionField.setAttribute("type", "text");
		questionField.setAttribute("placeholder", "Intitulé de la question");


		let checkboxContainer = document.createElement("div"),
		isELiminatoryCheckBox = document.createElement("input"),
		pCheckBox = document.createElement("p");
		
		isELiminatoryCheckBox.setAttribute("type", "checkbox");
		isELiminatoryCheckBox.setAttribute("id", "isELiminatoryCheckBox")
		pCheckBox.innerHTML = "Question eliminatoire";

		dropdownDomain = document.createElement("select");

        $.ajax({
        data : {method : "getAllDomain"},
        type : "post",
        url : "./app/view/assets/js/fonctionJs.php",
            success: function(response) 
            {
            	let domains = JSON.parse(response);
            	$.each(domains, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val[0]);
            		option.innerHTML = val[1];

            		dropdownDomain.appendChild(option);
            	});
            }
        });

        dropdownLevel = document.createElement("select");

        $.ajax({
        data : {method : "getAllLevel"},
        type : "post",
        url : "./app/view/assets/js/fonctionJs.php",
            success: function(response) 
            {
            	let levels = JSON.parse(response);
            	$.each(levels, function(index, val){
            		let option = document.createElement("option");
            		option.setAttribute("value", val[0]);
            		option.innerHTML = val[1];

            		dropdownLevel.appendChild(option);
            	});
            }
        });

        let buttonConfirm = document.createElement("button");
        buttonConfirm.innerHTML = "Valider";

        let answer1 = document.createElement("input"),
        answer2 = document.createElement("input"),
        answer3 = document.createElement("input"),
        answer4 = document.createElement("input");

        answer1.setAttribute("type", "text");
		answer1.setAttribute("placeholder", "Réponse 1");
		answer1.setAttribute("id", "answer1");

		answer2.setAttribute("type", "text");
		answer2.setAttribute("placeholder", "Réponse 2");
		answer2.setAttribute("id", "answer2");

		answer3.setAttribute("type", "text");
		answer3.setAttribute("placeholder", "Réponse 3");
		answer3.setAttribute("id", "answer3");

		answer4.setAttribute("type", "text");
		answer4.setAttribute("placeholder", "Réponse 4");
		answer4.setAttribute("id", "answer4");

		let divCheckBoxContainer = document.createElement("div");

		let divCheckBoxContainerAnswer1 = document.createElement("div"), 
		checkBoxAnswer1 = document.createElement("input"),
		pAnswer1 = document.createElement("p");
		checkBoxAnswer1.setAttribute("type", "checkbox");
		checkBoxAnswer1.setAttribute("id", "checkboxAnswer1");
		pAnswer1.innerHTML = "Réponse 1 vraie";

		let divCheckBoxContainerAnswer2 = document.createElement("div"), 
		checkBoxAnswer2 = document.createElement("input"),
		pAnswer2 = document.createElement("p");
		checkBoxAnswer2.setAttribute("type", "checkbox");
		checkBoxAnswer2.setAttribute("id", "checkboxAnswer2");
		pAnswer2.innerHTML = "Réponse 2 vraie";

		let divCheckBoxContainerAnswer3 = document.createElement("div"), 
		checkBoxAnswer3 = document.createElement("input"),
		pAnswer3 = document.createElement("p");
		checkBoxAnswer3.setAttribute("type", "checkbox");
		checkBoxAnswer3.setAttribute("id", "checkboxAnswer3");
		pAnswer3.innerHTML = "Réponse 3 vraie";

		let divCheckBoxContainerAnswer4 = document.createElement("div"), 
		checkBoxAnswer4 = document.createElement("input"),
		pAnswer4 = document.createElement("p");
		checkBoxAnswer4.setAttribute("type", "checkbox");
		checkBoxAnswer4.setAttribute("id", "checkboxAnswer4");
		pAnswer4.innerHTML = "Réponse 4 vraie";


		pCheckBox.appendChild(isELiminatoryCheckBox);
		checkboxContainer.appendChild(pCheckBox);

		createQuestionContainer.appendChild(questionField);
		createQuestionContainer.appendChild(checkboxContainer);
		createQuestionContainer.appendChild(dropdownDomain);
		createQuestionContainer.appendChild(dropdownLevel);

		createQuestionContainer.appendChild(answer1);
		createQuestionContainer.appendChild(answer2);
		createQuestionContainer.appendChild(answer3);
		createQuestionContainer.appendChild(answer4);

		divCheckBoxContainerAnswer1.appendChild(checkBoxAnswer1);
		divCheckBoxContainerAnswer1.appendChild(pAnswer1);

		divCheckBoxContainerAnswer1.appendChild(checkBoxAnswer2);
		divCheckBoxContainerAnswer1.appendChild(pAnswer2);

		divCheckBoxContainerAnswer1.appendChild(checkBoxAnswer3);
		divCheckBoxContainerAnswer1.appendChild(pAnswer3);

		divCheckBoxContainerAnswer1.appendChild(checkBoxAnswer4);
		divCheckBoxContainerAnswer1.appendChild(pAnswer4);

		divCheckBoxContainer.appendChild(divCheckBoxContainerAnswer1);
		divCheckBoxContainer.appendChild(divCheckBoxContainerAnswer2);
		divCheckBoxContainer.appendChild(divCheckBoxContainerAnswer3);
		divCheckBoxContainer.appendChild(divCheckBoxContainerAnswer4);
		
		createQuestionContainer.appendChild(divCheckBoxContainer);
		
		createQuestionContainer.appendChild(buttonConfirm);

		buttonConfirm.onclick = function(event){
			let answerVal1 = answer1.value,
			answerVal2 = answer2.value,
			answerVal3 = answer3.value,
			answerVal4 = answer4.value,
			isCheckedAnswer1 = 0,
			isCheckedAnswer2 = 0,
			isCheckedAnswer3 = 0,
			isCheckedAnswer4 = 0;

			if ($('input[id=checkboxAnswer1]').is(':checked')){
				isCheckedAnswer1 = 1;
			}else if ($('input[id=checkboxAnswer2]').is(':checked')){
				isCheckedAnswer2 = 1;
			}else if ($('input[id=checkboxAnswer3]').is(':checked')){
				isCheckedAnswer3 = 1;
			}else if ($('input[id=checkboxAnswer4]').is(':checked')){
				isCheckedAnswer4 = 1;
			}

			for (let i = 1; i <= 4; i++){
				let label = $("#answer"+i).val(),
				isCheckedAnswer = 0;
				if ($('input[id=checkboxAnswer'+i+']').is(':checked')){
					isCheckedAnswer = 1;
				}
				console.log(label);
				console.log(isCheckedAnswer);
			}
			
			if( $('input[id=isELiminatoryCheckBox]').is(':checked') ){
				$.ajax({
		        data : {method : "createQuestion", label : questionField.value , isEliminatory : 1, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
		        type : "post",
		        url : "./app/view/assets/js/fonctionJs.php",
		            success: function(response) 
		            {
		            	for(let i = 1; i <= 4; i++){
		            		let label = $("#answer"+i).val(),
							isCheckedAnswer = 0;
							if ($('input[id=checkboxAnswer'+i+']').is(':checked')){
								isCheckedAnswer = 1;
							}

							$.ajax({
					        data : {method : "createAnswer", label : label , isTrue : isCheckedAnswer},
					        type : "post",
					        url : "./app/view/assets/js/fonctionJs.php",
					        	success : function(response)
					        	{

					        	}
					        });
		            	}
				    	
		            }
		        });
			}else{
				$.ajax({
		        data : {method : "createQuestion", label : questionField.value , isEliminatory : 0, level_ID : dropdownLevel.value, domain_ID : dropdownDomain.value},
		        type : "post",
		        url : "./app/view/assets/js/fonctionJs.php",
		            success: function(response) 
		            {
		            	for(let i = 1; i <= 4; i++){
		            		let label = $("#answer"+i).val(),
							isCheckedAnswer = 0;
							if ($('input[id=checkboxAnswer'+i+']').is(':checked')){
								isCheckedAnswer = 1;
							}

							$.ajax({
					        data : {method : "createAnswer", label : label , isTrue : isCheckedAnswer},
					        type : "post",
					        url : "./app/view/assets/js/fonctionJs.php",
					        	success : function(response)
					        	{

					        	}
					        });
		            	}
		            }
		        });
			}
        };
	});
});