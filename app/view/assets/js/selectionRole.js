$( document ).ready(function(){
    $("#buttonCandidat").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=connexion&role=candidat";
    }); 

    $("#buttonAdmin").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=connexion&role=admin";
    });

    $("#buttonProjectManager").click(function(event){
        document.location.href="http://localhost/idleDevlopment/index.php?p=connexion&role=projectManager";
    });
});