<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageCandidat">Candidat</button>
		<button class="navButton" id="pageInfoDay">Journée d'information</button>
		<button class="navButton" id="pagePlanning">Planning</button>
		<button class="navButton" id="pageResultat">Résultat</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>

	<div class="col l8 offset-l2">
		<?php
			foreach($allInformationDay as $i){
				echo "<button class='buttonInformationDay' value='". $i->getID() ."'>". $i->getLabel() ."</button>";
			}
		?>
	</div>
	<div class="col l4 offset-l2" id="projectManagerContainer">
		<h4 id="title">Chef de projets responsable</h4>
	</div>
	<div class="col l8 offset-l2" id="candidateContainer">
		<h4 id="title">Les candidats</h4>
	</div>
</div>