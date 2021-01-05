<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageTestBegin">Test</button>
		<button class="navButton" id="pageResult">Résultat</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>

	<div class="col l8 offset-l2" id="beginContainer">
		<input type="hidden" id="candidate_ID" value="<?php echo $_SESSION["id"];?>">
	</div>
	<div class="col l8 offset-l2" id="testContainer">
	</div>
</div>