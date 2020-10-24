	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="./app/view/assets/js/selectionRole.js"></script>
	<?php 
		if(isset($_GET["role"])){

			if($_GET["role"] == "candidat"){
				echo '<script src="./app/view/assets/js/Candidat/connexion.js"></script>';
			}

			if($_GET["role"] == "admin"){
				echo '<script src="./app/view/assets/js/Admin/connexion.js"></script>';
			}

			if($_GET["role"] == "projectManager"){
				echo '<script src="./app/view/assets/js/ProjectManager/connexion.js"></script>';
				echo '<script src="./app/view/assets/js/ProjectManager/navBar.js"></script>';
			}
		}
	?>
</html>