<div class="row">
	<div class="col l12" id="navBar">
		<button class="navButton" id="pageTest">Test</button>
		<button class="navButton" id="pageQuestion">Question</button>
		<button class="navButton" id="pageOrganisationQuestions">Organisation questions</button>
		<button class="navButton" id="deconnexion"><i class="medium material-icons">power_settings_new</i></button>
	</div>
	<div class="col l6" id="containerDomain">
		<h1>Liste des domaines de questions</h1>
		<button id="addDomain">Ajouter un domain</button>
		<?php
			if(!empty($domains)){
				foreach($domains as $d){
					echo "<input id='label".$d->getID()."'type='text' disabled value='". $d->getLabel()."'>";
					echo "<button class='modifDomain' value='".$d->getID()."'>Modifier</button>";
				}
			}else{
				echo "<p>Il n'y a pas encore de domaines créer</p>";
			}
		?>
	</div>
	<div class="col l6" id="containerLevel">
		<h1>Liste des niveaux de questions</h1>
		<button id="addLevel">Ajouter un niveau</button>
		<?php
			if(!empty($level)){
				foreach($level as $l){
					echo "<input id='label".$l->getID()."'type='text' disabled value='". $l->getLabel()."'>";
					echo "<button class='modifLevel' value='".$l->getID()."'>Modifier</button>";
				}
			}else{
				echo "<p>Il n'y a pas encore de niveaux créer</p>";
			}
		?>
	</div>
</div>