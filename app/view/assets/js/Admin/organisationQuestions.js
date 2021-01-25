$( document ).ready(function(){

    let domainContainer = document.getElementById("containerDomain"),
    levelContainer = document.getElementById("containerLevel"),
    domainDisplay = document.getElementById("domainDisplay"),
    levelDisplay = document.getElementById("levelDisplay");

    //hide creation div
    $("#createDomainContainer").hide();
    $("#createLevelContainer").hide();

    //get all domains and display them
    $.ajax({
        data : {method : "getAllDomain"},
        type : "post",
        url : './app/model/Domain.php',
        success: function(answer){
            let domains = JSON.parse(answer);

            $.each(domains, function(index, val){
                //get domain's information
                let id = val["_id"],
                label = val["_label"];

                //create div, label and button
                let domainDiv = document.createElement("div"),
                domainLabel = document.createElement("label"),
                domainDeleteButton = document.createElement("button");

                //setAttribute on the label and the button
                domainLabel.innerHTML = label;

                domainDeleteButton.setAttribute("value", id);
                domainDeleteButton.setAttribute("class", "domainDeleteButton");
                domainDeleteButton.innerHTML = "Supprimer";

                //display variable in the page
                domainDiv.appendChild(domainLabel);
                domainDiv.appendChild(domainDeleteButton);

                domainDisplay.appendChild(domainDiv);
            });
        }
    });

    //create domain
    $("#addDomain").click(function(event){
        //show creation domain's div
        $("#createDomainContainer").show();

        $("#createDomainButton").click(function(event){
            //get the name of the new domain
            let domainLabel = $("#createDomainInput").val();

            //create this domain
            $.ajax({
                data : {method : "createDomain", label : domainLabel},
                type : "post",
                url : "./app/model/Domain.php",
                success: function(answer){   
                    let domain = JSON.parse(answer);

                    //add him on the page
                    // //create div, label and button
                    let domainDiv = document.createElement("div"),
                    domainLabel = document.createElement("label"),
                    domainDeleteButton = document.createElement("button");

                    //setAttribute on the label and the button
                    domainLabel.innerHTML = domain["_label"];

                    domainDeleteButton.setAttribute("value", domain["_id"]);
                    domainDeleteButton.setAttribute("class", "domainDeleteButton");
                    domainDeleteButton.innerHTML = "Supprimer";

                    //display variable in the page
                    domainDiv.appendChild(domainLabel);
                    domainDiv.appendChild(domainDeleteButton);

                    domainDisplay.appendChild(domainDiv);

                    //clean input
                    document.getElementById("createDomainInput").value = "";

                    //hide creation domain's div
                    $("#createDomainContainer").hide();
                }
            });
            
        })
   
    });

    //delete one domain
    $("#domainDisplay").on("click", ".domainDeleteButton", function(event){
        //get domain's id
        let domain_ID = $(this).val(),
        pressedButton = $(this);
        
        //delete this domain
        $.ajax({
            data : {method : "deleteDomain", domain_ID : domain_ID},
            type : "post",
            url : "./app/model/Domain.php",
            success: function(answer){
                pressedButton.parent().remove();
            }
        });
    });

    //get all levels and display them
    $.ajax({
        data : {method : "getAllLevel"},
        type : "post",
        url : './app/model/Level.php',
        success: function(answer){
            let levels = JSON.parse(answer);

            $.each(levels, function(index, val){
                //get domain's information
                let id = val["_id"],
                label = val["_label"];

                //create div, label and button
                let levelDiv = document.createElement("div"),
                levelLabel = document.createElement("label"),
                levelDeleteButton = document.createElement("button");

                //setAttribute on the label and the button
                levelLabel.innerHTML = label;

                levelDeleteButton.setAttribute("value", id);
                levelDeleteButton.setAttribute("class", "levelDeleteButton");
                levelDeleteButton.innerHTML = "Supprimer";

                //display variable in the page
                levelDiv.appendChild(levelLabel);
                levelDiv.appendChild(levelDeleteButton);

                levelDisplay.appendChild(levelDiv);
            });
        }
    });

    //create level
    $("#addLevel").click(function(event){
        //show creation level's div
        $("#createLevelContainer").show();

        $("#createLevelButton").click(function(event){
            //get the name of the new level
            let levelLabel = $("#createLevelInput").val();

            //create this domain
            $.ajax({
                data : {method : "createLevel", label : levelLabel},
                type : "post",
                url : "./app/model/Level.php",
                success: function(answer){   
                    let level = JSON.parse(answer);

                    //add him on the page
                    // //create div, label and button
                    let levelDiv = document.createElement("div"),
                    levelLabel = document.createElement("label"),
                    levelDeleteButton = document.createElement("button");

                    //setAttribute on the label and the button
                    levelLabel.innerHTML = level["_label"];

                    levelDeleteButton.setAttribute("value", level["_id"]);
                    levelDeleteButton.setAttribute("class", "levelDeleteButton");
                    levelDeleteButton.innerHTML = "Supprimer";

                    //display variable in the page
                    levelDiv.appendChild(levelLabel);
                    levelDiv.appendChild(levelDeleteButton);

                    levelDisplay.appendChild(levelDiv);

                    //clean input
                    document.getElementById("createLevelInput").value = "";

                    //hide creation domain's div
                    $("#createLevelContainer").hide();
                }
            });
            
        })
    });

    //delete one level
    $("#levelDisplay").on("click", ".levelDeleteButton", function(event){
        //get domain's id
        let level_ID = $(this).val(),
        pressedButton = $(this);
        
        //delete this domain
        $.ajax({
            data : {method : "deleteLevel", level_ID : level_ID},
            type : "post",
            url : "./app/model/Level.php",
            success: function(answer){
                pressedButton.parent().remove();
            }
        });
    });

});