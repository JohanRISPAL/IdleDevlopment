$( document ).ready(function(){

    $("#pageTest").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=test&role=admin";
    });

    $("#pageOrganisationQuestions").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=organisationQuestions&role=admin";
    });

    $("#pageQuestion").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=question&role=admin";
    });

    $("#deconnexion").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?checkDeco=true";
    });
});