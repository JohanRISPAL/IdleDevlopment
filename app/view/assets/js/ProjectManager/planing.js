$( document ).ready(function(){

    let projectManagerContainer = document.getElementById("projectManagerContainer"),
    candidateContainer = document.getElementById("candidateContainer");
    projectManagerContainer.style.display = "none";
    candidateContainer.style.display = "none";

    $(".buttonInformationDay").click(function(event){
        let informationDay_ID = $(this).val();
        $.ajax({
            data : {method : "getPlaningOfInformationDay", informationDay_ID : informationDay_ID},
            type : "post",
            url : "./app/model/Planing.php",
            success: function(response)
            {
                projectManagerContainer.style.display = "block";
                candidateContainer.style.display = "block";

                let planing = JSON.parse(response),
                addButton = document.createElement("button");
                addButton.setAttribute("value", informationDay_ID);
                addButton.innerHTML = "Ajouter un candidat";

                candidateContainer.appendChild(addButton);

                $.each(planing, function(index, val){
                    let planing_ID = val["_id"],
                    projectManager_ID = 0;
                    $.ajax({
                        data : {method : "getProjectManagerOfPlaning", planing_ID : planing_ID},
                        type : "post",
                        url : "./app/model/ProjectManager.php",
                        success: function(response)
                        {
                            let projectManager = JSON.parse(response),
                            projectMangerName = document.createElement("p");
                            projectManager_ID = projectManager["_id"];

                            projectMangerName.innerHTML = projectManager["_firstName"] + " " + projectManager["_name"];

                            projectManagerContainer.appendChild(projectMangerName);
                        }
                    });
                    $.ajax({
                        data : {method : "getCandidateOfPlaning", informationDay_ID : informationDay_ID, planing_ID : planing_ID},
                        type : "post",
                        url : "./app/model/Candidate.php",
                        success: function(response)
                        {
                           let candidate = JSON.parse(response);

                           $.each(candidate, function(index, val){
                                let candidateName = document.createElement("p"),
                                candidateHour = document.createElement("p");

                                candidateName.innerHTML = val["_name"] + " " + val["_firstName"];
                                candidateHour.innerHTML = val["_label"];

                                let buttonDeleteCandidate = document.createElement("button");
                                buttonDeleteCandidate.setAttribute("value", val["_id"]);
                                buttonDeleteCandidate.innerHTML = "Delete";

                                candidateContainer.appendChild(candidateName);
                                candidateContainer.appendChild(candidateHour);
                                candidateContainer.appendChild(buttonDeleteCandidate);

                                buttonDeleteCandidate.onclick = function(event){
                                    let candidate_ID = $(this).val();
                                   $.ajax({
                                        data : {method : "deleteCandidateInPlaning",  candidate_ID : candidate_ID, planing_ID : planing_ID},
                                        type : "post",
                                        url : "./app/model/Candidate.php",
                                        success: function(response)
                                        {
                                           
                                        }
                                    });
                                }
                           });
                        }
                    });

                    addButton.onclick = function(event){
                    $.ajax({
                        data : {method : "getEmptyHourInPlaning", planing_ID : planing_ID},
                        type : "post",
                        url : "./app/model/Hour.php",
                        success: function(response)
                        {
                            let emptyHour = JSON.parse(response);

                            $.ajax({
                                data : {method : "getCandidateNotInPlaning", planing_ID : planing_ID},
                                type : "post",
                                url : "./model/Candidate.php",
                                success: function(response){   
                                    let candidate = JSON.parse(response),
                                    dropdownCandidate = document.createElement("select");

                                    let disabledOption = document.createElement("option");
                                    disabledOption.setAttribute("disabled", true);
                                    disabledOption.innerHTML = "Clique sur un candidat pour l'ajouter au créneau juste après";

                                    dropdownCandidate.appendChild(disabledOption);

                                    $.each(candidate, function(index, val){
                                        let option = document.createElement("option");
                                        option.setAttribute('value', val["_id"]);
                                        option.innerHTML= val["_name"] + " " + val["_firstName"];
                                        dropdownCandidate.appendChild(option);

                                        option.onclick = function(event){
                                            if(emptyHour.length != 0){
                                                $.ajax({
                                                    data : {method : "addCandidateInPlaning",  candidate_ID : option.value, hour_ID : emptyHour[0][0], planing_ID : planing_ID, projectManager_ID : projectManager_ID},
                                                    type : "post",
                                                    url : "./app/model/Candidate.php",
                                                    success: function(response)
                                                    {
                                                       
                                                    }
                                                });
                                            }else{
                                                alert("Le planing est plein !")
                                            }
                                        };
                                    });

                                    candidateContainer.appendChild(dropdownCandidate);
                                }
                            });
                        }
                    });
                }
                });
            }
        });
    });
});