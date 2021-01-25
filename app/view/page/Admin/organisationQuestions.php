<section>
	<div class="row">
		<div class="col l12" id="navBar">
			<a href="http://localhost/idleDevlopment/index.php?p=test&role=admin">Test</a>
			<a href="http://localhost/idleDevlopment/index.php?p=question&role=admin">Question</a>
			<a href="http://localhost/idleDevlopment/index.php?p=organisationQuestions&role=admin">Organisation questions</a>
			<a href="http://localhost/idleDevlopment/index.php?checkDeco=true"><i class="small material-icons">power_settings_new</i></a>
		</div>
	</div>
</section>
<section>
	<div class="row">

		<!--Div contenant informations des domaines-->
		<div class="col l6" id="domainContainer">
			<h2 class="title">Liste des domaines</h2>
			<button class="addButton" id="addDomain"><i class="material-icons">add</i></button>
			<!--Div création domaine-->
			<div id="createDomainContainer">
				<label>Nom du domaine :</label>
				<input type="text" id="createDomainInput">
				<button id="createDomainButton">Créer</button>
			</div>
			<!--Fin div création domaine-->

			<!--Affichage domaines-->
			<div class="col l6" id="domainDisplay">
				<h2>Liste des domaines</h2>
			</div>
			<!--Fin affichage domaines-->
		</div>
		<!--Fin div contenant informations des domaines-->

		<!--Div contenant informations des niveaux-->
		<div class="col l6" id="levelContainer">
			<h2 class="title">Liste des Niveaux</h2>
			<button class="addButton" id="addLevel"><i class="material-icons">add</i></button>
			<!--Div création level-->
			<div id="createLevelContainer">
				<label>Nom du level :</label>
				<input type="text" id="createLevelInput">
				<button id="createLevelButton">Créer</button>
			</div>
			<!--Fin div création level-->

			<!--Affichage niveaux-->
			<div class="col l6" id="levelDisplay">
				<h2>Liste des niveaux</h2>
			</div>
			<!--Fin affichage niveaux-->
		</div>
		<!--Fin div contenant informations des niveaux-->
	</div>
</section>