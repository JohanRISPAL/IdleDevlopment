<section id="topPage">
	<div class="row">
		<div class="col l12" id="navBar">
			<a href="http://localhost/idleDevlopment/index.php?p=test&role=admin">Test</a>
			<a href="http://localhost/idleDevlopment/index.php?p=question&role=admin">Question</a>
			<a href="http://localhost/idleDevlopment/index.php?p=organisationQuestions&role=admin">Organisation questions</a>
			<a href="http://localhost/idleDevlopment/index.php?checkDeco=true"><i class="small material-icons">power_settings_new</i></a>
		</div>
	</div>
</section>
<section id="pageContent">
	<h1>Espace de gestion des tests</h1>
	<div class="row">
		<!--Div contenant les buttons pour afficher les tests ou en créer un-->
		<div class="col l2" id="buttonTestContainer">
			<h3>Tests créés</h3>
			<button class="createTest">Créer un test</button>
		</div>
		<!--Fin div contenant les buttons pour afficher les tests ou en créer un-->

		<!--Div contenant les éléments pour créer un test-->
		<div class="col l8" id="creationTestContainer">
			<h3>Création de test</h3>
			<div id="testLabelContainer">
				<p>Intitulé du test : </p>
				<input type="text" id="testLabel">
			</div>
			<div id="testInformationDay">
				<p>Journée d'information : </p>
				<select id="informationDayDropdown">
				</select>
			</div>
			<button id="testCreate">Créer le test</button>
		</div>
		<!--Fin div contenant les éléments pour créer un test-->

		<!--Div contenant l'affichage d'un test créé et l'ajout de question-->
		<div class="col l8" id="testCreatedContainer">
			<h3 id="testTitle"></h3>
			<div id="labelTestCreatedContainer">
				<p>Nom du test : </p>
				<input type='text' id="labelTestCreated" placeholder="nom du test" disabled>
			</div>
			<div id="informationDayTestCreatedContainer">
				<p>Journée d'information : </p>
				<select  id="informationDayTestCreated" disabled>
				</select>
			</div>
			<button id="modifTestButton">Modifier</button>
			<button id="confirmModifTestButton">Valider</button>
			<button id="supprTestButton">Supprimer</button>

			<div id="questionContainer">
				<h3>Questions dans le test</h3>
				<button id="addQuestionButton">Ajouter des questions</button>
				<div id="addQuestion">
					<select  id="question">
					</select>
				</div>
				<div id="questionContent">
				</div>
			</div>
		</div>
		<!--Div contenant l'affichage d'un test créé et l'ajout de question-->
	</div>
</section>