$( document ).ready(function(){

    $(".confirmModifCandidat").hide();
    $(".supprCandidat").hide();
    $("#creation").hide();

    let candidateList = document.getElementById("candidateList");

    $("#createInformationDay").click(function(event){
        $("#creation").show();

        $("#informationDayCreationButton").click(function(event){
            let labelField = $("#informationDayLabel").val(),
            dateField = $("#informationDayDate").val();

            $.ajax({
                data : {method : "createInformationDay", label : labelField, date : dateField},
                type : "post",
                url : "./app/model/InformationDay.php",
                success: function(response)
                {
                    
                }
            });
        })

    });


    $(".modifButton").click(function(index){
        let label = document.getElementById("label" + $(this).val()),
        date = document.getElementById("date" + $(this).val()),
        buttonConfirm = document.getElementById("confirm" + $(this).val()),
        buttonSuppr = document.getElementById("suppr" + $(this).val()),
        id = $(this).val();
        
        label.removeAttribute("disabled");
        date.removeAttribute("disabled");
        buttonConfirm.style.removeProperty("display");
        buttonSuppr.style.removeProperty("display");

        buttonConfirm.onclick = function(event){
            $.ajax({
                data : {method : "updateInformationDay", label : label.value, date : date.value, id : id},
                type : "post",
                url : "./app/model/InformationDay.php",
                success: function(response)
                {
                   
                }
            });
        };

        buttonSuppr.onclick = function(event){
            $.ajax({
                data : {method : "deleteInformationDay",  id : id},
                type : "post",
                url : "./app/model/InformationDay.php",
                success: function(response)
                {
                   
                }
            });
        };
    });

    $(".showCandidate").click(function(index){
        candidateList.innerHTML = ""; 
        let id_informationDay = $(this).val();
        $.ajax({
        data : {method : "getCandidateByInformationDay",  informationDay_ID : id_informationDay},
        type : "post",
        url : "./app/model/Candidate.php",
            success: function(response) 
            {
                let candidate = JSON.parse(response);
                

                $.each(candidate, function(index, val){
                    let id = val["_id"],
                    candidateName = document.createElement("p");
                    candidateName.innerHTML = val["_name"];

                    let buttonSupprCandidate = document.createElement("button");
                    buttonSupprCandidate.setAttribute("value", val["_id"]);
                    buttonSupprCandidate.innerHTML = "Delete";

                    candidateList.appendChild(candidateName);
                    candidateList.appendChild(buttonSupprCandidate);

                    buttonSupprCandidate.onclick = function(event){
                        $.ajax({
                            data : {method : "deleteCandidateInformationDay",  id : id},
                            type : "post",
                            url : "./app/model/Candidate.php",
                            success: function(response)
                            {
                               
                            }
                        });
                    };
                });

                let buttonAddCandidate = document.createElement("button");
                buttonAddCandidate.innerHTML = "Add";

                candidateList.appendChild(buttonAddCandidate);

                buttonAddCandidate.onclick = function(event){
                        $.ajax({
                            data : {method : "getCandidateNotInInformationDay", informationday_ID : id_informationDay},
                            type : "post",
                            url : "./app/model/Candidate.php",
                            success: function(response)
                            {
                                let candidate = JSON.parse(response),
                                dropdownCandidate = document.createElement("select");

                                let disabledOption = document.createElement("option");
                                disabledOption.setAttribute("disabled", true);
                                disabledOption.innerHTML = "Clique sur un candidat pour l'ajouter";

                                dropdownCandidate.appendChild(disabledOption);
                                
                                $.each(candidate, function(index, val){
                                    let option = document.createElement("option");
                                    option.setAttribute('value', val["_id"]);
                                    option.innerHTML= val["_name"] + " " + val["_firstName"];
                                    dropdownCandidate.appendChild(option);

                                    option.onclick = function(event){
                                        $.ajax({
                                            data : {method : "addCandidateInInformationDay",  candidate_ID : option.value, informationDay_ID : id_informationDay},
                                            type : "post",
                                            url : "./app/model/Candidate.php",
                                            success: function(response)
                                            {
                                               
                                            }
                                        });
                                    };
                                });

                                candidateList.appendChild(dropdownCandidate);
                            }
                        });
                };
            }
        });
    });
});