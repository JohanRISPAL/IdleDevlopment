$( document ).ready(function(){
	let test_ID = document.getElementById("test_ID").value,
	candidate_ID = document.getElementById("candidate_ID").value,
	questionLabel = document.getElementById("question"),

	answer1 = document.getElementById("answer1"),
	checkboxAnswer1 = document.getElementById("checkboxAnswer1"),

	answer2 = document.getElementById("answer2"),
	checkboxAnswer2 = document.getElementById("checkboxAnswer2"),

	answer3 = document.getElementById("answer3"),
	checkboxAnswer3 = document.getElementById("checkboxAnswer3"),

	answer4 = document.getElementById("answer4"),
	checkboxAnswer4 = document.getElementById("checkboxAnswer4");

	let i = 0;

	let answer_ID = 0;

	console.log(test_ID);

	$.ajax({
		data : {method : "getQuestionByTest", test_ID : test_ID},
		type : "post",
		url : "./app/model/Question.php",
		success: function(response)
        {
        	let question = JSON.parse(response);

        	questionLabel.innerHTML = question[i]["_label"];

        	getAnswerByQuestion(question[i]["_id"]);

            $("#nextQuestion").click(function(event){
            	answer_ID = $('input[type=radio][class=checkboxAnswer]:checked').val();
            	
            	$.ajax({
					data : {method : "insertCandidateAnswer", answerCandidate : answer_ID, candidate_ID : candidate_ID, question_ID : question[i][0], test_ID : test_ID},
					type : "post",
					url : "./app/model/Candidate.php",
					success: function(response)
			        {
			        	
			        }
				});

            	answer_ID = 0;
	
            	console.log(answer_ID);
            	i = i + 1;
            	console.log(question[i][0]);
            	questionLabel.innerHTML = question[i][1];
        		getAnswerByQuestion(question[i][0]);
            })
        }
	});

	function getAnswerByQuestion(question_ID){
		$.ajax({
			data : {method : "getAnswerByQuestion", question_ID : question_ID},
			type : "post",
			url : "./app/model/Answer.php",
			success: function(response)
	        {
	        	answers = JSON.parse(response);

	        	checkboxAnswer1.setAttribute("value", answers[0]["_id"]);
	        	answer1.innerHTML = answers[0]["_label"];
	        	
	        	checkboxAnswer2.setAttribute("value", answers[1]["_id"]);
	        	answer2.innerHTML = answers[1]["_label"];

	        	checkboxAnswer3.setAttribute("value", answers[2]["_id"]);
	        	answer3.innerHTML = answers[2]["_label"];

	        	checkboxAnswer4.setAttribute("value", answers[3]["_id"]);
	        	answer4.innerHTML = answers[3]["_label"];
	        }
		});
	}
});