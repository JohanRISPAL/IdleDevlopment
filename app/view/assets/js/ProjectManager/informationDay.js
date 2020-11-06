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
        id = $(this).val();
        $.ajax({
        data : {method : "getCandidateByInformationDay",  informationDay_ID : id},
        type : "post",
        url : "./app/view/assets/js/fonctionJs.php",
            success: function(response) 
            {
                let candidate = JSON.parse(response),
                candidateList = document.getElementById("candidateList");

                $.each(candidate, function(index, val){
                    let candidateName = document.createElement("p");
                    candidateName.innerHTML = val[1];

                    let buttonSupprCandidate = document.createElement("button");
                    buttonSupprCandidate.setAttribute("value", val[0]);
                    buttonSupprCandidate.innerHTML = "Delete";

                    candidateList.appendChild(candidateName);
                    candidateList.appendChild(buttonSupprCandidate);

                    
                });
            }
        });
    });
});