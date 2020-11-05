<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageCandidat">Candidat</button>
		<button class="navButton" id="pageInfoDay">Journée d'information</button>
		<button class="navButton" id="pagePlanning">Planning</button>
		<button class="navButton" id="pageResultat">Résultat</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>

	<div class="col l12" id="topPage">
		<h1 class="col l10">Liste des candidats</h1>
		<button class="col l1 offset-l1" id="createCandidat"><i class="material-icons">add</i></button>
	</div>

	<div class="col l8 offset-l2" id="candidatList">
		<?php
			foreach ($allCandidat as $c){
				echo "<p>Nom : </p>";
				echo '<input type="text" id="name'.$c->getID().'" disabled value="'. $c->getName().'">';
				echo "<p>Prénom : </p>";
				echo '<input type="text" id="firstName'.$c->getID().'" disabled value="'. $c->getFirstName().'">';
				echo "<p>Date de naissance : </p>";
				echo '<input type="date" id="birthday'.$c->getID().'" disabled value="'. $c->getBirthday().'">';
				echo "<p>Numéro Pole emploi : </p>";
				echo '<input type="text" id="poleEmploiNumber'.$c->getID().'" disabled value="'. $c->getPoleEmploiNumber().'">';
				echo "<button class='modifButtonCandidat' value='".$c->getID()."'><i class='material-icons'>mode_edit</i></button>";
				echo "<button class='confirmModifCandidat' id='confirmModifCandidat".$c->getID()."'><i class='material-icons'>check</i></button>";
				echo "<button class='supprCandidat' id='supprCandidat".$c->getID()."'><i class='material-icons'>close</i></button>";
			}
		?>
	</div>

	<div class="col l8 offset-l2" id="creation">

	</div>
</div>