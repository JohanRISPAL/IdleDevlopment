$( document ).ready(function(){
	let candidate_ID = document.getElementById("candidate_ID").value,
	divBeginTest = document.getElementById("beginContainer");

	$.ajax({
		data : {method : "getTestByCandidate", id : candidate_ID},
		type : "post",
		url : "./app/model/Test.php",
		success: function(response)
        {
            let test = JSON.parse(response);
            $.each(test, function(index, val){
            	let buttonStartTest = document.createElement("button");
            	buttonStartTest.setAttribute("class", "buttonStartTest");
            	buttonStartTest.setAttribute("value", val["_id"]);
            	buttonStartTest.innerHTML = "Commencer " + val["_label"];

            	divBeginTest.appendChild(buttonStartTest);
            });
        }
	});

	$("#beginContainer").on("click", ".buttonStartTest", function(event){
		let test_ID = $(this).val();
		document.location.href="http://localhost/idleDevlopment/index.php?p=testStarted&role=candidat&test_ID="+test_ID;
	});
});