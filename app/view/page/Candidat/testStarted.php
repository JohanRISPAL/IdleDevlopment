<div class="row">
	<input type="hidden" id="test_ID" value="<?php echo $_GET["test_ID"] ?>">
	<input type="hidden" id="candidate_ID" value="<?php echo $_SESSION["id"] ?>">
	<div class="col l12" id="topPage">
		<label id="timer">Temps restant :</label>
		<h1 id="questionNumber">Question numéro 1</h1>
		<label id="advancement">Terminer à :</label>
	</div>
	<div class="col l8 offset-l2" id="questionContainer">
		<h3 id="question"></h3>
		<div class="answer1Container">
			<input type="radio" class="checkboxAnswer" name="checkboxAnswer" id="checkboxAnswer1"><p id="answer1"></p>
		</div>
		<div class="answer2Container">
			<input type="radio" class="checkboxAnswer" name="checkboxAnswer" id="checkboxAnswer2"><p id="answer2"></p>
		</div>
		<div class="answer3Container">
			<input type="radio" class="checkboxAnswer" name="checkboxAnswer" id="checkboxAnswer3"><p id="answer3"></p>
		</div>
		<div class="answer4Container">
			<input type="radio" class="checkboxAnswer" name="checkboxAnswer" id="checkboxAnswer4"><p id="answer4"></p>
		</div>
		<button id="nextQuestion">Question suivante</button>
	</div>
</div>