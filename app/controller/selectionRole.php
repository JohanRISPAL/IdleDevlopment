<?php

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=idledevlopment;charset=utf8', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		include("./app/view/page/selectionRole.php");

	}catch(PDOException $e){
		echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
	}

?>