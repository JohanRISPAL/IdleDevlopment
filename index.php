<?php
	session_start();

	if(isset($_GET['p'])){
		if(isset($_GET["role"]) & $_GET["role"] == "candidat"){
			include('./app/view/page/header.php');
			include('./app/controller/Candidat/'.$_GET['p'].'.php');
			include('./app/view/page/footer.php');
		}
		elseif(isset($_GET["role"]) & $_GET["role"] == "admin"){
			include('./app/view/page/header.php');
			include('./app/controller/Admin/'.$_GET['p'].'.php');
			include('./app/view/page/footer.php');
		}
		elseif(isset($_GET["role"]) & $_GET["role"] == "projectManager"){
			include('./app/view/page/header.php');
			include('./app/controller/ProjectManager/'.$_GET['p'].'.php');
			include('./app/view/page/footer.php');
		}

	}else{
		include('./app/view/page/header.php');
		include('./app/controller/selectionRole.php');
		include('./app/view/page/footer.php');
	}

?>