$( document ).ready(function(){

    $("#pageCandidat").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=candidate&role=projectManager";
    });

    $("#pageInfoDay").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=infoDay&role=projectManager";
    });

    $("#pagePlanning").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=planing&role=projectManager";
    });

    $("#pageResultat").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=resultat&role=projectManager";
    });

    $("#deconnexion").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?checkDeco=true";
    });
});