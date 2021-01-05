	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="./app/view/assets/js/selectionRole.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<?php 
		if(isset($_GET["role"]) AND isset($_GET["p"])){

			if($_GET["role"] == "candidat"){
				if($_GET["p"] == "connexion"){
					echo '<script src="./app/view/assets/js/Candidat/connexion.js"></script>';
				}
				elseif($_GET["p"] == "testBegin"){
					echo '<script src="./app/view/assets/js/Candidat/testBegin.js"></script>';
				}
				elseif($_GET["p"] == "testStarted"){
					echo '<script src="./app/view/assets/js/Candidat/testStarted.js"></script>';
				}
			}

			if($_GET["role"] == "admin"){
				if($_GET["p"] == "connexion"){
					echo '<script src="./app/view/assets/js/Admin/connexion.js"></script>';
				}
				elseif($_GET["p"] == "organisationQuestions"){
					echo '<script src="./app/view/assets/js/Admin/organisationQuestions.js"></script>';
				}
				elseif($_GET["p"] == "question"){
					echo '<script src="./app/view/assets/js/Admin/question.js"></script>';
				}
				elseif($_GET["p"] == "test"){
					echo '<script src="./app/view/assets/js/Admin/test.js"></script>';
				}
			}

			if($_GET["role"] == "projectManager"){
				if($_GET["p"] == "connexion"){
					echo '<script src="./app/view/assets/js/ProjectManager/connexion.js"></script>';
				}elseif($_GET["p"] == "candidat"){
					echo '<script src="./app/view/assets/js/ProjectManager/candidat.js"></script>';
				}elseif($_GET["p"] == "infoDay"){
					echo '<script src="./app/view/assets/js/ProjectManager/informationDay.js"></script>';
				}elseif($_GET["p"] == "planing"){
					echo '<script src="./app/view/assets/js/ProjectManager/planing.js"></script>';
				}elseif($_GET["p"] == "resultat"){
					
				}	
			}
		}
	?>
	</body>
</html>