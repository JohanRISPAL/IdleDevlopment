<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageCandidat">Candidat</button>
		<button class="navButton" id="pageInfoDay">Journée d'information</button>
		<button class="navButton" id="pagePlanning">Planning</button>
		<button class="navButton" id="pageResultat">Résultat</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>

	<div class="col l12" id="topPage">
		<h1 class="col l10">Liste des journées d'information</h1>
		<button class="col l1 offset-l1" id="createInformationDay"><i class="material-icons">add</i></button>
	</div>
	
	<div class="col l8 offset-l2" id="candidatList">
		<?php
			if(!empty($allInformationDay)){
				foreach ($allInformationDay as $i){
					echo "<p>Nom : </p>";
					echo '<input type="text" id="label'.$i->getID().'" disabled value="'. $i->getLabel().'">';
					echo "<p>Date : </p>";
					echo '<input type="date" id="date'.$i->getID().'" disabled value="'. $i->getDateOfTheDay().'">';
					echo "<button class='modifButton' value='".$i->getID()."'><i class='material-icons'>mode_edit</i></button>";
					echo "<button class='confirmModif' id='confirm".$i->getID()."'><i class='material-icons'>check</i></button>";
					echo "<button class='supprDay' id='suppr".$i->getID()."'><i class='material-icons'>close</i></button>";
				}
			}else{
				echo "Il n'y a pas encore de journée d'information !";
			}	
		?>
	</div>

	<div class="col l8 offset-l2" id="creation">

	</div>
</div>