<?php 
	include_once '../BD/PartenaireBD.php';
?>

<div id='footer'>
	<div id='partenaires'>
		<?php 
			$partenaireBD = new PartenaireBD('localhost', 'polyjoule', 'polyjoule', 'azerty');
			$tabPartenaires = $partenaireBD->getAllPartner();	// Tableau d'objets Partenaire
			
			foreach($tabPartenaires as $part)
			{
				// Affichage de suite de liens en images, � modifier
				echo('<a href='.$part->site.'><img href='.$part->logo.' alt='.$part->nom.'></a>');
			}
		?>
	</div>
	<span id='signature'>Polyjoule 2011 - All rights reserved</span>
</div>