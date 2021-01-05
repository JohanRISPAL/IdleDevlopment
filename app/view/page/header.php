<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Idle Devlopment</title>
		<!-- import de font -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="./app/view/assets/css/navBar.css" media="all" />
		<?php 
		if(!(isset($_GET["p"]))){
			echo '<link rel="stylesheet" type="text/css" href="./app/view/assets/css/lobby.css" media="all" />';
		}

		if(isset($_GET["p"]) && $_GET["p"] == "connexion"){
			echo '<link rel="stylesheet" type="text/css" href="./app/view/assets/css/connexion.css" media="all" />';
		}

		if(isset($_GET["role"]) && $_GET["role"] == "admin"){
			echo '<link rel="stylesheet" type="text/css" href="./app/view/assets/css/Admin/test.css" media="all" />';
			echo '<link rel="stylesheet" type="text/css" href="./app/view/assets/css/Admin/question.css" media="all" />';
		}
		?>
		<link rel="stylesheet" type="text/css" href="./app/view/assets/css/informationDay.css" media="all" />
		<link rel="stylesheet" type="text/css" href="./app/view/assets/css/question.css" media="all" />
		<?php if(isset($_GET["p"]) && $_GET["p"] == "testStarted"){
			echo '<link rel="stylesheet" type="text/css" href="./app/view/assets/css/Candidat/testStarted.css" media="all" />';
		}?>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>