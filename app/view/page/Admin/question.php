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

			<!--Div contenant tout les questions crées-->
			<div class="col l2" id="listQuestion">
				<h3>Liste des questions crées</h3>
				<button id="createQuestion">Créer une question</button>
			</div>
			<!--Fin div contenant tout les questions crées-->

			<!--Div contenant une question créée-->
			<div class="col l8" id="createdQuestionContainer">
				<!--Div contenant le label de la question créée -->
				<div id="labelCreatedQuestionContainer">
					<label>Intitulé de la question</label>
					</br><input class="inputField" type="text" id="labelCreatedQuestion" disabled>
				</div>
				<!--Fin div contenant le label de la question créée -->

				<!--Div contenant la checkbox pour rendre la question éliminatoire -->
				<div id="isEliminatoryCreatedContainer">
					<label>Question éliminatoire</label>
					<input type="checkbox" id="isELiminatoryCreatedCheckBox" disabled>
				</div>
				<!--Fin div contenant la checkbox pour rendre la question éliminatoire -->

				<!--Div contenant les listes de domaines et de niveaux-->
				<div id="dropdownCreatedQuestionContainer">
					<div id="dropdownDomainCreatedQuestionContainer">
						<label>Domaines :</label>
						<select id="dropdownDomainCreatedQuestion" disabled>
						</select>
					</div>
					<div id="dropdownLevelCreatedQuestionContainer">
						<label>Niveaux :</label>
						<select id="dropdownLevelCreatedQuestion" disabled>
						</select>
					</div>
				</div>
				<!--Fin div contenant les listes de domaines et de niveaux-->

				<!--Div contenant toutes les réponses créées-->
				<div id="answerCreatedContainer">
					<!--Div contenant la réponse 1-->
					<div id="answer1CreatedContainer">
						<input type="hidden" id="hiddenAnswerCreated1">
						<label>Réponse 1 vraie</label>
						<input type="radio" name="radioAnswer" id="radioAnswerCreated1" value="1" disabled>
						</br><input  class="inputField" type="text" id="labelAnswerCreated1" placeholder="Réponse 1" disabled>
					</div>
					<!--Fin div contenant la réponse 1-->

					<!--Div contenant la réponse 2-->
					<div id="answer2CreatedContainer">
						<input type="hidden" id="hiddenAnswerCreated2">
						<label>Réponse 2 vraie</label>
						<input type="radio" name="radioAnswer" id="radioAnswerCreated2" value="2" disabled>
						</br><input class="inputField" type="text" id="labelAnswerCreated2" placeholder="Réponse 2" disabled>
					</div>
					<!--Fin div contenant la réponse 2-->

					<!--Div contenant la réponse 3-->
					<div id="answer3CreatedContainer">
						<input type="hidden" id="hiddenAnswerCreated3">
						<label>Réponse 3 vraie</label>
						<input type="radio" name="radioAnswer" id="radioAnswerCreated3" value="3" disabled>
						</br><input class="inputField" type="text" id="labelAnswerCreated3" placeholder="Réponse 3" disabled>
					</div>
					<!--Fin div contenant la réponse 3-->

					<!--Div contenant la réponse 4-->
					<div id="answer4CreatedContainer">
						<input type="hidden" id="hiddenAnswerCreated4">
						<label>Réponse 4 vraie</label>
						<input type="radio" name="radioAnswer" id="radioAnswerCreated4" value="4" disabled>
						</br><input class="inputField" type="text" id="labelAnswerCreated4" placeholder="Réponse 4" disabled>
					</div>
					<!--Fin div contenant la réponse 4-->
				</div>
				<!--Fin div contenant toutes les réponses créées-->

				<!--Div contenant les bouttons d'action sur la question-->
				<button id="modifQuestion">Modifier la question</button>
				<button id="confirmModifQuestion">Confirmer</button>
				<button id="supprQuestion">Supprimer la question</button>
				<!--Fin div les bouttons d'action sur la question-->
			</div>
			<!--Fin div contenant une question créée-->

			<!--Div contenant la création d'une question-->
			<div class="col l8" id="createQuestionContainer">
				<!--Div contenant le label pour la question a créer-->
				<div id="labelQuestionContainer">
					<label>Intitulé de la question</label>
					</br><input class="inputField" type="text" id="labelQuestion">
				</div>
				<!--Fin div contenant le label pour la question a créer-->

				<!--Div contenant la checkbox pour rendre la question éliminatoire-->
				<div id="isEliminatoryContainer">
					<label>Question éliminatoire</label>
					<input type="checkbox" id="isELiminatoryCheckBox">
				</div>
				<!--Fin div contenant la checkbox pour rendre la question éliminatoire-->


				<!--Div contenant les listes de domaines et de niveaux-->
				<div id="dropdownCreatedQuestionContainer">
					<div id="dropdownDomainContainer">
						<label>Domaines :</label>
						<select id="dropdownDomain">
						</select>
					</div>
					<div id="dropdownLevelContainer">
						<label>Niveaux :</label>
						<select id="dropdownLevel">
						</select>
					</div>
				</div>
				<!--Fin div contenant les listes de domaines et de niveaux-->

				<!--Div contenant toute les réponses à créées-->
				<div id="answerContainer">
					<!--Div contenant la réponse 1-->
					<div id="answer1Container" >
						<label>Réponse 1 : vraie </label>
						<input type="radio" name="radioAnswer" id="radioAnswer1" value="1">
						</br><input class="inputField" type="text" id="labelAnswer1" placeholder="Réponse 1">
					</div>
					<!--Fin div contenant la réponse 1-->

					<!--Div contenant la réponse 2-->
					<div id="answer2Container">
						<label>Réponse 2 : vraie </label>
						<input type="radio" name="radioAnswer" id="radioAnswer2" value="2">
						</br><input  class="inputField" type="text" id="labelAnswer2" placeholder="Réponse 2">
					</div>
					<!--Fin div contenant la réponse 2-->

					<!--Div contenant la réponse 3-->
					<div id="answer3Container">
						<label>Réponse 3 : vraie </label>
						<input type="radio" name="radioAnswer" id="radioAnswer3" value="3">
						</br><input class="inputField" type="text" id="labelAnswer3" placeholder="Réponse 3">
					</div>
					<!--Fin div contenant la réponse 3-->

					<!--Div contenant la réponse 4-->
					<div id="answer4Container">
						<label>Réponse 4 : vraie </label>
						<input type="radio" name="radioAnswer" id="radioAnswer4" value="4">
						</br><input class="inputField" type="text" id="labelAnswer4" placeholder="Réponse 4">
					</div>
					<!--Fin div contenant la réponse 4-->
				</div>
				<!--Div contenant toute les réponses à créées-->

				<button class="buttonCreateQuestion">Créer la question</button>
			</div>
			<!--Fin div contenant la création d'une question-->
		</div>
	</div>
</section>