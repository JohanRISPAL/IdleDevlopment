<section>
	<div class="row">
		<div class="col l12" id="navBar">
			<a href="http://localhost/idleDevlopment/index.php?p=test&role=admin">Test</a>
			<a href="http://localhost/idleDevlopment/index.php?p=question&role=admin">Question</a>
			<a href="http://localhost/idleDevlopment/index.php?p=organisationQuestions&role=admin">Organisation questions</a>
			<a href="http://localhost/idleDevlopment/index.php?checkDeco=true"><i class="small material-icons">power_settings_new</i></a>
		</div>
	</div>
</section>
<section>
	<div class="row">

		<!--Affichage des domaines-->
		<div class="col l6" id="containerDomain">
			<label class="titre">Liste des domaines</label>
			<button id="addDomain"><i class="material-icons">add</i></button>
			<?php
				//Remplissage dropdown de domaine
				if(!empty($domains)){
					foreach($domains as $d){
						echo "<input id='label".$d->getID()."'type='text' disabled value='". $d->getLabel()."'>";
						echo "<button class='modifDomain' value='".$d->getID()."'>Modifier</button>";
					}
				}else{
					echo "<p>Il n'y a pas encore de domaines créer</p>";
				}
				//Fin remplissage dropdown de domaine
			?>
		</div>
		<!--Fin affichage des domaines-->

		<!--Affichage des niveaux-->
		<div class="col l6" id="containerLevel">
			<label class="titre">Liste des Niveaux</label>
			<button id="addLevel"><i class="material-icons">add</i></button>
			<?php
				//Remplissage dropdown de niveau
				if(!empty($level)){
					foreach($level as $l){
						echo "<input id='label".$l->getID()."'type='text' disabled value='". $l->getLabel()."'>";
						echo "<button class='modifLevel' value='".$l->getID()."'>Modifier</button>";
					}
				}else{
					echo "<p>Il n'y a pas encore de niveaux créer</p>";
				}
				//Fin remplissage dropdown de niveau
			?>
		</div>
		<!--Fin affichage des niveaux-->
	</div>
</section>