$( document ).ready(function(){

    $("#pageExamen").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=examen&role=admin";
    });

    $("#deconnexion").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?checkDeco=true";
    });
});