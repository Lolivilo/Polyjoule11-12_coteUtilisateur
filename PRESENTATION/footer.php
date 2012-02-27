<?php 
	include_once '../BD/PartenaireBD.php';
?>

<div id='footer'>
	<div id='partenaires'>
		<?php 
			$tabPartenaires = getAllPartners();		// Tableau d'objets Partenaire
			foreach($tabPartenaires as $part)
			{
				// Affichage de suite de liens en images, ˆ modifier
				echo('<a href='.$part->site.'><img href='.$part->logo.' alt='.$part->nom.'></a>');
			}
		?>
	</div>
	<span id='signature'>Polyjoule 2012 - All rights reserved</span>
</div>