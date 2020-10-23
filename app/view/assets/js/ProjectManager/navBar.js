$( document ).ready(function(){

    $("#pageCandidat").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=candidat&role=projectManager";
    });

    $("#pageInfoDay").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=infoDay&role=projectManager";
    });

    $("#pagePlanning").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=planning&role=projectManager";
    });

    $("#pageResultat").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=resultat&role=projectManager";
    });

    $("#deconnexion").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=candidat&role=projectManager";
    });
});