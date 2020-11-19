$( document ).ready(function(){

    $(".confirmModifCandidat").hide();
    $(".supprCandidat").hide();

    $("#createInformationDay").click(function(event){

        let divCreateCandidat = document.getElementById('creation');

        let labelField = document.createElement("input");
        labelField.setAttribute("type", "text");
        labelField.setAttribute("placeholder", "Label :");

        let dateField = document.createElement("input");
        dateField.setAttribute("type", "date");
        dateField.setAttribute("placeholder", "Date de la journée :");

        let buttonValidate = document.createElement("button");
        buttonValidate.setAttribute("id", "validateButton");
        buttonValidate.innerHTML = "Valider";

        buttonValidate.onclick = function(event) {
            $.ajax({
                data : {method : "createInformationDay", label : labelField.value, date : dateField.value},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                    
                }
            });
        };

        divCreateCandidat.appendChild(labelField);

        divCreateCandidat.appendChild(dateField);

        divCreateCandidat.appendChild(buttonValidate);
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
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                   
                }
            });
        };

        buttonSuppr.onclick = function(event){
            $.ajax({
                data : {method : "deleteInformationDay",  id : id},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                   
                }
            });
        };
    });

    $(".showCandidate").click(function(index){
        let id_informationDay = $(this).val();
        $.ajax({
        data : {method : "getCandidateByInformationDay",  informationDay_ID : id_informationDay},
        type : "post",
        url : "./app/view/assets/js/fonctionJs.php",
            success: function(response) 
            {
                let candidate = JSON.parse(response),
                candidateList = document.getElementById("candidateList");

                $.each(candidate, function(index, val){
                    let id = val[0],
                    candidateName = document.createElement("p");
                    candidateName.innerHTML = val[1];

                    let buttonSupprCandidate = document.createElement("button");
                    buttonSupprCandidate.setAttribute("value", val[0]);
                    buttonSupprCandidate.innerHTML = "Delete";

                    candidateList.appendChild(candidateName);
                    candidateList.appendChild(buttonSupprCandidate);

                    buttonSupprCandidate.onclick = function(event){
                        $.ajax({
                            data : {method : "deleteCandidateInformationDay",  id : id},
                            type : "post",
                            url : "./app/view/assets/js/fonctionJs.php",
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
                            url : "./app/view/assets/js/fonctionJs.php",
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
                                    option.setAttribute('value', val[0]);
                                    option.innerHTML= val[1] + " " + val[2];
                                    dropdownCandidate.appendChild(option);

                                    option.onclick = function(event){
                                        $.ajax({
                                            data : {method : "addCandidateInInformationDay",  candidate_ID : option.value, informationDay_ID : id_informationDay},
                                            type : "post",
                                            url : "./app/view/assets/js/fonctionJs.php",
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