$( document ).ready(function(){

    let test_ID = 0;

    $("#creationTestContainer").hide();
    $("#testContainer").hide();
    $("#addQuestion").hide();
    $("#questionContainer").hide();
    let informationDayDropdown = document.getElementById("informationDayDropdown"),
    questionDropdown = document.getElementById("question"),
    divButtonContainer = document.getElementById("buttonTestContainer"),
    divQuestionContainer = document.getElementById("questionContainer"),
    divQuestionContent = document.getElementById("questionContent"),
    testTitle = document.getElementById("testTitle");

    $.ajax({
        data : {method : "getTest"},
        type : "post",
        url : "./app/model/Test.php",
        success: function(response)
        {
            let tests = JSON.parse(response);
            $.each(tests, function(index, val){
                let buttonTest = document.createElement("button");
                buttonTest.setAttribute("value", val["_id"]);
                buttonTest.setAttribute("class", "buttonTest");
                buttonTest.innerHTML = val["_label"];

                divButtonContainer.appendChild(buttonTest);
            });

            $(".createTest").click(function(event){
                $("#creationTestContainer").show();
                $("#testContainer").hide();
                $.ajax({
                    data : {method : "getInformationDay"},
                    type : "post",
                    url : "./app/model/InformationDay.php",
                    success: function(response)
                    {
                        let informationDay = JSON.parse(response);
                        $.each(informationDay, function(index, val){
                            let option = document.createElement("option");
                            option.setAttribute('value', val["_id"]);
                            option.innerHTML= val["_label"] + " date : " + val["_dateOfDay"];
                            informationDayDropdown.appendChild(option);
                        });
                    }
                });

                $("#testCreate").click(function(event){
                    $.ajax({
                        data : {method : "createTest", label : labelTest.value, informationDay_ID : informationDayDropdown.value},
                        type : "post",
                        url : "./app/model/Test.php",
                        success: function(response)
                        {
                            let test = JSON.parse(response);

                            buttonTestCreated.setAttribute("value", test[0][0]);
                            buttonTestCreated.setAttribute("class", "buttonTest");
                            buttonTestCreated.innerHTML = test[0][1];

                            divButtonContainer.appendChild(buttonTestCreated);
                        }
                    });
                });
            });

            $("#buttonTestContainer").on("click", ".buttonTest", function(event){
                $("#creationTestContainer").hide();
                $("#testContainer").show();
                $("#questionContainer").show();
                $("#confirmModifTestButton").hide();
                $("#supprTestButton").hide();
                test_ID = $(this).val();

                $.ajax({
                    data : {method : "getTestByID", test_ID : test_ID},
                    type : "post",
                    url : "./app/model/Test.php",
                    success: function(response)
                    {
                        test = JSON.parse(response);
                        labelTest.setAttribute("value", test[0]["_label"]);
                        testTitle.innerHTML = test[0]["_label"];
                        $.ajax({
                            data : {method : "getInformationDayById", informationDay_ID : test[0]["_informationDay_ID"]},
                            type : "post",
                            url : "./app/model/InformationDay.php",
                            success: function(response)
                            {
                                let informationDay = JSON.parse(response), 
                                option = document.createElement("option");
                                option.setAttribute('value', informationDay[0]["_id"]);
                                option.innerHTML= informationDay[0]["_label"] + " date : " + informationDay[0]["_dateOfDay"];
                                informationDayDropdown.appendChild(option);
                            }
                        });
                    }
                });

                $.ajax({
                    data : {method : "getQuestionByTest", test_ID : test_ID},
                    type : "post",
                    url : "./app/model/Question.php",
                    success: function(response)
                    {
                        if($(".labelQuestion") != null){
                            $(".labelQuestion").remove();
                        }

                        question = JSON.parse(response);
                        let counter = 1;

                        $.each(question, function(index, val){
                            let div = document.createElement("div"),
                            numberQuestion = document.createElement("label"),
                            labelQuestion = document.createElement("p"),
                            removeQuestion = document.createElement("button");

                            div.setAttribute("class", "labelQuestion");

                            numberQuestion.innerHTML = "Question " + counter;
                            labelQuestion.innerHTML = val["_label"];

                            removeQuestion.setAttribute("value", val["_id"]);
                            removeQuestion.innerHTML = "Enlever la question";

                            div.appendChild(numberQuestion);
                            div.appendChild(labelQuestion);
                            div.appendChild(removeQuestion);
                            divQuestionContent.appendChild(div);

                            removeQuestion.onclick = function(event){
                                let question_ID = $(this).val();
                                $.ajax({
                                    data : {method : "removeQuestionTest", id : question_ID},
                                    type : "post",
                                    url : "./app/model/Question.php",
                                    success: function(response)
                                    {
                                        div.remove();
                                    }
                                });
                            };

                            counter++;
                        });

                    }
                });

                $("#modifTestButton").click(function(event){
                    $("#confirmModifTestButton").show();
                    $("#supprTestButton").show();
                    
                    labelTest.removeAttribute("disabled");
                    informationDayDropdown.removeAttribute("disabled");

                    $("#informationDay").find("option").get(0).remove();

                    $.ajax({
                        data : {method : "getInformationDay"},
                        type : "post",
                        url : "./app/model/InformationDay.php",
                        success: function(response)
                        {
                            informationDay = JSON.parse(response);
                            
                            $.each(informationDay, function(index, val){
                                let option = document.createElement("option");
                                option.setAttribute('value', val["_id"]);
                                option.setAttribute('id', "optionInformationDay");
                                option.innerHTML= val["_label"] + " date : " + val["_dateOfDay"];
                                informationDayDropdown.appendChild(option);
                            });
                        }
                    });

                    $("#confirmModifTestButton").click(function(event){
                        $.ajax({
                            data : {method : "updateTest", label : labelTest.value, informationDay_ID : informationDayDropdown.value, id : test_ID},
                            type : "post",
                            url : "./app/model/Test.php",
                            success: function(response)
                            {
                                
                            }
                        });
                    });

                    $("#supprTestButton").click(function(event){
                        $.ajax({
                            data : {method : "updateTest", label : labelTest.value, informationDay_ID : informationDayDropdown.value, id : test_ID},
                            type : "post",
                            url : "./app/model/Test.php",
                            success: function(response)
                            {
                                
                            }
                        });
                    });
                });

                
                $("#addQuestionButton").click(function(event){
                    $("#addQuestion").show();
                    $.ajax({
                        data : {method : "getQuestionWithoutTest"},
                        type : "post",
                        url : "./app/model/Question.php",
                        success: function(response)
                        {
                            let question = JSON.parse(response);
                            $.each(question, function(index, val){
                                let option = document.createElement("option");
                                option.setAttribute('value', val["_id"]);
                                option.innerHTML= val["_label"];
                                questionDropdown.appendChild(option);

                                option.onclick = function(event){
                                    $.ajax({
                                        data : {method : "putQuestionInTest", test_ID : test_ID, id : $(this).val()},
                                        type : "post",
                                        url : "./app/model/Question.php",
                                        success: function(response)
                                        {
                                            
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            });
        }
    });
});