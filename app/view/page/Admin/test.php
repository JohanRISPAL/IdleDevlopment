<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageTest">Test</button>
		<button class="navButton" id="pageQuestion">Question</button>
		<button class="navButton" id="pageOrganisationQuestions">Organisation questions</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>
	<div class="col l8 offset-l2" id="buttonTestContainer">
		<?php
			foreach($test as $t){
				echo "<button class='buttonTest' value='". $t->getID() ."'>". $t->getLabel() ."</button>";
			}
		?>
		<button class="createTest">Créer un test</button>
	</div>
	<div class="col l8 offset-l2" id="testContainer">
		<input type='text' id="labelTest" placeholder="nom du test" disabled>
		<select  id="informationDay" disabled>
		</select>
		<button id="modifTestButton">Modifier</button>
		<button id="confirmModifTestButton">Valider</button>
		<button id="supprTestButton">Supprimer</button>
		<button id="addQuestionButton">Ajouter des questions</button>
	</div>
	<div class="col l8 offset-l2" id="creationTestContainer">
	</div>
	<div class="col l8 offset-l2" id="addQuestion">
		<select  id="question">
		</select>
	</div>
	<div class="col l8 offset-l2" id="questionContainer">
		
	</div>
</div>
