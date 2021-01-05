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
	<div class="row">
		<div class="col l12">
			<h1>Espaces questions</h1>
			<div class="col l2" id="buttonQuestionContainer">
				<h3>Liste des questions crées</h3>
				<button class="createButton">Créer une question</button>
			</div>
			<div class="col l8" id="questionContainer">
				<div class="labelQuestionContainer">
					<p>Intitulé de la question</p>
					<input type="text" id="labelQuestion" disabled>
				</div>

				<div class="isEliminatoryContainer">
					<p>Question éliminatoire</p>
					<input type="checkbox" id="isELiminatoryCheckBox" disabled>
				</div>

				<select id="dropdownDomainQuestion" disabled>
				</select>

				<select id="dropdownLevelQuestion" disabled>
				</select>

				<div class="answerContainer">
					<div class="answer1Container">
						<input type="hidden" id="hiddenAnswer1">
						<input type="radio" name="radioAnswer" id="radioAnswerCreated1" value="1" disabled>
						<p>Réponse 1 vraie</p>
						<input type="text" id="labelAnswerCreated1" placeholder="Réponse 1" disabled>
					</div>

					<div class="answer2Container">
						<input type="hidden" id="hiddenAnswer2">
						<input type="radio" name="radioAnswer" id="radioAnswerCreated2" value="2" disabled>
						<p>Réponse 2 vraie</p>
						<input type="text" id="labelAnswerCreated2" placeholder="Réponse 2" disabled>
					</div>

					<div class="answer3Container">
						<input type="hidden" id="hiddenAnswer3">
						<input type="radio" name="radioAnswer" id="radioAnswerCreated3" value="3" disabled>
						<p>Réponse 3 vraie</p>
						<input type="text" id="labelAnswerCreated3" placeholder="Réponse 3" disabled>
					</div>

					<div class="answer4Container">
						<input type="hidden" id="hiddenAnswer4">
						<input type="radio" name="radioAnswer" id="radioAnswerCreated4" value="4" disabled>
						<p>Réponse 4 vraie</p>
						<input type="text" id="labelAnswerCreated4" placeholder="Réponse 4" disabled>
					</div>
				</div>

				<button id="modifQuestion">Modidier la Question</button>
				<button id="confirmModifQuestion">Confirmer</button>
				<button id="supprQuestion">Supprimer la question</button>
			</div>
			<div class="col l8" id="createQuestionContainer">
				<div id="labelQuestionContainer">
					<p>Intitulé de la question</p>
					<input type="text" class="labelQuestion">
				</div>

				<div id="isEliminatoryContainer">
					<p>Question éliminatoire</p>
					<input type="checkbox" class="isELiminatoryCheckBox">
				</div>

				<select id="dropdownDomain">
				</select>

				<select id="dropdownLevel">
				</select>

				<div id="answerContainer">
					<div id="answer1Container">
						<input type="radio" name="radioAnswer" id="radioAnswer1" value="1">
						<p>Réponse 1 vraie</p>
						<input type="text" id="labelAnswer1" placeholder="Réponse 1">
					</div>

					<div id="answer2Container">
						<input type="radio" name="radioAnswer" id="radioAnswer2" value="2">
						<p>Réponse 2 vraie</p>
						<input type="text" id="labelAnswer2" placeholder="Réponse 2">
					</div>

					<div id="answer3Container">
						<input type="radio" name="radioAnswer" id="radioAnswer3" value="3">
						<p>Réponse 3 vraie</p>
						<input type="text" id="labelAnswer3" placeholder="Réponse 3">
					</div>

					<div id="answer4Container">
						<input type="radio" name="radioAnswer" id="radioAnswer4" value="4">
						<p>Réponse 4 vraie</p>
						<input type="text" id="labelAnswer4" placeholder="Réponse 4">
					</div>
				</div>

				<button class="buttonCreateQuestion">Créer la question</button>
			</div>
		</div>
	</div>
</section>