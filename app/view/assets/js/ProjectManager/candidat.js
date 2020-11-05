$( document ).ready(function(){

    $(".confirmModif").hide();
    $(".supprDay").hide();

    $("#createCandidat").click(function(event){

        let divCreateCandidat = document.getElementById('creation');

        let nameField = document.createElement("input");
        nameField.setAttribute("type", "text");
        nameField.setAttribute("placeholder", "Nom :");

        let firstNameField = document.createElement("input");
        firstNameField.setAttribute("type", "text");
        firstNameField.setAttribute("placeholder", "Prénom :");

        let birthdayField = document.createElement("input");
        birthdayField.setAttribute("type", "date");
        birthdayField.setAttribute("placeholder", "Date de naissance :");

        let poleEmploiNumberField = document.createElement("input");
        poleEmploiNumberField.setAttribute("type", "text");
        poleEmploiNumberField.setAttribute("placeholder", "Numéro pole emploi :");

        let buttonValidate = document.createElement("button");
        buttonValidate.setAttribute("id", "validateButton");
        buttonValidate.innerHTML = "Valider";

        buttonValidate.onclick = function(event) {
            $.ajax({
                data : {method : "createCandidat", name : nameField.value, firstName : firstNameField.value, birthday : birthdayField.value, poleEmploiNumber : poleEmploiNumberField.value},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                    
                }
            });
        };

        divCreateCandidat.appendChild(nameField);

        divCreateCandidat.appendChild(firstNameField);

        divCreateCandidat.appendChild(birthdayField);

        divCreateCandidat.appendChild(poleEmploiNumberField);

        divCreateCandidat.appendChild(buttonValidate);
    });

     $(".modifButtonCandidat").click(function(index){
        let name = document.getElementById("name" + $(this).val()),
        firstName = document.getElementById("firstName" + $(this).val()),
        birthday = document.getElementById("birthday" + $(this).val()),
        poleEmploiNumber = document.getElementById("poleEmploiNumber" + $(this).val()),
        buttonConfirm = document.getElementById("confirmModifCandidat" + $(this).val()),
        buttonSuppr = document.getElementById("supprCandidat" + $(this).val()),
        id = $(this).val();
        
        name.removeAttribute("disabled");
        firstName.removeAttribute("disabled");
        birthday.removeAttribute("disabled");
        poleEmploiNumber.removeAttribute("disabled");
        buttonConfirm.style.removeProperty("display");
        buttonSuppr.style.removeProperty("display");

        buttonConfirm.onclick = function(event){
            $.ajax({
                data : {method : "updateCandidat", name : name.value, firstName : firstName.value, birthday : birthday.value, poleEmploiNumber : poleEmploiNumber.value, id : id},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                   
                }
            });
        };

        buttonSuppr.onclick = function(event){
            $.ajax({
                data : {method : "deleteCandidat",  id : id},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                   
                }
            });
        };
    });
});