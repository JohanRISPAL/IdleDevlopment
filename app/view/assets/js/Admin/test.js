$( document ).ready(function(){

    //hide create test container and created test container
    $("#creationTestContainer").hide();
    $("#testCreatedContainer").hide();

    //get all test created
    $.ajax({
        data : {method : "getTest"},
        type : "post",
        url : "./app/model/Test.php",
        success: function(answer){
            //get tests
            let tests = JSON.parse(answer);

            //create the button for the tests and add them in DOM
            $.each(tests, function(index, val){
                let button = document.createElement("button");

                //set value in button
                button.setAttribute("value", val["_id"]);
                button.setAttribute("id", "buttonDisplayTest");
                button.innerHTML = val["_label"];

                document.getElementById("buttonTestContainer").appendChild(button);
            });
            
        }
    });

    //display test's information
    $("#buttonTestContainer").on("click", "#buttonDisplayTest", function(event){
        //hide create test container and show created test container
        $("#creationTestContainer").hide();
        $("#testCreatedContainer").show();
        //hide action's button;
        $("#confirmModifTestButton").hide();
        $("#supprTestButton").hide();

        //hide question's dropdown
        $("#addQuestion").hide();

        //clear question's dropdown
        $("#question").empty();

        //clear question container
        $("#questionContent").empty();

        //get test's id
        let test_ID = $(this).val();

        //set the id in the button value
        document.getElementById("confirmModifTestButton").setAttribute("value", test_ID);
        document.getElementById("supprTestButton").setAttribute("value", test_ID);
        document.getElementById("addQuestionButton").setAttribute("value", test_ID);

        //set the id in the dropdown
        document.getElementById("question").setAttribute("value", test_ID);

        //get test's information
        $.ajax({
            data : {method : "getTestByID", test_ID : test_ID},
            type : "post",
            url : "./app/model/Test.php",
            success: function(answer){
                //get the test
                let test = JSON.parse(answer);

                //set the value in fields
                document.getElementById("labelTestCreated").setAttribute("value", test[0]["_label"]);

                //get the information day
                let informationDay_ID = test[0]["_informationDay_ID"];

                $.ajax({
                    data : {method : "getInformationDayById", informationDay_ID : informationDay_ID},
                    type : "post",
                    url : "./app/model/InformationDay.php",
                    success: function(answer){
                        //get informationDay's information
                        let informationDay = JSON.parse(answer);

                        //create the option and add in the dropdown
                        let option = document.createElement("option");
                        option.setAttribute("value", informationDay[0]["_id"]);
                        option.innerHTML = informationDay[0]["_label"];

                        document.getElementById("informationDayTestCreated").appendChild(option);
                    }
                });
            }
        });

        //get test's questions
        $.ajax({
            data : {method : "getQuestionByTest", test_ID : test_ID},
            type : "post",
            url : "./app/model/Question.php",
            success: function(answer){
                //get the question
                let question = JSON.parse(answer);

                //create element to add this question in DOM
                let div = document.createElement("div"),
                label = document.createElement("label"),
                button = document.createElement("button");

                label.innerHTML = question[0]["_label"];

                button.setAttribute("value", question[0]["_id"]);
                button.setAttribute("id", "removeQuestion");
                button.innerHTML = "Supprimer";

                div.appendChild(label);
                div.appendChild(button);

                document.getElementById("questionContent").appendChild(div);
            }
        });
    });

    $("#modifTestButton").click(function(event){
        //hide this button
        $("#modifTestButton").hide();
        //show action's button
        $("#confirmModifTestButton").show();
        $("#supprTestButton").show();

        //remove disabled on fields
        document.getElementById("labelTestCreated").removeAttribute("disabled");
        document.getElementById("informationDayTestCreated").removeAttribute("disabled");

        let informationDay_ID = $("#informationDayTestCreated").prop("selectedIndex", 0).val();

        $.ajax({
            data : {method : "getOtherInformationDay", informationDay_ID : informationDay_ID},
            type : "post",
            url : "./app/model/InformationDay.php",
            success: function(answer){
                //get all informationDays
                let informationDays = JSON.parse(answer);

                //create an option and add it in the dropdown
                $.each(informationDays, function(index, val){
                    let option = document.createElement("option");
                    option.setAttribute("value", val["_id"]);
                    option.innerHTML = val["_label"];

                    document.getElementById("informationDayTestCreated").appendChild(option);       
                });
            }
        });
    });

    //confirm the modification
    $("#confirmModifTestButton").click(function(event){
        //get the information
        let test_ID = $(this).val(),
        label = document.getElementById("labelTestCreated").value,
        informationDay_ID = document.getElementById("informationDayTestCreated").value;

        $.ajax({
            data : {method : "updateTest", label : label, informationDay_ID : informationDay_ID, id : test_ID},
            type : "post",
            url : "./app/model/Test.php",
            success: function(answer){
                //hide the div
                $("#creationTestContainer").hide();

                //set disabled on fields
                document.getElementById("labelTestCreated").setAttribute("disabled", true);
                document.getElementById("informationDayTestCreated").setAttribute("disabled", true);
            }
        });
    });

    //delete the test
    $("#supprTestButton").click(function(event){
        //get the information
        let test_ID = $(this).val();

        $.ajax({
            data : {method : "deleteTest", id : test_ID},
            type : "post",
            url : "./app/model/Test.php",
            success: function(answer){
                //remove the button of the test
                $('button[id="buttonDisplayTest"][value="'+test_ID+'"]').remove();

                //hide the div
                $("#creationTestContainer").hide();

                //set disabled on fields
                document.getElementById("labelTestCreated").setAttribute("disabled", true);
                document.getElementById("informationDayTestCreated").setAttribute("disabled", true);
            }
        });
    });

    //show add question container
    $("#addQuestionButton").click(function(event){
        //show question's dropdown
        $("#addQuestion").show();

        $.ajax({
            data : {method : "getQuestionWithoutTest"},
            type : "post",
            url : "./app/model/Question.php",
            success: function(answer){
                //get questions
                let questions = JSON.parse(answer);

                $.each(questions, function(index, val){
                    let option = document.createElement("option");
                    option.setAttribute("id", "questionWithoutTest");
                    option.setAttribute("value", val["_id"]);
                    option.innerHTML = val["_label"];

                    document.getElementById("question").appendChild(option);       
                });
            }
        });
    });

    //add question in test
    $("#question").on("click","#questionWithoutTest",function() {
        //get question's id
        let question_ID = $(this).val();

        //get test's id
        let test_ID = $("#question").attr("value");

        $.ajax({
            data : {method : "putQuestionInTest", test_ID : test_ID, id : question_ID},
            type : "post",
            url : "./app/model/Question.php",
            success: function(answer){
                //get the question
                let question = JSON.parse(answer);

                //create element to add this question in DOM
                let div = document.createElement("div"),
                label = document.createElement("label"),
                button = document.createElement("button");

                label.innerHTML = question[0]["_label"];

                button.setAttribute("value", question[0]["_id"]);
                button.setAttribute("id", "removeQuestion");
                button.innerHTML = "Supprimer";

                div.appendChild(label);
                div.appendChild(button);

                document.getElementById("questionContent").appendChild(div);
            }
        });

        //remove the question
        $(this).remove();
    });

    //remove question of test
    $("#questionContent").on("click","#removeQuestion",function() {
        let buttonPressed = $(this);

        //get question's id
        let question_ID = $(this).val()
        
        $.ajax({
            data : {method : "removeQuestionTest", id : question_ID},
            type : "post",
            url : "./app/model/Question.php",
            success: function(answer){
                buttonPressed.parent().remove();
            }
        });
    });

    //display div creation test
    $(".createTest").click(function(event){
        //show create test container and hide created test container
        $("#creationTestContainer").show();
        $("#testCreatedContainer").hide();

        //get all informationDay
        $.ajax({
            data : {method : "getInformationDay"},
            type : "post",
            url : "./app/model/InformationDay.php",
            success: function(answer){
                //get the answer
                let informationDays = JSON.parse(answer);

                //create an option and add it in the dropdown
                $.each(informationDays, function(index, val){
                    let option = document.createElement("option");
                    option.setAttribute("value", val["_id"]);
                    option.innerHTML = val["_label"];

                    document.getElementById("informationDayDropdown").appendChild(option);       
                });
            }
        });
    });

    //create test
    $("#testCreate").click(function(event){
        //get the value of fields
        let label = document.getElementById("testLabel").value,
        informationDay_ID = document.getElementById("informationDayDropdown").value;

        $.ajax({
            data : {method : "createTest", label : label, informationDay_ID : informationDay_ID},
            type : "post",
            url : "./app/model/Test.php",
            success: function(answer){
                //get the new test and add it in DOM
                let test = JSON.parse(answer);

                let button = document.createElement("button");
                button.setAttribute("id", "buttonDisplayTest");
                button.setAttribute("value", test[0]["_id"]);
                button.innerHTML = test[0]["_label"];

                document.getElementById("buttonTestContainer").appendChild(button);
            }
        });

        //hide the div
        $("#creationTestContainer").hide();

        //clear input value
        document.getElementById("testLabel").innerHTML = "";
    });

});