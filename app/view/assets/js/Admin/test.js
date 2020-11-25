$( document ).ready(function(){
    let divCreationTest = document.getElementById("creationTestContainer"),
    divTest = document.getElementById("testContainer"),
    divAddQuestion = document.getElementById("addQuestion");
    divQuestionContainer = document.getElementById("questionContainer");

    let labelTest = document.getElementById("labelTest"),
    dropdownInformationDay = document.getElementById("informationDay"),
    buttonModif = document.getElementById("modifTestButton"),
    buttonValidateModif = document.getElementById("confirmModifTestButton"),
    buttonSuppr = document.getElementById("supprTestButton"),
    buttonAddQuestion = document.getElementById("addQuestionButton");

    let dropdownQuestion = document.getElementById("question");

    $("#labelTest").hide();
    dropdownInformationDay.style.opacity = 0;
    $("#modifTestButton").hide();
    $("#confirmModifTestButton").hide();
    $("#supprTestButton").hide();
    $("#addQuestionButton").hide();

    dropdownQuestion.style.opacity = 0;

    let test_ID = 0;

    $(".createTest").click(function(event){
        let labelTest = document.createElement("input");
        labelTest.setAttribute("type", "text");
        labelTest.setAttribute("placeholder", "Label du test");

        let dropdownInformationDay = document.createElement("select");

        $.ajax({
            data : {method : "getInformationDay"},
            type : "post",
            url : "./app/view/assets/js/fonctionJs.php",
            success: function(response)
            {
                let informationDay = JSON.parse(response);
                $.each(informationDay, function(index, val){
                    let option = document.createElement("option");
                    option.setAttribute('value', val[0]);
                    option.innerHTML= val[1] + " date : " + val[2];
                    dropdownInformationDay.appendChild(option);
                });
            }
        });

        let buttonConfirm = document.createElement("button");
        buttonConfirm.innerHTML = "Créer";
        
        divCreationTest.appendChild(labelTest);
        divCreationTest.appendChild(dropdownInformationDay);
        divCreationTest.appendChild(buttonConfirm);

        buttonConfirm.onclick = function(event){
            $.ajax({
                data : {method : "createTest", label : labelTest.value, informationDay_ID : dropdownInformationDay.value},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                    
                }
            });
        }
    });

    $(".buttonTest").click(function(event){
        test_ID = $(this).val();

        $("#labelTest").show();
        dropdownInformationDay.style.opacity = 1;
        $("#modifTestButton").show();
        $("#addQuestionButton").show();

        $.ajax({
            data : {method : "getTestByID", test_ID : test_ID},
            type : "post",
            url : "./app/view/assets/js/fonctionJs.php",
            success: function(response)
            {
                test = JSON.parse(response);
                labelTest.setAttribute("value", test[0][1]);
                $.ajax({
                    data : {method : "getInformationDayById", informationDay_ID : test[0][2]},
                    type : "post",
                    url : "./app/view/assets/js/fonctionJs.php",
                    success: function(response)
                    {
                        let informationDay = JSON.parse(response), 
                        option = document.createElement("option");
                        option.setAttribute('value', informationDay[0][0]);
                        option.innerHTML= informationDay[0][1] + " date : " + informationDay[0][2];
                        dropdownInformationDay.appendChild(option);
                    }
                });
            }
        });

        $.ajax({
            data : {method : "getQuestionByTest", test_ID : test_ID},
            type : "post",
            url : "./app/view/assets/js/fonctionJs.php",
            success: function(response)
            {
                if($(".labelQuestion") != null){
                    $(".labelQuestion").remove();
                }
                
                question = JSON.parse(response);

                $.each(question, function(index, val){
                    let div = document.createElement("div"),
                    labelQuestion = document.createElement("p"),
                    removeQuestion = document.createElement("button");

                    div.setAttribute("class", "labelQuestion");

                    labelQuestion.innerHTML = val[1];

                    removeQuestion.setAttribute("value", val[0]);
                    removeQuestion.innerHTML = "Enlever la question du test";

                    div.appendChild(labelQuestion);
                    div.appendChild(removeQuestion);
                    divQuestionContainer.appendChild(div);

                    removeQuestion.onclick = function(event){
                        let question_ID = $(this).val();
                        $.ajax({
                            data : {method : "removeQuestionTest", id : question_ID},
                            type : "post",
                            url : "./app/view/assets/js/fonctionJs.php",
                            success: function(response)
                            {
                                
                            }
                        });
                    };
                });

            }
        });

        buttonModif.onclick = function(event){
           $("#confirmModifTestButton").show();
            $("#supprTestButton").show();
            
            labelTest.removeAttribute("disabled");
            dropdownInformationDay.removeAttribute("disabled");

            $("#dropdownInformationDay option[value='1']").remove();

            $.ajax({
                data : {method : "getInformationDay"},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                    let informationDay = JSON.parse(response);
                    
                    $.each(informationDay, function(index, val){
                        let option = document.createElement("option");
                        option.setAttribute('value', val[0]);
                        option.setAttribute('id', "informationDay");
                        option.innerHTML= val[1] + " date : " + val[2];
                        dropdownInformationDay.appendChild(option);
                    });
                }
            });

            buttonValidateModif.onclick = function(event){
                $.ajax({
                    data : {method : "updateTest", label : labelTest.value, informationDay_ID : dropdownInformationDay.value, id : test_ID},
                    type : "post",
                    url : "./app/view/assets/js/fonctionJs.php",
                    success: function(response)
                    {
                        
                    }
                });
            }

            buttonSuppr.onclick = function(event){
                $.ajax({
                    data : {method : "deleteTest", id : test_ID},
                    type : "post",
                    url : "./app/view/assets/js/fonctionJs.php",
                    success: function(response)
                    {
                        
                    }
                });
            }
        }

        buttonAddQuestion.onclick = function(event){
            dropdownQuestion.style.opacity = 1;
            $.ajax({
                data : {method : "getQuestion"},
                type : "post",
                url : "./app/view/assets/js/fonctionJs.php",
                success: function(response)
                {
                    let question = JSON.parse(response);
                    $.each(question, function(index, val){
                        let option = document.createElement("option");
                        option.setAttribute('value', val[0]);
                        option.innerHTML= val[1];
                        dropdownQuestion.appendChild(option);

                        option.onclick = function(event){
                            $.ajax({
                                data : {method : "putQuestionInTest", test_ID : test_ID, id : $(this).val()},
                                type : "post",
                                url : "./app/view/assets/js/fonctionJs.php",
                                success: function(response)
                                {
                                    
                                }
                            });
                        }
                    });
                }
            });
        }
    });
});